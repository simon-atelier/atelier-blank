<?php
/*
	Do not change localisation action
*/
function atelier_enqueue_ajax_scripts() {
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/assets/scripts/ajax-scripts.js', array('jquery') );
    wp_localize_script( 'ajax-script', 'atelier_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'atelier_enqueue_ajax_scripts' );


// Sample AJAX function, replace every instance of FUNCTION_NAME
function FUNCTION_NAME() {
	$var = $_REQUEST['var'];
	
	$return_string = "Success";
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		exit(json_encode($return_string));
	} else {
		exit('Failed');
	}
}

add_action( 'wp_ajax_nopriv_FUNCTION_NAME', 'FUNCTION_NAME' );
add_action( 'wp_ajax_FUNCTION_NAME', 'FUNCTION_NAME' );