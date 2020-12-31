<?php
/**
 * Theme Options.
 *
 * Here, you can register Theme Options using the Carbon Fields library.
 *
 * @link    https://carbonfields.net/docs/containers-theme-options/
 *
 * @package WPEmergeCli
 */

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

$optionsPage =  Container::make('theme_options', __('Tuỳ chỉnh cơ bản', 'gaumap'))
                         ->set_page_file('app-theme-options.php')
                         ->set_page_menu_position(3)
                         ->set_icon('dashicons-admin-tools')
                         ->set_page_menu_title(__('Tuỳ chỉnh cơ bản', 'gaumap'))
                         ->add_tab(__('Hình ảnh thương hiệu | Branding', 'gaumap'), [
                             Field::make('image', 'image_default' .currentLanguage()  , __('Ảnh mặc định', 'gaumap'))  ->set_width(33.33),
                             Field::make('image', 'desktop_logo'  .currentLanguage()  , __('Logo máy tính', 'gaumap')) ->set_width(33.33),
                             Field::make('image', 'mobile_logo'   .currentLanguage()  , __('Logo điện thoại','gaumap'))->set_width(33.33),
                         ])
                         ->add_tab(__('Liên hệ | Contact', 'gaumap'), [
                             Field::make('text',    'website_name'.currentLanguage(), __('Tên website', 'gaumap'))      ->set_width(100)  ->set_default_value('Công Ty TNHH Kỹ Thuật & Dịch Vụ Công Nghiệp Quang Minh'),
                             Field::make('text',    'email'       .currentLanguage(), __('Email',       'gaumap'))      ->set_width(33.33)->set_default_value('sales@quangminhist.com'),
                             Field::make('text',    'phone'       .currentLanguage(), __('Điện thoại',  'gaumap'))      ->set_width(33.33)->set_default_value('0225 710 88 99'),
                             Field::make('text',    'hotline'     .currentLanguage(), __('Hotline',     'gaumap'))      ->set_width(33.33)->set_default_value('0987 935 898'),
                             Field::make('text',    'address'     .currentLanguage(), __('Trụ sở chính','gaumap'))      ->set_width(100),
                             Field::make('complex', 'branchs'     .currentLanguage(), __('Chi nhánh công ty','gaumap')) ->set_layout( 'tabbed-horizontal' )
                                  ->add_fields([
                                      Field::make('text', 'line', __('Nhập địa chỉ:')),
                                  ])->set_header_template('<% if (line) { %><%- line %><% } %>'),
                             Field::make('separator', 'socials_seperator'.currentLanguage(), __('Mạng xã hội | Socials', 'gaumap')),
                             Field::make('text',      'zalo'             .currentLanguage(), __('Zalo',      'gaumap'))->set_width(50),
                             Field::make('text',      'youtube'          .currentLanguage(), __('Youtube',   'gaumap'))->set_width(50),
                             Field::make('text',      'fanpage'          .currentLanguage(), __('Fanpage',   'gaumap'))->set_width(60),
                             Field::make('text',      'fanpage_id'       .currentLanguage(), __('Fanpage ID','gaumap'))->set_width(40),
                         ]);

