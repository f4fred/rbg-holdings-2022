<?php get_header(); ?>

	<?php require_once('extensions/bir-banners/templates/inner-banners.php'); ?>

	<?php while ( have_posts() ) : the_post(); ?>
	
        <div class="container">

		<?php require_once('extensions/bir-banners/templates/breadcrumbs.php'); ?>


			<div class="layout sidebar-enabled wrap">
								
				<div class="content">

					<?php the_content(); ?>

					<div class="postnav">

						<?php 
							the_post_navigation(
								$args = array(
									'prev_text' => __('<strong>%title</strong>', 'ir'),
									
									'next_text' => __('<strong>%title</strong>', 'ir'),
								)
							);
						?>

					</div>

				</div>

				<?php get_sidebar(); ?>

			</div>

        </div>

	<?php endwhile; ?>

<?php get_footer(); ?>
