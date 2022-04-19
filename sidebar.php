<div class="sidebar">
	
	<?php

		global $post;
		$parent_pageID = wp_get_post_parent_id(get_the_ID());

		$sidebar = get_field('select_sidebar');

	?>

	<?php if(is_page()){ ?>

		<div class="sidebar-widget">

			<?php dynamic_sidebar($sidebar); ?>

		</div>

	<?php }elseif(is_home() || is_single() || is_archive()){ ?>
		<div class="sidebar-widget">

		<?php if ($parent_pageID): ?>

			<h3 class="widget-title"><a href="<?php echo get_the_permalink( $parent_pageID ); ?>"><?php echo get_the_title( $parent_pageID ); ?></a></h3>

			<?php elseif(current_is_parent()): ?>

			<h3 class="widget-title"><?php the_title(); ?></h3>
			
		<?php endif; ?>

		<?php dynamic_sidebar('primary'); ?>

		</div>
		
	<?php } ?>

</div>