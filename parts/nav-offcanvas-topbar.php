<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: http://atelier.com/docs/off-canvas-menu/
 */
?>

<div class="top-bar" id="top-bar-menu">
	<div class="top-bar-left float-left">
		<ul class="menu">
			<?php 
				$logo = get_theme_mod( 'custom_logo' );
				$image = wp_get_attachment_image_src( $logo , 'full' );
			?>
			<?php if (!empty($image)) : ?>
				<li><a href="<?php echo home_url(); ?>"><img src="<?= $image[0] ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"></a></li>	
			<?php else: ?>
				<li><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></li>
			<?php endif ?>
			
		</ul>
	</div>
	<div class="top-bar-right show-for-medium">
		<?php atelier_top_nav(); ?>	
	</div>

	<?php if (function_exists('get_field') && get_field('enable_search_bar', 'options')): ?>
		<div class="top-bar-right">
			<?php get_template_part( 'parts/content', 'searchbar' ); ?>
		</div>
	<?php endif ?>
		
	<div class="top-bar-right hide-for-large">
		<ul class="menu-end">
			<li class="hide-for-large">
				<div class="header-menu">
					<div id="mobile_burger">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>
					<p class="sr_only">menu</p>
				</div>	
			</li>
		</ul>
	</div>
</div>