<section class="__feature">
    <div class="container">
        <div class="row">
            <div class="__blogs col-12 col-md-6 col-lg-4">
                <div class="__top_title d-flex justify-content-between">
                    <p class="__title">
                        <?php echo __('Tin tức','gaumap' ) ?>
                    </p>
                    <a href="/blogs/" class="__read_more"><?php echo __('Xem thêm ','gaumap' ) ?><i class="fas fa-angle-double-right"></i></a>
                </div>
                <div class="__bottom_post">
                    <?php
                    $post_query = new WP_Query([
                        'post_type'      => 'blogs',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                        'meta_query'     => [['key' => 'is_feature', 'value' => 'yes',]],
                    ]);
                    if ($post_query->have_posts()) :
                        while ($post_query->have_posts()) : $post_query->the_post();
                    ?>
                            <div class="__item d-flex">
                                <figure class="--media">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php thePostThumbnailUrl(170,100); ?>" alt="<?php theTitle(); ?>">
                                    </a>
                                </figure>
                                <div class="--title__day">
                                    <p class="--day"><?php echo get_the_date('m-yy') ?></p>
                                    <a  class="--title" href="<?php the_permalink(); ?>"><?php theTitle(); ?> </a>
                                </div>
                            </div>
                    <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    wp_reset_query();
                    ?>
                </div>
            </div>

            <div class="__videos col-12 col-md-6 col-lg-4">
                <div class="__top_title d-flex justify-content-between">
                    <p class="__title">
                        <?php echo __('Video','gaumap' ) ?>
                    </p>
                    <a href="/blogs/" class="__read_more"><?php echo __('Xem thêm ','gaumap' ) ?><i class="fas fa-angle-double-right"></i></a>
                </div>
                <div class="__bottom_post">
                    <?php
                    $post_query = new WP_Query([
                        'post_type'      => 'blogs',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                        'meta_query'     => [['key' => 'is_feature', 'value' => 'yes',]],
                    ]);
                    if ($post_query->have_posts()) :
                        while ($post_query->have_posts()) : $post_query->the_post();
                            ?>
                            <div class="__item d-flex">
                                <figure class="--media">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php thePostThumbnailUrl(170,100); ?>" alt="<?php theTitle(); ?>">
                                    </a>
                                </figure>
                                <div class="--title__day">
                                    <p class="--day"><?php echo get_the_date('m-yy') ?></p>
                                    <a  class="--title" href="<?php the_permalink(); ?>"><?php theTitle(); ?> </a>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    wp_reset_query();
                    ?>
                </div>
            </div>

            <div class="__albums col-12 col-md-12 col-lg-4">
                <div class="__top_title d-flex justify-content-between">
                    <p class="__title">
                        <?php echo __('Thư viện hình ảnh','gaumap' ) ?>
                    </p>
                    <a href="#" class="__read_more"><?php echo __('Xem thêm ','gaumap' ) ?><i class="fas fa-angle-double-right"></i></a>
                </div>
                <ul class="__album d-flex flex-wrap">
                    <?php
                    $albums= getOption('album');
                    $i=0;
                    foreach ($albums as $album){
                        $image_ID = $album['album_image'];
                        $image_URL = getImageUrlById($image_ID,300,300);
                        $image_ID = $album['album_title'];
                    ?>
                    <li>
                        <figure>
                            <a href="">
                                <img src="<?php echo $image_URL ?>" alt="">
                            </a>
                        </figure>

                    </li>

                    <?php
                        if (++$i == 9) break;
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
</section>
