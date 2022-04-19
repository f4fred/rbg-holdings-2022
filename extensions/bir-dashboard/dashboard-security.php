<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# SECURITY
# ------------------------------------------

    # ------------------------------------------
    # SECURITY: DISABLE JSON API
    # ------------------------------------------
    function gf_remove_api () {
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
    }
    add_action( 'after_setup_theme', 'gf_remove_api' );

    # ------------------------------------------
    # SECURITY: REMOVE EMOJI
    # ------------------------------------------
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    # ------------------------------------------
    # SECURITY: REMOVE WORDPRESS VERSION
    # ------------------------------------------
    add_filter('the_generator', '__return_false');

    # ------------------------------------------
    # SECURITY: DISABLE PING BACK SCANNER AND XMLRPC
    # ------------------------------------------
    add_filter( 'wp_xmlrpc_server_class', '__return_false' );
    add_filter('xmlrpc_enabled', '__return_false');

    # ------------------------------------------
    # SECURITY: REMOVE UNNECESSARY HEADER INFORMATION
    # ------------------------------------------
    function gf_remove_header_info() {
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head',10,0); // for WordPress >= 3.0
    }
    add_action('init', 'gf_remove_header_info');

    # ------------------------------------------
    # SECURITY: CHANGE LOGIN ERROR
    # ------------------------------------------
    function gf_hide_login_errors(){    
        return 'Invalid input!';    
    }
    add_filter( 'login_errors' , 'gf_hide_login_errors' );

    # ------------------------------------------
    # SECURITY: DISABLE RSS FEEDS
    # ------------------------------------------
    function gf_disable_feed() {
        wp_die( __('No feed available, please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
    }
    add_action('do_feed', 'gf_disable_feed', 1);
    add_action('do_feed_rdf', 'gf_disable_feed', 1);
    add_action('do_feed_rss', 'gf_disable_feed', 1);
    add_action('do_feed_rss2', 'gf_disable_feed', 1);
    add_action('do_feed_atom', 'gf_disable_feed', 1);
    add_action('do_feed_rss2_comments', 'gf_disable_feed', 1);
    add_action('do_feed_atom_comments', 'gf_disable_feed', 1);

    # ------------------------------------------
    # SECURITY: DISABLE JSON REST API
    # ------------------------------------------
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');

    # ------------------------------------------
    # SECURITY: REMOVE XPINGBACK
    # ------------------------------------------
    function gf_remove_x_pingback($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    }
    add_filter('wp_headers', 'gf_remove_x_pingback');

    # ------------------------------------------
    # SECURITY: DISABLE COMMENTS
    # ------------------------------------------
    function gf_disable_comments_status() {
        return false;
    }
    add_filter('comments_open', 'gf_disable_comments_status', 20, 2);
    add_filter('pings_open', 'gf_disable_comments_status', 20, 2);

    # ------------------------------------------
    # SECURITY: REMOVE COMMENT PAGE FROM WP DASHBOARD
    # ------------------------------------------
    function gf_disable_comments_admin_menu() {
        remove_menu_page('edit-comments.php');
    }
    add_action('admin_menu', 'gf_disable_comments_admin_menu');

    # ------------------------------------------
    # SECURITY: REMOVE VERSION NUMBER FROM SCRIPTS
    # ------------------------------------------
    function gf_remove_wp_ver_css_js( $src ) {
        if ( strpos( $src, 'ver=' ) )
            $src = remove_query_arg( 'ver', $src );
        return $src;
    }
    add_filter( 'style_loader_src', 'gf_remove_wp_ver_css_js', 9999 );
    add_filter( 'script_loader_src', 'gf_remove_wp_ver_css_js', 9999 );

    # ------------------------------------------
    # SECURITY: PREVENT MULTISITE SIGNUP
    # ------------------------------------------
    function gf_prevent_multisite_signup()
    {
        wp_redirect( site_url() );
        die();
    }
    add_action( 'signup_header', 'gf_prevent_multisite_signup' );

    # ------------------------------------------
    # SECURITY: CHANGE AUTHOR URL SLUG TO NICKNAME
    # source: http://wordpress.stackexchange.com/questions/5742/change-the-author-slug-from-username-to-nickname
    # ------------------------------------------
    function wpse5742_request( $query_vars ) {
        if ( array_key_exists( 'author_name', $query_vars ) ) {
            global $wpdb;
            $author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='nickname' AND meta_value = %s", $query_vars['author_name'] ) );
            if ( $author_id ) {
                $query_vars['author'] = $author_id;
                unset( $query_vars['author_name'] );
            }
        }
    
        return $query_vars;
    }
    add_filter( 'request', 'wpse5742_request' );
    
    function wpse5742_author_link( $link, $author_id, $author_nicename ) {
        $author_nickname = get_user_meta( $author_id, 'nickname', true );
        if ( $author_nickname ) {
            $link = str_replace( $author_nicename, $author_nickname, $link );
        }
        return $link;
    }
    add_filter( 'author_link', 'wpse5742_author_link', 10, 3 );
    
    function wpse5742_set_user_nicename_to_nickname( &$errors, $update, &$user ) {
        if ( ! empty( $user->nickname ) ) {
            $user->user_nicename = sanitize_title( $user->nickname, $user->display_name );
        }
    }
    add_action( 'user_profile_update_errors', 'wpse5742_set_user_nicename_to_nickname', 10, 3 );
    

    # ------------------------------------------
    # SECURITY: DISABLE AUTHOR PAGE TO BLOCK ENUM SCANNING
    # source: https://perishablepress.com/stop-user-enumeration-wordpress/
    # ------------------------------------------
    if (!is_admin()) {
        // default URL format
        if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die(); add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
    }
    function shapeSpace_check_enum($redirect, $request) {
        // permalink URL format
        if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die(); else return $redirect;
    }

?>