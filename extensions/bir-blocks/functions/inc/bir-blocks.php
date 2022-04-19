<?php

# ------------------------------------------
# GUTENBERG: CALENDAR
# ------------------------------------------
function register_calendar_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_calendar', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-calendar',
        'title'			=> __( 'Calendar', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-calendar.php',
        'category'		=> 'bir',
        'icon'			=> array( 'src' => 'calendar-alt', 'foreground' => '#ffd341' ),
        'mode'			=> 'preview',
        'keywords'		=> array( 'calendar', 'box' ),
		'supports'		=> array(
			'align' => true,
			'mode' => false,
			'jsx' => true
		)
    ));

}
add_action('acf/init', 'register_calendar_block_type' );


# ------------------------------------------
# GUTENBERG: CONTENT BLOCK
# ------------------------------------------
function register_content_box_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_content_box', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-content',
        'title'			=> __( 'Content Box', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-content-box.php',
        'category'		=> 'bir',
        'icon'			=> array( 'src' =>'archive', 'foreground' => '#ffd341' ),
        'mode'			=> 'preview',
        'keywords'		=> array( 'content', 'box' ),
		'supports'		=> array(
			'align' => true,
			'mode' => false,
			'jsx' => true
		)
    ));

}
add_action('acf/init', 'register_content_box_block_type' );

# ------------------------------------------
# GUTENBERG BLOCK : TEAM LIST
# ------------------------------------------
function register_team_block_type() {

	if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_team_list', 'option' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'team',
		'title'			=> __( 'Team List', 'bir' ),
		'render_template' => plugin_dir_path( __FILE__ ) . '../../templates/block-team-info.php',
		'category'		=> 'bir',
		'icon'			=> array( 'src' => 'admin-users', 'foreground'	=> '#ffd341' ),
		'mode'			=> 'auto',
		'keywords'		=> array( 'team', 'peope' )
	));

}
add_action('acf/init', 'register_team_block_type' );

# ------------------------------------------
# GUTENBERG BLOCK : TEAM LIGHTBOX
# ------------------------------------------
function register_team_grid_block_type() {

	if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_team_grid', 'option' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'teamgrid',
		'title'			=> __( 'Team Grid', 'bir' ),
		'render_template' => plugin_dir_path( __FILE__ ) . '../../templates/block-team-grid.php',
		'category'		=> 'bir',
		'icon'			=> array( 'src' => 'admin-users', 'foreground'	=> '#ffd341' ),
		'mode'			=> 'auto',
		'keywords'		=> array( 'team', 'peope' )
	));

}
add_action('acf/init', 'register_team_grid_block_type' );

# ------------------------------------------
# GUTENBERG BLOCK : POSTS
# ------------------------------------------
function register_posts_block_type() {

	if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_posts', 'option' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'posts',
		'title'			=> __( 'Posts', 'bir' ),
		'render_template' => plugin_dir_path( __FILE__ ) . '../../templates/block-posts.php',
		'category'		=> 'bir',
		'icon'			=> array( 'src' => 'media-text', 'foreground'	=> '#ffd341' ),
		'mode'			=> 'auto',
		'keywords'		=> array( 'news', 'post', 'press', 'release', 'latest' )
	));

}
add_action('acf/init', 'register_posts_block_type' );

# ------------------------------------------
# GUTENBERG BLOCK : CTA
# ------------------------------------------
function register_cta_block_type() {

	if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_cta', 'option' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'cta',
		'title'			=> __( 'CTA', 'bir' ),
		'render_template' => plugin_dir_path( __FILE__ ) . '../../templates/block-cta.php',
		'category'		=> 'bir',
		'icon'			=> array( 'src' => 'admin-appearance', 'foreground'	=> '#ffd341' ),
		'mode'			=> 'auto',
		'keywords'		=> array( 'cta', 'image', 'box' )
	));

}
add_action('acf/init', 'register_cta_block_type' );

# ------------------------------------------
# GUTENBERG: IMAGE CTA
# ------------------------------------------
function register_image_cta_block_type() {

	if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_image_cta', 'option' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'bir-image-cta',
		'title'			=> __( 'Image CTA', 'bir' ),
		'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-image-cta.php',
		'category'		=> 'bir',
		'icon'			=> array( 'src' => 'format-image', 'foreground'	=> '#ffd341' ),
		'mode'			=> 'auto',
		'keywords'		=> array( 'img', 'image', 'cta', 'call to action' )
	));

}
add_action('acf/init', 'register_image_cta_block_type' );

# ------------------------------------------
# GUTENBERG: BUTTON
# ------------------------------------------
function register_button_block_type() {

	if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_button', 'option' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'bir-button-cta',
		'title'			=> __( 'Button', 'bir' ),
		'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-button.php',
		'category'		=> 'bir',
		'icon'			=> array( 'src' => 'admin-links', 'foreground'	=> '#ffd341' ),
		'mode'			=> 'auto',
		'keywords'		=> array( 'button', 'btn' ),
		'styles'  => [
			[
				'name' => 'btn-white',
				'label' => __('White', 'bir'),
				'isDefault' => true,
			],
			[
				'name' => 'btn-primary',
				'label' => __('Primary colour', 'bir'),
			],
			[
				'name' => 'btn-secondary',
				'label' => __('Secondary colour', 'bir'),
			]
		]
	));

}
add_action('acf/init', 'register_button_block_type' );

