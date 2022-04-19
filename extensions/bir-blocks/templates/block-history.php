<?php

# ------------------------------------------
# GUTENBERG: HISTORY
# ------------------------------------------

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'bir-block history';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
$odd_even = 'odd';
?>

<div class="<?php echo esc_attr($className); ?>">
    <?php if(have_rows('years')) : while(have_rows('years')) : the_row(); ?>
        <div class="year-block">
            <div class="year"><?php the_sub_field('year') ?></div>

            <div class="events">
                <?php if(have_rows('events')) : while(have_rows('events')) : the_row(); ?>
                    <div class="event-block <?= $odd_even; ?>"><?php the_sub_field('event') ?></div>
                <?php
                $odd_even = ($odd_even == 'odd' ? 'even' : 'odd');
                endwhile; endif; ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php if ( is_admin() ) { ?>
    <style type="text/css">
        .year-block {
            margin-bottom: 30px;
        }
        .year {
            font-weight: bold;
        }
        .event-block {
            margin-bottom: 15px;
        }
    </style>
<?php } ?>