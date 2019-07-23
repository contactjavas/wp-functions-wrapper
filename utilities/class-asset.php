<?php
/**
 * Asset's utility
 *
 * @package WPFW
 */

namespace Wpfw;

/**
 * Automatically generate file name based on last modified time.
 *
 * E.g:
 * Asset::auto_version('css/style.css');
 * will generate something like 'css/style.1530734078.css'
 * The random number is the last modified time
 *
 * What is this for?
 * Sometimes we need to cache static assets for faster load speed via .htaccess
 * The static assets like css & js will be cached
 * The problem is, when those files are edited/ modified, they are still cached until user refreshes or even hard-reloads the page
 *
 * To solve it, this method adds "last modified time" before the extension
 * It could be like functions.1530734078.js or style.1530734078.css
 * (To make this work, we sill need to add a snippet to htaccess)
 *
 * This way, static assets will be cached AND no need to worry when you edit the file content
 * because it's auto renamed now :)
 *
 * But we need to insert some codes to htaccess
 * And apache-nginx based (like WP Engine) doesn't directly-support those codes
 */
class Asset {

	/**
	 * Auto versioning the asset.
	 * Not directly-supported in WP Engine.
	 *
	 * @param string $url Url of the asset.
	 * @return string
	 */
	public static function auto_version( $url ) {
		$site_url = get_site_url();

		if ( strpos( $url, $site_url ) === false ) {
			return $url;
		}

		$dir  = str_replace( $site_url . '/', ABSPATH, $url );
		$path = $dir;

		if ( ! file_exists( $dir ) ) {
			// phpcs:ignore
			trigger_error( esc_html( "The file $dir does not exist" ), E_USER_WARNING );
			return $url;
		}

		$ver  = '.' . date( 'YmdHis', filemtime( $dir ) );
		$path = pathinfo( $path );
		$name = $path['basename'];
		$arr  = explode( '.', $name );
		$end  = end( $arr );
		$file = str_replace( '.' . $end, $ver . '.' . $end, $name );

		$output = $path['dirname'] . '/' . $file;
		$output = str_replace( ABSPATH, '', $output );
		$output = $site_url . '/' . $output;

		clearstatcache();

		return $output;
	}

	/**
	 * Get last modified time
	 *
	 * @param string $url Url of the asset.
	 * @return string Last modified time.
	 */
	public static function get_modified_time( $url ) {
		$site_url = get_site_url();
		$base_dir = rtrim( ABSPATH, '/' );

		if ( strpos( $url, $site_url ) === false ) {
			return false;
		}
		$dir = str_replace( $site_url, $base_dir, $url );

		if ( ! file_exists( $dir ) ) {
			// phpcs:ignore
			trigger_error( esc_html( "The file $dir does not exist" ), E_USER_WARNING );
			return $url;
		}

		return date( 'YmdHis', filemtime( $dir ) );
	}
}
