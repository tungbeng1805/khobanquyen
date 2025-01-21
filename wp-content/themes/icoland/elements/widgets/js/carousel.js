( function( $ ) {

    var pxl_swiper_handler = function( $scope, $ ) {

        var breakpoints = elementorFrontend.config.breakpoints,
        carousel = $scope.find(".pxl-swiper-container");
        if(carousel.length == 0){
            return false;
        }

        /* Thumbs Slider */
        var galleryThumbs = new Swiper('.pxl-swiper-thumbs', {
          spaceBetween: 0,
          slidesPerView: 4,
          freeMode: true,
          watchSlidesProgress: true,
          direction:'horizontal'
      });

        /* Arrow Custom */
        $('.pxl-swiper-arrow-custom').parents('.pxl-swiper-sliders').addClass('pxl--hide-arrow');
        $('.pxl-navigation-carousel').parents('.elementor-section').addClass('pxl--hide-arrow');
        setTimeout(function() {
            $('.pxl-swiper-arrow-custom.pxl-swiper-arrow-next').on('click', function () {
                $(this).parents('.pxl-swiper-sliders').find('.pxl-swiper-arrow-main.pxl-swiper-arrow-next').trigger('click');
            });
            $('.pxl-swiper-arrow-custom.pxl-swiper-arrow-prev').on('click', function () {
                $(this).parents('.pxl-swiper-sliders').find('.pxl-swiper-arrow-main.pxl-swiper-arrow-prev').trigger('click');
            });
        }, 300);

        setTimeout(function() {
            $('.pxl-navigation-carousel .pxl-navigation-arrow-prev').on('click', function () {
                $(this).parents('.elementor-section').find('.pxl-swiper-arrow.pxl-swiper-arrow-prev').trigger('click');
            });
            $('.pxl-navigation-carousel .pxl-navigation-arrow-next').on('click', function () {
                $(this).parents('.elementor-section').find('.pxl-swiper-arrow.pxl-swiper-arrow-next').trigger('click');
            });
        }, 300);

        /* Main Slider */
        var data = carousel.data(), 
        settings = data.settings, 
        carousel_settings = {
            direction: settings['slide_direction'],
            centeredSlides: settings['slide_center'],
            effect: settings['slide_mode'],
            wrapperClass : 'pxl-swiper-wrapper',
            slideClass: 'pxl-swiper-slide',
            slidesPerView: settings['slides_to_show'],
            slidesPerGroup: settings['slides_to_scroll'],
            slidesPerColumn: settings['slide_percolumn'],
            spaceBetween: 0,
            navigation: {
                nextEl: $scope.find(".pxl-swiper-arrow-next"),
                prevEl: $scope.find(".pxl-swiper-arrow-prev"),
            },
            pagination : {
                el: $scope.find(".pxl-swiper-dots"),
                clickable : true,
                modifierClass: 'pxl-swiper-pagination-',
                bulletClass : 'pxl-swiper-pagination-bullet',
                renderCustom: function (swiper, element, current, total) {
                    return current + ' of ' + total;
                },
                type: settings['pagination_type'],
            },
            speed: settings['speed'],
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            breakpoints: {
                0 : {
                    slidesPerView: settings['slides_to_show_xs'],
                    slidesPerGroup: settings['slides_to_scroll'],
                },
                576 : {
                    slidesPerView: settings['slides_to_show_sm'],
                    slidesPerGroup: settings['slides_to_scroll'],
                },
                768 : {
                    slidesPerView: settings['slides_to_show_md'],
                    slidesPerGroup: settings['slides_to_scroll'],
                },
                992 : {
                    slidesPerView: settings['slides_to_show_lg'],
                    slidesPerGroup: settings['slides_to_scroll'],
                },
                1200 : {
                    slidesPerView: settings['slides_to_show'],
                    slidesPerGroup: settings['slides_to_scroll'],
                },
                1600 : {
                    slidesPerView: settings['slides_to_show_xxl'],
                    slidesPerGroup: settings['slides_to_scroll'],
                }
            }
        }; 
            // center
            if(settings['center'] === 'true'){
                carousel_settings['centeredSlides'] = true;
            }

            // effect
            if(settings['slide_mode'] === 'fade'){
                carousel_settings['fadeEffect'] = {
                    crossFade: true
                };
            }

            
            // loop
            if(settings['loop'] === 'true'){
                carousel_settings['loop'] = true;
            }
            // auto play
            if(settings['autoplay'] === 'true'){
                carousel_settings['autoplay'] = {
                    delay : settings['delay'],
                    disableOnInteraction : settings['pause_on_interaction']
                };
            } else {
                carousel_settings['autoplay'] = false;
            }
            
            carousel.each(function(index, element) {

                if($(this).closest('.pxl-swiper-sliders').find('.pxl-swiper-thumbs').length > 0){
                carousel_settings['thumbs'] = { swiper: galleryThumbs };
            }
            var swiper = new Swiper(carousel, carousel_settings);
                var swiper = new Swiper(carousel, carousel_settings);

                if(settings['autoplay'] === 'true' && settings['pause_on_hover'] === 'true'){
                    $(this).on({
                      mouseenter: function mouseenter() {
                        this.swiper.autoplay.stop();
                    },
                    mouseleave: function mouseleave() {
                        this.swiper.autoplay.start();
                    }
                });
                }

                $scope.find(".swiper-filter-wrap .filter-item").on("click", function(){
                    var target = $(this).attr('data-filter-target');
                    var parent = $(this).closest('.pxl-swiper-sliders');
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");

                    if(target == "all"){
                        parent.find("[data-filter]").removeClass("non-swiper-slide").addClass("swiper-slide-filter");
                        swiper.destroy();
                        swiper = new Swiper(carousel, carousel_settings);
                    } else {

                        parent.find(".swiper-slide-filter").not("[data-filter^='"+target+"'], [data-filter*=' "+target+"']").addClass("non-swiper-slide").removeClass("swiper-slide-filter");
                        parent.find("[data-filter^='"+target+"'], [data-filter*=' "+target+"']").removeClass("non-swiper-slide").addClass("swiper-slide-filter");
                        swiper.destroy();
                        swiper = new Swiper(carousel, carousel_settings);
                    }
                });

                $('.swiper-filter-wrap').parents('.pxl-swiper-sliders').addClass('swiper-filter-active');

            });

        };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        // Swipers
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_post_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_client_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_team_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_pricing_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_meta_box_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_image_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_history_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_testimonial_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_text_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_product_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_collection_carousel.default', pxl_swiper_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_slider.default', pxl_swiper_handler );
    } );
} )( jQuery );