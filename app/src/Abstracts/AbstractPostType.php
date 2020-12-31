<?php

namespace App\Abstracts;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

abstract class AbstractPostType
{
    /**
     * @var null $post_type
     */
    public $post_type = 'post';

    /**
     * Name for one object of this post type.
     *
     * @var string
     */
    public $singularName = 'Bài viết';

    /**
     * Name for one object of this post type in plural
     *
     * @var string
     */
    public $pluralName = 'Bài viết';

    public $slug = 'post';

    /**
     * Thay doi tieu de placeholder
     *
     * @var string
     */
    public $titlePlaceHolder = 'Tên bài viết';

    public $excerptLabel = 'Chú thích';

    /**
     * A short descriptive summary of what the post type is.
     *
     * @var string
     */
    public $description = 'Default description';

    /**
     * Whether to exclude posts with this post type from front end search results.
     * Note: If you want to show the posts's list that are associated to taxonomy's terms, you must set exclude_from_search to false
     * (ie : for call site_domaine/?taxonomy_slug=term_slug or site_domaine/taxonomy_slug/term_slug).
     * If you set to true, on the taxonomy page (ex: taxonomy.php) WordPress will not find your posts and/or pagination will make 404 error...
     * 'false' - site/?s=search-term will include posts of this post type.
     * 'true' - site/?s=search-term will not include posts of this post type.
     *
     * @var bool
     */
    public $excludeFromSearch = false;

    /**
     * Whether queries can be performed on the front end as part of parse_request().
     * Note: The queries affected include the following (also initiated when rewrites are handled). If query_var is empty, null, or a boolean FALSE,
     * WordPress will still attempt to interpret it (4.2.2) and previews/views of your custom post will return 404s.
     * ?post_type={post_type_key}
     * ?{post_type_key}={single_post_slug}
     * ?{post_type_query_var}={single_post_slug}
     *
     * @var bool
     */
    public $publiclyQueryable = true;

    /**
     * Whether to generate a default UI for managing this post type in the admin.
     * Note: _built-in post types, such as post and page, are intentionally set to false.
     * 'false' - do not display a user-interface for this post type
     * 'true' - display a user-interface (admin panel) for this post type
     *
     * @var bool
     */
    public $showUi = true;

    /**
     * Whether post_type is available for selection in navigation menus.
     *
     * @var bool
     */
    public $showInNavMenus = true;

    /**
     * Where to show the post type in the admin menu. show_ui must be true.
     * Note: When using 'some string' to show as a submenu of a menu page created by a plugin, this item will become the first submenu item, and replace the location of the top-level link. If this isn't desired, the plugin that creates the menu page needs to set the add_action priority for admin_menu to 9 or lower.
     * Note: As this one inherits its value from show_ui, which inherits its value from public, it seems to be the most reliable property to determine, if a post type is meant to be publicly useable. At least this works for _builtin post types and only gives back post and page.
     * 'false' - do not display in the admin menu
     * 'true' - display as a top level menu
     * 'some string' - If an existing top level page such as 'tools.php' or 'edit.php?post_type=page', the post type will be placed as a sub menu of that.
     *
     * @var bool|string
     */
    public $showInMenu = true;

    /**
     * Whether to make this post type available in the WordPress admin bar.
     *
     * @var bool
     */
    public $show_in_admin_bar = true;

    /**
     * The position in the menu order the post type should appear. show_in_menu must be true.
     *
     * @var int
     * 5 - below Posts
     * 10 - below Media
     * 15 - below Links
     * 20 - below Pages
     * 25 - below comments
     * 60 - below first separator
     * 65 - below Plugins
     * 70 - below Users
     * 75 - below Tools
     * 80 - below Settings
     * 100 - below second separator
     */
    public $menuPosition = 5;

    /**
     * The url to the icon to be used for this menu or the name of the icon from the icon font
     * Example:
     * 'dashicons-video-alt' (Uses the video icon from Dashicons[2])
     * 'get_template_directory_uri() . "/images/cutom-post_type-icon.png"' (Use a image located in the current theme)
     * More example at https://developer.wordpress.org/resource/dashicons/#format-image
     *
     * @var string
     */
    public $menuIcon = 'dashicons-admin-links';

