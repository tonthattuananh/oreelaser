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
    $product_value_bg    = getPostMetaImageUrl('product_value_bg');
    $product_value_title = getPostMeta('product_value_title');
?>
    <section class="product__value" style="background-image: url('<?php echo $product_value_bg ?>'); background-repeat: no-repeat!important;">
        <div class="container">
            <div class="top__title text-center">
                <span class="__title"><?php echo $product_value_title ?></span>
            </div>
            <div class="row">
                <div class="col-md-6 __value_title">
                    <ul class="nav nav-tabs tabs-left">
                        <?php
                        $product_value = getPostMeta('product_value');
                        $i= 0;
                        foreach ($product_value as $item) {
                            $title   = $item['item_value_title'];
                            $content = $item['item_value_content'];
                            if ($i== 0) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }

                            ?>
                                <li class="<?php echo $active ?>">
                                    <a class="<?php echo $active ?>" href="#<?php echo sanitize_title($title) ?>" data-toggle="tab"><?php echo $title ?></a>
                                </li>
                            <?php
                            $i++; }
                            ?>
                    </ul>
                </div>
                <div class="col-md-6 __value_content">
                    <!-- Tab panes -->
                    <div class="tab-content h-100">
                        <?php
                        $product_value = getPostMeta('product_value');
                        $i             = 0;
                        foreach ($product_value as $item) {
                            $title   = $item['item_value_title'];
                            $content = $item['item_value_content'];
                            if ($i == 0) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            ?>
                            <div class="tab-pane <?php echo $active ?>" id="<?php echo sanitize_title($title) ?>">
                                <div><?php echo $content ?></div>
                            </div>
                            <?php $i++;
                        } ?>

                    </div>
                </div>
            </div>

        </div>
    </section>
<?php
endwhile;
wp_reset_postdata();
?>
