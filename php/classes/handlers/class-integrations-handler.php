<?php

namespace SSP_Transcripts\Handlers;

use SSP_Transcripts\Interfaces\Integration;

/**
 * SSP integrations Handler.
 * Stores all the integrations in one place.
 */
class Integrations_Handler {

	/**
	 * @var Integration[]
	 * */
	private $integrations;

	/**
	 * Init all the integrations.
	 * If you have a controller which expects dependencies, please initialize and set it manually.
	 *
	 * @param string[] $integrations
	 */
	public function __construct( $integrations ) {
		foreach ( $integrations as $id => $controller ) {
			$instance = new $controller;

			if ( $instance instanceof Integration ) {
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
		return isset( $this->integrations[ $id ] ) ? $this->integrations['id'] : null;
	}

	/**
	 *
	 * @param string $id
	 * @param Integration $instance
	 *
	 * @return void
	 */
	public function set( $id, $instance ) {
		$this->integrations[ $id ] = $instance;
	}

	/**
	 * @return Integration[]
	 */
	public function get_all() {
		return $this->integrations;
	}
}
