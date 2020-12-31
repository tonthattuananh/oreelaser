<?php
/**
 * Register post types.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @hook    init
 * @package WPEmergeTheme
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('init', function () {
    register_post_type('blogs', [
        'labels'              => [
            'name'               => __('Tin tức', 'app'),
            'singular_name'      => __('Tin tức', 'app'),
            'add_new'            => __('Add New', 'app'),
            'add_new_item'       => __('Add new Custom Type', 'app'),
            'view_item'          => __('View Custom Type', 'app'),
            'edit_item'          => __('Edit Custom Type', 'app'),
            'new_item'           => __('New Custom Type', 'app'),
            'search_items'       => __('Search Custom Types', 'app'),
            'not_found'          => __('No custom types found', 'app'),
            'not_found_in_trash' => __('No custom types found in trash', 'app'),
        ],
        'public'              => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        '_edit_link'          => 'post.php?post=%d',
        'query_var'           => true,
        'menu_icon'           => 'dashicons-align-right',
        'supports'            => ['title', 'editor', 'thumbnail'],
        // 'rewrite'             => [
        //     'slug'       => 'custom-post-type',
        //     'with_front' => false,
        // ],
    ]);
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Bài viết nổi bật ', 'gaumap'))
             ->set_context('side')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('high')// high, core, default or low
             ->where('post_type', 'IN', ['blogs'])
             ->add_fields([
                 Field::make('checkbox', 'is_feature', __('', 'gaumap'))->set_default_value(false),
             ]);
});
