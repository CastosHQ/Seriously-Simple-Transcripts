<?php

namespace SSP_Transcripts\Controllers;

class Assets_Controller extends Abstract_Controller {

	/**
	 * Init function.
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10, 1 );
	}

	/**
	 * Load admin JavaScript.
	 * @access  public
	 * @return  void
	 * @since   1.0.0
	 */
	public function admin_enqueue_scripts() {
		wp_register_script( $this->_token . '-admin', esc_url( $this->assets_url ) . 'js/admin' . $this->script_suffix . '.js', array( 'jquery' ), $this->_version );
		wp_enqueue_script( $this->_token . '-admin' );

		$ssp_post_types = ssp_post_types();
		$screen = get_current_screen();

		// Make sure sidebar script loads only on SSP posts.
		if ( 'post' != $screen->base || ! $screen->post_type ||
		     ! in_array( $screen->post_type, $ssp_post_types ) ) {
			return;
		}

		wp_enqueue_script( $this->_token . '-sidebar', SSP_TRANSCRIPTS_PLUGIN_URL . 'build/plugins/sidebar/index.js',
			array( 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data' ),
			$this->_version,
			true
		);
	}
}
