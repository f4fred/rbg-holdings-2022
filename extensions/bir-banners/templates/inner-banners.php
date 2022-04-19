<?php 
/*
*   Inner Banner
*/

$inner_height = '';
$inner_background = '';
$map_shortcode = get_field('use_map_shortcode');

// banner image
if(is_404()) {

  $attachment_id = get_field('fourofour_banner_image', 'option');

} elseif(is_search()) {

  $attachment_id = get_field('search_banner_image', 'option');

} elseif(is_home()) {

  $attachment_id = get_field('inner_banner_image', get_option('page_for_posts'));

  if(get_field('inner_banner_height', get_option('page_for_posts'))) {
    $inner_height = 'height: '.get_field('inner_banner_height', get_option('page_for_posts')).'vh;';
  }

  if(!get_field('inner_banner_image', get_option('page_for_posts'))) {
    $inner_background = 'background: red;';
  }

}elseif(is_page()){

  $attachment_id = get_field('inner_banner_image');

  if(get_field('inner_banner_height')) {
    $inner_height = 'height: '.get_field('inner_banner_height').'vh;';
  }
  if(!get_field('inner_banner_image')) {
    $inner_background = 'background: #18181b;';
  }
  
}elseif(is_single() || is_archive()){
  $attachment_id = get_template_directory_uri() . '/img/custom/red_world_map.jpg';
}

// Banner Overlay

if(is_home()){
  if(get_field('inner_banner_custom_overlay_code', get_option('page_for_posts'))){
    $banner_overlay = get_field('inner_banner_custom_overlay_code', get_option('page_for_posts'));
  } 
}else{
  if(get_field('inner_banner_custom_overlay_code')){
    $banner_overlay = get_field('inner_banner_custom_overlay_code');
  }elseif(is_single() || is_search() || is_archive()){
    $banner_overlay = 'background: rgb(255,255,255); background: linear-gradient(0deg, rgba(255,255,255,0.2049413515406162) 0%, rgba(255,255,255,1) 100%);';
  }
}

// Custom Banner Heading
?>

<div class="inner-banner"<?php if($inner_height || $inner_background): ?> style="<?php echo $inner_height.$inner_background; ?>"<?php endif; ?>>

<?php if($map_shortcode):
  echo do_shortcode( $map_shortcode );

  else:

  if($attachment_id): ?>
    <div class="banner-image" style="background-image:url('<?php echo $attachment_id; ?>');<?php if(get_field('inner_banner_image_position')): ?>background-position: <?php the_field('inner_banner_image_position'); ?>;<?php endif; ?>"></div>
  <?php endif; ?>

  <div class="banner-overlay" style="<?php echo $banner_overlay; ?>">

    <div class="wrap">

      <?php if(is_home()){
        echo '<h1 class="page-title">In The News</h1>';
      }elseif(is_search()){

        if (have_posts()):
        echo '<h1 class="page-title">Showing results for: ' . esc_html( get_search_query( false ) ) . '</h1>';
        else:
          echo _e('<h1 class="page-title">Nothing found for <span class="search-term">');
          the_search_query();
          echo _e('</span>.</h1>');
        endif;
          
      }elseif(is_page()){

        if(get_field('custom_banner_heading')){
          echo '<h1 class="page-title">' . get_field('custom_banner_heading') . '</h1>';
        }else{
          echo the_title('<h1 class="page-title">', '</h1>');
        }
      
      }elseif(is_single()){

        echo the_title('<h1 class="page-title">', '</h1>');

        echo the_date('jS F Y', '<h4>', '</h4>');
      }elseif(is_archive()){

        echo '<h1 class="page-title">Archives</h1>';
        echo '<h4>' . get_query_var('year') . '</h4>';

      } ?>

    </div>

  </div><!-- banner-overlay -->

  <?php endif; ?>

</div>
