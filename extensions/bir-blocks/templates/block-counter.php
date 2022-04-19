<?php

# ------------------------------------------
# GUTENBERG: COUNTER
# ------------------------------------------ 
// Create id attribute allowing for custom "anchor" value.
$id = 'counter-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'counter';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$counter = get_field('counter_number');
$title = get_field('counter_title');

?>

<div id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>"> 
    <span data-from="0" data-to="<?php echo $counter; ?>" data-speed="2000"><?php echo $counter; ?></span>
    <p><?php echo $title; ?></p>
</div>

<?php if ( is_admin() ) { ?>

	<style type="text/css">
	
	</style>

<?php } else { ?>

	<script type="text/javascript">
		jQuery('.counter span').countTo();
	</script>

<?php } ?>