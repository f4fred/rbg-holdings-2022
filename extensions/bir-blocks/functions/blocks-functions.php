<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# GUTENBERG
# ------------------------------------------
include('inc/bir-blocks.php');

# ------------------------------------------
# GUTENBERG: THEME SUPPORT
# ------------------------------------------
function mytheme_setup() {
    add_theme_support( 'align-wide' );

    // RESPONSIVE EMBEDS
    add_theme_support( 'responsive-embeds' );

}
add_action( 'after_setup_theme', 'mytheme_setup' );

# ------------------------------------------
# GUTENBERG: EXTEND ALL BLOCKS
# ------------------------------------------
function blocks_extend_enqueue() {

  wp_enqueue_script( 'blocks-extend',
    get_template_directory_uri() . '/extensions/bir-blocks/js/_blocks-extend.js',
    array( 'wp-blocks', 'wp-editor', 'wp-components', 'wp-i18n', 'wp-hooks' )
  );

}

add_action( 'enqueue_block_editor_assets', 'blocks_extend_enqueue' );

# ------------------------------------------
# GUTENBERG: REGISTER BIR BLOCK CATEGORY
# ------------------------------------------
function ir_block_category( $categories, $post ) {
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'bir',
        'title' => __( 'BIR', 'ir' ),
      ),
    )
  );
}
add_filter( 'block_categories', 'ir_block_category', 10, 2);

# ------------------------------------------
# GUTENBERG: INJECT CSS
# ------------------------------------------
add_action('admin_head', 'gutenberg_custom_styles');
function gutenberg_custom_styles() {
  echo '<style>
    .acf-block-body .acf-block-fields {
     min-width: 200px;
     z-index: 2;
    } 
  </style>';
}

# ------------------------------------------
# ACF: GET FILE SIZE
# ------------------------------------------
function get_file_size( $file_url ) {

    $file_info = array_change_key_case( get_headers($file_url, TRUE) );
    $file_size = file_size_convert( $file_info['content-length'] );

    return $file_size;
}

# ------------------------------------------
# ACF: CONVERT FILE SIZE
# ------------------------------------------
function file_size_convert($bytes) {
    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "b",
            "VALUE" => 1
        ),
    );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 0)))."".' '.$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

# ------------------------------------------
# ACF: GET FILE TYPE
# ------------------------------------------
function get_file_type( $mime_type ) {

    if( preg_match('/msword/', $mime_type) || preg_match('/officedocument\.wordprocessingml\.document/', $mime_type) ):
        $type = 'DOC';
    elseif(preg_match('/pdf/', $mime_type)):
        $type = 'PDF';
    elseif(preg_match('/ms-powerpoint/', $mime_type) || preg_match('/officedocument\.presentationml/', $mime_type) ):
        $type = 'PPT';
    else:
      $type = null;
    endif;

    return $type;
}

?>