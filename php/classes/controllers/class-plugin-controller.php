<?php

namespace SSP_Transcripts\Controllers;


class Plugin_Controller extends Abstract_Controller {

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function init() {
		register_activation_hook( $this->file, array( $this, 'install' ) );
		add_action( 'plugins_loaded', array( $this, 'load_localization' ) );
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

	/**
	 * Load plugin localisation
	 * @access  public
	 * @return  void
	 * @since   1.0.0
	 */
	public function load_localization() {
		load_plugin_textdomain( 'seriously-simple-transcripts', false, basename( $this->dir ) . '/languages/' );
	}
}
