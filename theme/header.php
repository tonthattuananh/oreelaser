<?php
/**
 * Theme header partial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPEmergeTheme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
    <div class="wrapper">
    <!-- Back to top button -->
    <a id="button"></a>

    <div  class="__search_form_inner hide d-flex justify-content-center align-items-center">
        <button id="close"><i class="fas fa-times"></i></button>
        <form action="" class="--search">
            <div class="input-group mb-3">
                <input type="search" class="form-control" name="s" placeholder="Nhập từ khoá tìm kiếm ..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="__button" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <header id="header">
        <div class="menu__top">
            <div class="top__left">
                <a href="<?php echo get_bloginfo('url') ?>" class="__logo"><img src="<?php theOptionImage('desktop_logo'); ?>" alt="<?php theOption('website_name'); ?>"></a>
            </div>
            <div class="top__right">
                <div class="__main_menu d-none d-lg-block">
                    <?php
                    wp_nav_menu([
                        'menu'           => 'main-menu',
                        'theme_location' => 'main-menu',
                        'container'      => 'ul',
                        'menu_class'     => '',
                        'walker'         => new STC_Menu_Walker(),
                    ])
                    ?>
                </div>

                <div class="__right align-items-center">
                    <div class="__search_form">
                        <button id="--btn_search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="__language d-flex align-items-center">
                        <i class="fas fa-globe-asia"></i>
                        <label for=""><?php echo __('Ngôn ngữ','gaumap') ?></label>
                        <?php echo custom_polylang_langswitcher() ?>

                    </div>
                </div>

                <div class="__main_menu_mobile  d-lg-none d-block">
                    <a href="#mobile_menu">
                        <button class="mburger mburger--collapse">
                            <b></b>
                            <b></b>
                            <b></b>
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </header>


