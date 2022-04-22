<?php

namespace SSP_Transcripts;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SSP_Transcripts {

	/**
	 * The single instance of SSP_Transcripts.
	 * @var    object
	 * @access  private
	 * @since    1.0.0
	 */
	private static $_instance = null;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $_version;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $_token;

	/**
	 * The main plugin file.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $file;

	/**
	 * The main plugin directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $dir;

	/**
	 * The plugin assets URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $assets_url;

	/**
	 * Suffix for Javascripts.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $script_suffix;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function __construct( $file = '', $version = '1.0.0' ) {
		// Load plugin constants
		$this->_version = $version;
		$this->_token   = 'ssp_transcripts';

		// Load plugin environment variables
		$this->file          = $file;
		$this->dir           = dirname( $this->file );
		$this->assets_url    = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );
		$this->script_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		register_activation_hook( $this->file, array( $this, 'install' ) );

		// Add custom field to episode data
		add_filter( 'ssp_episode_fields', array( $this, 'add_field' ), 10, 1 );

		// Add transcript download link to episode meta
		add_filter( 'ssp_episode_meta_details', array( $this, 'display_link' ), 10, 3 );

		// Load admin Javascript
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10, 1 );

		// Handle localisation
		add_action( 'plugins_loaded', array( $this, 'load_localisation' ) );
	}

	/**
	 * @param array $fields
	 *
	 * @return array
	 */
	public function add_field( $fields = array() ) {

		$new_fields = array();

		foreach ( $fields as $key => $data ) {
			$new_fields[ $key ] = $data;

			if ( 'audio_file' == $key ) {
				$new_fields['transcript_file'] = array(
					'name'        => __( 'Transcript file:', 'seriously-simple-transcripts' ),
					'description' => __( 'Upload the transcript file or paste the file URL here.', 'seriously-simple-transcripts' ),
					'type'        => 'file',
					'default'     => '',
					'section'     => 'info',
				);

				$meta_enabled = get_option( 'ss_podcasting_player_meta_data_enabled' );

				if ( ! $meta_enabled ) {
					$message                                      = __( 'To add a <strong>Download Transcript</strong> link, <a href="%s">Enable Player meta data</a>', 'seriously-simple-transcripts' );
					$message                                      = sprintf( $message, admin_url( 'edit.php?post_type=' . SSP_CPT_PODCAST . '&page=podcast_settings&tab=player-settings#player_meta_data_enabled' ) );
					$new_fields['transcript_file']['description'] .= '<br><div class="warning">' . $message . '</div>';
				}
			}
		}

		return $new_fields;
	}

	/**
	 * @param $meta
	 * @param $episode_id
	 * @param $context
	 *
	 * @return array
	 */
	public function display_link( $meta = array(), $episode_id = 0, $context = '' ) {

		if ( ! $episode_id ) {
			return $meta;
		}

		$transcript_file = get_post_meta( $episode_id, 'transcript_file', true );

		if ( $transcript_file ) {
			$meta['transcript_file'] = sprintf( __( '%1$sDownload transcript%2$s', 'seriously-simple-transcripts' ), '<a href="' . esc_url( $transcript_file ) . '" target="_blank">', '</a>' );
		}

		return $meta;
	}

	/**
	 * Load admin Javascript.
	 * @access  public
	 * @return  void
	 * @since   1.0.0
	 */
	public function admin_enqueue_scripts() {
		wp_register_script( $this->_token . '-admin', esc_url( $this->assets_url ) . 'js/admin' . $this->script_suffix . '.js', array( 'jquery' ), $this->_version );
		wp_enqueue_script( $this->_token . '-admin' );
	}

	/**
	 * Load plugin localisation
	 * @access  public
	 * @return  void
	 * @since   1.0.0
	 */
	public function load_localisation() {
		load_plugin_textdomain( 'seriously-simple-transcripts', false, basename( $this->dir ) . '/languages/' );
	}

	/**
	 * Main SSP_Transcripts Instance
	 *
	 * Ensures only one instance of SSP_Transcripts is loaded or can be loaded.
	 *
	 * @param string $file
	 * @param string $version
	 *
	 * @return SSP_Transcripts instance
	 * @since 1.0.0
	 * @static
	 */
	public static function instance( $file = '', $version = '1.0.0' ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $file, $version );
		}

		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	}

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @return  void
	 * @since   1.0.0
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  public
	 * @return  void
	 * @since   1.0.0
	 */
	private function _log_version_number() {
		update_option( $this->_token . '_version', $this->_version );
	}

}
