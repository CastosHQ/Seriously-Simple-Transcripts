<?php

namespace SSP_Transcripts\Controllers;

class Episode_Fields_Controller extends Abstract_Controller {

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function init() {
		// Add custom field to episode data
		add_filter( 'ssp_episode_fields', array( $this, 'add_field' ), 10, 1 );
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
					$message = __( 'To add a <strong>Download Transcript</strong> link, <a href="%s">Enable Player meta data</a>', 'seriously-simple-transcripts' );
					$message = sprintf( $message, admin_url( 'edit.php?post_type=' . SSP_CPT_PODCAST . '&page=podcast_settings&tab=player-settings#player_meta_data_enabled' ) );

					$new_fields['transcript_file']['description'] .= '<br><div class="warning">' . $message . '</div>';
				}
			}
		}

		return $new_fields;
	}
}
