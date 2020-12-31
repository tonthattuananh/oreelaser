<section class="products__feature">
    <div class="container">
        <div class="swiper-container products_feature_slider">
            <div class="swiper-wrapper">
                <?php
                $post_query = new WP_Query([
                    'post_type' => 'products',
                    'posts_per_page' => 10,
                    'post_status' => 'publish',
                    'meta_query'     	=> [[ 'key'   => 'is_feature',	    'value' => 'yes', ]],
                ]);
                if ($post_query->have_posts()) :
                while ($post_query->have_posts()) : $post_query->the_post();
                ?>
                    <div class="swiper-slide">
                        <div class="__products_slide">
                            <p class="--title"><?php theTitle(); ?></p>
                            <div class="--media text-center ">
                                <a href="#" class="__product_img">
                                    <img src="<?php thePostThumbnailUrl(380,220); ?>" alt="<?php theTitle();?>">
                                </a>
                            </div>
                        </div>
                    </div><!---item_news--->
                <?php
                endwhile;
                endif;
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </div>
        </div>
        <!-- Add Pagination -->
        <!--<div class="swiper-pagination"></div>-->
        <!-- Add Arrows -->
        <!--<div class="swiper-button-next"></div>-->
        <!--<div class="swiper-button-prev"></div>-->
    </div>
</section>
