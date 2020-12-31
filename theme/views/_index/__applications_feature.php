<section class="applications__feature text-center">
    <div class="container">
        <div class="top__title">
            <span class="__title"><?php echo __('Ứng dụng','gaumap') ?></span>
            <span class="__subtitle"><?php echo __('Chọn một máy và xem những gì bạn có thể làm bằng máy này','gaumap') ?></span>
        </div>
        <div class="row">
            <?php
            $post_query = new WP_Query([
                'post_type' => 'applications',
                'posts_per_page' => 8,
                'post_status' => 'publish',
                'meta_query'     	=> [[ 'key'   => 'is_feature',	    'value' => 'yes', ]],
            ]);
            if ($post_query->have_posts()) :
            while ($post_query->have_posts()) : $post_query->the_post();
            ?>
                <div class="__item col-6 col-md-3 col-lg-3">
                    <div class="item__inner transition ">
                        <figure >
                            <img src="<?php thePostThumbnailUrl(282,190); ?>" alt="<?php theTitle(); ?>">
                        </figure>
                        <p class="--title "><?php theTitle() ?></p>
                    </div>
                </div>
                <div class="__item col-6 col-md-3 col-lg-3">
                    <div class="item__inner transition ">
                        <figure >
                            <img src="<?php thePostThumbnailUrl(282,190); ?>" alt="<?php theTitle(); ?>">
                        </figure>
                        <p class="--title "><?php theTitle() ?></p>
                    </div>
                </div>
                <div class="__item col-6 col-md-3 col-lg-3">
                    <div class="item__inner transition ">
                        <figure >
                            <img src="<?php thePostThumbnailUrl(282,190); ?>" alt="<?php theTitle(); ?>">
                        </figure>
                        <p class="--title "><?php theTitle() ?></p>
                    </div>
                </div>
                <div class="__item col-6 col-md-3 col-lg-3">
                    <div class="item__inner transition ">
                        <figure >
                            <img src="<?php thePostThumbnailUrl(282,190); ?>" alt="<?php theTitle(); ?>">
                        </figure>
                        <p class="--title "><?php theTitle() ?></p>
                    </div>
                </div>
            <?php
            endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>
        <div class="read_more__btn ">
            <a href="" class="transition">
                <?php echo __('Xem thêm','gaumap') ?>
            </a>
        </div>
    </div>

</section>
