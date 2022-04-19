<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# CPT
# ------------------------------------------

  # ------------------------------------------
  # CPT - CALENDAR
  # ------------------------------------------
  function post_type_calendar() {

    $labels = array(
      'name' => _x('Calendar', 'post type general name'),
      'singular_name' => _x('Event', 'post type singular name'),
      'menu_name' => _x('Calendar', 'post type singular name'),
      'add_new' => _x('Add new event', 'ir'),
      'add_new_item' => __('Add new event'),
      'edit_item' => __('Edit event'),
      'new_item' => __('New event'),
      'view_item' => __('View event'),
      'search_items' => __('Search events'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in trash'),
      'parent_item_colon' => ''
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => false,
      'exclude_from_search' => false,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'show_in_admin_bar' => false,
      'menu_position'=> 20,
      'menu_icon' => 'dashicons-calendar-alt',
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'supports' => array('title')
    );

    register_post_type( 'calendar' , $args );

  }
  add_action('init', 'post_type_calendar');



if(true === get_theme_mod('ir_add_docs')) {

  # ------------------------------------------
  # CPT - DOCS
  # ------------------------------------------
  function post_type_document() {

    $labels = array(
      'name' => _x('Documents', 'post type general name'),
      'singular_name' => _x('Document', 'post type singular name'),
      'menu_name' => _x('Documents', 'post type singular name'),
      'add_new' => _x('Add new', 'ir'),
      'add_new_item' => __('Add new document'),
      'edit_item' => __('Edit document'),
      'new_item' => __('New document'),
      'view_item' => __('View document'),
      'search_items' => __('Search documents'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in trash'),
      'parent_item_colon' => ''
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'show_in_admin_bar' => false,
      'menu_position'=> 20,
      'menu_icon' => 'dashicons-welcome-write-blog',
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'supports' => array('title')
    );

    register_post_type( 'documents' , $args );

  }
  add_action('init', 'post_type_document');

  # ------------------------------------------
  # CPT - CREATE TAX DOCUMENT CATEGORIES
  # ------------------------------------------
  function create_document_category() {
    
    $labels = array(
      'name' => _x( 'Document type', 'taxonomy general name' ),
      'singular_name' => _x( 'Document type', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search types' ),
      'all_items' => __( 'All types' ),
      'parent_item' => __( 'Parent type' ),
      'parent_item_colon' => __( 'Parent type:' ),
      'edit_item' => __( 'Edit type' ),
      'update_item' => __( 'Update type' ),
      'add_new_item' => __( 'Add new type' ),
      'new_item_name' => __( 'New type name' ),
      'menu_name'         => __( 'Types' ),
    );

    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
    );

    register_taxonomy( 'document-type', array( 'documents' ), $args );

  }
  add_action( 'init', 'create_document_category', 0 );

}


# ------------------------------------------
# CPT - SIDEBAR
# ------------------------------------------
// function post_type_sidebar() {

//   $labels = array(
//     'name' => _x('Sidebar Blocks', 'post type general name'),
//     'singular_name' => _x('Sidebar Block', 'post type singular name'),
//     'menu_name' => _x('Sidebar Blocks', 'post type singular name'),
//     'add_new' => _x('Add New', 'ir'),
//     'add_new_item' => __('Add new Block'),
//     'edit_item' => __('Edit Block'),
//     'new_item' => __('New Block'),
//     'view_item' => __('View Block'),
//     'search_items' => __('Search Sidebar Blocks'),
//     'not_found' =>  __('Nothing found'),
//     'not_found_in_trash' => __('Nothing found in trash'),
//     'parent_item_colon' => ''
//   );

//   $args = array(
//     'labels' => $labels,
//     'public' => true,
//     'publicly_queryable' => true,
//     'exclude_from_search' => true,
//     'show_ui' => true,
//     'show_in_menu' => true,
//     'show_in_nav_menus' => false,
//     'menu_position'=> 20,
//     'menu_icon' => 'dashicons-align-right',
//     'query_var' => true,
//     'rewrite' => true,
//     'capability_type' => 'post',
//     'hierarchical' => false,
//     'has_archive' => false,
//     'supports' => array('title')
//   );

//   register_post_type( 'sidebar' , $args );

// }
// add_action('init', 'post_type_sidebar');


if(true === get_theme_mod('ir_add_team')) {

  # ------------------------------------------
  # CPT - TEAM
  # ------------------------------------------
  function post_type_team() {

    $labels = array(
      'name' => _x('Team', 'post type general name'),
      'singular_name' => _x('Team', 'post type singular name'),
      'menu_name' => _x('Team', 'post type singular name'),
      'add_new' => _x('Add New', 'ir'),
      'add_new_item' => __('Add new person'),
      'edit_item' => __('Edit person'),
      'new_item' => __('New person'),
      'view_item' => __('View person'),
      'search_items' => __('Search team'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in trash'),
      'parent_item_colon' => ''
    );

    $args = array(
      'labels' => $labels,
      'public' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'menu_position'=> 20,
      'menu_icon' => 'dashicons-groups',
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'supports' => array('title')
    );

    register_post_type( 'team' , $args );

  }
  add_action('init', 'post_type_team');

  # ------------------------------------------
  # CPT - CREATE TAX TEAM CATEGORIES
  # ------------------------------------------
  function create_team_category() {
    
    $labels = array(
      'name' => _x( 'Team category', 'taxonomy general name' ),
      'singular_name' => _x( 'Team category', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search categories' ),
      'all_items' => __( 'All categories' ),
      'parent_item' => __( 'Parent category' ),
      'parent_item_colon' => __( 'Parent category:' ),
      'edit_item' => __( 'Edit category' ),
      'update_item' => __( 'Update category' ),
      'add_new_item' => __( 'Add new category' ),
      'new_item_name' => __( 'New category name' ),
      'menu_name'         => __( 'Categories' ),
    );

    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
    );

    register_taxonomy( 'team-category', array( 'team' ), $args );

  }
  add_action( 'init', 'create_team_category', 0 );

}

if(true === get_theme_mod('ir_add_jobs')) {

  # ------------------------------------------
  # CPT - CAREERS
  # ------------------------------------------
  function post_type_careers() {

    $labels = array(
      'name' => _x('Vacancies', 'post type general name'),
      'singular_name' => _x('Vacancy', 'post type singular name'),
      'menu_name' => _x('Vacancies', 'post type singular name'),
      'add_new' => _x('Add New', 'ir'),
      'add_new_item' => __('Add new vacancy'),
      'edit_item' => __('Edit vacancy'),
      'new_item' => __('New vacancy'),
      'view_item' => __('View vacancy'),
      'search_items' => __('Search vacancies'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in trash'),
      'parent_item_colon' => ''
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'menu_position'=> 20,
      'menu_icon' => 'dashicons-id',
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'supports' => array('title', 'editor')
    );

    register_post_type( 'careers' , $args );

  }
  add_action('init', 'post_type_careers');

}

if(true === get_theme_mod('ir_add_casestudies')) {
    
  # ------------------------------------------
  # CPT - CASE STUDIES
  # ------------------------------------------
  function post_type_casestudies() {

    $labels = array(
      'name' => _x('Case studies', 'post type general name'),
      'singular_name' => _x('Case study', 'post type singular name'),
      'menu_name' => _x('Case studies', 'post type singular name'),
      'add_new' => _x('Add New', 'ir'),
      'add_new_item' => __('Add new case study'),
      'edit_item' => __('Edit case study'),
      'new_item' => __('New case study'),
      'view_item' => __('View case study'),
      'search_items' => __('Search case studies'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in trash'),
      'parent_item_colon' => ''
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'menu_position'=> 5,
      'menu_icon' => 'dashicons-portfolio',
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
    );

    register_post_type( 'case-studies' , $args );

  }
  add_action('init', 'post_type_casestudies');

  # ------------------------------------------
  # CPT - CREATE TAX CASE STUDY CATEGORIES
  # ------------------------------------------
  function create_casestudy_category() {
    
    $labels = array(
      'name' => _x( 'Case study category', 'taxonomy general name' ),
      'singular_name' => _x( 'Case study category', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search categories' ),
      'all_items' => __( 'All categories' ),
      'parent_item' => __( 'Parent category' ),
      'parent_item_colon' => __( 'Parent category:' ),
      'edit_item' => __( 'Edit category' ),
      'update_item' => __( 'Update category' ),
      'add_new_item' => __( 'Add new category' ),
      'new_item_name' => __( 'New category name' ),
      'menu_name'         => __( 'Categories' ),
    );

    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
    );

    register_taxonomy( 'case-study', array( 'case-studies' ), $args );

  }
  add_action( 'init', 'create_casestudy_category', 0 );
  
}

if(true === get_theme_mod('ir_add_testimonials')) {

  # ------------------------------------------
  # CPT - TESTIMONIALS
  # ------------------------------------------
  function post_type_testimonials() {
  
    $labels = array(
      'name' => _x('Testimonials', 'post type general name'),
      'singular_name' => _x('Testimonials', 'post type singular name'),
      'menu_name' => _x('Testimonials', 'post type singular name'),
      'add_new' => _x('Add New', 'ir'),
      'add_new_item' => __('Add new testimonial'),
      'edit_item' => __('Edit testimonial'),
      'new_item' => __('New testimonial'),
      'view_item' => __('View testimonial'),
      'search_items' => __('Search testimonials'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in trash'),
      'parent_item_colon' => ''
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'menu_position'=> 20,
      'menu_icon' => 'dashicons-format-quote',
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'supports' => array('title', 'editor')
    );

    register_post_type( 'testimonial' , $args );

  }
  add_action('init', 'post_type_testimonials');

}

if(true === get_theme_mod('ir_add_calendar')) {

  # ------------------------------------------
  # CPT - CALENDAR
  # ------------------------------------------
  function post_type_calendar() {

    $labels = array(
      'name' => _x('Calendar', 'post type general name'),
      'singular_name' => _x('Calendar', 'post type singular name'),
      'menu_name' => _x('Calendar', 'post type singular name'),
      'add_new' => _x('Add new', 'ir'),
      'add_new_item' => __('Add new event'),
      'edit_item' => __('Edit event'),
      'new_item' => __('New event'),
      'view_item' => __('View event'),
      'search_items' => __('Search event'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in trash'),
      'parent_item_colon' => ''
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'menu_position'=> 20,
      'menu_icon' => 'dashicons-calendar',
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'supports' => array('title')
    );

    register_post_type( 'calendar' , $args );

  }
  add_action('init', 'post_type_calendar');

}

if(true === get_theme_mod('ir_add_faq')) {
    
  #------------------------------------------
  # CPT - FAQ
  # ------------------------------------------
  function post_type_faq() {

    $labels = array(
      'name' => _x('FAQ', 'post type general name'),
      'singular_name' => _x('FAQ', 'post type singular name'),
      'menu_name' => _x('FAQ', 'post type singular name'),
      'add_new' => _x('Add new', 'ir'),
      'add_new_item' => __('Add new'),
      'edit_item' => __('Edit'),
      'new_item' => __('New'),
      'view_item' => __('View'),
      'search_items' => __('Search'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in trash'),
      'parent_item_colon' => ''
    );

    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'show_in_admin_bar' => false,
      'menu_position'=> 20,
      'menu_icon' => 'dashicons-welcome-write-blog',
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'supports' => array("title", "editor", "custom-fields")
    );

    register_post_type( 'faq' , $args );

  }
  add_action('init', 'post_type_faq');

  # ------------------------------------------
  # CPT - CREATE TAX FAQ CATEGORIES
  # ------------------------------------------
  function create_faq_category() {

    $labels = array(
      'name' => _x( 'FAQ category', 'taxonomy general name' ),
      'singular_name' => _x( 'FAQ category', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search category' ),
      'all_items' => __( 'All category' ),
      'parent_item' => __( 'Parent category' ),
      'parent_item_colon' => __( 'Parent category:' ),
      'edit_item' => __( 'Edit category' ),
      'update_item' => __( 'Update category' ),
      'add_new_item' => __( 'Add new category' ),
      'new_item_name' => __( 'New category name' ),
      'menu_name'         => __( 'Types' ),
    );

    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
    );

    register_taxonomy( 'faq-type', array( 'faq' ), $args );

  }
  add_action( 'init', 'create_faq_category', 0 );

}
