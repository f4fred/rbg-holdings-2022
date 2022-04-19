<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# ENQUEUE
# ------------------------------------------

    # ------------------------------------------
    # ENQUEUE SCRIPTS AND STYLE
    # ------------------------------------------
    function enqueue_scripts_and_style() {

        wp_enqueue_script( 'jquery' );

        // packages
        wp_enqueue_script('slick-js', get_stylesheet_directory_uri() . '/packages/slick/_slick.js', array(), '', false);
        wp_enqueue_script('waypoints-js', get_stylesheet_directory_uri() . '/packages/waypoints/_jquery.waypoints.min.js', array(), '', false);
        wp_enqueue_script('countto-js', get_stylesheet_directory_uri() . '/packages/countto/_jquery.countTo.js', array(), '', false);

        // extensions
        wp_enqueue_script('bir-banners-js', get_stylesheet_directory_uri() . '/extensions/bir-banners/js/_birbanners.js', array(), '', false);
        wp_enqueue_script('bir-blocks-js', get_stylesheet_directory_uri() . '/extensions/bir-blocks/js/_blocks-frontend.js', array(), '', false);

        // scripts
        wp_enqueue_script('scripts-js', get_stylesheet_directory_uri() . '/js/custom.js', array(), '', false);

        // style
        wp_enqueue_style('style-base', get_stylesheet_directory_uri() . '/style-base.css' );        
        
        // fancybox    
        wp_enqueue_style( 'fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
        wp_enqueue_script( 'fancybox-js', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '', true );	

    }

    add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_style' );
    add_action( 'login_enqueue_scripts', 'enqueue_scripts_and_style', 10 );

    
?>