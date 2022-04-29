<?php

namespace SSP_Transcripts\Handlers;

use SSP_Transcripts\Interfaces\Controller;

/**
 * SSP Controllers Handler.
 * Stores all the controllers in one place.
 */
class Controllers_Handler {

	/**
	 * @var Controller[]
	 * */
	private $controllers;

	/**
	 * Init all the controllers.
	 * If you have a controller which expects dependencies, please initialize and set it manually.
	 *
	 * @param string[] $controllers
	 */
	public function __construct( $controllers ) {
		foreach ( $controllers as $id => $controller ) {
			$instance = new $controller;

			if ( $instance instanceof Controller ) {
				$this->set( $id, $instance );
				$instance->init();
			}
		}
	}

	/**
	 * @param $id
	 *
	 * @return mixed|null
	 */
	public function get( $id ) {
		return isset( $this->controllers[ $id ] ) ? $this->controllers['id'] : null;
	}

	/**
	 *
	 * @param string $id
	 * @param Controller $instance
	 *
	 * @return void
	 */
	public function set( $id, $instance ) {
		$this->controllers[ $id ] = $instance;
	}

	/**
	 * @return Controller[]
	 */
	public function get_all() {
		return $this->controllers;
	}
}
