<section class="intro__company">
    <div class="container">
        <div class="row">
            <?php
            $getposts = new WP_query(); $getposts->query('post_status=publish&post_type=page&p=21');
            global $wp_query; $wp_query->in_the_loop = true;
            while ($getposts->have_posts()) : $getposts->the_post();
                $intro_company = getPostMeta('intro_company');
                foreach ($intro_company as $intro){
                    $icon_ID = $intro['intro_company_icon'];
                    $icon_URL= getImageUrlById($icon_ID,36,36);
                    $title   = $intro['intro_company_title'];
                    $content = $intro['intro_company_content'];
            ?>
                    <div class="__item col-12 col-md-4 col-lg-4">
                        <div class="item__inner">
                            <div class="__top_title text-center">
                                <img src="<?php echo $icon_URL ?>" alt="<?php echo $title ?>">
                                <p class="--title"><?php echo $title ?></p>
                            </div>
                            <div class="__content">
                                <?php echo $content ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            endwhile; wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
