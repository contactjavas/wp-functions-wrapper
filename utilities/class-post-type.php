<?php
/**
 * Post type utility.
 *
 * @package WPFW
 */

namespace Wpfw;

use Wpfw\Helpers\Post_Type_Helper;

/**
 * Class to manage post type utility.
 */
class Post_Type {

	/**
	 * Register new post type.
	 *
	 * @param string $singular_name The singular name.
	 * @param string $plural_name The plural name.
	 * @return object
	 */
	public static function register( $singular_name, $plural_name = '' ) {
		$object = new Post_Type_Helper();
		return $object->register( $singular_name, $plural_name );
	}

	/**
	 * Beautiful alias for "register".
	 *
	 * @param string $singular_name The singular name.
	 * @param string $plural_name The plural name.
	 * @return object
	 */
	public static function make( $singular_name, $plural_name = '' ) {
		return self::register( $singular_name, $plural_name );
	}
}
