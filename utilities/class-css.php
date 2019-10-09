<?php
/**
 * CSS enqueue utility.
 *
 * @package WPFW
 */

namespace Wpfw;

use Wpfw\Helpers\CSS_Helper;

/**
 * Class to manage utility of style enqueue.
 */
class CSS {
	/**
	 * Register a stylesheet.
	 *
	 * @param string $handle Name of the stylesheet. Should be unique.
	 * @return object Chaining css enqueue methods.
	 */
	public static function register( $handle ) {
		$object = new CSS_Helper();
		return $object->register( $handle );
	}

	/**
	 * Enqueue a stylesheet
	 *
	 * @param string $handle Name of the stylesheet. Should be unique.
	 * @return void
	 */
	public static function enqueue( $handle ) {
		wp_enqueue_style( $handle );
	}
}
