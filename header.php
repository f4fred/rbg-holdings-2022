<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

	<?php
		if(true === get_theme_mod('show_topbar')) {
	?>

		<section id="topbar">

			<div class="wrap">
				<?php if ( is_active_sidebar( 'topbar-left' ) ) { ?>
					<div class="col left">
						<?php dynamic_sidebar( 'topbar-left' ); ?>
					</div>
				<?php } ?>

				<?php if ( is_active_sidebar( 'topbar-right' ) ) { ?>
					<div class="col right clear">
						<?php dynamic_sidebar( 'topbar-right' ); ?>
					</div>
				<?php } ?>
			</div>

		</section>

	<?php } ?>

	<header class="header full-width" aria-label="site header">

		<div class="wrap">

			<?= is_front_page() ? '<h1 class="logo">' : '<div class="logo">' ?>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php get_template_part('extensions/bir-template-parts/template-part', 'logo'); ?>
				<span class="screen-reader-text"><?php bloginfo('name'); ?></span>
			</a>

			<?php if( true === get_theme_mod( 'show_tagline' ) ) { ?>
				<em class="tagline"><?php bloginfo( 'description' ); ?></em>
			<?php } ?>

			<?= is_front_page() ? '</h1>' : '</div>' ?>

			<div class="header-right">

				<?php if ( has_nav_menu( 'primary' ) ) { ?>
					<?php $hambClasses = '';

					if( get_field('menu_full_page_height','option')) {
						$hambClasses .= 'full-height ';
					}
					if( get_field('menu_full_page_width','option')) {
						$hambClasses .= 'full-width ';
					}
					if( get_field('menu_sub_menu_collapsed','option')) {
						$hambClasses .= 'collapsed ';
					}
					if( get_field('menu_scrollable','option')) {
						$hambClasses .= 'scrollable ';
					}
					if( get_field('menu_parent_page_clickable','option')) {
						$hambClasses .= 'not-clickable ';
					} else {$hambClasses .= 'clickable ';}
				?>

				<nav id="site-navigation"
				class="header-nav <?php echo $hambClasses;?>"
				aria-label="main navigation"
				aria-expanded="false"
				>
				<?php wp_nav_menu(array(
					'theme_location' => 'primary',
					'container' => false,
					'walker' => new clean_walker)
					);

					get_search_form();
				?>
				<a class="search-trigger"><i class="fa-solid fa-magnifying-glass"></i></a>
				
				</nav>

				<?php } ?>

				<button id="nav_mobile"
				 data-menu-mobile-anim="<?php the_field('menu_animation', 'option') ?>"
				 data-menu-mobile-anim-speed="<?php the_field('menu_animation_speed', 'option') ?>"
				 class="burger-menu"
				 aria-label="main navigation controls"
				 aria-controls="site-navigation"
				 >
					 <span></span>
					 <span></span>
					 <span></span>
					 <span></span>
			 	</button>

			</div><!-- .header-right -->

		</div>
	</header>

	<div class="search-overlay">

	</div>


	<main aria-label="main content">