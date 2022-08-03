<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

$id = 'content-panel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'content-panel custom-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$slanted = get_field('slanted_background');
$bordered = get_field('cp_bordered_panels');
$jagged = get_field('jagged_background');
if($slanted) $className .= ' slanted';
if($bordered) $className .= ' bordered';
if($jagged) $className .= ' seacity';

$no_pad_top = get_field('remove_padding_top');
if($no_pad_top) $className .= ' noPadTop';

$no_pad_bottom = get_field('remove_padding_bottom');
if($no_pad_bottom) $className .= ' noPadBottom';

$cp_panels = get_field_object('cp_panels');
$background = get_field('background_colour');

$even_heights = (get_field('cp_even_heights')) ? "even" : "not-even";
$bg_colour = (!empty($background)) ? ' style="background-color:' . ($background) . ';"' : "";
$panel_count = count($cp_panels['value']);

?>

<section id='<?php echo esc_attr($id); ?>' class='<?php echo esc_attr($className); ?>'<?= $bg_colour ?>>
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<?php if (!empty(get_field('cp_title')) || !empty(get_field('cp_description'))): ?>
			<div class="large-12 cell">
				<div class="content-panel_top">
					<div class="content-panel_title">
						<?php if (!empty(get_field('cp_title'))): ?>
							<h2><?php the_field('cp_title') ?></h2>	
						<?php endif; ?>
						<?php if (!empty(get_field('cp_description'))): ?>
							<?php the_field('cp_description') ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php $x=1; foreach ($cp_panels['value'] as $key => $c_panel): ?>
				<?php if ($panel_count == 1): ?>
					<?php if ($x == 1): ?>
						<div class="cell medium-6 medium-offset-3 large-4 large-offset-4">
					<?php else: ?>
						<div class="cell medium-6 large-4">
					<?php endif ?>
				<?php elseif ($panel_count == 2): ?>
					<?php if ($x == 1): ?>
						<div class="cell medium-6 large-4 large-offset-2">
					<?php else: ?>
						<div class="cell medium-6 large-4">
					<?php endif ?>
				<?php elseif ($panel_count == 3): ?>
					<div class="cell medium-6 large-4">
				<?php elseif ($panel_count == 4): ?>
					<div class="cell medium-6 large-3">
				<?php endif; ?>
					<?php $link = !empty($c_panel['link']) ? $c_panel['link'] : false; ?>
						<div class="content-panel_container <?= $even_heights ?>">
							<?php if ($link): ?><a href="<?= $link['url'] ?>"><?php endif; ?>
								<div class="content-panel_container-media"><?php 
										$img_or_vid = $c_panel['image_or_video']; 
										if ($img_or_vid == "video") {
											$video = $c_panel['video'];
									    	echo $video;
										} else {
											$image = $c_panel['image'];
											if (!empty($image)) echo wp_get_attachment_image( $image['id'], 'full' );
										}
									?></div>
							<?php if ($link): ?></a><?php endif; ?>
							
							<div class="content-panel_container-content">
								<?php if ($link): ?>
									<h4><a href="<?= $link['url'] ?>"><?= $c_panel['title']; ?></a></h4>
								<?php else: ?>	
									<h4><?= $c_panel['title']; ?></h4>
								<?php endif; ?>
								
								<?= $c_panel['content']; ?>

								<?php 
									$arrow = ($c_panel['link_style'] == 'arrowlink') ? '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path id="circle-arrow-right" d="M10,0A10,10,0,1,0,20,10,10,10,0,0,0,10,0Zm5.883,10.883L11.855,14.91a1.25,1.25,0,0,1-1.768-1.768l1.9-1.893H5a1.25,1.25,0,0,1,0-2.5h6.984L10.055,6.821a1.25,1.25,0,0,1,1.768-1.768L15.85,9.081a1.308,1.308,0,0,1,.4.919A1.26,1.26,0,0,1,15.883,10.883Z" fill="#129bdb"/></svg>' : "";
								?>

								<div class="content-panel_container-content_controls">
									<?php if ($link): ?>
										<p><a href="<?= $link['url'] ?>" class="<?php echo $c_panel['link_style']; ?>" target="<?= $link['target'] ?>"><?= $arrow ?><?= $link['title'] ?></a></p>	
									<?php endif ?>
								</div>
							
							</div>
						</div>
					</div>
			<?php $x++; endforeach ?>
		</div>
	</div>	
</section>

<?php /*

*/ ?>