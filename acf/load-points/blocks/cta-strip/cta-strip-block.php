<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
include( __DIR__ . '/../../styles.php');

$id = 'cta-strip-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'cta-strip custom-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$fields = get_field('cta_strip_fields'); 

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"<?php if (!empty($style_string)) echo " style='" . $style_string . "'"; ?>>
    <div class="cta_strip">
        <div class="cta_strip-text">
            <h3><?= $fields['title'] ?></h3>
            <p><?= $fields['subtitle'] ?></p>
        </div>
        <div class="cta_strip-controls">
            <a class="button black bottom-left"><?= $fields['button_title'] ?></a>
        </div>
    </div>
</section>