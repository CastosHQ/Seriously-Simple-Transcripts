<?php

namespace SSP_Transcripts\Controllers;

use SSP_Transcripts\Handlers\Integrations_Handler;

class Integrations_Controller extends Abstract_Controller {

	/**
	 * @var     Integrations_Handler
	 * @access  public
	 * @since   1.1.0
	 */
	public $integrations_handler;

	/**
	 * Init function.
	 */
	public function init() {
		$this->init_integrations();
	}

	/**
	 * Initialize all the integrations.
	 *
	 * @return void
	 *
	 * @see Elementor_Widgets
	 */
	protected function init_integrations() {
		$integrations = array(
			'elementor' => 'SSP_Transcripts\Integrations\Elementor\Elementor_Widgets',
		);

		$this->integrations_handler = new Integrations_Handler( $integrations );
	}
}
