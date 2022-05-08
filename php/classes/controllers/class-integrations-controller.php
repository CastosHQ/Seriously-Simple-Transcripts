<?php

namespace SSP_Transcripts\Controllers;

use SSP_Transcripts\Handlers\Integrations_Handler;
use SSP_Transcripts\Integrations\Elementor\Elementor_Integrator;
use SSP_Transcripts\Integrations\Gutenberg\Gutenberg_Integrator;

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
	 * @see Elementor_Integrator
	 * @see Gutenberg_Integrator
	 */
	protected function init_integrations() {
		$integrations = array(
			'elementor' => 'SSP_Transcripts\Integrations\Elementor\Elementor_Integrator',
			'gutenberg' => 'SSP_Transcripts\Integrations\Gutenberg\Gutenberg_Integrator',
		);

		$this->integrations_handler = new Integrations_Handler( $integrations );
	}
}
