<?php
/**
 * Plugin Name: WordPress Functions Wrapper
 * Plugin URI:  https://github.com/contactjavas/wp-functions-wrapper
 * Description: WordPress functions wrapper for faster & simpler development.
 * Version:     0.0.1
 * Author:      Bagus
 * Author URI:  https://buatapp.com/
 * License:     MIT
 * License URI: https://oss.ninja/mit?organization=buatapp
 * Text Domain: wpfw
 *
 * @package WPFW
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

load_plugin_textdomain( 'wpfw', false, __DIR__ . '/languages' );

// identities constants.
define( 'WPFW_PLUGIN_VERSION', '0.0.1' );
define( 'WPFW_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'WPFW_PLUGIN_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );

require_once WPFW_PLUGIN_DIR . '/autoload.php';
