<?php
function at_load_blocks(){
    $path = parse_url(get_bloginfo('url'), PHP_URL_PATH);
    $get_block_directories = scandir($_SERVER['DOCUMENT_ROOT'] . $path . '/wp-content/themes/atelier-blank/acf/blocks');
    foreach ($get_block_directories as $key => $block_directory) {
        if ($block_directory[0] == ".") continue;
        register_block_type(__DIR__. '/blocks/' . $block_directory);
    }
}
add_action( 'init', 'at_load_blocks' );