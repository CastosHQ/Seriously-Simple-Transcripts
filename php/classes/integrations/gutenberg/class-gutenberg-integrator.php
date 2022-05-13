<?php

namespace SSP_Transcripts\Integrations\Gutenberg;

use SSP_Transcripts\Integrations\Abstract_Integrator;

class Gutenberg_Integrator extends Abstract_Integrator {

	public function is_compatible() {
		// Gutenberg is a core feature, so always return true.
		return true;
	}

	public function init() {
		add_action( 'init', array( $this, 'init_blocks' ) );
	}

	public function init_blocks() {
		$blocks = $this->get_registered_blocks();

		foreach ( $blocks as $block_name => $block_id ) {
			register_block_type( SSP_TRANSCRIPTS_PLUGIN_PATH . 'build/blocks/' . $block_name );
		}
	}

	public function get_registered_blocks(){
		return array(
			'transcript' => 'create-block/castos-transcript',
		);
	}
}
