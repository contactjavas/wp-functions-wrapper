<?php
/**
 * JS enqueue statical interface
 *
 * @package WPFW
 */

namespace Wpfw;

use Wpfw\Helpers\JS_Helper;

/**
 * Class to manage statical interface of script enqueue
 */
class JS {

	/**
	 * Register a script
	 *
	 * @param string $handle Name of the script. Should be unique.
	 * @return object Chaining js enqueue methods.
	 */
	public static function register( $handle ) {
		$object = new JS_Helper();
		return $object->register( $handle );
	}

	/**
	 * Localize global object to a specific script
	 * Wrapper for wp_localize_script
	 *
	 * @param string $handle Script handle which the data will be attached to.
	 * @param string $object_name Name for the JavaScript object.
	 * @param array  $object_value The data which can be either a single or multi-dimensional array.
	 * @return void
	 */
	public static function localize_global_object( $handle, $object_name, $object_value ) {
		wp_localize_script( $handle, $object_name, $object_value );
	}

	/**
	 * Add global object to a specific script
	 * Wrapper for wp_localize_script
	 *
	 * @param string $handle Script handle which the data will be attached to.
	 * @param string $object_name Name for the JavaScript object.
	 * @param array  $object_value The data which can be either a single or multi-dimensional array.
	 * @return void
	 */
	public static function add_global_object( $handle, $object_name, $object_value ) {
		wp_localize_script( $handle, $object_name, $object_value );
	}

	/**
	 * Output global object instead of localizing it to specific script
	 *
	 * @see See https://developer.wordpress.org/reference/classes/wp_scripts/localize/
	 *
	 * @param string $object_name Name for the JavaScript object.
	 * @param array  $object_value The data which can be either a single or multi-dimensional array.
	 * @return void
	 */
	public static function print_global_object( $object_name, $object_value ) {
		foreach ( $object_value as $key => $value ) {
			if ( ! is_scalar( $value ) ) {
				continue;
			}
			$object_value[ $key ] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8' );
		}

		$script  = '<script>';
		$script .= "var $object_name = " . wp_json_encode( $object_value ) . ';';
		$script .= '</script>';

		// phpcs:ignore
		echo $script;
	}

	/**
	 * Enqueue a script
	 *
	 * @param string $handle Name of the script. Should be unique.
	 * @return void
	 */
	public static function enqueue( $handle ) {
		wp_enqueue_script( $handle );
	}

	/**
	 * Deregister a script.
	 *
	 * @param string $handle Name of the script to be deregistered.
	 * @return void
	 */
	public static function deregister( $handle ) {
		wp_deregister_script( $handle );
	}

	/**
	 * Dequeue a script.
	 *
	 * @param string $handle Name of the script to be de-queued.
	 * @return void
	 */
	public static function dequeue( $handle ) {
		wp_dequeue_script( $handle );
	}
}
