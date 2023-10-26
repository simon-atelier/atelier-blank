<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
include( __DIR__ . '/../../styles.php');

$id = 'image-gallery-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'image-gallery custom-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$gallery = get_field('gallery_block');

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"<?php if (!empty($style_string)) echo " style='" . $style_string . "'"; ?>>
    <div class="gallery_slider-controls">
        <div class="gal-prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.782" height="35.766" viewBox="0 0 21.782 35.766"><path d="M2.871-17.144a1.787,1.787,0,0,0-.656,1.395,1.787,1.787,0,0,0,.656,1.395L18.785,1.559a1.98,1.98,0,0,0,2.789,0l1.8-1.8a2.052,2.052,0,0,0,.615-1.395,1.765,1.765,0,0,0-.533-1.395L10.746-15.75,23.461-28.465a1.765,1.765,0,0,0,.533-1.395,2.052,2.052,0,0,0-.615-1.395l-1.8-1.8a1.9,1.9,0,0,0-1.395-.574,1.9,1.9,0,0,0-1.395.574Z" transform="translate(-2.215 33.633)"/></svg>
        </div>
        <div class="gal-next">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.782" height="35.766" viewBox="0 0 21.782 35.766"><path d="M23.379-14.355a1.787,1.787,0,0,0,.656-1.395,1.787,1.787,0,0,0-.656-1.395L7.465-33.059a1.9,1.9,0,0,0-1.395-.574,1.9,1.9,0,0,0-1.395.574l-1.8,1.8a2.052,2.052,0,0,0-.615,1.395,1.765,1.765,0,0,0,.533,1.395L15.5-15.75,2.789-3.035a1.765,1.765,0,0,0-.533,1.395A2.052,2.052,0,0,0,2.871-.246l1.8,1.8a1.9,1.9,0,0,0,1.395.574,1.9,1.9,0,0,0,1.395-.574Z" transform="translate(-2.253 33.633)"/></svg>
        </div>
    </div> 
    <div class="gallery">
        <?php if(is_array($gallery)) : ?>
            <?php foreach ( $gallery as $gallery_item ) : ?>
                <a href="<?= $gallery_item['url'] ?>" class="gallery-item">
                    <div>                    
                        <div class="gallery-item-image">
                            <div class="color_filter"></div>
                            <?php if (!empty($gallery_item['caption'])): ?>
                                <div class="gallery-item-description">
                                    <p><?= $gallery_item['caption'] ?></p>
                                </div>
                            <?php endif ?>
                            <?php echo wp_get_attachment_image( $gallery_item['ID'], 'full'); ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; wp_reset_postdata();?>
        <?php endif; ?>
    </div>
    <div class="swiper_icon">
        <img src="<?php bloginfo('template_directory'); ?>/assets/images/swipe.svg" alt="Swipe">
    </div>
</section>