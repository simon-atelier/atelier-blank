<?php

$id = 'content-container-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'content-container';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


$container_size = get_field('cc_container_width8');

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"<?= $bg_colour ?>>
	<?php if ( $container_size == "small" ): ?>
	<div class="small-container">
	<?php elseif($container_size == "medium"): ?>
	<div class="medium-container">
	<?php elseif($container_size == "large"): ?>
	<div class="grid-container">
	<?php elseif($container_size == "fullwidth"): ?>
	<div class="full-container">
	<?php endif; ?>
		<div class="grid-x grid-margin-x">
			<div class="large-12 cell">
				<InnerBlocks />		
			</div>
		</div>
    </div>
</section>