    /**
     * Whether the post type is hierarchical (e.g. page). Allows Parent to be specified.
     * The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page.
     * Note: this parameter was intended for Pages. Be careful when choosing it for your custom post type.
     * If you are planning to have very many entries (say - over 2-3 thousand), you will run into load time issues.
     * With this parameter set to true WordPress will fetch all IDs of that particular post type on each administration page load for your post type.
     * Servers with limited memory resources may also be challenged by this parameter being set to true.
     *
     * @var bool
     */
    public $hierarchical = false;

    /**
     * An alias for calling add_post_type_support() directly. As of 3.5, boolean false can be passed as value instead of an array to prevent default
     * (title and editor) behavior.
     *
     * @var array|boolean
     */
    public $supports = [
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'page-attributes',
        'post-formats',
    ];

    /**
     * Whether to expose this post type in the REST API.
     *
     * @var bool
     */
    public $showInRest = true;

    public $quickEdit = true;

    public $archiveNoPaging = false;

    public $showThumbnailOnList = false;

    public function __construct()
    {
        add_action('init', function () {
            register_extended_post_type(
                $this->post_type,
                [
                    'show_in_feed'        => true,
                    'archive'             => [
                        'nopaging' => $this->archiveNoPaging,
                    ],
                    'quick_edit'          => $this->quickEdit,
                    'labels'              => $this->getLabels(),
                    'menu_icon'           => $this->menuIcon,
                    'supports'            => $this->supports,
                    'description'         => $this->description,
                    'exclude_from_search' => $this->excludeFromSearch,
                    'publicly_queryable'  => $this->publiclyQueryable,
                    'hierarchical'        => $this->hierarchical,
                    'show_in_rest'        => $this->showInRest,
                    'rest_base'           => $this->post_type,
                    'show_in_admin_bar'   => false,
                    'menu_position'       => 25,
                    //                    'map_meta_cap'        => true,
                    //                    'capabilities'        => [
                    //                        'create_posts'           => 'create_' . $this->post_type,
                    //                        'delete_others_posts'    => 'delete_others_' . $this->post_type,
                    //                        'delete_posts'           => 'delete_' . $this->post_type,
                    //                        'delete_private_posts'   => 'delete_private_' . $this->post_type,
                    //                        'delete_published_posts' => 'delete_published_' . $this->post_type,
                    //                        'edit_others_posts'      => 'edit_others_' . $this->post_type,
                    //                        'edit_posts'             => 'edit_' . $this->post_type,
                    //                        'edit_private_posts'     => 'edit_private_' . $this->post_type,
                    //                        'edit_published_posts'   => 'edit_published_' . $this->post_type,
                    //                        'publish_posts'          => 'publish_' . $this->post_type,
                    //                        'read_private_posts'     => 'read_private_' . $this->post_type,
                    //                    ],
                ],
                [
                    'singular' => $this->singularName,
                    'plural'   => $this->pluralName,
                    'slug'     => $this->slug,
                ]
            );
        });

        add_filter('enter_title_here', function ($title) {
            $screen = get_current_screen();
            if ($this->post_type === $screen->post_type) {
                $title = $this->titlePlaceHolder;
            }

            return $title;
        });

        add_filter('gettext', function ($translation, $original) {
            if ($original === 'Excerpt') {
                return $this->excerptLabel;
            } elseif (false !== strpos($original, 'Excerpts are optional hand-crafted summaries of your')) {
                return '';
            }
            return $translation;
        }, 10, 2);

        add_filter('manage_' . $this->post_type . '_posts_columns', function ($cols) {
            $cols['title'] = $this->titlePlaceHolder;
            return $cols;
        }, 9900, 9900);

        if ($this->showThumbnailOnList) {
            add_filter('manage_' . $this->post_type . '_posts_columns', [$this, 'editAdminColumn'], 9999, 9999);
            add_action('manage_' . $this->post_type . '_posts_custom_column', [$this, 'editAdminColumnData'], 10, 2);
            add_action('admin_head', [$this, 'adminCustomColumnStyle'], 10, 2);
        }

        add_action('carbon_fields_register_fields', [$this, 'metaFields']);

        add_action('carbon_fields_register_fields', function () {
            Container::make('post_meta', __('Cài đặt', 'gaumap'))
                     ->set_context('side')// normal, advanced, side or carbon_fields_after_title
                     ->set_priority('high')// high, core, default or low
                     ->where('post_type', 'IN', [$this->post_type])
                     ->add_fields([
                         Field::make('checkbox', 'is_feature', __('Nổi bật', 'gaumap'))->set_default_value(false),
                     ]);
        });

        $this->createRequiredPages();
    }

