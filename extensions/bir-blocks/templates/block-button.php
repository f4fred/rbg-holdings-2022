<?php

# ------------------------------------------
# GUTENBERG: BUTTON
# ------------------------------------------ 
// Create id attribute allowing for custom "anchor" value.
$id = 'button-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'button';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$button_label = get_field('button_label');
$button_url = get_field('button_url');
$button_target = get_field('button_new_tab');

?>

<a id="<?php echo $id; ?>" href="<?php echo $button_url; ?>" class="btn <?php echo esc_attr($className); ?>"<?php if($button_target): ?> target="_blank"<?php endif; ?>> 
    <?php if($button_label): echo '<span>' . $button_label . '</span>'; endif; ?><i class="fa-solid fa-circle-chevron-right"></i>
</a>

<?php if ( is_admin() ) { ?>
	<style type="text/css">
		
	</style>
<?php } ?>