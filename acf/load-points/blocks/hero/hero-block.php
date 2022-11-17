<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero custom-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    
    <div class="hero-container">
        <?php $x=1; if( have_rows('hero_slides') ): while ( have_rows('hero_slides') ) : the_row(); ?>
            <div class="hero-slide">
                <?php $fields = get_sub_field('home_hero_fields'); ?>
                <?php $bg_image = $fields['background']; ?>
                <div class="hero-background">
                    <?php echo wp_get_attachment_image( $bg_image, 'full' ); ?>    
                </div>
                <div class="hero-content">
                    <?php if($x == 1) : // Ensure only one H1 tag is output, style by class ?>
                        <h1 class="hero-content-title"><?= $fields['title']; ?></h1>
                    <?php else : ?>
                        <p class="hero-content-title"><?= $fields['title']; ?></p>
                    <?php endif; ?>
                    <?php if(!empty($fields['subtitle'])): ?>
                    <p class="hero-content-subtitle"><?= $fields['subtitle']; ?></p>
                    <?php endif; ?>
                    <p class="hero-content-controls"><a href="<?= $fields['button_link'] ?>" class="button"><?= $fields['button_title']; ?></a></p>
                </div>
            </div>
        <?php $x++; endwhile; endif; ?>
    </div>

</div>