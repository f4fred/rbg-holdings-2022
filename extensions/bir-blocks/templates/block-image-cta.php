<?php

# ------------------------------------------
# GUTENBERG: IMAGE CTA
# ------------------------------------------ 

// Create id attribute allowing for custom "anchor" value.
$id = 'image-cta-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'bi-block image-cta';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$image_cta_title = get_field('image_cta_title');
$image_cta_content = get_field('image_cta_content');
$image_cta_background = get_field('image_cta_background');
$image_cta_button_label = get_field('image_cta_button_label');
$image_cta_button_url = get_field('image_cta_button_url');
$image_cta_button_icon = get_field('image_cta_button_icon');
$image_cta_background_parallax = get_field('image_cta_background_parallax');
$image_cta_button_position_title = get_field('image_cta_position_button_title');
$title_wrapper = '';

?>

<div id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>" style="background-image: url('<?php echo $image_cta_background; ?>');<?php if($image_cta_background_parallax): ?>background-attachment: fixed;<?php endif; ?>">

    <div class="image-cta-overlay"></div>

    <div class="wrap">

        <div class="image-cta-content-wrapper">

            <?php 

                if($image_cta_button_url && $image_cta_button_position_title): 
                    $title_wrapper = true;
                    
            ?>

                <div class="image-cta-content-title-wrapper">
            
            <?php endif; ?>

            <?php if($image_cta_title): ?><h2><?php echo $image_cta_title; ?></h2><?php endif; ?>

            <?php if($title_wrapper): ?>

                    <a href="<?php echo $image_cta_button_url; ?>" class="btn">
                        <span><?php echo $image_cta_button_label; ?><?php if($image_cta_button_icon) { get_template_part('extensions/bir-template-parts/template-part', 'arrowright'); } ?></span>
                    </a>

                </div><!-- .image-cta-content-title-wrapper -->

            <?php endif; ?>


            <?php if($image_cta_content): ?><p><?php echo $image_cta_content; ?></p><?php endif; ?>

            <?php if($image_cta_button_url && !$image_cta_button_position_title): ?>

                <a href="<?php echo $image_cta_button_url; ?>" class="btn">
                    <span><?php echo $image_cta_button_label; ?> <?php if($image_cta_button_icon) { get_template_part('extensions/bir-template-parts/template-part', 'arrowright'); } ?></span>
                </a>

            <?php endif; ?>

        </div><!-- .image-content-wrapper -->

    </div>

</div>


<?php if ( is_admin() ) { ?>
	<style type="text/css">
		.image-cta {
			min-height: 300px;
            padding: 20px;
            background-position: center;
        }
        .image-cta.alignfull .wrap,
        .image-cta.alignwide .wrap {
            max-width: 720px;
            margin: 0 auto;
        }
	</style>
<?php } ?>