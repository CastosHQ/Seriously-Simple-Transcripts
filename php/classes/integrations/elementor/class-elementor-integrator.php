<?php

namespace SSP_Transcripts\Integrations\Elementor;

use Elementor\Plugin as Elementor;
use SSP_Transcripts\Integrations\Abstract_Integrator;
use SSP_Transcripts\Integrations\Elementor\Widgets\Elementor_Transcripts_Widget;

class Elementor_Integrator extends Abstract_Integrator {

	/**
	 * Minimum Elementor Version
	 *
	 * @since 2.4
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	protected $template_importer;


	public function is_compatible() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			return false;
		}
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, $this::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			return false;
		}

		return true;
	}

	public function init() {
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'init_widgets' ) );
	}

	public function init_widgets() {
		Elementor::instance()->widgets_manager->register( new Elementor_Transcripts_Widget() );
	}
}
