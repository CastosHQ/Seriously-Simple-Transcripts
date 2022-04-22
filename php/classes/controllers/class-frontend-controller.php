<?php

namespace SSP_Transcripts\Controllers;

class Frontend_Controller extends Abstract_Controller {

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function init() {
		// Add transcript download link to episode meta
		add_filter( 'ssp_episode_meta_details', array( $this, 'display_link' ), 10, 3 );
	}

	/**
	 * @param $meta
	 * @param $episode_id
	 * @param $context
	 *
	 * @return array
	 */
	public function display_link( $meta = array(), $episode_id = 0, $context = '' ) {

		if ( ! $episode_id ) {
			return $meta;
		}

		$transcript_file = get_post_meta( $episode_id, 'transcript_file', true );

		if ( $transcript_file ) {
			$meta['transcript_file'] = sprintf( __( '%1$sDownload transcript%2$s', 'seriously-simple-transcripts' ), '<a href="' . esc_url( $transcript_file ) . '" target="_blank">', '</a>' );
		}

		return $meta;
	}
}
