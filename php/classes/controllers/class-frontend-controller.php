<?php

namespace SSP_Transcripts\Controllers;

class Frontend_Controller extends Abstract_Controller {

	/**
	 * Init function.
	 */
	public function init() {
		add_filter( 'ssp_episode_meta_details', array( $this, 'display_link' ), 10, 3 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
	}

	public function enqueue_styles() {
		// Register it first, so Elementor widget could enqueue it later
		$settings = include( SSP_TRANSCRIPTS_PLUGIN_PATH . 'build/css/all.asset.php' );
		wp_register_style( 'ssp_transcripts', SSP_TRANSCRIPTS_PLUGIN_URL . 'build/css/all.css', array(), $settings['version'] );
	}

	public function is_elementor_page() {
		$elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

		return boolval( $elementor_page );
	}

	/**
	 * Add transcript download link to episode meta.
	 *
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

		$display_link_enabled = ssp_get_option( 'download_transcript_enabled', 'on' );

		if ( 'on' !== $display_link_enabled ) {
			return $meta;
		}

		$transcript_file = get_post_meta( $episode_id, 'transcript_file', true );

		if ( $transcript_file ) {
			$meta['transcript_file'] = sprintf( __( '%1$sDownload transcript%2$s', 'seriously-simple-transcripts' ), '<a href="' . esc_url( $transcript_file ) . '" target="_blank">', '</a>' );
		}

		return $meta;
	}
}
