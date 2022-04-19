<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# CUSTOMISER
# ------------------------------------------
function ir_customizer( $wp_customize ) {

    # ------------------------------------------
    # CUSTOMISER: THEME SETTINGS
    # ------------------------------------------
    $wp_customize->add_panel(
        'ir_panel_themesettings',
        array(
            'priority'       => 30,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => 'Theme Settings',
            'description'    => '',
        )
    );

    # ------------------------------------------
    # CUSTOMISER: THEME SETTINGS: HEADER
    # ------------------------------------------
    $wp_customize->add_section( 'ir_section_header', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => 'Header',
        'description'    => '',
        'panel'  => 'ir_panel_themesettings',
    ) );

    $wp_customize->add_setting (
        'show_topbar',
        array(
            'default' => 0,
        )
    );

    $wp_customize->add_control (
        'show_topbar',
        array(
            'label'     => 'Display topbar',
            'section'   => 'ir_section_header',
            'type'      => 'checkbox',
        )
    );

    $wp_customize->add_setting (
        'show_tagline',
        array(
            'default' => 0,
        )
    );

    $wp_customize->add_control (
        'show_tagline',
        array(
            'label'     => 'Display tagline in header',
            'section'   => 'ir_section_header',
            'type'      => 'checkbox',
        )
    );

    # ------------------------------------------
    # CUSTOMISER: THEME SETTINGS: FOOTER
    # ------------------------------------------
    $wp_customize->add_section( 'ir_section_footer', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => 'Footer',
        'description'    => '',
        'panel'  => 'ir_panel_themesettings',
    ) );


    $wp_customize->add_setting (
        'footer_copy',
        array(
            'default' => '',
        )
    );

    $wp_customize->add_control (
        'footer_copy',
        array(
            'label' => 'Copyright statement',
            'section' => 'ir_section_footer',
            'type' => 'textarea',
        )
    );

     $wp_customize->add_setting (
        'show_backtotop',
        array(
            'default' => 1,
        )
    );

    $wp_customize->add_control (
        'show_backtotop',
        array(
            'label'     => 'Back to top',
            'section'   => 'ir_section_footer',
            'type'      => 'checkbox',
        )
    );

    # ------------------------------------------
    # CUSTOMISER: THEME SETTINGS: LAYOUT
    # ------------------------------------------
    $wp_customize->add_section( 'ir_section_layout', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => 'Layout',
        'description'    => '<strong>Sidebar position</strong>',
        'panel'  => 'ir_panel_themesettings',
    ) );

    $wp_customize->add_setting(
        'ir_post_sidebar',
        array(
            'default' => 'sidebar-left',
            'sanitize_callback' => 'ir_customizer_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'ir_post_sidebar',
        array(
            'type' => 'radio',
            'label' => __('Post sidebars', 'ir'),
            'description' => __( 'Sidebar location on posts' ),
            'section' => 'ir_section_layout',
            'choices' => array(
            'sidebar-left' => __( 'Left sidebar' ),
            'sidebar-right' => __( 'Right sidebar' ),
            'full-width' => __( 'No sidebar' ),
          ),
        )
    );

    $wp_customize->add_setting(
        'ir_archive_sidebar',
        array(
            'default' => 'sidebar-left',
            'sanitize_callback' => 'ir_customizer_sanitize_radio',
        )
    );

    $wp_customize->add_control(
        'ir_archive_sidebar',
        array(
            'type' => 'radio',
            'label' => __('Category sidebars', 'ir'),
            'description' => __( 'Sidebar location on categories' ),
            'section' => 'ir_section_layout',
            'choices' => array(
            'sidebar-left' => __( 'Left sidebar' ),
            'sidebar-right' => __( 'Right sidebar' ),
            'full-width' => __( 'No sidebar' ),
          ),
        )
    );

    $wp_customize->add_setting(
        'ir_search_sidebar',
        array(
            'default' => 'full-width',
            'sanitize_callback' => 'ir_customizer_sanitize_radio',
        )
    );
    $wp_customize->add_control(
        'ir_search_sidebar',
        array(
            'type' => 'radio',
            'label' => __('Search page sidebars', 'ir'),
            'description' => __( 'Sidebar location on search results page' ),
            'section' => 'ir_section_layout',
            'choices' => array(
            'sidebar-left' => __( 'Left sidebar' ),
            'sidebar-right' => __( 'Right sidebar' ),
            'full-width' => __( 'No sidebar' ),
          ),
        )
    );

    function ir_customizer_sanitize_radio( $input, $setting ) {
        $input = sanitize_key( $input );
        $choices = $setting->manager->get_control( $setting->id )->choices;
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    # ------------------------------------------
    # CUSTOMISER: THEME SETTINGS: MODULES
    # ------------------------------------------
    $wp_customize->add_section( 'ir_section_modules', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => 'Additional Modules',
        'description'    => '<strong>Choose modules you want to add to your site</strong>',
        'panel'  => 'ir_panel_themesettings',
    ) );


    $wp_customize->add_setting('ir_add_docs', array(
        'default'    => false,
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'ir_add_docs',
            array(
                'label'     => __('Documents', 'ir'),
                'section'   => 'ir_section_modules',
                'settings'  => 'ir_add_docs',
                'type'      => 'checkbox',
            )
        )
    );

    $wp_customize->add_setting('ir_add_team', array(
        'default'    => false,
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'ir_add_team',
            array(
                'label'     => __('Team', 'ir'),
                'section'   => 'ir_section_modules',
                'settings'  => 'ir_add_team',
                'type'      => 'checkbox',
            )
        )
    );

    $wp_customize->add_setting('ir_add_jobs', array(
        'default'    => false,
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'ir_add_jobs',
            array(
                'label'     => __('Careers', 'ir'),
                'section'   => 'ir_section_modules',
                'settings'  => 'ir_add_jobs',
                'type'      => 'checkbox',
            )
        )
    );

    $wp_customize->add_setting('ir_add_casestudies', array(
        'default'    => false,
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'ir_add_casestudies',
            array(
                'label'     => __('Case Studies', 'ir'),
                'section'   => 'ir_section_modules',
                'settings'  => 'ir_add_casestudies',
                'type'      => 'checkbox',
            )
        )
    );

    $wp_customize->add_setting('ir_add_testimonials', array(
        'default'    => false,
    ));
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'ir_add_testimonials',
            array(
                'label'     => __('Testimonials', 'ir'),
                'section'   => 'ir_section_modules',
                'settings'  => 'ir_add_testimonials',
                'type'      => 'checkbox',
            )
        )
    );

}
add_action( 'customize_register', 'ir_customizer' );


# ------------------------------------------
# DISABLE CUSTOMISER
# NOTE: TEAM DISCUSSION BUT ONLY TO BE USED FOR QUICK FIXES WHEN WFH
# ------------------------------------------
// add_action( 'customize_register', 'gf_customize_register' );
// function gf_customize_register( $wp_customize ) {
// 	$wp_customize->remove_control( 'custom_css' );
// }


?>