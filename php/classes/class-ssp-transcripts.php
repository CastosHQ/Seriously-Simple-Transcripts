<?php

namespace SSP_Transcripts;

use SSP_Transcripts\Controllers\Assets_Controller;
use SSP_Transcripts\Controllers\Episode_Fields_Controller;
use SSP_Transcripts\Controllers\Frontend_Controller;
use SSP_Transcripts\Controllers\Integrations_Controller;
use SSP_Transcripts\Controllers\Plugin_Controller;
use SSP_Transcripts\Controllers\Settings_Controller;
use SSP_Transcripts\Handlers\Controllers_Handler;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Endpoint to run all the app controllers.
 * */
class SSP_Transcripts {

	/**
	 * The single instance of SSP_Transcripts.
	 * @var    object
	 * @access  private
	 * @since    1.0.0
	 */
	private static $_instance = null;

	/**
	 * @var     Controllers_Handler
	 * @access  public
	 * @since   1.1.0
	 */
	public $controllers_handler;


	/**
	 * Constructor function.
	 *
	 * @since   1.0.0
	 */
	protected function __construct() {
		$this->init_controllers();
	}

	/**
	 * Initialize all the controllers.
	 *
	 * @return void
	 *
	 * @see Assets_Controller
	 * @see Plugin_Controller
	 * @see Episode_Fields_Controller
	 * @see Frontend_Controller
	 * @see Feed_Controller
	 * @see Settings_Controller
	 * @see Integrations_Controller
	 *
	 * @see Assets_Controller
	 */
	protected function init_controllers() {
		$controllers = array(
			'assets'       => 'SSP_Transcripts\Controllers\Assets_Controller',
			'plugin'       => 'SSP_Transcripts\Controllers\Plugin_Controller',
			'fields'       => 'SSP_Transcripts\Controllers\Episode_Fields_Controller',
			'frontend'     => 'SSP_Transcripts\Controllers\Frontend_Controller',
			'feed'         => 'SSP_Transcripts\Controllers\Feed_Controller',
			'settings'     => 'SSP_Transcripts\Controllers\Settings_Controller',
			'integrations' => 'SSP_Transcripts\Controllers\Integrations_Controller',
		);

		$this->controllers_handler = new Controllers_Handler( $controllers );
	}


	/**
	 * Main SSP_Transcripts Instance
	 *
	 * Ensures only one instance of SSP_Transcripts is loaded or can be loaded.
	 *
	 * @return SSP_Transcripts|null instance
	 * @since 1.0.0
	 * @static
	 */
	public static function instance() {
		if ( ! defined( 'SSP_TRANSCRIPTS_PLUGIN_FILE' ) || ! defined( 'SSP_TRANSCRIPTS_VERSION' ) ) {
			return null;
		}

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
}
