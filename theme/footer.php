<?php
/**
 * Theme footer partial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPEmergeTheme
 */
?>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="__top_title"><p class="__title"><?php echo __('Liên hệ','gaumap') ?></p></div>
                <div class="__bottom_line">
                    <ul>
                        <li class="--address"><?php theOption('address'); ?></li>
                        <?php
                        $branchs = getOption('branchs');
                        foreach ($branchs as $branch){
                            $branch =  $branch['line'];
                        ?>
                        <li class="--address"><?php echo $branch ?></li>
                        <?php } ?>
                        <li class="--phone"><?php echo __('Điện thoại: ','gaumap')?><?php theOption('phone'); ?></li>
                        <li class="--email"><?php echo __('Email: ','gaumap') ?>    <?php theOption('email'); ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <div class="__top_title"><p class="__title"><?php echo __('Sản phẩm','gaumap') ?></p></div>
                <div class="__bottom_line">
                    <?php
                    wp_nav_menu([
                        'menu'           => 'footer-menu-1',
                        'theme_location' => 'footer-menu-1',
                        'container'      => 'ul',
                        'menu_class'     => '',
                        'walker'         => new STC_Menu_Walker(),
                    ])
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <div class="__top_title"><p class="__title"><?php echo __('Hỗ trợ','gaumap') ?></p></div>
                <div class="__bottom_line">
                    <?php
                    wp_nav_menu([
                        'menu'           => 'footer-menu-2',
                        'theme_location' => 'footer-menu-2',
                        'container'      => 'ul',
                        'menu_class'     => '',
                        'walker'         => new STC_Menu_Walker(),
                    ])
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="__top_title"><p class="__title"><?php echo __('Đăng kí','gaumap') ?></p></div>
                <div class="__bottom_line">
                    <p class="--des"><?php echo __('Truy cập độc quyền cung cấp tin tức nhiều hơn nữa','gaumap') ?></p>

                    <form action="" class="--subcribe d-flex justify-content-between form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nhập email ..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class=" transition btn btn-outline-secondary" type="button">Theo dõi</button>
                            </div>
                        </div>
                    </form>

                    <ul class="--social d-flex flex-wrap">
                        <li class="text-center transition">
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href=""><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<nav id="mobile_menu" data-fb="<?php theOption('fanpage'); ?>" data-ytb="<?php theOption('youtube'); ?>">
    <?php
    wp_nav_menu([
        'menu'           => 'main-menu',
        'theme_location' => 'main-menu',
        'container'      => 'ul',
        'menu_class'     => '',
        'walker'         => new STC_Menu_Walker(),
    ])
    ?>
</nav>
</div>
		<?php wp_footer(); ?>
	</body>
</html>
