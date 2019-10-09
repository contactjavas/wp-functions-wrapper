<?php
/**
 * Post type helper.
 *
 * @package WPFW
 */

namespace Wpfw\Helpers;

/**
 * Class to provide metabox utilities.
 */
class Post_Type_Helper {

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
	 * Available argument's keys.
	 * Not used in this class, but used as helper when writing methods.
	 *
	 * @var array
	 */
	private $args_keys = [
		'label',
		'labels',
		'description',
		'public',
		'hierarchical',
		'exclude_from_search',
		'publicly_queryable',
		'show_ui',
		'show_in_menu',
		'show_in_nav_menus',
		'show_in_admin_bar',
		'show_in_rest',
		'rest_base',
		'rest_controller_class',
		'menu_position',
		'menu_icon',
		'capability_type',
		'capabilities',
		'map_meta_cap',
		'supports',
		'register_meta_box_cb',
		'taxonomies',
		'has_archive',
		'rewrite',
		'query_var',
		'can_export',
		'delete_with_user',
		'_builtin',
		'_edit_link',
	];

	/**
	 * Register post type name.
	 *
	 * @param string $singular_name The singular name.
	 * @param string $plural_name The plural name.
	 * @return object
	 */
	public function register( $singular_name, $plural_name = '' ) {
		$plural_name = $plural_name ? $plural_name : $singular_name . 's';

		$this->id++;
		$this->item[ $this->id ] = [];

		$this->item[ $this->id ]['args']           = [];
		$this->item[ $this->id ]['args']['labels'] = [];
		$this->item[ $this->id ]['singular_name']  = $singular_name;
		$this->item[ $this->id ]['plural_name']    = $plural_name;

		return $this;
	}

	/**
	 * Set the post type key.
	 * This is the 1st parameter in "register_post_type" function.
	 *
	 * @param string $post_type_key The post type key.
	 * @return object
	 */
	public function set_id( $post_type_key ) {
		$this->item[ $this->id ]['post_type_key'] = $post_type_key;
		return $this;
	}

	/**
	 * Set "labels" args.
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
	 * Set the post type description.
	 *
	 * @param string $description Post type description.
	 * @return object
	 */
	public function set_description( $description ) {
		$this->item[ $this->id ]['args']['description'] = $description;
		return $this;
	}

	/**
	 * Set "public" args as true.
	 *
	 * @param boolean $is_public Whether to set the "public" args true or false.
	 * @return object
	 */
	public function set_public( $is_public = true ) {
		$this->item[ $this->id ]['args']['public'] = $is_public;
		return $this;
	}

	/**
	 * Set "public" args as false.
	 *
	 * @return object
	 */
	public function set_private() {
		$this->item[ $this->id ]['args']['public'] = false;
		return $this;
	}

	/**
	 * Set the "hierarchical" args.
	 *
	 * @param boolean $hierarchical Whether the post type is hierarchical (e.g. page).
	 * @return object
	 */
	public function set_hierarchical( $hierarchical = true ) {
		$this->item[ $this->id ]['args']['hierarchical'] = $hierarchical;
		return $this;
	}

	/**
	 * Set "show_ui" args as true.
	 *
	 * @param boolean $is_shown Whether to set the "show_ui" args true or false.
	 * @return object
	 */
	public function show_ui( $is_shown = true ) {
		$this->item[ $this->id ]['args']['show_ui'] = $is_shown;
		return $this;
	}

	/**
	 * Set "show_ui" args as false.
	 *
	 * @return object
	 */
	public function hide_ui() {
		$this->item[ $this->id ]['args']['show_ui'] = false;
		return $this;
	}

	/**
	 * Set "show_in_menu" args as true.
	 *
	 * @param boolean $is_shown Whether to set the "show_in_menu" args true or false.
	 * @return object
	 */
	public function show_in_menu( $is_shown = true ) {
		$this->item[ $this->id ]['args']['show_in_menu'] = $is_shown;
		return $this;
	}

	/**
	 * Set "show_in_menu" args as false.
	 *
	 * @return object
	 */
	public function hide_from_menu() {
		$this->item[ $this->id ]['args']['show_in_menu'] = false;
		return $this;
	}

	/**
	 * Set the "supports" args.
	 *
	 * @param array $supports Core feature(s) the post type supports.
	 * @return object
	 */
	public function set_supports( $supports ) {
		$this->item[ $this->id ]['args']['supports'] = $supports;
		return $this;
	}

	/**
	 * Set the "menu_icon" args.
	 *
	 * @param string $icon The url to the icon to be used for this menu.
	 * @return object
	 */
	public function set_icon( $icon ) {
		$this->item[ $this->id ]['args']['menu_icon'] = $icon;
		return $this;
	}

	/**
	 * Set "has_archive" args to true.
	 *
	 * @return object
	 */
	public function enable_archive() {
		$this->item[ $this->id ]['args']['has_archive'] = true;
		return $this;
	}

	/**
	 * Set "has_archive" args to false.
	 *
	 * @return object
	 */
	public function disable_archive() {
		$this->item[ $this->id ]['args']['has_archive'] = false;
		return $this;
	}

	/**
	 * Set argument using key, value as param.
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
	 * Set arguments using array of key-value pair.
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
	 * Set admin menu name.
	 * Part of "labels" args.
	 *
	 * @param string $menu_name Label for the menu name.
	 * @return object
	 */
	public function set_menu_name( $menu_name ) {
		$this->item[ $this->id ]['menu_name'] = $menu_name;
		return $this;
	}

	/**
	 * Collect the arguments.
	 *
	 * @return void
	 */
	public function save() {
		$item          = $this->item[ $this->id ];
		$singular_name = $item['singular_name'];
		$plural_name   = $item['plural_name'];
		$post_type_key = isset( $item['post_type_key'] ) ? $item['post_type_key'] : strtolower( str_replace( ' ', '_', $singular_name ) );
		$menu_name     = isset( $item['menu_name'] ) ? $item['menu_name'] : $plural_name;

		$args   = $this->item[ $this->id ]['args'];
		$labels = [
			'name'                  => $plural_name,
			'singular_name'         => $singular_name,
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New ' . $singular_name,
			'edit_item'             => 'Edit ' . $singular_name,
			'new_item'              => 'New ' . $singular_name,
			'view_item'             => 'View ' . $singular_name,
			'view_items'            => 'View ' . $plural_name,
			'search_items'          => 'Search ' . $plural_name,
			'name_admin_bar'        => $singular_name,
			'not_found'             => 'Nothing found',
			'not_found_in_trash'    => 'Nothing found in Trash',
			'parent_item_colon'     => '',
			'all_items'             => 'All ' . $plural_name,
			'archives'              => $singular_name . ' Archives',
			'attributes'            => $singular_name . ' Attributes',
			'insert_into_item '     => 'Insert into ' . $singular_name,
			'uploaded_to_this_item' => 'Uploaded to this ' . $singular_name,
			'menu_name'             => $menu_name,
			'filter_items_list'     => 'Filter' . $plural_name . 'list',
			'items_list_navigation' => $plural_name . ' list navigation',
			'items_list'            => $plural_name . ' list',
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

		register_post_type( $post_type_key, $args );
	}

	/**
	 * Add the post type.
	 *
	 * @param string $hook The hook used to register the post type.
	 * @return void
	 */
	public function add( $hook = 'init' ) {
		add_action( $hook, [ $this, 'save' ] );
	}
}
