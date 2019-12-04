<?php
/**
 * CSS enqueue helper.
 *
 * @package WPFW
 */

namespace Wpfw\Helpers;

/**
 * Class to provide stylesheet enqueue methods.
 */
class CSS_Helper {
	/**
	 * Item's id.
	 *
	 * @var integer
	 */
	private $id = -1;

	/**
	 * Item's container.
	 *
	 * @var array
	 */
	private $items = array();

	/**
	 * Register the stylesheet handle name.
	 *
	 * @param string $handle Name of the stylesheet. Should be unique.
	 * @return object
	 */
	public function register( $handle ) {
		$this->id++;
		$this->items[ $this->id ]           = array();
		$this->items[ $this->id ]['handle'] = $handle;
		return $this;
	}

	/**
	 * Set the stylesheet url.
	 *
	 * @param string $url Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
	 * @return object
	 */
	public function set_url( $url ) {
		$this->items[ $this->id ]['url'] = $url;
		return $this;
	}

	/**
	 * Set the stylesheet dependencies.
	 *
	 * @param array $deps An array of registered stylesheet handles which this stylesheet depends on.
	 * @return object
	 */
	public function set_dependencies( $deps ) {
		$this->items[ $this->id ]['deps'] = $deps;
		return $this;
	}

	/**
	 * Set the stylesheet version.
	 *
	 * @param string $ver String specifying stylesheet version number.
	 * @return object
	 */
	public function set_version( $ver ) {
		$this->items[ $this->id ]['ver'] = $ver;
		return $this;
	}

	/**
	 * Register the stylesheet to WP.
	 *
	 * @return void
	 */
	public function save() {
		$handle = $this->items[ $this->id ]['handle'];
		$url    = $this->items[ $this->id ]['url'];
		$deps   = isset( $this->items[ $this->id ]['deps'] ) ? $this->items[ $this->id ]['deps'] : array();
		$ver    = isset( $this->items[ $this->id ]['ver'] ) ? $this->items[ $this->id ]['ver'] : null; // remove default WordPress version for security.
		$ver    = $ver && 'auto' === $ver ? \Wpfw\Asset::get_modified_time( $url ) : $ver;

		wp_register_style( $handle, $url, $deps, $ver );
	}

	/**
	 * Enqueue the stylesheet.
	 *
	 * @param string $handle Name of the stylesheet. Should be unique.
	 * @return void
	 */
	public function enqueue( $handle = false ) {
		if ( $handle ) {
			wp_enqueue_style( $handle );
		} else {
			$this->save();
			wp_enqueue_style( $this->items[ $this->id ]['handle'] );
		}
	}

	/**
	 * Unregister a stylesheet.
	 *
	 * @param string $handle Name of the stylesheet to be un-registered.
	 * @return void
	 */
	public function deregister( $handle ) {
		wp_deregister_style( $handle );
	}

	/**
	 * Dequeue a stylesheet.
	 *
	 * @param string $handle Name of the stylesheet to be de-queued.
	 * @return void
	 */
	public function dequeue( $handle ) {
		wp_dequeue_style( $handle );
	}
}