Container::make('theme_options', __('Giao diện website', 'app'))
         ->set_page_parent($optionsPage)
         ->set_page_file(__('giao-dien-website', 'gaumap'))
         ->add_tab(__('Đầu trang | Header', 'gaumap'), [
             Field::make('separator',   'slider_seperator'.currentLanguage(), __('SLIDER HOME', 'gaumap')),
             Field::make('complex',     'main_slider'     .currentLanguage(), __('Chọn hình ảnh slider','gaumap')) ->set_layout( 'tabbed-horizontal' )
                  ->add_fields([
                      Field::make('image', 'slider_image', __(''))          ->set_width(30),
                      Field::make('text',  'slider_link' , __('Đường dẫn')) ->set_width(50),
                  ]),
         ])
         ->add_tab(__('Thân trang | Index', 'gaumap'), [
             Field::make( 'association', 'crb_association', __( 'Association','gaumap' ) )
                ->set_max( 1 )
                ->set_duplicates_allowed(false)
                ->set_types( array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'page',
                        'term_id'   => get_the_ID(),
                    )
                ) ),
             Field::make('separator','album_seperator' .currentLanguage(), __('____________Thư viện hình ảnh | Album ', 'gaumap')),
             Field::make('complex',  'album'           .currentLanguage(), __('Chọn hình ảnh','gaumap')) ->set_layout( 'tabbed-horizontal' )
                  ->add_fields([
                      Field::make('image', 'album_image', __(''))          ->set_width(30),
                      Field::make('text',  'album_title' , __('Tiêu đế')) ->set_width(50),
                  ]),
         ])
         ->add_tab(__('Chân trang | Footer', 'gaumap'), [

         ]);

Container::make('theme_options', __('Insert script', 'app'))
         ->set_page_parent($optionsPage)
         ->set_page_file(__('insert-script', 'gaumap'))
         ->add_fields([
             Field::make('text', 'crb_google_maps_api_key', __('Google Maps API Key', 'app')),
             Field::make('header_scripts', 'crb_header_script', __('Header Script', 'app')),
             Field::make('footer_scripts', 'crb_footer_script', __('Footer Script', 'app')),
         ]);

//**********************template_about_us
//__page_feature
Container::make('post_meta', __('Trang nổi bật', 'gaumap'))
         ->set_context('side')// normal, advanced, side or carbon_fields_after_title
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/template_about_us.php' )
         ->add_fields([
             Field::make('checkbox', 'is_feature', __('', 'gaumap'))->set_default_value(false),
         ]);
//__about_number
Container::make('post_meta', __('___________Thông tin sơ lược về chúng tôi', 'gaumap'))
         ->set_context('carbon_fields_after_title')
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/template_about_us.php' )
         ->add_fields([
             Field::make('image',  'show_bg_about_us', __('Hình nền: ',     'gaumap')),
             Field::make('complex','show_about', __('THÔNG TIN CƠ SỞ CÔNG TY: '))
                  ->set_layout( 'tabbed-horizontal' )
                  ->add_fields([
                      Field::make('text',   'show_about_number',  __('Số liệu:','gaumap')),
                      Field::make('text',   'show_about_title',   __('Tiêu đề:','gaumap')),
                  ])->set_header_template('<% if (show_about_title) { %><%- show_about_title %><% } %>')->set_width(50),
             Field::make('complex','show_service', __('THÔNG TIN BẢO HÀNH & DỊCH VỤ: '))
                  ->set_layout( 'tabbed-horizontal' )
                  ->add_fields([
                      Field::make('icon','show_service_icon',  __('Icon',    'gaumap'))->set_width(30),
                      Field::make('text','show_service_title', __('Tiêu đề:','gaumap')),
                  ])->set_header_template('<% if (show_service_title) { %><%- show_service_title %><% } %>')->set_width(50),
         ]);
//__video_intro
Container::make('post_meta', __('___________Video giới thiệu công ty', 'gaumap'))
         ->set_context('normal')
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/template_about_us.php' )
         ->add_fields([
             Field::make('image', 'show_bg_video_intro',__('Hình nền: ',      'gaumap')),
             Field::make('text',  'title_video_intro',  __('Tiêu đề: ',       'gaumap'))->set_width(50),
             Field::make('text',  'link_video_intro',   __('Đường dẫn video:','gaumap'))->set_width(50),
         ]);
//__product_value
Container::make('post_meta', __('___________Giá trị mang lại cho khách hàng', 'gaumap'))
         ->set_context('normal')
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/template_about_us.php' )
         ->add_fields([
             Field::make('image', 'product_value_bg',__('Hình nền: ',       'gaumap'))->set_width(30),
             Field::make('text',  'product_value_title',  __('Tiêu đề: ',   'gaumap'))->set_width(60),
             Field::make('complex','product_value', __('Nhập thông tin:'))
                  ->set_layout( 'tabbed-horizontal' )
                  ->add_fields([
                      Field::make('text',     'item_value_title',  __('Tiêu đề:',  'gaumap')),
                      Field::make('textarea', 'item_value_content',__('Nội dung:', 'gaumap')),
                  ])->set_header_template('<% if (item_value_title) { %><%- item_value_title %><% } %>'),
         ]);
