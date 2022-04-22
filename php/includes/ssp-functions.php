<?php
/**
 * Functions used by plugins
 */

/**
 * SSP Detection
 */
if ( ! function_exists( 'is_ssp_active' ) ) {
	function is_ssp_active( $minimum_version = '' ) {
		return \SSP_Transcripts\SSP_Dependencies::ssp_active_check( $minimum_version );
	}
}
