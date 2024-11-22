<?php
/*
 * Plugin Name: Seriously Simple Transcripts
 * Version: 1.1.1
 * Plugin URI: https://wordpress.org/plugins/seriously-simple-transcripts
 * Description: Add downloadable transcripts to your Seriously Simple Podcasting episodes.
 * Author: Castos
 * Author URI: https://www.castos.com/
 * Requires at least: 4.4
 * Tested up to: 6.1
 *
 * Text Domain: seriously-simple-transcripts
 *
 * @package WordPress
 * @author Hugh Lashbrooke, Sergiy Zakharchenko
 * @since 1.0.0
 */

namespace SSP_Transcripts;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SSP_TRANSCRIPTS_VERSION', '1.1.1' );
define( 'SSP_TRANSCRIPTS_PLUGIN_FILE', __FILE__ );
define( 'SSP_TRANSCRIPTS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SSP_TRANSCRIPTS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once __DIR__ . '/php/includes/ssp-functions.php';
require_once __DIR__ . '/autoloader.php';

if ( is_ssp_active( '1.14.8' ) ) {
	ssp_transcripts();
}
