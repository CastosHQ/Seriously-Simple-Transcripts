<?php

namespace SSP_Transcripts\Controllers;

class Assets_Controller extends Abstract_Controller {

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function init() {
		// Load admin Javascript
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10, 1 );
	}

	/**
	 * Load admin Javascript.
	 * @access  public
	 * @return  void
	 * @since   1.0.0
	 */
	public function admin_enqueue_scripts() {
		wp_register_script( $this->_token . '-admin', esc_url( $this->assets_url ) . 'js/admin' . $this->script_suffix . '.js', array( 'jquery' ), $this->_version );
		wp_enqueue_script( $this->_token . '-admin' );
	}
}
