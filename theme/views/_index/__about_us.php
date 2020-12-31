<?php
$post_query = new WP_query();
$post_query->query([
                    'post_status'=>'publish',
                    'post_type'=> 'page',
                    'term_id'=>'21',
            ]);
global $wp_query;
$wp_query->in_the_loop = true;
while ($post_query->have_posts()) : $post_query->the_post();
    $bg_about_us = getPostMetaImageUrl('show_bg_about_us');
?>
    <section class="about__us background_fixed" style="background-image: url('<?php echo $bg_about_us?>'); background-repeat: no-repeat!important;">
        <div class="container">
            <div class="row">
                <div class="__left col-12 col-md-6">
                    <span class="left_title"><?php theTitle(); ?></span>
                    <div class="left_about_number">
                        <div class="row">
                            <?php
                            $show_about = getPostMeta('show_about');
                            foreach ($show_about as $about) {
                                $number = $about['show_about_number'];
                                $title  = $about['show_about_title'];
                                ?>
                                <div class="col-4">
                                    <p class="--number"><?php echo $number ?></p>
                                    <p class="--title"><?php echo $title ?></p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="left_about_service">
                        <div class="row">
                            <?php
                            $show_service = getPostMeta('show_service');
                            foreach ($show_service as $service) {
                                $icon  = $service['show_service_icon'];
                                $title = $service['show_service_title'];
                                ?>
                                <div class="col-6 d-flex">
                                    <p class="--icon"><i class="<?php echo $icon['class'] ?>"> </i></p>
                                    <p class="--title"><?php echo $title ?></p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="__right col-12 col-md-6">
                    <div class="__content">
                        <?php
                        $id =21;
                        $post = get_post($id);
                        $content_arr = get_extended($post->post_content);
                        echo apply_filters('the_content', $content_arr['main']);
                        ?>
                    </div>
                </div>

            </div>
            <div class="read_more__btn ">
                <a href="<?php the_permalink(); ?>" class="transition">
                    <?php echo __('Xem thêm', 'gaumap') ?>
                </a>
            </div>
        </div>
    </section>
<?php
endwhile;
wp_reset_postdata();
?>
