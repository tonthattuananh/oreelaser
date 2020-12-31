<?php
/**
 * Register custom taxonomies.
 *
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 * @hook    init
 * @package WPEmergeTheme
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Custom hierarchical taxonomy (like categories).
// phpcs:disable

// add_action('init', function () {
//     register_taxonomy(
//         'app_custom_taxonomy',
//         array( 'project' ),
//         array(
//             'labels'            => array(
//                 'name'              => __( 'Custom Taxonomies', 'app' ),
//                 'singular_name'     => __( 'Custom Taxonomy', 'app' ),
//                 'search_items'      => __( 'Search Custom Taxonomies', 'app' ),
//                 'all_items'         => __( 'All Custom Taxonomies', 'app' ),
//                 'parent_item'       => __( 'Parent Custom Taxonomy', 'app' ),
//                 'parent_item_colon' => __( 'Parent Custom Taxonomy:', 'app' ),
//                 'view_item'         => __( 'View Custom Taxonomy', 'app' ),
//                 'edit_item'         => __( 'Edit Custom Taxonomy', 'app' ),
//                 'update_item'       => __( 'Update Custom Taxonomy', 'app' ),
//                 'add_new_item'      => __( 'Add New Custom Taxonomy', 'app' ),
//                 'new_item_name'     => __( 'New Custom Taxonomy Name', 'app' ),
//                 'menu_name'         => __( 'Custom Taxonomies', 'app' ),
//             ),
//             'hierarchical'      => true,
//             'show_ui'           => true,
//             'show_admin_column' => true,
//             'query_var'         => true,
//             'rewrite'           => array( 'slug' => 'custom-taxonomy' ),
//         )
//     );
// });

// phpcs:enable

// add_action('carbon_fields_register_fields', function () {
//     Container::make('term_meta', __('Cài đặt', 'gaumap'))
//              ->where('term_taxonomy', 'IN', ['app_custom_taxonomy'])
//              ->add_fields([
//                  Field::make('checkbox', 'is_feature', __('Nổi bật', 'gaumap'))->set_default_value(false),
//                  Field::make('time', 'opens_at', __('Opening time')),
//              ]);
// });
