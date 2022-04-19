<?php get_header(); ?>

    <?php require_once('extensions/bir-banners/templates/inner-banners.php'); ?>

    <div class="container">
    <?php require_once('extensions/bir-banners/templates/breadcrumbs.php'); ?>


        <div class="layout wrap <?php if( get_field('enable_sidebar')) { echo "sidebar-enabled"; } else {echo "full-width"; } ?>">
        
            <div class="content">

                <?php if (have_posts()): while (have_posts()): the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile; endif; ?>
                
            </div>

            <?php
                if( get_field('enable_sidebar')):
                    get_sidebar();
                endif;
            ?>

        </div>

    </div>

<?php get_footer(); ?>



