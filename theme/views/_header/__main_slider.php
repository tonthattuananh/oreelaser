<div class="swiper-container main_slider">
    <div class="swiper-wrapper">
        <?php
        $sliders = getOption('main_slider');
        foreach ($sliders as $slider) {
            $slider_ID =  $slider['slider_image'];
            $slider_URL = getImageUrlById($slider_ID, 1920, 620);
            $slider_link =  $slider['slider_link'];
            ?>
            <div class="swiper-slide">
                <a href="<?php echo  $slider_link ?>">
                    <img src="<?php echo $slider_URL ?>" alt="<?php echo  $slider_link ?>">
                </a>
            </div>
        <?php } ?>

    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
