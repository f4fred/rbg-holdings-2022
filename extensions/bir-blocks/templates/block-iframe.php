<?php

# ------------------------------------------
# GUTENBERG: IFRAME
# ------------------------------------------ 

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

$className = 'bir-block iframe';

if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
?>

<div class="<?php echo esc_attr($className); ?>">
    <iframe id="<?php the_field('iframe_id') ?>" class="bir-tool bir-iframe <?php the_field('class_name') ?>" src="<?php the_field('iframe_url') ?>"></iframe>
</div>


<?php if ( is_admin() ) { ?>
	<style type="text/css">
        iframe {
            height: 100px !important;
        }
	</style>
<?php } ?>

