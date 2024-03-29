<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
include( __DIR__ . '/../../styles.php');

$id = 'related-posts-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'related-posts custom-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$posts = get_field('related_posts');
if (empty($posts)) {
    $args = array( 'posts_per_page' => 4, 'post_type'=> 'post' );
    $posts = get_posts( $args );
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"<?php if (!empty($style_string)) echo " style='" . $style_string . "'"; ?>>
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
                    <div class="post-block">
                        <div class="post-block-image">
                            <?php echo wp_get_attachment_image( $image, 'full'); ?>
                            <span class="tag"><?= $category[0]->name ?></span>
                        </div>
                        <div class="post-block-content">
                            <h2><?php echo get_the_title($post->ID); ?></h2>
                            <p><?php echo get_the_excerpt($post->ID); ?></p>
                            <div class="post-block-content-controls">
                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="button black bottom-left">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <div class="swiper_icon">
            <img src="<?php bloginfo('template_directory'); ?>/assets/images/swipe.svg" alt="Swipe">
        </div>
        <div class="grid-x">
            <div class="large-12 cell">
                <div class="related-posts-controls">
                    <p class="midtext"><a href="<?php bloginfo('url'); ?>/" class="button bottom-left red">See all posts</a></p>
                </div>
            </div>
        </div>
    </div>

</section>