# ------------------------------------------
# GUTENBERG: IMAGE SLIDER
# ------------------------------------------
function register_image_slider_block_type() {

	if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_image_slider', 'option' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'bir-image-slider',
		'title'			=> __( 'Image Slider', 'bir' ),
		'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-image-slider.php',
		'category'		=> 'bir',
		'icon'			=> array( 'src' => 'format-gallery', 'foreground' => '#ffd341' ),
		'mode'			=> 'auto',
		'keywords'		=> array( 'image', 'gallery', 'slider' )
	));

}
add_action('acf/init', 'register_image_slider_block_type' );

# ------------------------------------------
# GUTENBERG: DOCUMENT TABLE
# ------------------------------------------
function register_document_table_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_document_table', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-document-table-cta',
        'title'			=> __( 'Document Table', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-document-table.php',
        'category'		=> 'bir',
		'icon'			=> array( 'src' => 'list-view', 'foreground' => '#ffd341' ),
        'mode'			=> 'auto',
        'keywords'		=> array( 'document-table', 'document', 'document_table', 'file', 'file_table', 'file-table' )
    ));

}
add_action('acf/init', 'register_document_table_block_type' );

# ------------------------------------------
# GUTENBERG: IFRAME
# ------------------------------------------
function register_iframe_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_iframe', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-iframe',
        'title'			=> __( 'Iframe', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-iframe.php',
        'category'		=> 'bir',
		'icon'			=> array( 'src' => 'editor-code', 'foreground' => '#ffd341' ),
        'mode'			=> 'auto',
        'keywords'		=> array( 'iframe' )
    ));

}
add_action('acf/init', 'register_iframe_block_type' );

# ------------------------------------------
# GUTENBERG: BIR HEADER
# ------------------------------------------
function register_bir_header_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_bir_header', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-header',
        'title'			=> __( 'BIR Header', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-bir-header.php',
        'category'		=> 'bir',
		'icon'			=> array( 'src' =>'editor-bold', 'foreground' => '#ffd341' ),
        'mode'			=> 'auto',
        'keywords'		=> array( 'header' )
    ));

}
add_action('acf/init', 'register_bir_header_block_type' );

# ------------------------------------------
# GUTENBERG: HISTORY
# ------------------------------------------
function register_history_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_history', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-history',
        'title'			=> __( 'History', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-history.php',
        'category'		=> 'bir',
        'icon'			=> array( 'src' =>'book-alt', 'foreground' => '#ffd341' ),
        'mode'			=> 'auto',
        'keywords'		=> array( 'history' )
    ));

}
add_action('acf/init', 'register_history_block_type' );

# ------------------------------------------
# GUTENBERG: COUNTER
# ------------------------------------------
function register_counter_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_counter', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-counter',
        'title'			=> __( 'Counter', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-counter.php',
        'category'		=> 'bir',
		'icon'			=> array( 'src' => 'upload', 'foreground' => '#ffd341' ),
        'mode'			=> 'auto',
        'keywords'		=> array( 'counter', 'number' )
    ));

}
add_action('acf/init', 'register_counter_block_type' );

# ------------------------------------------
# GUTENBERG: LATEST DOCUMENT
# ------------------------------------------
function register_latest_document_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_latest_document', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-latest-document',
        'title'			=> __( 'Latest Document', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-latest-document.php',
        'category'		=> 'bir',
		'icon'			=> array( 'src' => 'media-text', 'foreground' => '#ffd341' ),
        'mode'			=> 'auto',
        'keywords'		=> array( 'document', 'latest' )
    ));

}
add_action('acf/init', 'register_latest_document_block_type' );

# ------------------------------------------
# GUTENBERG: ROW
# ------------------------------------------
function register_row_block_type() {

    if( ! function_exists( 'acf_register_block_type' ) || get_field( 'disable_block_row', 'option' ) )
        return;

    acf_register_block_type( array(
        'name'			=> 'bir-row',
        'title'			=> __( 'Row', 'bir' ),
        'render_template'	=> plugin_dir_path( __FILE__ ) . '../../templates/block-row.php',
        'category'		=> 'bir',
		'icon'			=> array( 'src' => 'editor-insertmore', 'foreground' => '#ffd341' ),
        'mode'			=> 'preview',
		'keywords'		=> array( 'row', 'layout' ),
		'supports'		=> array(
			'align' => true,
			'mode' => false,
			'jsx' => true
		),
		'styles'  => [
			[
				'name' => 'grey-bg',
				'label' => __('Grey background', 'bir'),
			],
		]
    ));

}
add_action('acf/init', 'register_row_block_type' );
