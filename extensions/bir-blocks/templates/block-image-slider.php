<?php

# ------------------------------------------
# GUTENBERG: IMAGE SLIDER
# ------------------------------------------ 

// Create id attribute allowing for custom "anchor" value.
$id = 'image-slider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'bir-block image-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$image_slider = get_field('image_slider_gallery');

?>

<div id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">

    <?php
        if( $image_slider ): 
    ?>
        <ul>
            <?php foreach( $image_slider as $image_single ): ?>
                <li>

                    <a href="<?php echo esc_url($image_single['url']); ?>">
                        <img src="<?php echo esc_url($image_single['sizes']['large']); ?>" alt="<?php echo esc_attr($image_single['alt']); ?>" />
                    </a>

                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>


<?php if ( is_admin() ) { ?>
    <style type="text/css">
        .image-slider ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .image-slider ul li {
            width: 200px;
            height: 180px;
            background: grey;
            margin: 5px;
            display: flex;
        }
        .image-slider ul li img {
            height: 100%;
            width: 100%;
        }
	</style>
<?php } ?>