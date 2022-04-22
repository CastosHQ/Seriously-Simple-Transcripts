<?php

namespace SSP_Transcripts\Controllers;

use SSP_Transcripts\Interfaces\Controller;

abstract class Abstract_Controller implements Controller {
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
	 * Suffix for JavaScripts.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $script_suffix;

	public function __construct() {
		$this->load_properties();
	}

	/**
	 * @return void
	 */
	protected function load_properties() {
		$this->_version = SSP_TRANSCRIPTS_VERSION;
		$this->file     = SSP_TRANSCRIPTS_PLUGIN_FILE;

		$this->_token        = 'ssp_transcripts';
		$this->dir           = dirname( $this->file );
		$this->assets_url    = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );
		$this->script_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	}
}
