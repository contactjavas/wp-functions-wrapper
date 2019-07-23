<?php
/**
 * JS enqueue interfaces
 *
 * @package WPFW
 */

namespace Wpfw\Helpers;

/**
 * Class to provide script enqueue methods
 */
class JS_Helper {

	/**
	 * Item's id
	 *
	 * @var integer
	 */
	private $id = -1;

	/**
	 * Item's container
	 *
	 * @var array
	 */
	private $item = [];

	/**
	 * Register the script handle name
	 *
	 * @param string $handle Name of the script. Should be unique.
	 * @return object
	 */
	public function register( $handle ) {
		$this->id++;
		$this->item[ $this->id ]         = [];
		$this->item[ $this->id ]['name'] = $handle;
		return $this;
	}

	/**
	 * Set the script url
	 *
	 * @param string $url Full URL of the script, or path of the script relative to the WordPress root directory.
	 * @return object
	 */
	public function set_url( $url ) {
		$this->item[ $this->id ]['url'] = $url;
		return $this;
	}

	/**
	 * Set the script dependencies
	 *
	 * @param array $deps An array of registered script handles which this script depends on.
	 * @return object
	 */
	public function set_dependencies( $deps ) {
		$this->item[ $this->id ]['deps'] = $deps;
		return $this;
	}

	/**
	 * Put the script inside head tag
	 *
	 * @return object
	 */
	public function put_on_header() {
		$this->item[ $this->id ]['in_footer'] = false;
		return $this;
	}

	/**
	 * Put the script before the closing body tag
	 *
	 * @return object
	 */
	public function put_on_footer() {
		$this->item[ $this->id ]['in_footer'] = true;
		return $this;
	}

	/**
	 * Set the script version
	 *
	 * @param string $ver String specifying script version number.
	 * @return object
	 */
	public function set_version( $ver ) {
		$this->item[ $this->id ]['ver'] = $ver;
		return $this;
	}

	/**
	 * Localize global object to the script
	 *
	 * @param array $array Array of object name & object value. Object value can be either a single or multi-dimensional array.
	 * @return object
	 */
	public function set_global_object( $array ) {
		$this->item[ $this->id ]['localize'] = [
			'name'  => $array['name'],
			'value' => $array['value'],
		];

		return $this;
	}

	/**
	 * Register the script to WP
	 *
	 * @return void
	 */
	public function save() {
		$url       = $this->item[ $this->id ]['url'];
		$handle    = $this->item[ $this->id ]['name'];
		$deps      = isset( $this->item[ $this->id ]['deps'] ) ? $this->item[ $this->id ]['deps'] : [];
		$ver       = isset( $this->item[ $this->id ]['ver'] ) ? $this->item[ $this->id ]['ver'] : null;
		$ver       = $ver && 'auto' === $ver ? Asset::get_modified_time( $url ) : $ver;
		$in_footer = isset( $this->item[ $this->id ]['in_footer'] ) ? $this->item[ $this->id ]['in_footer'] : true; // put default to footer for non-blocking request.
		$localize  = isset( $this->item[ $this->id ]['localize'] ) ? $this->item[ $this->id ]['localize'] : false;

		wp_register_script( $handle, $url, $deps, $ver, $in_footer );

		if ( $localize ) {
			wp_localize_script(
				$this->item[ $this->id ]['name'],
				$this->item[ $this->id ]['localize']['name'],
				$this->item[ $this->id ]['localize']['value']
			);
		}
	}

	/**
	 * Enqueue the script
	 *
	 * @param string $handle Name of the script. Should be unique.
	 * @return void
	 */
	public function enqueue( $handle = false ) {
		if ( $handle ) {
			wp_enqueue_script( $handle );
		} else {
			$this->save();
			wp_enqueue_script( $this->item[ $this->id ]['name'] );
		}
	}
}
