<?php

$id = 'button-block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'button-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$button = get_field('button_link'); 

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <p>
        <a class="button <?= get_field('button_colour') ?> <?= get_field('button_size') ?>" 
        	href="<?= $button['url'] ?>"
        	<?php if ($button['url']) echo 'target="' . $button['target'] . '"' ?>>
            <?= $button['title'] ?>
        </a>
    </p>
</section>