<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
include( __DIR__ . '/../../styles.php');

$id = 'contact-form-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'contact-form custom-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$fields = get_field('signup_fields');

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"<?php if (!empty($style_string)) echo " style='" . $style_string . "'"; ?>>
   <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <?php if(!empty(get_field('form_title'))): ?>
            <div class="large-12 cell">
                <div class="midtext contact_form-title">
                    <h2><?php the_field('form_title'); ?></h2>
                    <p><?php the_field('form_subtitle'); ?></p>
                </div>
            </div>
            <?php endif; ?>
            <div class="large-12 cell">
            	<div class="contact_form">
                    <div class="contact_form-inner">
                        <?php echo do_shortcode( get_field('shortcode') ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>