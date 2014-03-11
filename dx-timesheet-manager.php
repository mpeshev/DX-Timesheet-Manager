<?php


if( ! class_exists( 'DX_Timesheet_Manager' ) ) {
	
	class DX_Timesheet_Manager {
		
		public function __construct() {
			add_action( 'init', array( $this, 'register_timesheet_type' ) );
			add_action( 'init', array( $this, 'register_timesheet_taxonomy' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
			// reporting and browsing
			add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
		}
		
		public function register_timesheet_type() {
			register_post_type( 'dxtimesheet', array(
				'labels' => array(
					'name' => __("Timesheets", 'dxtm'),
					'singular_name' => __("Timesheet", 'dxtm'),
					'add_new' => _x("Add New", 'pluginbase', 'dxtm' ),
					'add_new_item' => __("Add New Timesheet", 'dxtm' ),
					'edit_item' => __("Edit Timesheet", 'dxtm' ),
					'new_item' => __("New Timesheet", 'dxtm' ),
					'view_item' => __("View Timesheet", 'dxtm' ),
					'search_items' => __("Search Timesheets", 'dxtm' ),
					'not_found' =>  __("No Timesheets found", 'dxtm' ),
					'not_found_in_trash' => __("No Timesheets found in Trash", 'dxtm' ),
				),
				'description' => __("Timesheets for the demo", 'dxtm'),
				'public' => true,
				'publicly_queryable' => true,
				'query_var' => true,
				'rewrite' => true,
				'exclude_from_search' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'menu_position' => 40, // probably have to change, many plugins use this
				'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'custom-fields',
					'page-attributes',
				),
			));
		}
		
		public function register_timesheet_taxonomy() {
			register_taxonomy( 'dxtimesheettax', 'dxtimesheet', array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x( "Timesheet Taxonomies", 'taxonomy general name', 'dxtm' ),
					'singular_name' => _x( "Timesheet Taxonomy", 'taxonomy singular name', 'dxtm' ),
					'search_items' =>  __( "Search Taxonomies", 'dxtm' ),
					'popular_items' => __( "Popular Taxonomies", 'dxtm' ),
					'all_items' => __( "All Taxonomies", 'dxtm' ),
					'parent_item' => null,
					'parent_item_colon' => null,
					'edit_item' => __( "Edit Timesheet Taxonomy", 'dxtm' ),
					'update_item' => __( "Update Timesheet Taxonomy", 'dxtm' ),
					'add_new_item' => __( "Add New Timesheet Taxonomy", 'dxtm' ),
					'new_item_name' => __( "New Timesheet Taxonomy Name", 'dxtm' ),
					'separate_items_with_commas' => __( "Separate Timesheet taxonomies with commas", 'dxtm' ),
					'add_or_remove_items' => __( "Add or remove Timesheet taxonomy", 'dxtm' ),
					'choose_from_most_used' => __( "Choose from the most used Timesheet taxonomies", 'dxtm' )
				),
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => true,
			));
			
			register_taxonomy_for_object_type( 'dxtimesheettax', 'dxtimesheet' );
		}
		
		public function add_metabox() {
			add_meta_box(
				'dxtm_data_box',
				__( "Details", 'dxtm' ),
				array( $this, 'timesheet_metabox' ),
				'dxtimesheet' // leave empty quotes as '' if you want it on all custom post add/edit screens or add a post type slug
			);
		}
		
		public function timesheet_metabox( $id ) {
			
		}
		
		public function add_admin_page() {
			
		}
	}

}

add_action( 'init', 'dxtm_setup_manager' );

function dxtm_setup_manager() {
	new DX_Timesheet_Manager();
}