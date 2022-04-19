<?php 
/*
*   Breadcrumbs
*   Description: If breadcrumbs are enabled then this will display it at the top of the page
*/

$parent_pageID = wp_get_post_parent_id(get_the_ID());

?>

<div class="breadcrumbs">
    <div class="wrap">
    <?php if ($parent_pageID): ?>
        <a href="<?php echo get_the_permalink( $parent_pageID ); ?>"><h3 class="widget-title"><?php echo get_the_title( $parent_pageID ); ?></h3></a>
    <?php elseif(current_is_parent() || is_page()): ?>

    <h3 class="widget-title"><?php the_title(); ?></h3>

    <?php elseif(is_home() || is_single()): ?>
        <h3 class="widget-title">Media</h3>
    <?php endif; ?>
    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    </div>
</div>