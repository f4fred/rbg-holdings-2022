<?php get_header(); ?>

	<?php require_once('extensions/bir-banners/templates/home-banners.php'); ?>

	<div class="container">

		<div class="layout wrap">

			<div class="content">

				<?php if (have_posts()): while (have_posts()): the_post(); ?>

					<?php the_content(); ?>

				<?php endwhile; endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
