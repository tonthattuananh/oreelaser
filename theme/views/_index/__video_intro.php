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
$bg_video_intro = getPostMetaImageUrl('show_bg_video_intro');
$title= getPostMeta('title_video_intro');
$link= getPostMeta('link_video_intro');
?>
    <section class="video__intro background_fixed text-center d-flex justify-content-center align-items-center" style="background-image: url('<?php echo $bg_video_intro?>'); background-repeat: no-repeat!important;">
        <div class="container">
            <div class="top__title">
                <span class="__title"><?php echo $title ?></span>
                <button type="button" class="btn video-btn" data-toggle="modal" data-src="<?php echo $link ?>" data-target="#myModal">
                    <i class="far fa-play-circle"></i>
                </button>
            </div>

        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->

<?php
endwhile;
wp_reset_postdata();
?>
