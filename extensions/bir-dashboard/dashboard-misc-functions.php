<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# MISC
# ------------------------------------------

    # ------------------------------------------
    # MISC: ADD THEME SUPPORT
    # ------------------------------------------
    add_theme_support( 'menus' );

    # ------------------------------------------
    # MISC: REGISTER MENU LOCATIONS
    # ------------------------------------------
    register_nav_menus( array(
        'primary' => "Primary Menu",
    ) );


    register_nav_menus( array(
        'legal' => "Legal",
    ) );

    # ------------------------------------------
    # MISC: REPLACE HTML TAGS WITH HTML5
    # ------------------------------------------
    add_action( 'template_redirect', function() {
        ob_start( function( $buffer ){
            $buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $buffer );
            $buffer = str_replace( array( 'type="text/css"', "type='text/css'" ), '', $buffer );
            $buffer = str_replace( array( 'frameborder="0"', "frameborder='0'" ), '', $buffer );
            $buffer = str_replace( array( 'scrolling="no"', "scrolling='no'" ), '', $buffer );

            return $buffer;
        });
    });

    # ------------------------------------------
    # MISC: DEFAULT EXCERPT LENGTH
    # ------------------------------------------
    function gf_custom_excerpt_length( $length ) {
        return 60;
    }
    add_filter( 'excerpt_length', 'gf_custom_excerpt_length', 999 );

    # ------------------------------------------
    # MISC: CUSTOM EXCERPT LENGTH  -  echo excerpt(45);
    # ------------------------------------------
    function excerpt($limit) {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
        } else {
        $excerpt = implode(" ",$excerpt).'...';
        }
        $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
        return $excerpt;
    }

    # ------------------------------------------
    # MISC: WRAP AROUND VIDEOS
    # ------------------------------------------
    function gf_embed_oembed_html($html, $url, $attr, $post_id) {
        return '<div class="video-wrapper">' . $html . '</div>';
    }
    add_filter('embed_oembed_html', 'gf_embed_oembed_html', 99, 4);

    # ------------------------------------------
    # MISC: LOGIN SCREEN LOGO LINK
    # ------------------------------------------
    function gf_login_logo_url() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'gf_login_logo_url' );

    # ------------------------------------------
    # MISC: LOGIN SCREEN LOGO ALT TAG
    # ------------------------------------------
    function my_login_logo_url_title() {
        return esc_html(get_bloginfo('name'));
    }
    add_filter( 'login_headertext', 'my_login_logo_url_title' );

    # ------------------------------------------
    # MISC: CUSTOM LOGIN SCREEN
    # ------------------------------------------
    function gf_login_logo() { ?>
        <style type="text/css">
            body.login.login-action-login div#login h1 a {
                <?php
                    $login_logo = get_stylesheet_directory_uri().'/img/custom/logo.svg';
                ?>
                background-image: url('<?php echo $login_logo; ?>');
            }
        </style>
    <?php }
    add_action( 'login_enqueue_scripts', 'gf_login_logo' );

    # ------------------------------------------
    # MISC: CHECK FOR SUBPAGES
    # ------------------------------------------
    function is_child($pageID) {
        global $post;
        if( is_page() && ($post->post_parent==$pageID) ) {
            return true;
        } else {
            return false;
        }
    }

    # ------------------------------------------
    # MISC: PARENT PAGE ID
    # ------------------------------------------
    function get_top_parent_page_id() {
        global $post;
        // Check if page is a child page (any level)
        if ($post->ancestors) {
            //  Grab the ID of top-level page from the tree
            return end($post->ancestors);
        } else {
            // Page is the top level, so use its own id
            return $post->ID;
        }
    }

    # ------------------------------------------
    # MISC: BROWSER DETECTION, sorry IE...
    # ------------------------------------------
    function mv_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) {
            $classes[] = 'ie';
            if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
            $classes[] = 'ie'.$browser_version[1];

        } else $classes[] = 'unknown';

        if($is_iphone) $classes[] = 'iphone';

        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
            $classes[] = 'osx';
        } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
            $classes[] = 'linux';
        } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
            $classes[] = 'windows';
        }
        return $classes;
    }
    add_filter('body_class','mv_browser_body_class');

    # ------------------------------------------
    # MISC: REMOVE WP-LOGO AND COMMENT ICON FROM ADMIN BAR
    # ------------------------------------------
    function gf_remove_admin_bar_links() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo'); #Remove WordPress logo
        $wp_admin_bar->remove_menu('comments'); #Remove comments icon
    }
    add_action( 'wp_before_admin_bar_render', 'gf_remove_admin_bar_links' );

    # ------------------------------------------
    # MISC: ADD CUSTOM MESSAGE TO WP DASHBOARD
    # ------------------------------------------
    function gf_dashboard_msg() {
        global $wp_meta_boxes;
        wp_add_dashboard_widget('custom_help_widget', 'BrighterIR Gutenberg Framework', 'gf_admin_msg_text');
    }
    function gf_admin_msg_text() {
        echo '<p>This custom theme was created by <a href="https://www.brighterir.com">BrighterIR</a>. If you need any support, please email us on <a href="mailto:support@brighterir.com" target="_blank">support@brighterir.com</a>.</p>';
    }
    add_action('wp_dashboard_setup', 'gf_dashboard_msg');

    # ------------------------------------------
    # MISC: REMOVE WELCOME TO WP MESSAGE
    # ------------------------------------------
    remove_action('welcome_panel', 'wp_welcome_panel');

    # ------------------------------------------
    # MISC: REMOVE EMOJIS
    # ------------------------------------------
    function gf_disable_emojicons_tinymce( $plugins ) {
        return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
    }
    function gf_disable_wp_emojicons() {
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        add_filter( 'tiny_mce_plugins', 'gf_disable_emojicons_tinymce' );
        add_filter( 'emoji_svg_url', '__return_false' );
    }
    add_action( 'init', 'gf_disable_wp_emojicons' );

    # ------------------------------------------
    # MISC: REMOVE RECENT COMMENT STYLES
    # ------------------------------------------
    function gf_remove_recent_comments_style() {
        global $wp_widget_factory;
        if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
            remove_action( 'wp_head', array(
                $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
                'recent_comments_style'
            ) );
        }
    }
    add_action( 'widgets_init', 'gf_remove_recent_comments_style' );

    # ------------------------------------------
    # MISC: CHANGE WP DASHBOARD FOOTER
    # ------------------------------------------
    function gf_change_footer_admin () {
        echo 'Powered by <a href="http://wordpress.org">WordPress</a> | designed &amp; built by <a class="ir" href="https://www.brighterir.com">BRIGHTER<span class="col">*</span><strong>IR</strong></a>';
    }
    add_filter('admin_footer_text', 'gf_change_footer_admin');

    # ------------------------------------------
    # MISC: REMOVE WIDGETS FROM DASHBOARD
    # ------------------------------------------
    function gf_remove_dashboard_widgets(){
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');
        remove_meta_box('dashboard_primary', 'dashboard', 'side');
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    }
    add_action('wp_dashboard_setup', 'gf_remove_dashboard_widgets');

    # ------------------------------------------
    # MISC: ADD ROBOTS BLOCK ALERT
    # ------------------------------------------
    function gf_addAlert() {
        if(get_option('blog_public') == 0):
    ?>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                jQuery('.wrap > h2').parent().prev().after('<div class="update-nag"><strong>Robots blocked</strong>. Remember to change this setting when going live under <strong>Settings > Reading</strong> by unchecking the <strong>Discourage search engines from indexing this site</strong> option.</div>');
            });
        </script>

    <?php
        endif;
    } add_action('admin_head','gf_addAlert');

    # ------------------------------------------
    # MISC: MOVE YOAST TO BOTTOM
    # ------------------------------------------
    function gf_yoasttobottom() {
        return 'low';
    }
    add_filter( 'wpseo_metabox_prio', 'gf_yoasttobottom');

    # ------------------------------------------
    # MISC: ADD ADMIN CSS
    # ------------------------------------------
    function gf_add_admin_style() {
        echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/scss/admin/admin-style.css">';
    }
    add_action('admin_head', 'gf_add_admin_style');

    # ------------------------------------------
    # MISC: ALTERNATIVE TO FILE_GET_CONTENTS
    # ------------------------------------------
    function url_get_contents ($Url) {
        if (!function_exists('curl_init')){
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    # ------------------------------------------
    # MISC: ADD TITLE TAG SUPPORT
    # ------------------------------------------
    add_theme_support( 'title-tag' );

    # ---------------------------------------------------
    # MISC: AUTO ALT TAG ON UPLOAD
    # ---------------------------------------------------
    add_action( 'add_attachment', 'gf_auto_alt' );
    function gf_auto_alt( $post_ID ) {
        if ( wp_attachment_is_image( $post_ID ) ) {
            $my_image_title = get_post( $post_ID )->post_title;
            $my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );
            $my_image_title = ucwords( strtolower( $my_image_title ) );
            $my_image_meta = array(
                'ID'		=> $post_ID,
                'post_title'	=> $my_image_title,
            );
            update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );
            wp_update_post( $my_image_meta );
        }
    }

    # ------------------------------------------
    # MISC: PROPER ob_end_flush() FOR ALL LEVELS
    # ------------------------------------------
    // remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
    // add_action( 'shutdown', function() {
    //     while ( @ob_end_flush() );
    // });

    # ------------------------------------------
    # MISC: GET POST LEVELS
    # ------------------------------------------
    function get_post_levels($post) {
        $ancestors = [
            'levels' => 1,
            'level_1' => $post
        ];

        if ($post->post_parent)
        {
            $parent = get_post($post->post_parent);
            $parents_parent = get_post($parent->post_parent);
            $parent_of_parents_parent = get_post($parents_parent->post_parent);

            if ($parent->post_parent == false)
            {
                $ancestors = [
                    'levels' => 2,
                    'level_1' => $parent,
                    'level_2' => $post,
                    'parent' => $parent
                ];
            }
            elseif ($parents_parent->post_parent == false)
            {
                $ancestors = [
                    'levels' => 3,
                    'level_1' => $parents_parent,
                    'level_2' => $parent,
                    'level_3' => $post,
                    'parent' => $parent,
                    'grandparent' => $parents_parent
                ];
            }
            elseif ($parent_of_parents_parent->post_parent == false)
            {
                $ancestors = [
                    'levels' => 4,
                    'level_1' => $parent_of_parents_parent,
                    'level_2' => $parents_parent,
                    'level_3' => $parent,
                    'level_4' => $post,
                    'parent' => $parent,
                    'grandparent' => $parents_parent,
                    'greatgrandparent' => $parent_of_parents_parent
                ];
            }
        }

        return $ancestors;
    }

    # ------------------------------------------
    # MISC: FIND POST ANCESTOR
    # ------------------------------------------
    function find_post_ancestor($post, $return = false) {
        $post_ancestor = $post;
        $level = 1;

        if ($post->post_parent)
        {
            $parent = get_post($post->post_parent);
            $parents_parent = get_post($parent->post_parent);
            $parent_of_parents_parent = get_post($parents_parent->post_parent);

            if ($parent->post_parent == false)
            {
                $post_ancestor = $parent;
                $level = 2;
            }
            elseif ($parents_parent->post_parent == false)
            {
                $post_ancestor = $parents_parent;
                $level = 3;
            }
            elseif ($parent_of_parents_parent->post_parent == false)
            {
                $post_ancestor = $parent_of_parents_parent;
                $level = 4;
            }
        }

        if($return == 'level')
        {
            return $level;
        }
        else
        {
            return $post_ancestor;
        }
    }

    # ------------------------------------------
    # MISC: REPLACE GRAVITY FORM INPUT SUBMIT WITH BUTTON
    # ------------------------------------------
    if ( class_exists( 'GFCommon' ) ) {
            
        add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
        add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
        add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
        function input_to_button( $button, $form ) {
            $dom = new DOMDocument();
            $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
            $input = $dom->getElementsByTagName( 'input' )->item(0);
            $new_button = $dom->createElement( 'button' );
            $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
            $input->removeAttribute( 'value' );
            foreach( $input->attributes as $attribute ) {
                $new_button->setAttribute( $attribute->name, $attribute->value );
            }
            $input->parentNode->replaceChild( $new_button, $input );
        
            return $dom->saveHtml( $new_button );
        }

    }

    # ------------------------------------------
    # MISC: CHECK IF CURRENT PAGE IS PARENT
    # ------------------------------------------
    function current_is_parent() {
        global $post;

        $parent = false;

        $children = get_pages('child_of='.$post->ID);
        if( count( $children ) > 0 ) {
            $parent = true;
        }

        return $parent;
    }

    # Highlight query in search results

    function generate_excerpt($text, $query, $length) {

        $words = explode(' ', $text);
        $total_words = count($words);

        if ($total_words > $length) {

            $queryLow = array_map('strtolower', $query);
            $wordsLow = array_map('strtolower', $words);

            for ($i=0; $i <= $total_words; $i++) {

                foreach ($queryLow as $queryItem) {

                    if (preg_match("/\b$queryItem\b/", $wordsLow[$i])) {
                        $posFound = $i;
                        break;
                    }
                }

                if ($posFound) {
                    break;
                }
            }

            if ($i > ($length+($length/2))) {
                $i = $i - ($length/2);
            } else {
        $i = 0;
        }

        }

        $cutword = array_splice($words,$i,$length);
        $excerpt = implode(' ', $cutword);

        $keys = implode('|', $query);
        $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="tx-indexedsearch-redMarkup">\0</strong>', $excerpt);
        $excerptRet = '<p>';
    if ($i !== 0) {
        $excerptRet .= '... ';
    }
    $excerptRet .= $excerpt . ' ...</p>';

        return $excerptRet;
    
    }

    function search_excerpt_highlight() {

        # Length in word count
        $excerptLength = 32;

        $text = wp_strip_all_tags( get_the_content() );

        # Filter double quotes from query. They will
        # work on the results side but won't help with
        # text highlighting and displaying.
        $query=get_search_query(false);
        $query=str_replace('"','',$query);
        $query=esc_html($query);

        $query = explode(' ', $query);

        echo generate_excerpt($text, $query, $excerptLength);

    }

    

    # ------------------------------------------
    # MISC: REMOVE LANGUAGE DROPDOWN ON ADMIN LOGIN
    # ------------------------------------------
    add_filter( 'login_display_language_dropdown', '__return_false' );

    # ------------------------------------------
    # MISC: DISABLE AUTOMATIC UPDATE
    # ------------------------------------------
    add_filter( 'auto_update_plugin', '__return_false' );
    add_filter( 'auto_update_theme', '__return_false' );
  

?>