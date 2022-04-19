<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# ------------------------------------------
# ACF
# ------------------------------------------

# ------------------------------------------
# REGISTER OPTION PAGES
# SOURCE: http://www.advancedcustomfields.com/docs/tutorials/register-multiple-options-pages/
# ------------------------------------------
if( function_exists('acf_add_options_page') ) {

    acf_add_options_sub_page(array(
        'page_title'  => 'Theme Settings',
        'menu_title'  => 'Theme Settings',
        'parent_slug' => 'themes.php',
    ));

}

// ACF ADD CUSTOM LOCATION FOR MENU ITEM

add_filter('acf/location/rule_types', 'acf_location_rules_types');

function acf_location_rules_types($choices)
{
    $choices['Menu']['menu_level'] = 'Top Level Menu Items';

    return $choices;
}

add_filter('acf/location/rule_values/menu_level', 'acf_location_rule_values_level');

function acf_location_rule_values_level($choices)
{
    $choices[0] = '0';
    $choices[1] = '1';

    return $choices;
}

add_filter('acf/location/rule_match/menu_level', 'acf_location_rule_match_level', 10, 4);
function acf_location_rule_match_level($match, $rule, $options, $field_group)
{
    if ($rule['operator'] == "==") {
        $match = ($options['nav_menu_item_depth'] == $rule['value']);
    }

    return $match;
}


# ------------------------------------------
# LOCAL JSON
# ------------------------------------------
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

?>