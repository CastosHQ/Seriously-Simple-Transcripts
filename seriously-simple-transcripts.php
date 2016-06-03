<?php
/*
 * Plugin Name: Seriously Simple Transcripts
 * Version: 1.0
 * Plugin URI: https://wordpress.org/plugins/seriously-simple-transcripts
 * Description: Add downloadable transcripts to your Seriously Simple Podcasting episodes.
 * Author: Hugh Lashbrooke
 * Author URI: https://hughlashbrooke.com/
 * Requires at least: 4.4
 * Tested up to: 4.5.2
 *
 * Text Domain: seriously-simple-transcripts
 *
 * @package WordPress
 * @author Hugh Lashbrooke
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'is_ssp_active' ) ) {
	require_once( 'ssp-includes/ssp-functions.php' );
}

if( is_ssp_active( '1.14' ) ) {

	// Load plugin class files
	require_once( 'includes/class-ssp-transcripts.php' );

	/**
	 * Returns the main instance of SSP_Transcripts to prevent the need to use globals.
	 *
	 * @since  1.0.0
	 * @return object SSP_Stats
	 */
	function SSP_Transcripts () {
		$instance = SSP_Transcripts::instance( __FILE__, '1.0.0' );
		return $instance;
	}

	SSP_Transcripts();

}