<?php if ( have_rows('social_media', 'option') ) : ?>

    <div class="social-wrapper">

        <ul>

            <?php while( have_rows('social_media', 'option') ) : the_row(); ?>

                <li>

                    <a href="<?php the_sub_field('social_media_url'); ?>" target="_blank" title="<?php the_sub_field('social_media_platform'); ?>">
                        <i class="<?php the_sub_field('social_media_icon'); ?>"></i>
                    </a>
                    
                </li>

            <?php endwhile; ?>

        </ul>

    </div><!-- .social-wrapper -->

<?php endif; ?>