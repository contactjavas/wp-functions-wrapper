<?php
/**
 * Admin ajax helper.
 *
 * @package WPFW
 */

namespace Wpfw\Helpers;

/**
 * Class to provide admin ajax methods.
 */
class Admin_Ajax_Helper {

	/**
	 * Item's id
	 *
	 * @var integer
	 */
	private $id = -1;

	/**
	 * Item's container.
	 *
	 * @var array
	 */
	private $items = [];

	/**
	 * Register action.
	 *
	 * @param string $action Action to be registered to wp_ajax_.
	 * @return object
	 */
	public function register( $action ) {
		$this->id++;
		$this->items[ $this->id ]               = [];
		$this->items[ $this->id ]['action']     = $action;
		$this->items[ $this->id ]['is_private'] = true;
		return $this;
	}

	/**
	 * Set the request as public.
	 *
	 * @return object
	 */
	public function set_public() {
		$this->items[ $this->id ]['is_private'] = false;
		return $this;
	}

	/**
	 * Set handler class for the request.
	 *
	 * @param object $handler Class to handle the request.
	 * @return void
	 */
	public function set_handler( $handler ) {
		add_action( 'wp_ajax_' . $this->items[ $this->id ]['action'], [ $handler, 'ajax' ] );

		if ( ! $this->items[ $this->id ]['is_private'] ) {
			add_action( 'wp_ajax_nopriv_' . $this->items[ $this->id ]['action'], [ $handler, 'ajax' ] );
		}
	}
}
