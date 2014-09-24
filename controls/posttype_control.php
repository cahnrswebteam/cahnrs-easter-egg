<?php namespace cahnrswp\cahnrs\easter_egg;

class posttype_control {
	
	public function __construct() {

		\add_action( 'init', array( $this, 'post_type' ), 0 );

	}
	
	public function post_type() {

		$labels = array(
			'name'                => 'Easter Eggs',
			'singular_name'       => 'Easter Egg',
			'menu_name'           => 'Easter Eggs',
			'parent_item_colon'   => 'Parent Item:',
			'all_items'           => 'All Easter Eggs',
			'view_item'           => 'View Easter Egg',
			'add_new_item'        => 'Add New Easter Egg',
			'add_new'             => 'Add New',
			'edit_item'           => 'Edit Easter Egg',
			'update_item'         => 'Update Easter Egg',
			'search_items'        => 'Search Easter Eggs',
			'not_found'           => 'Not found',
			'not_found_in_trash'  => 'Not found in Trash',
		);
	
		$args = array(
			'label'               => 'easter-egg',
			'description'         => 'An interactive background element for the top CAHNRS properties integrated web presence',
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			//'taxonomies'          => array( 'programs', 'locations' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
			'menu_position'       => 80,
			'menu_icon'           => 'dashicons-smiley',
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
	
		\register_post_type( 'easter-egg', $args );

	}
	
}