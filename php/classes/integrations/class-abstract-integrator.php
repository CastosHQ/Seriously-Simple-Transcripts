<?php

namespace SSP_Transcripts\Integrations;

use SSP_Transcripts\Interfaces\Integration;

abstract class Abstract_Integrator implements Integration {

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );
	}

	public function on_plugins_loaded() {
		if ( $this->is_compatible() ) {
			add_action( 'init', array( $this, 'init' ) );
		}
	}

	abstract public function is_compatible();

	abstract public function init();
}
