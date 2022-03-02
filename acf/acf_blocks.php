<?php
add_action('acf/init', 'flex_acf_init_block_types');
function flex_acf_init_block_types() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name' => 'content-container',
            'title' => __('Content container'),
            'description' => __('Wraps content in a styled container.'), 
            'category' => 'create-blocks',
            'icon' => 'welcome-widgets-menus',
            'keywords' => [ 'container', 'content', 'box' ],
            'supports' => [
                'align' => true,
                'mode' => false,
                'jsx' => true
            ],
            'render_template' => get_template_directory() . '/acf/blocks/content-container/content-container-block.php',
            'enqueue_style'     => get_template_directory_uri() . '/acf/blocks/content-container/content-container.css'
        ));
   
    } 
}