<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

$id = 'related-posts-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'related-posts';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$posts = get_field('related_posts');

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12 cell">
                <h2 class="midtext">Related posts</h2>
            </div>
        </div>
        <div class="grid-x grid-margin-x related-slides">
            <?php foreach ($posts as $key => $post): ?>
                <?php 
                    $image = get_post_thumbnail_id($post->ID);
                    $category = get_the_category($post->ID);
                ?>
                <div class="large-4 cell">
                    <div class="related_post">
                        <div class="related_post-image">
                            <?php echo wp_get_attachment_image( $image, 'full'); ?>
                        </div>
                        <div class="related_post-content">
                            <span class="tag"><?= $category[0]->name ?></span>
                            <h3 class="white"><?php echo get_the_title($post->ID); ?></h3>
                            <p><?php echo strip_limit($post->post_content, 100); ?></p>
                            <div class="related_post-content-controls">
                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="button black bottom-left">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="swiper_icon">
            <img src="<?php bloginfo('template_directory'); ?>/assets/images/swipe.svg" alt="Swipe">
        </div>
        <div class="grid-x">
            <div class="large-12 cell">
                <div class="related_post-controls">
                    <p class="midtext"><a href="<?php bloginfo('url'); ?>/" class="button bottom-left red">See all posts</a></p>
                </div>
            </div>
        </div>
    </div>

</section>