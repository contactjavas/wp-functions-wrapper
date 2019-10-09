<?php
/**
 * Image size helper.
 *
 * @package WPFW
 */

namespace Wpfw\Helpers;

/**
 * Class to add image size.
 */
class Image_Size_Helper {

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
	private $items = [];

	/**
	 * Register image size.
	 *
	 * @param string $size_name Image size identifier.
	 * @return object
	 */
	public function register( $size_name ) {
		$this->id++;
		$this->items[ $this->id ]         = [];
		$this->items[ $this->id ]['name'] = $size_name;
		return $this;
	}

	/**
	 * Set the width.
	 *
	 * @param int $width Image width in pixels.
	 * @return object
	 */
	public function set_width( $width ) {
		$this->items[ $this->id ]['width'] = $width;
		return $this;
	}

	/**
	 * Set the height.
	 *
	 * @param int $height Image height in pixels.
	 * @return object
	 */
	public function set_height( $height ) {
		$this->items[ $this->id ]['height'] = $height;
		return $this;
	}

	/**
	 * Set the crop mode.
	 *
	 * @param boolean $crop Whether to crop images to specified width and height or resize.
	 * @return object
	 */
	public function set_crop( $crop = true ) {
		$this->items[ $this->id ]['crop'] = $crop;
		return $this;
	}

	/**
	 * Add the registered size.
	 *
	 * @return void
	 */
	public function add() {
		$name   = $this->items[ $this->id ]['name'];
		$width  = isset( $this->items[ $this->id ]['width'] ) ? $this->items[ $this->id ]['width'] : 9999;
		$height = isset( $this->items[ $this->id ]['height'] ) ? $this->items[ $this->id ]['height'] : 9999;
		$crop   = isset( $this->items[ $this->id ]['crop'] ) ? $this->items[ $this->id ]['crop'] : false;

		add_image_size( $name, $width, $height, $crop );
	}
}
