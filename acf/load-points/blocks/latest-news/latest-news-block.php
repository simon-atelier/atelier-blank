<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
include( __DIR__ . '/../../styles.php');

$id = 'latest-news-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'latest-news custom-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$posts_per_page = get_field('ln_posts_to_show');
$post_type = !empty(get_field('ln_post_type')) ? get_field('ln_post_type') : "post";
$args = array( 'posts_per_page' => $posts_per_page, 'post_type'=> $post_type );
$myposts = get_posts( $args );

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"<?php if (!empty($style_string)) echo " style='" . $style_string . "'"; ?>>
    <h2></h2>
    <div class="latest_news_cards">
        <div class="grid-container">
            <div class="grid-x grid-margin-x small-slides">
                <?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                    <div class="large-4 cell">
                        <a class="latest_news_card" href="<?php echo get_the_permalink($post->ID); ?>">
                            <div class="box">
                                <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
                                <div class="latest_news-image">
                                    <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                                </div>    
                                
                                <div class="latest_news-inner">
                                    <h3><?php echo get_the_title($post->ID); ?></h3>
                                    <p><?= strip_limit(get_the_content($post->ID), 200) ?></p>
                                    <span class="button red bottom-left">Read more</span>    
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; wp_reset_postdata();?>
            </div>
            <div class="swiper_icon">
                <img src="<?php bloginfo('template_directory'); ?>/assets/images/swipe.svg" alt="Swipe">
            </div>
        </div>
    </div>
</section>