//__partners
Container::make('post_meta', __('___________Đối tác', 'gaumap'))
         ->set_context('normal')
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/template_about_us.php' )
         ->add_fields([
             Field::make('image',    'partners_bg'      , __('Ảnh nền',     'gaumap')),
             Field::make('text',     'partners_title'   , __('Tiêu đề',     'gaumap'))->set_width(35),
             Field::make('text',     'partners_subtitle', __('Tiêu đề nhỏ', 'gaumap'))->set_width(65),
             Field::make('complex',  'partners_slider'  , __('Chọn logo',   'gaumap'))->set_layout( 'tabbed-horizontal' )
                  ->add_fields([
                      Field::make('text',  'partners_name' , __('Tên'))       ->set_width(100),
                      Field::make('image', 'partners_image', __(''))          ->set_width(30),
                      Field::make('text',  'partners_link' , __('Đường dẫn')) ->set_width(50),
                  ])->set_header_template('<% if (partners_name) { %><%- partners_name %><% } %>'),
         ]);
//__intro_company
Container::make('post_meta', __('___________Quảng bá dịch vụ công ty', 'gaumap'))
         ->set_context('normal')
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/template_about_us.php' )
         ->add_fields([
             Field::make('complex','intro_company', __('Nhập thông tin'))
                  ->set_layout( 'tabbed-horizontal' )
                  ->add_fields([
                      Field::make('image',    'intro_company_icon',   __('Biểu tượng','gaumap'))->set_width(30),
                      Field::make('text',     'intro_company_title',  __('Tiêu đề:',  'gaumap'))->set_width(70),
                      Field::make('rich_text','intro_company_content',__('',          'gaumap')),
                  ])->set_header_template('<% if (intro_company_title) { %><%- intro_company_title %><% } %>'),
         ]);
//__customer_comments
Container::make('post_meta', __('___________Đánh giá từ khách hàng', 'gaumap'))
         ->set_context('normal')
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/template_about_us.php' )
         ->add_fields([
             Field::make('text',   'customer_comments_title', __('Tiêu đề', 'gaumap')),
             Field::make('complex','customer_comments'      ,  __('Nhập thông tin',       'gaumap'))
                  ->set_layout( 'tabbed-horizontal')
                  ->add_fields([
                      Field::make('image',    'customer_comments_image',   __('Ảnh đại diện','gaumap'))->set_width(30),
                      Field::make('textarea', 'customer_comments_content', __('Tiêu đề:',  'gaumap'))  ->set_width(70),
                  ]),
         ]);
//__branch_map
Container::make('post_meta', __('___________Bản đồ chi nhánh', 'gaumap'))
         ->set_context('normal')
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/template_about_us.php' )
         ->add_fields([
             // Field::make('image',  'branch_map_image', __('Ảnh nền bản đồ', 'gaumap'))->set_width(30),
             Field::make('text',   'branch_map_title',      __('Tiêu đề', 'gaumap'))->set_width(50),
             Field::make('text',   'branch_map_subtitle',   __('Tiêu đề nhỏ', 'gaumap'))->set_width(50),
             Field::make('text',   'branch_map_shortcode',  __('Shortcode Map', 'gaumap')),
             // Field::make('complex','branch_map'      , __('Nhập địa chỉ',       'gaumap'))
             // ->set_layout( 'tabbed-horizontal')
             // ->add_fields([
             //    Field::make('text', 'branch_map_address', __('Địa chỉ:',  'gaumap')),
             // ])->set_header_template('<% if (branch_map_address) { %><%- branch_map_address %><% } %>'),
         ]);

?>






