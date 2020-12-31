<?php
$post_query = new WP_query();
$post_query->query([
    'post_status' => 'publish',
    'post_type'   => 'page',
    'term_id'     => '21',
]);
global $wp_query;
$wp_query->in_the_loop = true;
while ($post_query->have_posts()) : $post_query->the_post();
    $partners_bg        = getPostMetaImageUrl('partners_bg');
    $partners_title     = getPostMeta('partners_title');
    $partners_subtitle  = getPostMeta('partners_subtitle');
    $partners_slider    = getPostMeta('partners_slider');
?>
    <section class="__partners background_fixed text-center " style="background-image: url('<?php echo $partners_bg?>'); background-repeat: no-repeat!important;">
        <div class="container">
            <div class="top__title">
                <span class="__title"><?php echo $partners_title ?></span>
                <span class="__subtitle"><?php echo $partners_subtitle ?></span>
            </div>
            <div class="row justify-content-center">
                    <?php
                    foreach ($partners_slider as $item){
                        $link= $item['partners_link'];
                        $img_ID= $item['partners_image'];
                        $img_URL= getImageUrlById($img_ID,190,83);
                    ?>
                        <div class="__partner_item col-4  col-md-3 col-lg-2">
                            <div class="--media">
                                <a href="<?php echo $link ?>"><img src="<?php echo $img_URL ?>" alt="<?php echo $link ?>"></a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
            </div>
        </div>

    </section>
<?php
endwhile;
wp_reset_postdata();
?>
