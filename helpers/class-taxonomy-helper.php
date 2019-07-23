<?php
/**
 * Taxonomy interfaces
 *
 * @package WPFW
 */

namespace Wpfw\Helpers;

/**
 * Class to provide taxonomy utilities
 */
class Taxonomy_Helper {

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
	 * Register taxonomy name
	 *
	 * @param string $singular_name The singular name.
	 * @param string $plural_name The plural name.
	 * @return object
	 */
	public function register( $singular_name, $plural_name = '' ) {
		$plural_name = $plural_name ? $plural_name : $singular_name . 's';

		$this->id++;
		$this->item[ $this->id ] = [];

		$this->item[ $this->id ]['object_type']    = 'post';
		$this->item[ $this->id ]['args']           = [];
		$this->item[ $this->id ]['args']['labels'] = [];
		$this->item[ $this->id ]['singular_name']  = $singular_name;
		$this->item[ $this->id ]['plural_name']    = $plural_name;

		return $this;
	}

	/**
	 * Set the taxonomy type key
	 * This is the 1st parameter in "register_taxonomy" function.
	 *
	 * @param string $tax_key The taxonomy key.
	 * @return object
	 */
	public function set_id( $tax_key ) {
		$this->item[ $this->id ]['tax_key'] = $tax_key;
		return $this;
	}

	/**
	 * Set "labels" args
	 *
	 * @param array $array Array of labels.
	 * @return object
	 */
	public function set_labels( $array = [] ) {
		if ( ! $array ) {
			return $this;
		}

		foreach ( $array as $key => $value ) {
			$this->item[ $this->id ]['args']['labels'][ $key ] = $value;
		}

		return $this;
	}

	/**
	 * Set the taxonomy description
	 *
	 * @param string $description Taxonomy description.
	 * @return object
	 */
	public function set_description( $description ) {
		$this->item[ $this->id ]['args']['description'] = $description;
		return $this;
	}

	/**
	 * Set "public" args as true
	 *
	 * @param boolean $is_public Whether to set the "public" args true or false.
	 * @return object
	 */
	public function set_public( $is_public = true ) {
		$this->item[ $this->id ]['args']['public'] = $is_public;
		return $this;
	}

	/**
	 * Set "public" args as false
	 *
	 * @return object
	 */
	public function set_private() {
		$this->item[ $this->id ]['args']['public'] = false;
		return $this;
	}

	/**
	 * Set the "hierarchical" args
	 *
	 * @param boolean $hierarchical Whether the post type is hierarchical (e.g. page).
	 * @return object
	 */
	public function set_hierarchical( $hierarchical = true ) {
		$this->item[ $this->id ]['args']['hierarchical'] = $hierarchical;
		return $this;
	}

	/**
	 * Set "show_ui" args as true
	 *
	 * @param boolean $is_shown Whether to set the "show_ui" args true or false.
	 * @return object
	 */
	public function show_ui( $is_shown = true ) {
		$this->item[ $this->id ]['args']['show_ui'] = $is_shown;
		return $this;
	}

	/**
	 * Set "show_ui" args as false
	 *
	 * @return object
	 */
	public function hide_ui() {
		$this->item[ $this->id ]['args']['show_ui'] = false;
		return $this;
	}

	/**
	 * Set "show_admin_column" args as true
	 *
	 * @param boolean $is_shown Whether to set the "show_admin_column" args true or false.
	 * @return object
	 */
	public function show_admin_column( $is_shown = true ) {
		$this->item[ $this->id ]['args']['show_admin_column'] = $is_shown;
		return $this;
	}

	/**
	 * Set "show_admin_column" args as false
	 *
	 * @return object
	 */
	public function hide_admin_column() {
		$this->item[ $this->id ]['args']['show_admin_column'] = false;
		return $this;
	}

	/**
	 * Set argument using key, value as param
	 *
	 * @param string $arg_name The argument name.
	 * @param mixed  $arg_value The argument value.
	 * @return object
	 */
	public function set_argument( $arg_name, $arg_value ) {
		$this->item[ $this->id ]['args'][ $arg_name ] = $arg_value;
		return $this;
	}

	/**
	 * Set arguments using array of key-value pair
	 *
	 * @param array $args The arguments (key-value pair).
	 * @return object
	 */
	public function set_arguments( $args ) {
		if ( ! $args ) {
			return;
		}
		if ( ! is_array( $args ) ) {
			return;
		}

		foreach ( $args as $arg_name => $arg_value ) {
			$this->setArgument( $arg_name, $arg_value );
		}

		return $this;
	}

	/**
	 * Set admin menu name
	 * Part of "labels" args
	 *
	 * @param string $menu_name Label for the menu name.
	 * @return object
	 */
	public function set_menu_name( $menu_name ) {
		$this->item[ $this->id ]['menu_name'] = $menu_name;
		return $this;
	}

	/**
	 * Collect the arguments
	 *
	 * @return void
	 */
	public function save() {
		$item          = $this->item[ $this->id ];
		$singular_name = $item['singular_name'];
		$plural_name   = $item['plural_name'];
		$tax_key       = isset( $item['tax_key'] ) ? $item['tax_key'] : strtolower( str_replace( ' ', '_', $singular_name ) );
		$object_type   = $item['object_type'];
		$current_args  = $item['args'];
		$menu_name     = isset( $item['menu_name'] ) ? $item['menu_name'] : $plural_name;

		$args   = $item['args'];
		$labels = [
			'name'              => $plural_name,
			'singular_name'     => $singular_name,
			'search_items'      => 'Search ' . $plural_name,
			'all_items'         => 'All ' . $plural_name,
			'parent_item'       => 'Parent ' . $singular_name,
			'parent_item_colon' => 'Parent ' . $singular_name . ' :',
			'edit_item'         => 'Edit ' . $singular_name,
			'update_item'       => 'Update ' . $singular_name,
			'add_new_item'      => 'Add New ' . $singular_name,
			'new_item_name'     => 'New ' . $singular_name . ' Name',
			'menu_name'         => $menu_name,
		];

		if ( $args['labels'] ) {
			foreach ( $args['labels'] as $key => $value ) {
				if ( $args['labels'][ $key ] ) {
					$labels[ $key ] = $value;
				}
			}
		}

		unset( $args['labels'] );
		$args['labels'] = $labels;

		register_taxonomy( $tax_key, $object_type, $args );
	}

	/**
	 * Add to object type
	 *
	 * @param string|array $object_type Object type or array of object types with which the taxonomy should be associated.
	 * @param string       $hook The hook which taxonomy will be added in.
	 * @return void
	 */
	public function add_to_object_type( $object_type, $hook = 'init' ) {
		$this->item[ $this->id ]['object_type'] = $object_type;
		add_action( $hook, [ $this, 'save' ] );
	}

	/**
	 * Beautiful alias for "add_to_object_type"
	 *
	 * @param string|array $object_type Object type or array of object types with which the taxonomy should be associated.
	 * @param string       $hook The hook which taxonomy will be added in.
	 * @return void
	 */
	public function add_to_post_type( $object_type, $hook = 'init' ) {
		$this->add_to_object_type( $object_type, $hook );
	}
}