    /**
     * Get array of post type label
     *
     * @return array
     */
    protected function getLabels()
    {
        return [
            'name'                  => $this->pluralName,
            'singular_name'         => $this->singularName,
            'add_new'               => __('Thêm mới', 'gaumap'),
            'add_new_item'          => __('Thêm mới ' . $this->singularName, 'gaumap'),
            'edit_item'             => __('Sửa', 'gaumap'),
            'new_item'              => __('Mục mới', 'gaumap'),
            'view_item'             => __('Chi tiết', 'gaumap'),
            'search_items'          => __('Tìm kiếm', 'gaumap'),
            'not_found'             => __('Không tìm thấy', 'gaumap'),
            'not_found_in_trash'    => __('Không tìm thấy mục nào bị xóa', 'gaumap'),
            'parent_item_colon'     => __('Mục cha:', 'gaumap'),
            'all_items'             => __('Tất cả các mục', 'gaumap'),
            'archives'              => __('Các mục được lưu trữ', 'gaumap'),
            'insert_into_item'      => __('Chèn vào mục này', 'gaumap'),
            'uploaded_to_this_item' => __('Đính kèm vào mục này', 'gaumap'),
            'featured_image'        => __('Hình đại diện', 'gaumap'),
            'set_featured_image'    => __('Chọn hình đại diện này', 'gaumap'),
            'remove_featured_image' => __('Xóa hình đại diện', 'gaumap'),
            'use_featured_image'    => __('Sử dụng làm hình đại diện', 'gaumap'),
            'menu_name'             => $this->pluralName,
            'name_admin_bar'        => $this->singularName,
            //'filter_items_list' - String for the table views hidden heading.
            //'items_list_navigation' - String for the table pagination hidden heading.
            //'items_list' - String for the table hidden heading.
            //'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`.
        ];
    }

