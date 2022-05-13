<?php

use SSP_Transcripts\SSP_Transcripts;
use SSP_Transcripts\Handlers\SSP_Dependencies;

if ( ! function_exists( 'is_ssp_active' ) ) {
	function is_ssp_active( $minimum_version = '' ) {
		return SSP_Dependencies::ssp_active_check( $minimum_version );
	}
}

if ( ! function_exists( 'ssp_transcripts' ) ) {
	/**
	 * @return SSP_Transcripts|null
	 */
	function ssp_transcripts() {
		return SSP_Transcripts::instance();
	}
}
