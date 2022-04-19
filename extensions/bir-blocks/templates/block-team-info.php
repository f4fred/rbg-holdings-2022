<?php

# ------------------------------------------
# GUTENBERG: TEAM INFO
# ------------------------------------------ 

$id = 'team-info-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

$className = 'bir-block team';

if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$category = get_field('team_category');

?>


<div id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
	
	<?php
		$args = array(
			'post_type' => 'team',
			'posts_per_page' => -1,
			'order' => 'ASC',
			'tax_query' => array(
			    array(
			        'taxonomy' => 'team-category',
			        'field' => 'id',
					'terms'    => $category,
			    )
			)
		);
		$teamQuery = new WP_Query( $args ); 
		global $post;
	?>
	
	<?php if ($teamQuery->have_posts()): ?>
		<div class="team-grid two-col">
			<?php while ($teamQuery->have_posts()): $teamQuery->the_post(); ?>

				<div class="team-member-grid">
					<div class="name">
						<h3><?php the_title(); ?>, <span><?php the_field('position', $post); ?></span></h3>
						<?php the_field('institution', $post); ?>
					</div>
				</div>

				
			<?php endwhile; ?>
		</div>
	<?php endif; wp_reset_query(); ?>

</div>

<?php if ( is_admin() ) { ?>
	<style type="text/css">
		.team-member-grid {
			margin: 0 0 10px 0;
			padding: 15px;
			background: #fafafa;
		}
		.team-member-grid .name h3 {
			font-size: 18px!important;
			margin: 0!important;
		}
		.team-member-grid .name p {
			display: block;
			font-size: 80%;
			margin: 5px 0 0 0;
		}
	</style>
<?php } ?>

