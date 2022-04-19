<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# PROTECTED LOGIN
# ------------------------------------------
function pl_path() {
    return esc_url(get_template_directory()).'/extensions/bir-protected-login';
}

    # ------------------------------------------
    # CUSTOM THEME FOR PROTECTED LOGIN
    # ------------------------------------------
    function gf_password_protected_theme_file( $file ) {
        return pl_path().'/templates/pl-password-login.php';
    }
    add_filter( 'password_protected_theme_file', 'gf_password_protected_theme_file' );


    # ------------------------------------------
    # REMOVE STYLESHEET FOR PROTECTED PAGE
    # ------------------------------------------
    function gf_password_protected_remove_styles() {
        wp_deregister_style( 'style-base' );
    }
    add_filter( 'password_protected_login_head', 'gf_password_protected_remove_styles' );



?>