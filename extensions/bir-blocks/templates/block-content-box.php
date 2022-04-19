<?php

# ------------------------------------------
# GUTENBERG: CONTENT BOX
# ------------------------------------------ 
// Create id attribute allowing for custom "anchor" value.
$id = 'content-box-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'content-box';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$bg = get_field('cb_background_image');


?>

<div id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>"<?php if( $bg ): ?> style="background-image: url(<?php echo $bg; ?>);"<?php endif; ?>> 
	
	<?php if ( is_admin() ) { ?>
        <span class="content-box-label">Content Box</span>
    <?php } ?>

	<?php if( $bg ): ?>
		<div class="content-box-overlay"></div>
	<?php endif; ?>
	
	<div class="content-box-content">

		<InnerBlocks />

	</div>
	
</div>


<?php if ( is_admin() ) { ?>
	<style type="text/css">
        .content-box {
            border: 2px solid #007cba;
            border-radius: 5px;
            padding: 20px;
            min-height: 50px;
            position: relative;
            background-size: cover;
        }
        .content-box-label {
            position: absolute;
            top: 0;
            right: 0;
            background: #007cba;
            color: white;
            padding: 0 10px;
            font-size: 12px;
            border-radius: 0 0 0 5px;
        }
	</style>
<?php } ?>