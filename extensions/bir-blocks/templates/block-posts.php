<?php

# ------------------------------------------
# GUTENBERG: POSTS
# ------------------------------------------ 

$id = 'posts-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

$className = 'bir-block posts';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$count = get_field('number_of_posts') ?: '3';
$layout = get_field('layout');
$length = get_field('excerpt_length') ? : '15';

?>

<div id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
	
	<?php
		$args = array(
			'post_type'			=> array( 'post' ),
			'posts_per_page'	=> $count,
		);
		$postsQuery = new WP_Query( $args );
	?>

	<?php if ($postsQuery->have_posts()) : ?>
		<div class="posts <?php echo $layout; ?>">
			<?php while ($postsQuery->have_posts()) : $postsQuery->the_post(); ?>
				<div class="excerpt">
						
					<?php if ( get_field( 'show_date' ) && !is_admin() ) { ?>
						<p class="meta"><?php the_date('d F Y'); ?></p>
					<?php } ?>
				
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					
					<?php if ( !is_admin() ) { ?>
						
						<?php if ( get_field( 'read_more' ) ) { ?>
							<a class="btn-sm" href="<?php the_permalink(); ?>">
								Read more
								<svg role="img" xmlns="http://www.w3.org/2000/svg" width="23" height="12"><path fill="#621244" fill-rule="nonzero" d="M16.707 11.914L15.293 10.5l3.293-3.293H0v-2h18.586l-3.293-3.293L16.707.5l5.707 5.707z"/></svg>	
							</a>
						<?php } ?>
						
					<?php } ?>	
				</div>		
			<?php endwhile; ?>
		</div>
		
	<?php endif; wp_reset_query(); ?>

</div>

<?php if ( is_admin() ) { ?>
	<style type="text/css">
		.excerpt {
			margin: 0 0 10px 0;
			padding: 15px;
			background: #fafafa;
		}
		.excerpt h3 {
			font-size: 18px!important;
			margin: 0!important;
		}
		.excerpt h3 a {
			text-decoration: none;
			color: #444;
		}
	</style>
<?php } ?>