<?php

namespace SSP_Transcripts\Controllers;

class Feed_Controller extends Abstract_Controller {

	/**
	 * Init function.
	 */
	public function init() {
		add_action( 'ssp_feed_item_args', array( $this, 'add_feed_item_args' ), 10, 2 );
	}

	/**
	 * Adds transcript data (for podcast:transcript) to the feed.
	 *
	 * @see https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md
	 *
	 * @param array $args
	 * @param int $post_id
	 */
	public function add_feed_item_args( $args, $post_id ) {
		$transcript_file = get_post_meta( $post_id, 'transcript_file', true );

		$allowed_mime_types = array(
			'txt'  => 'text/plain',
			'html' => 'text/html',
			'vtt'  => 'text/vtt',
			'json' => 'application/json',
			'srt'  => 'application/x-subrip',
		);

		$ext = mb_strtolower( pathinfo( $transcript_file, PATHINFO_EXTENSION ) );

		if ( ! array_key_exists( $ext, $allowed_mime_types ) ) {
			return $args;
		}

		$mime_type = $allowed_mime_types[ $ext ];

		$args['transcript_url']  = $transcript_file;
		$args['transcript_mime'] = $mime_type;

		return $args;
	}
}
