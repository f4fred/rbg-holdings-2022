<?php

# ------------------------------------------
# GUTENBERG: ROW
# ------------------------------------------ 

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

$className = 'bir-block row';

if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}


// Wrapper
$row_wrapper_start = '';
$row_wrapper_end = '';
if(get_field('row_enable_wrapper')) {
    $row_wrapper_start = '<div class="wrap">';
    $row_wrapper_end = '</div>';
}

// Background
$row_background_image_style = '';
if(get_field('row_background_type') == 'image') {
    $row_background_image_style = 'background-image: url('.get_field("row_background_image").');';
}
$row_background_color = '';
if(get_field('row_background_color')){
    $row_background_color = ' dark';
}else{
    $row_background_color = ' light';
}

// Overlay 
$row_overlay = '';
if(get_field('row_background_overlay')) {
    $row_overlay = '<div class="row-bg-overlay"></div>';
}

// Styling attr
$row_style = ' style="'.$row_background_image_style.'"';


?>


<div class="<?php echo esc_attr($className); echo $row_background_color; ?>"<?php echo $row_style; ?>>

    <?php echo $row_overlay; ?>

    <?php if ( is_admin() ) { ?>
        <span class="row-label">Row</span>
    <?php } ?>

    <?php echo $row_wrapper_start; ?>

        <InnerBlocks />

    <?php echo $row_wrapper_end; ?>

</div>


<?php if ( is_admin() ) { ?>
	<style type="text/css">
        .row {
            border: 2px solid #007cba;
            border-radius: 5px;
            padding: 20px;
            min-height: 50px;
            position: relative;
        }
        .row-label {
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