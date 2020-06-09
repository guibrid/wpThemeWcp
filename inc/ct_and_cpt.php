<?php
/**
 * CUSTOM POST TYPES AND TAXONOMIES
 */
function custom_tax_cpt() {
 
	// schedule taxonomy and CPT start

	$labels_schedule = [
		'name'				 => __( 'Schedules' ),
		'singular_name' 	 => __( 'Schedule' ),
		'add_new'            => __( 'Add New'),
		'add_new_item'       => __( 'New schedule'),
		'edit_item'          => __( 'Edit schedule'),
		'new_item'           => __( 'New schedule'),
		'all_items'          => __( 'All schedules'),
		'view_item'          => __( 'View schedule'),
		'search_items'       => __( 'Search schedules'),
		'not_found'          =>  __( 'No schedule found'),
		'not_found_in_trash' => __( 'No schedule found in Trash'), 
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Schedule')
	];

	$args_schedule = [
		'labels'             => $labels_schedule,
		'public' 			 => true,
		'has_archive' 		 => true,
		'publicly_queryable' => true,
		'show_ui'            => true, 
		'show_in_menu'       => true, 
		'query_var'          => true,
		'has_archive'        => true,
		'rewrite' 			 => array('slug' => 'schedules'),
		'menu_position'      => 3,
		'menu_icon'			 => 'dashicons-calendar-alt',
		'supports' => array( 'title', 'custom-fields' ),
	];

	register_post_type( 'schedule', $args_schedule ); // register CP

	$label_area = [
		'name' 				 => __('Areas'),
		'singular_name' 	 => __( 'Area'),
		'search_items' 		 =>  __( 'Search Areas' ),
		'all_items' 		 => __( 'All Areas' ),
		'parent_item' 		 => __( 'Parent area' ),
		'parent_item_colon'  => __( 'Parent area:' ),
		'edit_item' 		 => __( 'Edit Area' ), 
		'update_item' 		 => __( 'Update Area' ),
		'add_new_item' 		 => __( 'Add New Area' ),
		'new_item_name' 	 => __( 'New Type Area' ),
		'menu_name' 		 => __( 'Areas' ),
	];

	$args_area = [
		'hierarchical' => true,
		'labels' => $label_area,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'area' ),
	];

	register_taxonomy('area', array( 'schedule' ), $args_area); // register CT
	
	// schedule taxonomy and CPT end
}
add_action( 'init', 'custom_tax_cpt' );