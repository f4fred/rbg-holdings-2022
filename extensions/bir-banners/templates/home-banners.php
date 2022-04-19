<?php 
/*
*   Home Banners
*   Description: This will add home banners to the home page
*/
?>

<?php if( have_rows('home_banners') ): ?>

<section class="main-slider" data-slick='{ "speed": 600, "pauseOnFocus": false, "autoplaySpeed": <?php the_field('home_banners_autoplay_speed'); ?>, "cssEase": "cubic-bezier(0.87, 0.03, 0.41, 0.9)", <?php if(get_field('home_banners_autoplay')): ?>"autoplay": true, <?php endif; ?><?php if(get_field('home_banners_dots')): ?>"dots": true, <?php endif; ?><?php if(get_field('home_banners_draggable')): ?>"draggable": false, <?php endif; ?><?php if(get_field('home_banners_loop')): ?>"infinite": false, <?php endif; ?><?php if(get_field('home_banners_pause_on_hover')): ?>"pauseOnHover": false, <?php endif; ?><?php if(get_field('home_banners_arrows')): ?>"arrows": true <?php else: ?>"arrows": false <?php endif; ?>}'>

    <?php while ( have_rows('home_banners') ) : the_row(); ?>
  
      <?php if( get_row_layout() == 'standard_banner' ): ?>

        <div class="item image">

          <figure>

            <div class="slide-image slide-media" style="background-image:url('<?php the_sub_field('home_banners_image'); ?>');<?php if(get_sub_field('home_banners_image_position')): ?>background-position: <?php the_sub_field('home_banners_image_position'); ?>;<?php endif; ?>"></div>

            <div class="banner-caption-wrapper">
              
              <div class="wrap">

                <div class="banner-caption<?php if(get_sub_field('home_banners_caption_background')): ?> has-background<?php endif; ?>">

                  <h2><?php the_sub_field('home_banners_main_caption'); ?></h2>
                  <p><?php the_sub_field('home_banners_sub-caption'); ?></p>

                  <?php if ( have_rows('home_banners_buttons') ) : ?>

                    <div class="banner-caption-buttons">

                      <?php while( have_rows('home_banners_buttons') ) : the_row(); ?>
                        <a href="<?php the_sub_field('home_banners_button_url'); ?>" class="<?php the_sub_field('home_banners_button_style'); ?> btn"<?php if(get_sub_field('home_banners_button_new_tab')): ?> target="_blank"<?php endif;?>><span><?php the_sub_field('home_banners_button_text'); ?></span><i class="fa-solid fa-circle-chevron-right"></i></a>
                      <?php endwhile; ?>

                    </div><!-- banner-caption-buttons -->

                  <?php endif; ?>

                </div><!-- banner-caption -->

                <?php if(get_sub_field('home_banners_custom_html')): the_sub_field('home_banners_custom_html'); endif; ?>

              </div><!-- wrap -->

            </div><!-- banner-caption-wrapper -->

            <div class="banner-overlay" style="<?php if(get_sub_field('home_banners_custom_overlay_code')): the_sub_field('home_banners_custom_overlay_code'); endif; ?>"></div><!-- banner-overlay -->

          </figure>
          
        </div>

      <?php elseif(get_row_layout() == 'video_banner'): ?>

        <div class="item <?php the_sub_field('video_type'); ?>">

          <?php if(get_sub_field('video_type') === 'vimeo'): ?>
            <iframe class="embed-player slide-media vimeo" src="https://player.vimeo.com/video/<?php the_sub_field('vimeo_video_id'); ?>?api=1&byline=0&quality=1080p&portrait=0&title=0&background=1&muted=1&loop=1&autoplay=0&autopause=0&id=<?php the_sub_field('vimeo_video_id'); ?>" width="980" height="520" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          <?php else: ?>
            <iframe class="embed-player slide-media youtube" width="980" height="520" src="https://www.youtube.com/embed/<?php the_sub_field('youtube_video_id'); ?>?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&loop=1&playlist=<?php the_sub_field('youtube_video_id'); ?>&start=1&mute=1&autoplay=1" frameborder="0" allowfullscreen></iframe>  
          <?php endif; ?>

          <?php
              $altimg = get_sub_field('home_banners_alt_image');
          ?>

            <div class="home_banners_alt_image" style="background-image: url('<?php echo $altimg; ?>');"></div>

            <div class="banner-caption-wrapper">
              <div class="wrap">

                <div class="banner-caption<?php if(get_sub_field('home_banners_caption_background')): ?> has-background<?php endif; ?>">

                  <h2><?php the_sub_field('home_banners_main_caption'); ?></h2>
                  <p><?php the_sub_field('home_banners_sub-caption'); ?></p>

                  <?php if ( have_rows('home_banners_buttons') ) : ?>

                    <div class="banner-caption-buttons">

                      <?php while( have_rows('home_banners_buttons') ) : the_row(); ?>
                        <a href="<?php the_sub_field('home_banners_button_url'); ?>" class="<?php the_sub_field('home_banners_button_style'); ?> btn"<?php if(get_sub_field('home_banners_button_new_tab')): ?> target="_blank"<?php endif;?>><?php the_sub_field('home_banners_button_text'); ?><i class="fa-solid fa-circle-chevron-right"></i></a>
                      <?php endwhile; ?>

                    </div><!-- banner-caption-buttons -->

                  <?php endif; ?>

                </div><!-- banner-caption -->

                <?php if(get_sub_field('home_banners_custom_html')): the_sub_field('home_banners_custom_html'); endif; ?>

              </div><!-- wrap -->
              
            </div><!-- banner-caption-wrapper -->

            <div class="banner-overlay" style="<?php if(get_sub_field('home_banners_custom_overlay_code')): the_sub_field('home_banners_custom_overlay_code'); endif; ?>"></div><!-- banner-overlay -->        
            
        </div>

      <?php endif; ?>

    <?php endwhile; ?>

  </section>

<?php endif; ?>