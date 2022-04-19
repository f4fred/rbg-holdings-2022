<?php get_header(); ?>

    <?php require_once('extensions/bir-banners/templates/inner-banners.php'); ?>

    <div class="container">

        <div class="layout wrap">
        
            <div class="content">

                <?php if (have_posts()): ?>
                    
                    <?php while (have_posts()): the_post(); ?>


                    <div class="search-result">

                        <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                        <?php search_excerpt_highlight(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary"><span><?php echo __( 'Read more', 'ir' ); ?><i class="fa-solid fa-circle-chevron-right"></i></a>


                    </div>

                    <?php endwhile; ?>

                    <?php //ir_pagination(); ?>

                <?php else: ?>

                    <?php
                        echo _e('<h3>Sorry, nothing came up for that search.</h3>');
                        echo _e('<a href="#" class="btn btn-primary search-trigger"><span>Search something else!</span></a>');
                    ?>

                <?php endif; ?>

            </div>

        </div>

    </div>

<?php get_footer(); ?>