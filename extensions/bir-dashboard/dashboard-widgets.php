<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# WIDGETS
# ------------------------------------------

    # ------------------------------------------
    # WIDGETS: SIDEBARS
    # ------------------------------------------
    add_action( 'widgets_init', 'gf_register_sidebars' );
    function gf_register_sidebars() {

        register_sidebar(
            array(
                'id'            => 'primary',
                'name'          => __( 'Sidebar' ),
                'description'   => __( 'Main sidebar.' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );

        # ------------------------------------------
        # WIDGETS: INVESTORS SIDEBAR
        # ------------------------------------------

        register_sidebar(
            array(
                'id'            => 'investor_sidebar',
                'name'          => __( 'Investors Sidebar' ),
                'description'   => __( 'Sidebar for the investors page and its sub pages.' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );

        # ------------------------------------------
        # WIDGETS: ABOUT SIDEBAR
        # ------------------------------------------

        register_sidebar(
            array(
                'id'            => 'about_sidebar',
                'name'          => __( 'About Sidebar' ),
                'description'   => __( 'Sidebar for the About Page and sub pages.' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );

    }



    # ------------------------------------------
    # WIDGETS: FOOTER WIDGETS
    # ------------------------------------------
    add_action( 'widgets_init', 'gf_register_footer_widgets' );
    function gf_register_footer_widgets() {

        register_sidebar(
            array(
                'name' => 'Footer 1',
                'id' => 'col-1-footer-navigation',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => '',
            )
        );

        register_sidebar(
            array(
                'name' => 'Footer 2',
                'id' => 'col-2-footer-navigation',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => '',
            )
        );

        register_sidebar(
            array(
                'name' => 'Footer 3',
                'id' => 'col-3-footer-navigation',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => '',
            )
        );

        register_sidebar(
            array(
                'name' => 'Footer 4',
                'id' => 'col-4-footer-navigation',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => '',
            )
        );

    }

    # ------------------------------------------
    # WIDGETS: RELATED PAGES WIDGET
    # ------------------------------------------
    class related_pages_widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'related_pages_widget',
                'Related Pages Widget',
                array( 'description' => 'Widget for displaying related pages', )
            );
        }

        public function widget( $args, $instance ) {
            $title = get_field('title', 'widget_'.$this->id);
            echo '<div class="related_pages '.sanitize_title($title, 'related-pages').'">';
            echo '<ul class="top_level">';
            $this->related_pages();
            echo '</ul>';
            echo '</div>';
        }

        public function related_pages() {

            global $post;
            $queried_post = $post;
            $args = [];

            $related_to = get_field('related_to', 'widget_'.$this->id);
            $restrict_by = get_field('restrict_by', 'widget_'.$this->id);

            if ($related_to)
            {
                $queried_post = $related_to;
            }

            $post_levels = get_post_levels($queried_post);
            $args['child_of'] = $queried_post->ID;

            if ($restrict_by)
            {
                if($restrict_by == 'level')
                {
                    $highest_level = get_field('highest_level', 'widget_'.$this->id);
                    $lowest_level = get_field('lowest_level', 'widget_'.$this->id);

                    if(array_key_exists('level_'.$highest_level, $post_levels))
                    {
                        $queried_post = $post_levels['level_'.$highest_level];
                        $post_levels = get_post_levels($queried_post);
                        $args['child_of'] = $queried_post->ID;

                        if(array_key_exists('parent', $post_levels))
                        {
                            $queried_post = $post_levels['parent'];
                            $post_levels = get_post_levels($queried_post);
                            $args['child_of'] = $queried_post->ID;
                        }
                        else
                        {
                            unset($args['child_of']);
                        }
                    }

                    if(array_key_exists('levels', $post_levels))
                    {
                        $depth = 1;

                        if ($lowest_level >= $post_levels['levels'])
                        {
                            $depth = $lowest_level - $post_levels['levels'];

                            if($depth < 1)
                            {
                                $depth = 1;
                            }
                        }

                        if(array_key_exists('child_of', $args) == false)
                        {
                            $depth = $depth + 1;
                        }

                        $args['depth'] = $depth;
                    }
                }

                if($restrict_by == 'relations')
                {
                    $highest_relation = get_field('highest_relation', 'widget_'.$this->id);
                    $lowest_relation = get_field('lowest_relation', 'widget_'.$this->id);

                    if(array_key_exists($highest_relation, $post_levels))
                    {
                        $queried_post = $post_levels[$highest_relation];
                        $post_levels = get_post_levels($queried_post);

                        if(array_key_exists('parent', $post_levels))
                        {
                            $queried_post = $post_levels['parent'];
                            $post_levels = get_post_levels($queried_post);
                            $args['child_of'] = $queried_post->ID;
                        }
                        else
                        {
                            unset($args['child_of']);
                        }
                    }
                    elseif($highest_relation == 'self')
                    {
                        if(array_key_exists('parent', $post_levels))
                        {
                            $queried_post = $post_levels['parent'];
                            $post_levels = get_post_levels($queried_post);
                            $args['child_of'] = $queried_post->ID;
                        }
                        else
                        {
                            unset($args['child_of']);
                        }
                    }
                    else
                    {
                        unset($args['child_of']);
                    }

                    if($lowest_relation)
                    {
                        $depths = [
                            'self' => 1,
                            'child' => 2,
                            'grandchild' => 3,
                            'greatgrandchild' => 4
                        ];

                        $depth = 1;

                        if(array_key_exists($lowest_relation, $post_levels))
                        {
                            $depth = $depths[$lowest_relation];
                        }

                        $args['depth'] = $depth;
                    }
                }
            }

            $args['title_li'] = '';
            $args['post_type'] = get_post_type($queried_post);

            wp_list_pages($args);
        }

        public function form( $instance ) {
            echo '<p>All settings are optional</p>';
            echo '<p>Default: show child pages</p>';
        }
    }
    function related_pages_widget_load_widget() {
        register_widget( 'related_pages_widget' );
    }
    add_action( 'widgets_init', 'related_pages_widget_load_widget' );


    # ------------------------------------------
    # WIDGETS: CHILD PAGE DROPDOWN
    # ------------------------------------------
    class child_pages_dropdown_widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'child_pages_dropdown_widget',
                'Child Pages Dropdown Widget',
                array( 'description' => 'Widget for displaying a dropdown of child pages', )
            );
        }

        public function widget( $args, $instance ) {
            $title = get_field('title', 'widget_'.$this->id);
            echo '<div class="child_pages_dropdown '.sanitize_title($title, 'child-pages').'">';
            echo '<label for="child_pages">'.$title.'</label>';
            echo '<select class="top_level" id="child_pages">';
            $this->child_pages_dropdown();
            echo '</select>';
            echo '</div>';
        }

        function child_pages_dropdown() {
            echo '<option selected disabled>Select Page</option>';

            $queried_pages = get_field('related_to', 'widget_'.$this->id);

            foreach($queried_pages as $queried_page)
            {
                echo '<option value="'.get_the_permalink($queried_page).'">'.get_the_title($queried_page).'</option>';

                $this->get_child_pages($queried_page, 0);
            }
        }

        function get_child_pages($page, $level) {
            $child_pages = $this->query_child_pages($page);
            if( !empty ($child_pages) )
            {
                $next_level = $level + 1;
                $this->child_pages($child_pages, $next_level);
            }
        }

        function child_pages($child_pages, $level)
        {
            foreach ($child_pages as $child_page) {
                echo '<option value="'.get_the_permalink($child_page).'">'.str_repeat('&mdash;', $level).' ' . get_the_title($child_page) . '</option>';

                $this->get_child_pages($child_page, $level);
            }
        }

        function query_child_pages($page)
        {
            return get_children([
                'post_parent' => $page->ID,
                'post_type' => 'page',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ]);
        }

        public function form( $instance ) {
            echo '<p>All settings are optional</p>';
        }
    }
    function child_pages_dropdown_widget_load_widget() {
        register_widget( 'child_pages_dropdown_widget' );
    }
    add_action( 'widgets_init', 'child_pages_dropdown_widget_load_widget' );