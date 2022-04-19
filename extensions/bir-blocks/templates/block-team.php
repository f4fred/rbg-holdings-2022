<?php

# ------------------------------------------
# GUTENBERG: TEAM
# ------------------------------------------ 

$id = 'team-' . $block['id'];
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
			<?php while ($teamQuery->have_posts()): $teamQuery->the_post(); ?>
				<div class="team-member">
					
					<div class="head">
						<?php 
							if ( !is_admin() ) { 
									$image = get_field('photo', $post);
								$size = 'full';
								if( $image ) {
									echo wp_get_attachment_image( $image, $size );
								} else {
									echo '<img src="'.get_stylesheet_directory_uri().'/img/framework/team-member.jpg" width="500" height="500" alt="" />';
								}
							}
						?>
						
						<h3 class="name">
							<span>
								<?php the_title(); ?>
								<em class="pos"><?php the_field('position', $post); ?></em>
							</span>
						</h3>
					</div>
					
					<?php if ( !is_admin() ) { ?>
						<div class="bio">
							<?php the_field('biography', $post); ?>
						</div>
					<?php } ?>
				
				</div>
			<?php endwhile; ?>
	<?php endif; wp_reset_query(); ?>

</div>

<?php if ( is_admin() ) { ?>
	<style type="text/css">
		.team-member {
			margin: 0 0 10px 0;
			padding: 15px;
			background: #fafafa;
		}
		.team-member h3.name {
			font-size: 18px!important;
			margin: 0!important;
		}
		.team-member h3.name em {
			display: block;
			font-size: 80%;
			font-style: normal;
		}
	</style>
<?php } ?>