    public function createRequiredPages()
    {
        $postType = $this->post_type === 'post' ? '' : '-' . $this->post_type;

        $filename = __DIR__ . '/../../../archive' . $postType . '.php';
        if (!file_exists($filename)) {
            file_put_contents($filename, '<?php get_header() ?>
<?php theBreadcrumb() ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="gm-content-wrapper">
                    <?php if($currentPage->have_posts()) : ?>
                        <?php while($currentPage->have_posts()) : $currentPage->the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php wp_reset_query(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>');
        }

        $filename = __DIR__ . '/../../../single' . $postType . '.php';
        if (!file_exists($filename)) {
            file_put_contents($filename, '<?php get_header() ?>
<?php theBreadcrumb() ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="gm-content-wrapper">
                    <?php if($currentPage->have_posts()) : ?>
                        <?php while($currentPage->have_posts()) : $currentPage->the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php wp_reset_query(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>');
        }
    }

    /**
     * Custom style
     */
    public function adminCustomColumnStyle()
    {
        ?>

		<style>
			form#posts-filter
			{
				position : relative;
			}

			.column-featured_image, .column-is_feature
			{
				width : 60px !important;
			}

			.column-is_feature a
			{

				padding               : 2px;
				-webkit-border-radius : 100%;
				-moz-border-radius    : 100%;
				border-radius         : 100%;
			}

			.column-is_feature a.dashicons-yes
			{
				border : solid 1px #00cd00;
				color  : #00cd00;
			}

			.column-is_feature a.dashicons-no
			{
				border : solid 1px #cd0000;
				color  : #cd0000;
			}

			.wp-list-table td
			{
				vertical-align : middle;
			}
		</style>

        <?php
    }

    /**
     * Hook custom admin columns
     *
     * @param $columns
     *
     * @return array
     */
    public function editAdminColumn($columns): array
    {
        $totalColumn = count($columns);
        $columns     = insertArrayAtPosition($columns, ['featured_image' => 'Image'], 1);
        $columns     = insertArrayAtPosition($columns, ['is_feature' => __('Nổi bật', 'gaumap')], $totalColumn - 1);

        return $columns;
    }

    /**
     * Hook custom admin column data
     *
     * @param $column
     * @param $postId
     */
    public function editAdminColumnData($column, $postId)
    {
        switch ($column) {
            case 'featured_image':
            	$thumbnailUrl = get_the_post_thumbnail_url($postId);
                echo "<a href='javascript:' data-trigger-change-thumbnail-id data-post-id='{$postId}'><img src='{$thumbnailUrl}' style='width:60px;height:60px' /></a>";
                break;
            case 'is_feature':
                $iSFeature = carbon_get_post_meta($postId, 'is_feature');
                $icon      = $iSFeature ? 'dashicons-yes' : 'dashicons-no';
                echo "<a href='javascript:' data-trigger-toggle-feature data-post-id='{$postId}' class='dashicons {$icon}'></a>";
                break;
        }
    }

    /**
     * Document: https://docs.carbonfields.net/#/containers/post-meta
     */
    public function metaFields()
    {
        //        Container::make('post_meta', __('Advanced', 'gaumap'))
        //                 ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
        //                 ->set_priority('high')// high, core, default or low
        //                 ->where('post_type', 'IN', [$this->post_type])
        //                 ->add_fields([
        //                                  Field::make('checkbox', 'abcd', __('Tin nóng', 'gaumap')),
        //                              ]);
    }

    // Metabox ban do
    public function addMetaBoxBanDo()
    {
        add_action('add_meta_boxes', function () {
            add_meta_box('gaumap_meta_map_box', __('Vị trí trên bản đồ', 'gaumap'), [$this, 'hienThiMetaBoxBanDo'], $this->post_type, 'normal', 'high');
        });

        add_action('save_post', function ($postId) {
            if (array_key_exists('geo_json_code', $_POST)) {
                updatePostMeta($postId, '_geo_json_code', $_POST['geo_json_code']);
            }
        });

        add_action('rest_api_init', function () {
            register_rest_field($this->post_type, 'geo_json_code', [
                'schema'       => null,
                'get_callback' => function ($object) {
                    //get the id of the post object array
                    $post_id = $object['id'];

                    //return the post meta
                    return get_post_meta($post_id, '_geo_json_code', true);
                },
            ]);
        });
    }

    public function hienThiMetaBoxBanDo($post)
    {
        $apiKey = 'AIzaSyAqe2bYYRe6NFAlEIxW0ty-mrSWbAY3wdc';
        wp_enqueue_script('gaumap-map-libraries', 'https://maps.googleapis.com/maps/api/js?key=' . $apiKey . '&libraries=geometry,places,drawing', [], '1.0', true);
        wp_enqueue_script('gaumap-map-control', adminAsset('js/gaumap-meta-box-ban-do.js'), [], '1.0', true);
        $geoJsonCode = get_post_meta($post->ID, '_geo_json_code', true); ?>
		<div id="gm_map"></div>
		<textarea id="geo_json_code" name="geo_json_code" style="height:700px;width:100%;resize:none"><?php echo $geoJsonCode ?></textarea>
		<script>
            jQuery(function () {
                gmInitMap('gm_map', {
                    debug          : true,
                    limitOverlays  : 1,
                    supportedColors: ['#1e90ff', '#ff1493', '#32cd32', '#ff8c00', '#4b0082'],
                    drawingMode    : false,
                    drawingModes   : [
                        google.maps.drawing.OverlayType.POLYLINE,
                        google.maps.drawing.OverlayType.POLYGON,
                        google.maps.drawing.OverlayType.RECTANGLE,
                        google.maps.drawing.OverlayType.CIRCLE,
                        google.maps.drawing.OverlayType.MARKER
                    ]
                }, true);
            });
		</script>
    <?php }

    public function addMetaBoxDiemDauCuoi()
    {
        Container::make('post_meta', __('Thông tin vị trí điểm đầu - cuối', 'gaumap'))
                 ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
                 ->set_priority('default')// high, core, default or low
                 ->where('post_type', 'IN', [$this->post_type])
                 ->add_fields([
                     Field::make('text', 'dia_chi_dau', __('Địa chỉ (điểm đầu)', 'gaumap'))
                          ->set_width(100),
                     Field::make('select', 'tinh_dau', __('Tỉnh / Thành phố (điểm đầu)', 'gaumap'))
                          ->add_options(function () {
                              $posts   = get_posts([
                                  'post_type'      => 'dia-phan-tinh',
                                  'posts_per_page' => -1,
                              ]);
                              $results = [];
                              foreach ($posts as $post) {
                                  $results[$post->ID] = $post->post_title;
                              }

                              return $results;
                          })
                          ->set_width(33),
                     Field::make('select', 'quan_huyen_dau', __('Quận / Huyện (điểm đầu)', 'gaumap'))
                          ->add_options(['---- Chọn quận / huyện ----'])
                          ->set_width(33),
                     Field::make('select', 'phuong_xa_dau', __('Phường / Xã (điểm đầu)', 'gaumap'))
                          ->add_options(['---- Chọn phường / xã ----'])
                          ->set_width(34),
                     Field::make('text', 'toa_do_x_dau', __('Tọa độ X (điểm đầu)', 'gaumap'))
                          ->set_width(50),
                     Field::make('text', 'toa_do_y_dau', __('Tọa độ Y (điểm đầu)', 'gaumap'))
                          ->set_width(50),

                     Field::make('text', 'dia_chi_cuoi', __('Địa chỉ (điểm cuối)', 'gaumap'))
                          ->set_width(100),
                     Field::make('select', 'tinh_cuoi', __('Tỉnh / Thành phố (điểm cuối)', 'gaumap'))
                          ->add_options(function () {
                              $posts   = get_posts([
                                  'post_type'      => 'dia-phan-tinh',
                                  'posts_per_page' => -1,
                              ]);
                              $results = [];
                              foreach ($posts as $post) {
                                  $results[$post->ID] = $post->post_title;
                              }

                              return $results;
                          })
                          ->set_width(33),
                     Field::make('select', 'quan_huyen_cuoi', __('Quận / Huyện (điểm cuối)', 'gaumap'))
                          ->add_options(['---- Chọn quận / huyện ----'])
                          ->set_width(33),
                     Field::make('select', 'phuong_xa_cuoi', __('Phường / Xã (điểm cuối)', 'gaumap'))
                          ->add_options(['---- Chọn phường / xã ----'])
                          ->set_width(34),
                     Field::make('text', 'toa_do_x_cuoi', __('Tọa độ X (điểm cuối)', 'gaumap'))
                          ->set_width(50),
                     Field::make('text', 'toa_do_y_cuoi', __('Tọa độ Y (điểm cuối)', 'gaumap'))
                          ->set_width(50),
                 ]);


        add_action('wp_ajax_get_quan_huyen', function () {
            $idTinh  = $_GET['_tinh'];
            $posts   = get_posts([
                'post_type'      => 'dia-phan-huyen',
                'posts_per_page' => -1,
                'meta_query'     => [
                    [
                        'key'   => '_id_dia_phan_tinh',
                        'value' => $idTinh,
                    ],
                ],
            ]);
            $results = [];
            foreach ($posts as $post) {
                $results[$post->ID] = $post->post_title;
            }

            return wp_send_json_success($results);
        });

        add_action('wp_ajax_get_phuong_xa', function () {
            $idQuanHuyen = $_GET['_quan_huyen'];
            $posts       = get_posts([
                'post_type'      => 'dia-phan-xa',
                'posts_per_page' => -1,
                'meta_query'     => [
                    [
                        'key'   => '_id_dia_phan_huyen',
                        'value' => $idQuanHuyen,
                    ],
                ],
            ]);
            $results     = [];
            foreach ($posts as $post) {
                $results[$post->ID] = $post->post_title;
            }

            return wp_send_json_success($results);
        });

        add_action('save_post', function ($postId) {
            if (array_key_exists('_quan_huyen_dau', $_POST)) {
                updatePostMeta($postId, '_quan_huyen_dau', $_POST['_quan_huyen_dau']);
            }
            if (array_key_exists('_phuong_xa_dau', $_POST)) {
                updatePostMeta($postId, '_phuong_xa_dau', $_POST['_phuong_xa_dau']);
            }
            if (array_key_exists('_quan_huyen_cuoi', $_POST)) {
                updatePostMeta($postId, '_quan_huyen_cuoi', $_POST['_quan_huyen_cuoi']);
            }
            if (array_key_exists('_phuong_xa_cuoi', $_POST)) {
                updatePostMeta($postId, '_phuong_xa_cuoi', $_POST['_phuong_xa_cuoi']);
            }
        }, PHP_INT_MAX);

        add_action('admin_footer', function () { ?>
			<input type="hidden" id="_selected_id_tinh_dau" value="<?php echo get_post_meta(get_the_ID(), '_tinh_dau', true) ?>">
			<input type="hidden" id="_selected_id_quan_huyen_dau" value="<?php echo get_post_meta(get_the_ID(), '_quan_huyen_dau', true) ?>">
			<input type="hidden" id="_selected_id_phuong_xa_dau" value="<?php echo get_post_meta(get_the_ID(), '_phuong_xa_dau', true) ?>">
			<input type="hidden" id="_selected_id_tinh_cuoi" value="<?php echo get_post_meta(get_the_ID(), '_tinh_cuoi', true) ?>">
			<input type="hidden" id="_selected_id_quan_huyen_cuoi" value="<?php echo get_post_meta(get_the_ID(), '_quan_huyen_cuoi', true) ?>">
			<input type="hidden" id="_selected_id_phuong_xa_cuoi" value="<?php echo get_post_meta(get_the_ID(), '_phuong_xa_cuoi', true) ?>">
			<script type="text/javascript">

                jQuery(document).ready(function () {
                    jQuery('[name=_tinh_dau]').change();
                    jQuery('[name=_tinh_cuoi]').change();
                });

                jQuery(document).on('change', '[name=_tinh_dau]', function () {
                    let idTinh = jQuery(this).val();
                    jQuery.get(`<?php ajaxUrl() ?>?action=get_quan_huyen&_tinh=${idTinh}`, function (response) {
                        if (response.success === true) {
                            let selectHuyen = jQuery('[name=_quan_huyen_dau]');
                            selectHuyen.html(new Option('---- Chọn quận / huyện ----', '0'));
                            let dsHuyen = response.data;
                            let selectedVal = parseInt(jQuery('#_selected_id_quan_huyen_dau').val());
                            let isSelected = false;
                            for (let idHuyen in dsHuyen) {
                                selectHuyen.append(new Option(dsHuyen[idHuyen], idHuyen));
                                if (selectedVal === parseInt(idHuyen)) selectHuyen.val(idHuyen).trigger('change');
                                isSelected = true;
                            }
                            if (isSelected === false) selectHuyen.val(0);
                        }
                    });
                })

                jQuery(document).on('change', '[name=_tinh_cuoi]', function () {
                    let idTinh = jQuery(this).val();
                    jQuery.get(`<?php ajaxUrl() ?>?action=get_quan_huyen&_tinh=${idTinh}`, function (response) {
                        if (response.success === true) {
                            let selectHuyen = jQuery('[name=_quan_huyen_cuoi]');
                            selectHuyen.html(new Option('---- Chọn quận / huyện ----', '0'));
                            let dsHuyen = response.data;
                            let selectedVal = parseInt(jQuery('#_selected_id_quan_huyen_cuoi').val());
                            let isSelected = false;
                            for (let idHuyen in dsHuyen) {
                                selectHuyen.append(new Option(dsHuyen[idHuyen], idHuyen));
                                if (selectedVal === parseInt(idHuyen)) selectHuyen.val(idHuyen).trigger('change');
                                isSelected = true;
                            }
                            if (isSelected === false) selectHuyen.val(0);
                        }
                    });
                })

                jQuery(document).on('change', '[name=_quan_huyen_dau]', function () {
                    let idQuanHuyen = jQuery(this).val();
                    jQuery.get(`<?php ajaxUrl() ?>?action=get_phuong_xa&_quan_huyen=${idQuanHuyen}`, function (response) {
                        if (response.success === true) {
                            let selectPhuong = jQuery('[name=_phuong_xa_dau]');
                            selectPhuong.html(new Option('---- Chọn phường / xã ----', '0'));
                            let dsPhuong = response.data;
                            let selectedVal = parseInt(jQuery('#_selected_id_phuong_xa_dau').val());
                            let isSelected = false;
                            for (let idPhuong in dsPhuong) {
                                selectPhuong.append(new Option(dsPhuong[idPhuong], idPhuong));
                                if (selectedVal === parseInt(idPhuong)) selectPhuong.val(idPhuong);
                                isSelected = true;
                            }
                            if (isSelected === false) selectPhuong.val(0);
                        }
                    });
                });

                jQuery(document).on('change', '[name=_quan_huyen_cuoi]', function () {
                    let idQuanHuyen = jQuery(this).val();
                    jQuery.get(`<?php ajaxUrl() ?>?action=get_phuong_xa&_quan_huyen=${idQuanHuyen}`, function (response) {
                        if (response.success === true) {
                            let selectPhuong = jQuery('[name=_phuong_xa_cuoi]');
                            selectPhuong.html(new Option('---- Chọn phường / xã ----', '0'));
                            let dsPhuong = response.data;
                            let selectedVal = parseInt(jQuery('#_selected_id_phuong_xa_cuoi').val());
                            let isSelected = false;
                            for (let idPhuong in dsPhuong) {
                                selectPhuong.append(new Option(dsPhuong[idPhuong], idPhuong));
                                if (selectedVal === parseInt(idPhuong)) selectPhuong.val(idPhuong);
                                isSelected = true;
                            }
                            if (isSelected === false) selectPhuong.val(0);
                        }
                    });
                });

			</script>
        <?php });
    }

    public function addMetaBoxDiaChi()
    {
        Container::make('post_meta', __('Thông tin vị trí', 'gaumap'))
                 ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
                 ->set_priority('default')// high, core, default or low
                 ->where('post_type', 'IN', [$this->post_type])
                 ->add_fields([
                     Field::make('text', 'dia_chi', __('Địa chỉ', 'gaumap'))
                          ->set_width(100),
                     Field::make('select', 'tinh', __('Tỉnh / Thành phố', 'gaumap'))
                          ->add_options(function () {
                              $posts   = get_posts([
                                  'post_type'      => 'dia-phan-tinh',
                                  'posts_per_page' => -1,
                              ]);
                              $results = [];
                              foreach ($posts as $post) {
                                  $results[$post->ID] = $post->post_title;
                              }

                              return $results;
                          })
                          ->set_width(33),
                     Field::make('select', 'quan_huyen', __('Quận / Huyện', 'gaumap'))
                          ->add_options(['---- Chọn quận / huyện ----'])
                          ->set_width(33),
                     Field::make('select', 'phuong_xa', __('Phường / Xã', 'gaumap'))
                          ->add_options(['---- Chọn phường / xã ----'])
                          ->set_width(34),
                     Field::make('text', 'toa_do_x', __('Tọa độ X', 'gaumap'))
                          ->set_width(50),
                     Field::make('text', 'toa_do_y', __('Tọa độ Y', 'gaumap'))
                          ->set_width(50),
                 ]);


        add_action('wp_ajax_get_quan_huyen', function () {
            $idTinh  = $_GET['_tinh'];
            $posts   = get_posts([
                'post_type'      => 'dia-phan-huyen',
                'posts_per_page' => -1,
                'meta_query'     => [
                    [
                        'key'   => '_id_dia_phan_tinh',
                        'value' => $idTinh,
                    ],
                ],
            ]);
            $results = [];
            foreach ($posts as $post) {
                $results[$post->ID] = $post->post_title;
            }

            return wp_send_json_success($results);
        });

        add_action('wp_ajax_get_phuong_xa', function () {
            $idQuanHuyen = $_GET['_quan_huyen'];
            $posts       = get_posts([
                'post_type'      => 'dia-phan-xa',
                'posts_per_page' => -1,
                'meta_query'     => [
                    [
                        'key'   => '_id_dia_phan_huyen',
                        'value' => $idQuanHuyen,
                    ],
                ],
            ]);
            $results     = [];
            foreach ($posts as $post) {
                $results[$post->ID] = $post->post_title;
            }

            return wp_send_json_success($results);
        });

        add_action('save_post', function ($postId) {
            if (array_key_exists('_quan_huyen', $_POST)) {
                updatePostMeta($postId, '_quan_huyen', $_POST['_quan_huyen']);
            }
            if (array_key_exists('_phuong_xa', $_POST)) {
                updatePostMeta($postId, '_phuong_xa', $_POST['_phuong_xa']);
            }
        }, PHP_INT_MAX);

        add_action('admin_footer', function () { ?>
			<input type="hidden" id="_current_id" value="<?php echo get_the_ID() ?>">
			<input type="hidden" id="_selected_id_tinh" value="<?php echo get_post_meta(get_the_ID(), '_tinh', true) ?>">
			<input type="hidden" id="_selected_id_quan_huyen" value="<?php echo get_post_meta(get_the_ID(), '_quan_huyen', true) ?>">
			<input type="hidden" id="_selected_id_phuong_xa" value="<?php echo get_post_meta(get_the_ID(), '_phuong_xa', true) ?>">
			<script type="text/javascript">

                jQuery(document).ready(function () {
                    jQuery('[name=_tinh]').change();
                });

                jQuery(document).on('change', '[name=_tinh]', function () {
                    let idTinh = jQuery(this).val();
                    jQuery.get(`<?php ajaxUrl() ?>?action=get_quan_huyen&_tinh=${idTinh}`, function (response) {
                        if (response.success === true) {
                            let selectHuyen = jQuery('[name=_quan_huyen]');
                            selectHuyen.html(new Option('---- Chọn quận / huyện ----', '0'));
                            let dsHuyen = response.data;
                            let selectedVal = parseInt(jQuery('#_selected_id_quan_huyen').val());
                            let isSelected = false;
                            for (let idHuyen in dsHuyen) {
                                selectHuyen.append(new Option(dsHuyen[idHuyen], idHuyen));
                                if (selectedVal === parseInt(idHuyen)) selectHuyen.val(idHuyen).trigger('change');
                                isSelected = true;
                            }
                            if (isSelected === false) selectHuyen.val(0);
                        }
                    });
                })

                jQuery(document).on('change', '[name=_quan_huyen]', function () {
                    let idQuanHuyen = jQuery(this).val();
                    jQuery.get(`<?php ajaxUrl() ?>?action=get_phuong_xa&_quan_huyen=${idQuanHuyen}`, function (response) {
                        if (response.success === true) {
                            let selectPhuong = jQuery('[name=_phuong_xa]');
                            selectPhuong.html(new Option('---- Chọn phường / xã ----', '0'));
                            let dsPhuong = response.data;
                            let selectedVal = parseInt(jQuery('#_selected_id_phuong_xa').val());
                            let isSelected = false;
                            for (let idPhuong in dsPhuong) {
                                selectPhuong.append(new Option(dsPhuong[idPhuong], idPhuong));
                                if (selectedVal === parseInt(idPhuong)) selectPhuong.val(idPhuong);
                                isSelected = true;
                            }
                            if (isSelected === false) selectPhuong.val(0);
                        }
                    });
                });

			</script>
        <?php });
    }
}
