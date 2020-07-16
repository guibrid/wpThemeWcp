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

	// Document taxonomy and CPT start

	$labels_document = [
		'name'				 => __( 'Documents' ),
		'singular_name' 	 => __( 'Document' ),
		'add_new'            => __( 'Add New'),
		'add_new_item'       => __( 'New document'),
		'edit_item'          => __( 'Edit document'),
		'new_item'           => __( 'New document'),
		'all_items'          => __( 'All documents'),
		'view_item'          => __( 'View document'),
		'search_items'       => __( 'Search documents'),
		'not_found'          =>  __( 'No document found'),
		'not_found_in_trash' => __( 'No document found in Trash'), 
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Document')
	];

	$args_document = [
		'labels'             => $labels_document,
		'public' 			 => true,
		'has_archive' 		 => true,
		'publicly_queryable' => true,
		'show_ui'            => true, 
		'show_in_menu'       => true, 
		'query_var'          => true,
		'has_archive'        => true,
		'rewrite' 			 => array('slug' => 'documents'),
		'menu_position'      => 4,
		'menu_icon'			 => 'dashicons-admin-page',
		'supports' => array( 'title', 'custom-fields' ),
	];

	register_post_type( 'document', $args_document ); // register CP

	$label_typeDoc = [
		'name' 				 => __('Types'),
		'singular_name' 	 => __( 'Type'),
		'search_items' 		 =>  __( 'Search types' ),
		'all_items' 		 => __( 'All types' ),
		'parent_item' 		 => __( 'Parent type' ),
		'parent_item_colon'  => __( 'Parent type:' ),
		'edit_item' 		 => __( 'Edit type' ), 
		'update_item' 		 => __( 'Update type' ),
		'add_new_item' 		 => __( 'Add New type' ),
		'new_item_name' 	 => __( 'New Type type' ),
		'menu_name' 		 => __( 'Types' ),
	];

	$args_typeDoc = [
		'hierarchical' => true,
		'labels' => $label_typeDoc,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'typeDoc' ),
	];

	register_taxonomy('typeDoc', array( 'document' ), $args_typeDoc); // register CT
	
	// schedule taxonomy and CPT end
}
add_action( 'init', 'custom_tax_cpt' );