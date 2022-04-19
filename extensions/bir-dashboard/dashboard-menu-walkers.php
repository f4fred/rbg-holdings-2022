<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# CUSTOM MENU WALKERS
# Version: 1.0 (Last update: 29 Aug 2013)
# ------------------------------------------

    # ------------------------------------------
    # CUSTOM MENU WALKERS: CLEAN WALKER
    # CUSTOM WALKER TO REMOVE ALL THE WP_NAV_MENU JUNK
    # SOURCE: http://forrst.com/posts/Wordpress_cleaner_menu_walker_function-Iwa
    # ------------------------------------------
    class clean_walker extends Walker_Nav_Menu {
        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $current_indicators = array('current-menu-parent', 'current-page-item', 'current-menu-item', 'current-page-parent', 'menu-item-has-children');

            $newClasses = array();

            foreach($classes as $el){

                if (in_array($el, $current_indicators)){
                        array_push($newClasses, $el);
                }

            }

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $newClasses), $item ) );
            
            if($item -> description || get_field('use_mega_menu', $item)){
                if($class_names!='') $class_names = ' class="'. esc_attr( $class_names ) . ' mega-menu"';
            }else{
                if($class_names!='') $class_names = ' class="'. esc_attr( $class_names ) . '"';
            }

            $output .= $indent . '<li' . $value . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            if($depth != 0) {
                //children stuff
            }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

            if($item -> description || get_field('use_mega_menu', $item)){

                $output .= "\n<div class=\"mega-menu\">\n";
                $output .= '<div class="mega-content">';
                if($item -> description){
                    $output .= '<a'. $attributes .'><h4>' . $item->title . '</h4></a>';
                    $output .= '<p>' . $item->description . '</p>';
                }
                $output .= '</div>';
                $indent = str_repeat("\t", $depth);
                $output .= "$indent\n".($depth ? "$indent</div>\n" : "");

            }
        }
    }

    # ------------------------------------------
    # CUSTOM MENU WALKERS: CLEAN PAGE WALKER
    # CUSTOM WALKER TO REMOVE ALL THE WP_LIST_PAGES JUNK
    # Source: http://www.456bereastreet.com/archive/201101/cleaner_html_from_the_wordpress_wp_list_pages_function/
    # ------------------------------------------
    class clean_walker_page extends Walker_Page {

        protected $_itemsNoByDepth = array( 0 => 0 );

        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $this->_itemsNoByDepth[$depth+1] = 0;
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"submenu\"><li><a href=\"#\" class=\"back\" title=\"Back\">Back</a></li>\n";
        }

        function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {
            if ( $depth )
                $indent = str_repeat("\t", $depth);
            else
                $indent = '';

            extract($args, EXTR_SKIP);

            // Apple appropriate class(es)
            $class_attr = '';
            $_current_page = get_page( $current_page );

            if ( !empty($current_page) ) { // If is the current page
                if ( ($page->ID == $current_page )) {
                    $class_attr = 'current_page_item';
                }

            } elseif ( is_single($page->ID) ) { // If is single
                $class_attr = 'current_page_item';

            } elseif ( $class_attr != '' ) {
                $class_attr = $class_attr;
            }


            if($args['has_children']) {
                $href_link = get_page_link($page->ID);
                $arrow = '<span class="subnav-arrow"></span>';
            } else {
                $href_link = get_page_link($page->ID);
            }

            $output .= $indent .'<li class="' . $class_attr . '"><a href="' . $href_link .'" title="'.get_the_title($page->ID).'">' . apply_filters( 'the_title', $page->post_title, $page->ID ).$arrow.'</a>';
        
        }
    }