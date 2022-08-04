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
	
	/* 
	Remove custom colours and define palette
	add_theme_support('disable-custom-colors');
	add_theme_support(
	    'editor-color-palette',
	    array(
	        array(
	            'name'  => esc_html__( 'Black', 'atelier' ),
	            'slug'  => 'black',
	            'color' => "#000",
	        ),
	        array(
	            'name'  => esc_html__( 'Black', 'atelier' ),
	            'slug'  => 'white',
	            'color' => "#fff",
	        ),
	    )
	);
	*/
}

add_action( 'after_setup_theme', 'atelier_theme_support' );

// Register editor styles for Gutenberg
function atelier_gutenberg_editor_css() {
	$editor_css = '/assets/styles/editor-styles.css';
	$version = filemtime(get_stylesheet_directory() . $editor_css);
	wp_enqueue_style('editor-css', get_stylesheet_directory_uri() . $editor_css, [], $version);
}
add_action('enqueue_block_editor_assets', 'atelier_gutenberg_editor_css');


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


