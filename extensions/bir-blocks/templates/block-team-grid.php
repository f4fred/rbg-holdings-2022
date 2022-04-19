<?php

# ------------------------------------------
# GUTENBERG: TEAM GRID
# ------------------------------------------

$id = 'team-grid-' . $block['id'];
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
		<div class="team-grid">
			<?php while ($teamQuery->have_posts()): $teamQuery->the_post(); ?>

				<div class="team-member-grid">

					<?php $titleSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', get_the_title()))); ?>
					<div class="team-image">
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
						<div class="name">
							<h3 id="<?php echo $titleSlug; ?>"><?php the_title(); ?></h3>
							<p class="pos"><?php the_field('position', $post); ?></p>
							<?php the_field('institution', $post); ?>
						</div>
					</div>

					<div id="<?php echo  $post->post_name; ?>" class="bio">

						<div class="bio-body fancy-box">

							<div class="bio-name">
								<h3><?php the_title(); ?></h3>
								<p class="pos"><?php the_field('position', $post); ?></p>
								<?php the_field('institution', $post); ?>
							</div>

							<?php the_field('biography', $post); ?>

						</div>
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
		.team-member-grid .name .pos {
			display: block;
			font-size: 80%;
			margin: 5px 0 0 0;
		}
		.team-member-grid a {
			display: block;
			text-decoration: none;
			color: #191e24;
		}
	</style>
<?php } ?>

