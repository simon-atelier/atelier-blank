<?php
// Theme support options
require_once(get_template_directory().'/functions/theme-support.php'); 

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menu.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/functions/translation/translation.php');

// Add ACF block functions
require_once(get_template_directory().'/functions/acf.php');
require_once(get_template_directory().'/acf/acf_blocks.php');

// Add breadcrumbs
require_once(get_template_directory().'/functions/breadcrumbs.php');

// Use this as a template for custom post types
require_once(get_template_directory().'/functions/custom-post-type.php');


// Use AJAX functions
// require_once(get_template_directory().'/functions/ajax.php'); 

// Remove Emoji Support
// require_once(get_template_directory().'/functions/disable-emoji.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/functions/related-posts.php'); 

// Customize the WordPress login menu
// require_once(get_template_directory().'/functions/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/functions/admin.php'); 

// Strip tags and limit output
function strip_limit($string_in, $limit) {
	$string_in = strip_tags($string_in);
	if(strlen($string_in) > $limit) {
		$string_out = substr($string_in, 0, $limit) . "...";
		return $string_out;
	} else {
		return $string_in;
	}
}




