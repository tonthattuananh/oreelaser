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
    register_post_type('products', [
        'labels'              => [
            'name'               => __('Sản phẩm', 'app'),
            'singular_name'      => __('Sản phẩm', 'app'),
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
        'menu_icon'           => 'dashicons-info',
        'supports'            => ['title', 'editor','thumbnail'],
        // 'rewrite'             => [
        //     'slug'       => 'products',
        //     'with_front' => false,
        // ],
    ]);
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('bài viết nổi bật ', 'gaumap'))
             ->set_context('side')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('high')// high, core, default or low
             ->where('post_type', 'IN', ['products'])
             ->add_fields([
                 Field::make('checkbox', 'is_feature', __('', 'gaumap'))->set_default_value(false),
             ]);
});
add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Thư viện ảnh sản phẩm ', 'gaumap'))
             ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('high')// high, core, default or low
             ->where('post_type', 'IN', ['products'])
             ->add_fields([
                 Field::make('media_gallery', 'album_products', __('Chọn hình ảnh:', 'gaumap')),
             ]);
});
add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Mô tả sản phẩm', 'gaumap'))
             ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('high')// high, core, default or low
             ->where('post_type', 'IN', ['products'])
             ->add_fields([
                 Field::make('text',        'product_des_title',    __('Tiêu đề', 'gaumap')),
                 Field::make('text',        'product_des_subtitle', __('Tiêu đề nhỏ', 'gaumap')),
                 Field::make('rich_text',   'product_des_content',  __('Nội dung mô tả', 'gaumap')),

                 Field::make('separator','parameter_seperator', __('Thông số kỹ thuật ', 'gaumap')),
                 Field::make('text', 'parameter_model',         __('Kiểu mẫu | Model',   'gaumap'))->set_width(70),
                 Field::make('complex','product_parameter', __('Nhập thông số sản phẩm:'))         ->set_layout('tabbed-horizontal')
                 ->add_fields([
                      Field::make('text', 'parameter_size',         __('Kích thước | Size',              'gaumap'))->set_width(30),
                      Field::make('text', 'parameter_working_area', __('Khu vực làm việc | Working Area','gaumap'))->set_width(60),
                      Field::make('text', 'parameter_power',        __('Công suất | Power',              'gaumap'))->set_width(45),
                      Field::make('text', 'parameter_max_speed',    __('Tốc độ tối đa | Max Speed',      'gaumap'))->set_width(45),
                 ])->set_header_template('<% if (parameter_size) { %><%- parameter_size %><% } %>'),
             ]);
});
add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Video sản phẩm', 'gaumap'))
             ->set_context('carbon_fields_after_title')
             ->set_priority('high')
             ->where('post_type', 'IN', ['products'])
             ->add_fields([
                 Field::make('text', 'video_title',    __('Tiêu đề',    'gaumap')),
                 Field::make('text', 'video_subtitle', __('Tiêu đề nhỏ','gaumap')),
                 Field::make('text', 'video_link',     __('Đường dẫn',  'gaumap')),
             ]);
});
add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Ưu điểm của sản phẩm', 'gaumap'))
             ->set_context('carbon_fields_after_title')
             ->set_priority('high')
             ->where('post_type', 'IN', ['products'])
             ->add_fields([
                 Field::make('text',    'product_advantage_title',    __('Tiêu đề',    'gaumap')),
                 Field::make('text',    'product_advantage_subtitle', __('Tiêu đề nhỏ','gaumap')),
                 Field::make('complex', 'product_advantage',          __('Nhập thông tin'))   ->set_layout('tabbed-horizontal')
                  ->add_fields([
                      Field::make('image',   'advantage_image',   __('Hình ảnh','gaumap'))->set_width(60),
                      Field::make('text',    'advantage_title',   __('Tiêu đề', 'gaumap'))->set_width(30),
                      Field::make('textarea','advantage_content', __('Nội dung','gaumap')),
                  ])->set_header_template('<% if (advantage_title) { %><%- advantage_title %><% } %>'),
             ]);
});
