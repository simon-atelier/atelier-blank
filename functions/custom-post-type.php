<?php

function atelier_custom_post_types() {
	if(get_field('enable_testimonials', 'options')) {
		register_post_type( 'testimonials',
			array(
				'labels' => array(
					'name' 					=> __('Testimonials', 'atelier_wp'),
					'singular_name' 		=> __('Testimonial', 'atelier_wp'),
					'all_items' 			=> __('All Testimonials', 'atelier_wp'),
					'add_new' 				=> __('Add New', 'atelier_wp'),
					'add_new_item' 			=> __('Add New Testimonial', 'atelier_wp'),
					'edit' 					=> __('Edit', 'atelier_wp' ),
					'edit_item' 			=> __('Edit Testimonial', 'atelier_wp'),
					'new_item' 				=> __('New Testimonial', 'atelier_wp'),
					'view_item' 			=> __('View Testimonial', 'atelier_wp'),
					'search_items' 			=> __('Search Testimonials', 'atelier_wp'),
					'not_found' 			=> __('Nothing found in the Database.', 'atelier_wp'),
					'not_found_in_trash' 	=> __('Nothing found in Trash', 'atelier_wp'),
					'parent_item_colon' 	=> ''
				),
				'description' 			=> __( 'Testimonials', 'atelier_wp' ),
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'show_ui' 				=> true,
				'query_var' 			=> true,
				'menu_position' 		=> 8,
				'menu_icon' 			=> 'dashicons-book',
				// 'rewrite'				=> array( 'slug' => 'custom_type', 'with_front' => false ),
				'has_archive' 			=> 'testimonials',
				'capability_type' 		=> 'post',
				'hierarchical' 			=> false,
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		 	)
		); 
	}
		
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'custom_type');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'custom_type');
	
} 
// Register post types
add_action( 'init', 'atelier_custom_post_types');
	
	// custom taxonomy example
    register_taxonomy( 'custom_cat', 
    	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Custom Categories', 'atelier_wp' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Custom Category', 'atelier_wp' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Custom Categories', 'atelier_wp' ), /* search title for taxomony */
    			'all_items' => __( 'All Custom Categories', 'atelier_wp' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom Category', 'atelier_wp' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom Category:', 'atelier_wp' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom Category', 'atelier_wp' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom Category', 'atelier_wp' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Custom Category', 'atelier_wp' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Category Name', 'atelier_wp' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'custom-slug' ),
    	)
    );   
    
	// custom tags example
    register_taxonomy( 'custom_tag', 
    	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Custom Tags', 'atelier_wp' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Custom Tag', 'atelier_wp' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Custom Tags', 'atelier_wp' ), /* search title for taxomony */
    			'all_items' => __( 'All Custom Tags', 'atelier_wp' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom Tag', 'atelier_wp' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom Tag:', 'atelier_wp' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom Tag', 'atelier_wp' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom Tag', 'atelier_wp' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Custom Tag', 'atelier_wp' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Tag Name', 'atelier_wp' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 