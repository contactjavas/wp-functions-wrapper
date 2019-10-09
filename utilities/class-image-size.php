<?php
/**
 * CSS enqueue utility.
 *
 * @package WPFW
 */

namespace Wpfw;

use Wpfw\Helpers\Image_Size_Helper;

/**
 * Class to manage utility of style enqueue.
 */
class Image_Size {

	/**
	 * Register image size.
	 *
	 * @param string $size_name Image size identifier.
	 * @return object
	 */
	public static function register( $size_name ) {
		$object = new Image_Size_Helper();
		return $object->register( $size_name );
	}
}
