<?php

if ( ! defined( 'ABSPATH' ) ) exit; 


$id = 'text-image-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'text-image';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$fields = get_field('text_image_fields');

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php 
        $image = $fields['image'];
        $text_background = $fields['text_background'];
    ?>
    <div class="grid-container">
        <div class="grid-x">
            <?php if ($fields['image_position'] == "Left"): ?>
                <div class="large-6 cell">
                    <div class="image_text-image">
                        <?php if ($fields['image_or_video'] == "video"): ?>
                            <?php $video = $fields['video'] ?>
                            <video autoplay>
                                <source src="<?= $video['url'] ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                        <?php endif ?>
                    </div>
                </div>
            <?php endif; ?>
                    
                    

            <div class="large-6 cell">
                <div class="image_text-content">
                    <?php if (!empty($text_background)): ?>
                        <div class="image_text-content-background">
                            <?php echo wp_get_attachment_image( $text_background, 'full' ); ?>
                        </div>
                    <?php endif ?>
                    <div class="image_text-content-text">
                        <h3><?= $fields['title'] ?></h3>
                        <p class=""><?= $fields['body'] ?></p>
                        <?php if (!empty($fields['button_title'])): ?>
                            <p class="controls"><a href="<?= $fields['button_link'] ?>" class="button black bottom-left"><?= $fields['button_title'] ?></a></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <?php if ($fields['image_position'] == "Right"): ?>
                <div class="large-6 cell">
                    <div class="image_text-image">
                        <?php if ($fields['image_or_video'] == "video"): ?>
                            <?php $video = $fields['video'] ?>
                            <video autoplay>
                                <source src="<?= $video['url'] ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                        <?php endif ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>