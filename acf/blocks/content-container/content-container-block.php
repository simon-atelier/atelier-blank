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


$container_size = get_field('container_size');

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php if ( $container_size == "full" ): ?>
	<div class="full-width">
	<?php else: ?>	
	<div class="grid-container">
	<?php endif; ?>
    	<InnerBlocks />
    </div>
</section>