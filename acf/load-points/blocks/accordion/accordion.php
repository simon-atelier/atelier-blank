<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

$id = 'accordion-block-' . ['id'];
if( !empty(['anchor']) ) {
    $id = ['anchor'];
}

$className = 'accordion-block custom-block';
if( !empty(['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>

<section id='<?php echo esc_attr($id); ?>' class='<?php echo esc_attr($className); ?>'>
	  <?php if(have_rows('accordion')) : ?>
	  	<?php $i = 1; ?>
	  	<ul class="accordion" data-accordion>
	  	<?php while (have_rows('accordion')) : the_row(); ?>
	  		<?php if($i == 1) : ?>
	  		  <li class="accordion-item is-active" data-accordion-item>
	  		<?php else : ?>
	  		  <li class="accordion-item" data-accordion-item>
	  		<?php endif; ?>
	  		    <a href="#" class="accordion-title"><?php the_sub_field('question'); ?></a>
	  		    <div class="accordion-content" data-tab-content>
	  		      <?php the_sub_field('answer'); ?>
	  		    </div>
	  		  </li>	
	  		<?php $i++; ?>
	  	<?php endwhile; ?>
	  	</ul>
	  <?php endif;?>
</section>

