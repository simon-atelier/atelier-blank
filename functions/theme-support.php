<?php
	
// Adding WP Functions & Theme Support
function atelier_theme_support() {

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );
	
	// Default thumbnail size
	set_post_thumbnail_size(125, 125, true);

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );
	
	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );

	// Add Support for Woocommerce templates
	add_theme_support( 'woocommerce' );
	
	// Add HTML5 Support
	add_theme_support( 'html5', 
         array( 
         	'comment-list', 
         	'comment-form', 
         	'search-form', 
         ) 
	);
	
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	// Adding post format support
	 add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	); 
	
	// Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	$GLOBALS['content_width'] = apply_filters( 'atelier_theme_support', 1200 );	

	// Gutenburg support to include stylesheet with blocks
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/styles/editor-styles.css' );
	
}

add_action( 'after_setup_theme', 'atelier_theme_support' );



// Register new category for Gutenburg
function atelier_block_categories( $categories ) {
    $custom_block = array(
        'slug'  => 'flexi-blocks',
        'title' => __( 'Flexi Template Blocks' ),
    );

    $categories_sorted = [];
    $categories_sorted[0] = $custom_block;
    foreach ($categories as $category) { $categories_sorted[] = $category; }

    return $categories_sorted;
}
add_action( 'block_categories_all', 'atelier_block_categories', 10);


