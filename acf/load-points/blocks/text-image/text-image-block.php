<?php

if ( ! defined( 'ABSPATH' ) ) exit; 


$id = 'text-image-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'text-image custom-block';
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
        $button = $fields['button'];
    ?>
    <div class="grid-container">
        <div class="grid-x">
            <?php $order = ($fields['image_position'] == "Left") ? "order-1" : "order-3"; ?>
            <div class="large-6 cell<?= $order ?>">
                <div class="text-image-image">
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

            <div class="large-6 cell order-2">
                <div class="text-image-content">
                    <div class="text-image-content-text">
                        <h3><?= $fields['title'] ?></h3>
                        <?= $fields['body'] ?>
                        <?php if (!empty($fields['button_title'])): ?>
                            <p class="controls"><a href="<?= $button['url'] ?>" class="button black bottom-left"><?= $button['title'] ?></a></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>