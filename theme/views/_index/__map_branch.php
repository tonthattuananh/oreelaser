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
    $branch_map_title    = getPostMeta('branch_map_title');
    $branch_map_subtitle = getPostMeta('branch_map_subtitle');
    $shortcode           = getPostMeta('branch_map_shortcode');
?>
    <section class="map__branch text-center " >
        <div class="container">
            <div class="top__title">
                <span class="__title"><?php echo $branch_map_title ?></span>
                <span class="__subtitle"><?php echo $branch_map_subtitle ?></span>
            </div>
        </div>
        <div class="map__content">
            <?php echo do_shortcode($shortcode) ?>
        </div>
    </section>
<?php
endwhile;
wp_reset_postdata();
?>
