<?php
function vesst_register_post_type() {

	/**
	 * Post Type: Resources.
	 */

	$labels = array(
		"name" 			=> __( "Resources"),
		"singular_name" => __( "Resource"),
		"menu_name" 	=> __( "Resource Library"),
		"add_new"		=> __( "Add New Resource"),
		"add_new_item" 	=> __( "Add New Resource"),
		"edit_item" 	=> __( "Edit Resource"),
		"new_item" 		=> __( "New Resource"),
	);

	$args = array(
		"label" 				=> __( "Resources"),
		"labels" 				=> $labels,
		"description" 			=> "",
		"public"				=> true,
		"publicly_queryable" 	=> true,
		"show_ui" 				=> true,
		"show_in_rest" 			=> false,
		"rest_base" 			=> "",
		"has_archive" 			=> false,
		"show_in_menu" 			=> true,
		"exclude_from_search" 	=> false,
		"capability_type" 		=> "post",
		'menu_icon'           	=> 'dashicons-media-document',
		"hierarchical" 			=> false,
		"rewrite" 				=> array( 	
									"slug" => "resource", 
									"with_front" => true 
								),
		"query_var" 			=> true,
		"supports" 				=> array( "title", "revisions", "thumbnail", "editor", "excerpt"),
		"taxonomies" 			=> array( "post_tag", "resource_category", "category" ),
	);

	register_post_type( "resource", $args );
}

add_action( 'init', 'vesst_register_post_type' );


function vesst_register_tax() {

	/**
	 * Taxonomy: Resource Category.
	 */

	$labels = array(
		"name" => __( "Resource Category"),
		"singular_name" => __( "Resource Category"),
	);

	$args = array(
		"label" => __( "Resource Category"),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Resource Category",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'resource_category', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	// register_taxonomy( "resource_category", array( "resource",  "events", "post", "page" ), $args );
	register_taxonomy( "resource_category", array( "resource" ), $args );

}

add_action( 'init', 'vesst_register_tax' );



function vesst_type_tax() {

	/**
	 * Taxonomy: Type Category.
	 */

	$labels = array(
		"name" => __( "Type"),
		"singular_name" => __( "Type"),
		"popular_items" => NULL,
	);

	$args = array(
		"label" => __( "Type"),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Type",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'type_group', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		'show_admin_column' => true,
		"show_in_quick_edit" => false,
	);
	// register_taxonomy( "type_group", array( "resource", "video", "events", "post", "page" , "casey-study" ), $args );
	register_taxonomy( "type_group", array( "resource"), $args );

}

add_action( 'init', 'vesst_type_tax' );


// Post tags on Pages yall
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');


