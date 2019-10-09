<?php
/**
 * Admin Ajax utility.
 *
 * @package WPFW
 */

namespace Wpfw;

use Wpfw\Helpers\Admin_Ajax_Helper;

/**
 * Class to manage utility of admin ajax
 */
class Admin_Ajax {
	/**
	 * Register admin ajax.
	 *
	 * @param string $action The action to be registered to wp_ajax_.
	 * @return object
	 */
	public static function register( $action ) {
		$object = new Admin_Ajax_Helper();
		return $object->register( $action );
	}

	/**
	 * Beautiful alias for "register".
	 *
	 * @param string $action The action to be registered to wp_ajax_.
	 * @return object
	 */
	public static function make( $action ) {
		return self::register( $action );
	}
}
