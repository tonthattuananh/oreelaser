// eslint-disable-next-line no-unused-vars
import config from '@config';
import './vendor/*.js';
import './pages/*.js';
import '@styles/theme';
import '@images/favicon.ico';
import 'airbnb-browser-shims';

// Your code goes here ...
import 'mmenu-js/src/mmenu';
import 'swiper/swiper-bundle';
import 'swiper/swiper-bundle.min'
import Swiper from 'swiper/bundle';
import '@fancyapps/fancybox/dist/jquery.fancybox.min';
import '@fancyapps/fancybox/dist/jquery.fancybox';
import 'aos/dist/aos';
import AOS from 'aos';

$().ready(function(){
        //============================
        // ***** AOS
        //============================
        AOS.init({});
        //============================
        // ***** mmenu
        //============================
        //     $('#mobile_menu').mmenu({
        //         extensions: ['fx-menu-slide', 'position-left'],
        //         searchfield: false,
        //         counters: false,
        //         navbar: {
        //             title: 'MENU',
        //         },
        //     });
        //============================
        // ***** Slider
        //============================
        const swiper_slider= new Swiper('.main_slider', {
                spaceBetween: 0,
                centeredSlides: true,
                autoplay: {
                    delay: 3000,
                },
                pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                },
                navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                },
        });
        //============================
        // ***** product_feature
        //============================
        const swiper_product_feature = new Swiper('.products_feature_slider', {
                spaceBetween: 30,
                slidesPerView: 3,
                autoplay: {
                        delay: 3000,
                },
                breakpoints: {
                        640: {
                                slidesPerView: 2,
                        },
                        768: {
                                slidesPerView: 2,
                        },
                        1024: {
                                slidesPerView: 3,
                        },
                },
                // pagination: {
                //         el: '.swiper-pagination',
                //         clickable: true,
                // },
                // navigation: {
                //         nextEl: '.swiper-button-next',
                //         prevEl: '.swiper-button-prev',
                // },
        });

        //============================
        // ***** __video_intro (popup)
        //============================
        var $videoSrc;
        $('.video-btn').click(function() {
                $videoSrc = $(this).data( "src" );
        });
        console.log($videoSrc);

        // when the modal is opened autoplay it
        $('#myModal').on('shown.bs.modal', function (e) {

        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
                $("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" );
        })

        // stop playing the youtube video when I close the modal
        $('#myModal').on('hide.bs.modal', function (e) {
                // a poor man's stop video
                $("#video").attr('src',$videoSrc);
        })

        //============================
        // ***** __product_value (popup)
        //============================

        //============================
        // ***** fancybox
        //============================
        //     $('[data-fancybox="fancybox-thumb"]').fancybox({
        //         thumbs : {
        //             autoStart : true
        //         }
        //     });
});


