<?php

# ------------------------------------------
# GUTENBERG: BIR HEADER
# ------------------------------------------

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'bir-block bir-header';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>

<div class="<?php echo esc_attr($className); ?>">
    <<?= get_field('header_level') ?>><?= get_field('header_text') ?></<?= get_field('header_level') ?>>
    <div class="header-after">
        <div class="spacer"></div>
    </div>
</div>

<?php if ( is_admin() ) { ?>
    <style type="text/css">

    </style>
<?php } ?>