<?php

# ------------------------------------------
# GUTENBERG: CTA BLOCK
# ------------------------------------------ 
$id = 'cta-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

$className = 'bir-block cta';

if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$title = get_field('title');
$content = get_field('content');
$link = get_field('button');
$image_type = get_field('image_type');
$feat = get_field('featured_image');
$layout = get_field('layout') ?: 'horis';

?>

<div id="<?php echo $id; ?>" class="<?php echo $className; ?> cta <?php echo $layout; ?>">
	<?php  if ( $feat ) { ?>
		<span class="cta-bg <?php echo $image_type; ?>" style="background-image: url(<?php echo $feat; ?>);"></span>
	<?php } ?>
	
	<div class="cta-content">
	
		<?php if ($title) { ?>
			<h3><?php echo $title; ?></h3>
		<?php } ?>
		
		<?php if ($content) { ?>
			<?php echo $content; ?>
		<?php } ?>
		
		<?php if( $link ): 
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
		?>
			<a class="btn button is-style-btn-secondary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><span><?php echo $link_title ?></span><i class="fa-solid fa-circle-chevron-right"></i></a>
		<?php endif; ?>
	</div>

	<?php if(is_admin()){?>

		<style>
		.cta-content{
			padding: 4rem 2rem;
			background: #383536;
			position: relative;
			color: white;
			text-align: center;
		}
		</style>
	
	<?php }?>


</div>