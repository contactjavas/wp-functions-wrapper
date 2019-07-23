<?php
/**
 * Metabox interfaces
 *
 * @package WPFW
 */

/**
 * Class to provide metabox utilities
 */
class Metabox_Helper {

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
	 * Register metabox id
	 *
	 * @param string $name The metabox id.
	 * @return object
	 */
	public function register( $name ) {
		$this->id++;
		$this->item[ $this->id ]         = [];
		$this->item[ $this->id ]['name'] = $name;

		return $this;
	}

	/**
	 * Set the metabox title
	 *
	 * @param string $title Title of the meta box.
	 * @return object
	 */
	public function set_title( $title ) {
		$this->item[ $this->id ]['title'] = $title;
		return $this;
	}

	/**
	 * Display callback
	 *
	 * @param callable $display_callback Function that fills the box with the desired content. The function should echo its output.
	 * @return object
	 */
	public function render_display( $display_callback ) {
		$this->item[ $this->id ]['display_callback'] = $display_callback;
		return $this;
	}

	/**
	 * Add metabox to specific screen
	 *
	 * @param string|array|WP_Screen $screen The screen(s) on which to show the box.
	 * @return object
	 */
	public function add_to_screen( $screen ) {
		$this->item[ $this->id ]['screen'] = $screen;
		return $this;
	}

	/**
	 * Set screen where the boxes should be displayed
	 *
	 * @param string $screen_context The context within the screen ('normal', 'side', 'advanced').
	 * @return object
	 */
	public function set_screen_context( $screen_context = 'advanced' ) {
		$this->item[ $this->id ]['screen_context'] = $screen_context;
		return $this;
	}

	/**
	 * Set the screen context's priority where the boxes should show
	 *
	 * @param string $context_priority The priority within the context ('high', 'default', 'low').
	 * @return object
	 */
	public function set_context_priority( $context_priority = 'default' ) {
		$this->item[ $this->id ]['context_priority'] = $context_priority;
		return $this;
	}

	/**
	 * Set callback arguments
	 *
	 * @param array $callback_args Data that should be set as the $args property of the box array (which is the second parameter passed to the render_display).
	 * @return object
	 */
	public function set_callback_args( $callback_args = null ) {
		$this->item[ $this->id ]['callback_args'] = $args;
		return $this;
	}

	/**
	 * Collect the arguments then add them to the metabox
	 *
	 * @return object
	 */
	public function save() {
		$name             = $this->item[ $this->id ]['name'];
		$title            = $this->item[ $this->id ]['title'];
		$display_callback = $this->item[ $this->id ]['display_callback'];
		$screen           = $this->item[ $this->id ]['screen'];
		$screen_context   = isset( $this->item[ $this->id ]['screen_context'] ) ? $this->item[ $this->id ]['screen_context'] : 'advanced';
		$context_priority = isset( $this->item[ $this->id ]['context_priority'] ) ? $this->item[ $this->id ]['context_priority'] : 'default';
		$callback_args    = isset( $this->item[ $this->id ]['callback_args'] ) ? $this->item[ $this->id ]['callback_args'] : null;

		add_meta_box(
			$name,
			$title,
			$display_callback,
			$screen,
			$screen_context,
			$context_priority,
			$callback_args
		);

		return $this;
	}

	/**
	 * Provide callback when processing the submission
	 *
	 * @param callable $submission_callback The function/ method to be called using 'save_post', or custom hook.
	 * @param string   $submission_hook The hook where $onsave_callback is called.
	 * @return object
	 */
	public function set_submission_callback( $submission_callback, $submission_hook = 'save_post' ) {
		$this->item[ $this->id ]['submission_callback'] = $submission_callback;
		$this->item[ $this->id ]['submission_hook']     = $submission_hook;
		return $this;
	}

	/**
	 * Add the metabox
	 *
	 * @param string $hook The hook which the metabox will be registered in. E.g: 'add_meta_boxes', 'load-nav-menus.php'.
	 * @return void
	 */
	public function add( $hook = 'add_meta_boxes' ) {
		add_action( $hook, [ $this, 'save' ] );
		$item = $this->item[ $this->id ];

		if ( isset( $item['submission_callback'] ) && $item['submission_callback'] ) {
			add_action( $item['submission_hook'], $item['submission_callback'] );
		}
	}
}
