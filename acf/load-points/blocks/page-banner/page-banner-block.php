<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

$id = 'page-banner-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'page-banner custom-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$fields = get_field('page_banner_fields');
$background = $fields['background'];

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    
    <div class="page_banner-background">
        <?php if ($fields['image_or_video'] == "Video"): ?>
            <?php $video = $fields['video_background'] ?>
            <video autoplay>
                <source src="<?= $video['url'] ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <?php else: ?>
            <?php echo wp_get_attachment_image( $background, 'large' ); ?>    
        <?php endif; ?>
    </div>
    <div class="page_banner-content">
        <div class="page_banner-content-text">
            <p class="page_banner-content-title"><?= $fields['title'] ?></p>
            <p class="page_banner-content-subtitle"><?= $fields['subtitle'] ?></p>
        </div>
    </div>

</section>
<?php atelier_show_breadcrumbs(); ?>