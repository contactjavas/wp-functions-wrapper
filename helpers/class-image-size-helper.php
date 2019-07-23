<?php
/**
 * Image size utility
 *
 * @package WPFW
 */

namespace Wpfw\Helpers;

/**
 * Class to add image size
 */
class Image_Size_Helper {

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
	 * Register image size
	 *
	 * @param string $size_name Image size identifier.
	 * @return object
	 */
	public function register( $size_name ) {
		$this->id++;
		$this->item[ $this->id ]         = [];
		$this->item[ $this->id ]['name'] = $size_name;
		return $this;
	}

	/**
	 * Set the width
	 *
	 * @param int $width Image width in pixels.
	 * @return object
	 */
	public function set_width( $width ) {
		$this->item[ $this->id ]['width'] = $width;
		return $this;
	}

	/**
	 * Set the height
	 *
	 * @param int $height Image height in pixels.
	 * @return object
	 */
	public function set_height( $height ) {
		$this->item[ $this->id ]['height'] = $height;
		return $this;
	}

	/**
	 * Set the crop mode
	 *
	 * @param boolean $crop Whether to crop images to specified width and height or resize.
	 * @return object
	 */
	public function set_crop( $crop = true ) {
		$this->item[ $this->id ]['crop'] = $crop;
		return $this;
	}

	/**
	 * Add the registered size
	 *
	 * @return void
	 */
	public function add() {
		$name   = $this->item[ $this->id ]['name'];
		$width  = isset( $this->item[ $this->id ]['width'] ) ? $this->item[ $this->id ]['width'] : 9999;
		$height = isset( $this->item[ $this->id ]['height'] ) ? $this->item[ $this->id ]['height'] : 9999;
		$crop   = isset( $this->item[ $this->id ]['crop'] ) ? $this->item[ $this->id ]['crop'] : false;

		add_image_size( $name, $width, $height, $crop );
	}
}
