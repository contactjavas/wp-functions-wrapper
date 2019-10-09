<?php
/**
 * Metabox utility
 *
 * @package WPFW
 */

namespace Wpfw;

use Wpfw\Helpers\Metabox_Helper;

/**
 * Class to manage metabox utility.
 */
class Metabox {

	/**
	 * Register new metabox.
	 *
	 * @param string $name The metabox id.
	 * @return object
	 */
	public static function register( $name ) {
		$object = new Metabox_Helper();
		return $object->register( $name );
	}

	/**
	 * Beautiful alias for "register".
	 *
	 * @param string $name The metabox id.
	 * @return object
	 */
	public static function make( $name ) {
		return self::register( $name );
	}
}
