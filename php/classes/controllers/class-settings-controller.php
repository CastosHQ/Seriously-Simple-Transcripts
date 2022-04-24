<?php

namespace SSP_Transcripts\Controllers;

class Settings_Controller extends Abstract_Controller {

	/**
	 * Init function.
	 */
	public function init() {
		add_action( 'ssp_player_meta_settings', array( $this, 'modify_meta_settings' ) );
	}

	/**
	 * Modifies settings.
	 *
	 * @param array settings
	 */
	public function modify_meta_settings( $meta_settings ) {
		$meta_settings[] = array(
			'id'          => 'download_transcript_enabled',
			'label'       => __( 'Show download transcript link', 'seriously-simple-podcasting' ),
			'description' => __( 'Turn on to display the download transcript link', 'seriously-simple-podcasting' ),
			'type'        => 'checkbox',
			'default'     => 'on',
		);

		return $meta_settings;
	}
}
