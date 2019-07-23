<?php
/**
 * Taxonomy utility
 *
 * @package WPFW
 */

namespace Wpfw;

use Wpfw\Helpers\Taxonomy_Helper;

/**
 * Class to manage taxonomy utility
 */
class Taxonomy {

	/**
	 * Register new taxonomy
	 *
	 * @param string $singular_name The singular name.
	 * @param string $plural_name The plural name.
	 * @return object
	 */
	public static function register( $singular_name, $plural_name = '' ) {
		$object = new Taxonomy_Helper();
		return $object->register( $singular_name, $plural_name );
	}

	/**
	 * Beautiful alias for "register"
	 *
	 * @param string $singular_name The singular name.
	 * @param string $plural_name The plural name.
	 * @return object
	 */
	public static function make( $singular_name, $plural_name = '' ) {
		return self::register( $singular_name, $plural_name );
	}
}
