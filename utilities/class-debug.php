<?php
/**
 * Debugging utility
 *
 * @package WPFW
 */

namespace Wpfw;

/**
 * Class to provide debugging utility
 *
 * Many operations are phpcs-ignored, because this class is just providing debugging utility,
 * not calling/ initializing directly
 */
class Debug {

	/**
	 * Readable var_dump
	 *
	 * @param mixed  $var The variable to be dumped.
	 * @param string $mode Var dump or print_r.
	 * @return void
	 */
	public static function dump( $var, $mode = 'var_dump' ) {
		echo '<pre>'; // phpcs:ignore
		if ( 'var_dump' === $mode ) {
			var_dump( $var ); // phpcs:ignore
		} elseif ( 'print_r' === $mode ) {
			print_r($var); // phpcs:ignore
		}
		echo '</pre>'; // phpcs:ignore
	}

	/**
	 * Print variable as JSON
	 *
	 * @param mixed $var The variable to be printed.
	 * @return void
	 */
	public static function print_as_json( $var ) {
		$var = wp_json_encode( $var, JSON_PRETTY_PRINT );
		echo '<pre>'; // phpcs:ignore
		echo $var; // phpcs:ignore
		echo '</pre>'; // phpcs:ignore
	}

	/**
	 * Log the variable
	 *
	 * @todo Handle the $file param
	 *
	 * @param mixed   $var The variable to be logged.
	 * @param boolean $file Whether to log it tp debug.log or custom file location.
	 * @return void
	 */
	public static function log( $var, $file = false ) {
		error_log( print_r( $var, true ) ); // phpcs:ignore
	}
}
