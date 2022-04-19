<?php get_header(); ?>

<?php require_once('extensions/bir-banners/templates/inner-banners.php'); ?>

<div class="container">
<?php require_once('extensions/bir-banners/templates/breadcrumbs.php'); ?>


        <div class="layout wrap <?php if( get_field('enable_sidebar', get_option('page_for_posts'))) { echo "sidebar-enabled"; } else {echo "full-width"; } ?>">
        
            <div class="content">

			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>

				<div class="the_post">

					<p class="meta"><?php the_date('d F Y'); ?></p>

					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title('<h2>', '</h2>'); ?></a>
					<?php the_excerpt('<p>','</p>'); ?>
					<a href="<?php the_permalink(); ?>" class="btn button is-style-btn-primary"> 
						<span>Read More</span><i class="fa-solid fa-circle-chevron-right"></i>
					</a>

				</div>
				
				<?php endwhile; ?>

				<div class="postnav">

				<?php 
					the_posts_navigation(
						$args = array(
							'prev_text' => __('<strong>Older Posts</strong>', 'ir'),
							
							'next_text' => __('<strong>Newer Posts</strong>', 'ir'),
						)
					);
				?>

				</div>

			<?php endif; ?>
						
            </div>

            <?php

			if(is_home() || is_archive()){
                    get_sidebar();
			}else{
                if( get_field('enable_sidebar')):
                    get_sidebar();
                endif;
			}


            ?>

        </div>

    </div>

	
<?php get_footer(); ?>