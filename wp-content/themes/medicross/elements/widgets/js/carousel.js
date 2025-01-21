( function( $ ) {
        "use strict";

    function medicross_svg_color2($scope) {
        jQuery($scope).find('.pxl-swiper-slider .pxl-post--icon img').each(function () {
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function (data) {
                var $svg = jQuery(data).find('svg');
                if (imgID) {
                    $svg.attr('id', imgID);
                }
                if (imgClass) {
                    $svg.attr('class', imgClass + ' replaced-svg');
                }
                $svg.removeAttr('xmlns:a');
                if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 24 24');
                }
                $img.replaceWith($svg);
            }, 'xml');
        });
    }

    function pxl_swiper_handler($scope){
        $scope.find('.pxl-swiper-slider').each(function(index, element) {
            var $this = $(this);
            
            var settings = $this.find(".pxl-swiper-container").data().settings;
            var numberOfSlides = $this.find(".pxl-swiper-slide").length;
            var carousel_settings = {
                direction: settings['slide_direction'],
                effect: settings['slide_mode'],
                wrapperClass : 'pxl-swiper-wrapper',
                slideClass: 'pxl-swiper-slide',
                slidesPerView: settings['slides_to_show'],
                slidesPerGroup: settings['slides_to_scroll'],
                slidesPerColumn: settings['slide_percolumn'],
                allowTouchMove:  settings['allow_touch_move'] !== undefined ? settings['allow_touch_move']:true,
                spaceBetween: 0,
                observer: true,
                observeParents: true,
                navigation: {
                    nextEl: $this.find('.pxl-swiper-arrow-next')[0],
                    prevEl: $this.find('.pxl-swiper-arrow-prev')[0],
                },
                pagination : {
                    type: settings['pagination_type'],
                    el: $this.find('.pxl-swiper-dots')[0],
                    clickable : true,
                    modifierClass: 'pxl-swiper-pagination-',
                    bulletClass : 'pxl-swiper-pagination-bullet',
                    renderCustom: function (swiper, element, current, total) {
                        return current + ' of ' + total;
                    }
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
                    1400 : {
                        slidesPerView: settings['slides_to_show_xxl'],
                        slidesPerGroup: settings['slides_to_scroll'],
                    }
                },
                on: {
                    slideChangeTransitionStart : function (swiper){
                        var activeIndex = this.activeIndex;
                        $(this.slides).each(function(index){
                            if(index == activeIndex)
                                $(this).find('.wow').removeClass('pxl-invisible').addClass('animated');
                            else
                                $(this).find('.wow').removeClass('animated').addClass('pxl-invisible');
                        });
                        
                    },

                    slideChange: function (swiper) { 

                        var activeIndex = this.activeIndex; 
                        $(this.slides).each(function(index){
                            if(index == activeIndex)
                                $(this).find('.wow').removeClass('pxl-invisible').addClass('animated');
                            else
                                $(this).find('.wow').removeClass('animated').addClass('pxl-invisible');
                        });

                    },

                    sliderMove: function (swiper) { 

                        var activeIndex = this.activeIndex; 
                        $(this.slides).each(function(index){
                            if(index == activeIndex)
                                $(this).find('.wow').removeClass('pxl-invisible').addClass('animated');
                            else
                                $(this).find('.wow').removeClass('animated').addClass('pxl-invisible');
                        });

                    },

                }
            };


            // if ($('.pxl-slider-carousel1').length > 0) {
            //     carousel_settings.allowTouchMove = true;
            // }


            if(settings['center_slide'] || settings['center_slide'] === 'true'){
                if(settings['loop'] || settings['loop'] === 'true'){
                    carousel_settings['initialSlide'] = Math.floor(numberOfSlides / 2);
                } else {
                    if(carousel_settings['slidesPerView'] > 1){  
                        carousel_settings['initialSlide'] = Math.floor((numberOfSlides - carousel_settings['slidesPerView']) / 2);
                    } else {
                        carousel_settings['initialSlide'] = Math.ceil((numberOfSlides / 2) - 1);
                    }
                }
                
               // carousel_settings['initialSlide']  = 3;
            }

            
            if(settings['center_slide'] || settings['center_slide'] == 'true')
                carousel_settings['centeredSlides'] = true;

            if(settings['loop'] || settings['loop'] === 'true'){
                carousel_settings['loop'] = true;
            }

            if(settings['autoplay'] || settings['autoplay'] === 'true'){
                carousel_settings['autoplay'] = {
                    delay : settings['delay'],
                    disableOnInteraction : settings['pause_on_interaction']
                };
            } else {
                carousel_settings['autoplay'] = false;
            }
            
            // parallax
            if(settings['parallax'] === 'true'){
                carousel_settings['parallax'] = true;
            }

            if(settings['slide_mode'] === 'fade'){
                carousel_settings['fadeEffect'] = {
                    crossFade: true
                };
            }
            
            // Creative Effect
            if(settings['creative-effect'] === 'effect1'){
                carousel_settings['creativeEffect'] = {
                    prev: {
                        opacity: 0,
                    },
                    next: {
                        opacity: 0,
                    },
                };
            }

            // Start Swiper Thumbnail
            if($this.find('.pxl-swiper-thumbs').length > 0) {

                var thumb_settings = $this.find('.pxl-swiper-thumbs').data().settings;

                var thumb_carousel_settings = {
                    effect: 'slide',
                    direction: 'horizontal',
                    spaceBetween: 0,
                    slidesPerView: '4',
                    centeredSlides: false,
                    loop: false,  
                    watchSlidesProgress: true,
                    slideToClickedSlide: true,
                };

                var slide_thumbs = new Swiper($this.find('.pxl-swiper-thumbs')[0], thumb_carousel_settings);
                carousel_settings['thumbs'] = { swiper: slide_thumbs };
            }

            var allSlides = $this.find(".pxl-swiper-slide");
            // End Swiper Thumbnail
           /* $this.find(".pxl-swiper-slide").remove();
            allSlides.each(function(e){ 
                 $this.find('.pxl-swiper-wrapper').append($(this)[0].outerHTML);
                
            });*/

            var swiper = new Swiper($this.find(".pxl-swiper-container")[0], carousel_settings);

            if(settings['autoplay'] === 'true' && settings['pause_on_hover'] === 'true'){
                $( $this.find('.pxl-swiper-container') ).on({
                    mouseenter: function mouseenter() {
                        this.swiper.autoplay.stop();
                    },
                    mouseleave: function mouseleave() {
                        this.swiper.autoplay.start();
                    }
                });
            }

            // Scroll Section Slip
            $(window).scroll(function() {
                let pxl_window_height = $(window).innerHeight();

                let slides = swiper.slides;
                let hPerc = Math.round(100 / slides.length);

                if($('.pxl-testimonial-slip-wrapper').length > 0) {
                    let offset = $('.pxl-testimonial-slip-wrapper')[0].getBoundingClientRect();
                    if (offset.top < 0 && offset.bottom - pxl_window_height > 0) {
                        let perc = Math.round(100 * Math.abs(offset.top) / (offset.height - $(window).height()));
                        if (hPerc > 19) {
                            for (var i = 0; i < slides.length; i++) {
                                if (perc > (hPerc * i) && perc < (hPerc * (i + 1))) {
                                    swiper.slideTo(i, 300);
                                }
                            }
                        }
                    }
                } 
            });

            // Navigation-Carousel
            $('.pxl-navigation-carousel').parents('.elementor-section').addClass('pxl--hide-arrow');
            setTimeout(function() {
                $('.pxl-navigation-carousel .pxl-navigation-arrow-prev').on('click', function () {
                    $(this).parents('.elementor-section').find('.pxl-swiper-arrow.pxl-swiper-arrow-prev').trigger('click');
                });
                $('.pxl-navigation-carousel .pxl-navigation-arrow-next').on('click', function () {
                    $(this).parents('.elementor-section').find('.pxl-swiper-arrow.pxl-swiper-arrow-next').trigger('click');
                });
            }, 300);

            


            $scope.find(".pxl--filter-inner .filter-item").on("click", function(){
                var target = $(this).attr('data-filter-target');
                var $parent = $(this).closest('.pxl-swiper-slider');
                $(this).siblings().removeClass("active");
                $(this).addClass("active");
                $parent.find(".pxl-swiper-slide").remove();
                if(target == "all"){
                    allSlides.each(function(){
                        $this.find('.pxl-swiper-wrapper').append($(this)[0].outerHTML);
                    });
                }else{
                    allSlides.each(function(){
                        if( $(this).is("[data-filter^='"+target+"']") || $(this).is("[data-filter*='"+target+"']")  ) { 
                            $this.find('.pxl-swiper-wrapper').append($(this)[0].outerHTML);
                        }
                    });
                }
                numberOfSlides = $parent.find(".pxl-swiper-slide").length;     
                if(carousel_settings['centeredSlides'] ){
                    if( carousel_settings['loop'] ){
                        carousel_settings['initialSlide'] = Math.floor(numberOfSlides / 2);
                    } else {
                        if( carousel_settings['slidesPerView'] > 1){  
                            carousel_settings['initialSlide'] = Math.ceil((numberOfSlides - carousel_settings['slidesPerView']) / 2);
                        } else {
                            carousel_settings['initialSlide'] = Math.ceil((numberOfSlides / 2) - 1);
                        }
                    }

                }
                swiper.destroy();
                swiper = new Swiper($parent.find(".pxl-swiper-container")[0], carousel_settings);


                $('.pxl-portfolio-carousel2 .pxl-swiper-slide .pxl-post--inner').each(function(){
                 var bg = $(this).css('background-image');
                 bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
                 $('.bgr-change').css('background-image', 'url(' + bg + ')');
                 $(this).hover(function(){
                    var bg = $(this).css('background-image');
                    bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
                    $('.bgr-change').css('background-image', 'url(' + bg + ')');
                    $('.bgr-change').addClass('flicker')
                    setTimeout(() => {
                        $('.bgr-change').removeClass('flicker')
                    }, 600)
                });
             });
            });
        });  
        jQuery($scope).find('.pxl-swiper-slider .pxl-post--icon img').each(function () {
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function (data) {
                var $svg = jQuery(data).find('svg');
                if (imgID) {
                    $svg.attr('id', imgID);
                }
                if (imgClass) {
                    $svg.attr('class', imgClass + ' replaced-svg');
                }
                $svg.removeAttr('xmlns:a');
                if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 24 24');
                }
                $img.replaceWith($svg);
            }, 'xml');
        });
function findCenteredSlides( swiper, $parent  ) {
    var slides = $parent.find( '.swiper-slide-visible' ),
    elOffsetLeft  = $( swiper.$el ).offset().left,
    elOffsetRight = elOffsetLeft + $( swiper.$el ).outerWidth();
    slides.each( function() {
        if ($(this).hasClass('swiper-slide-visible')) {
            var thisSlideOffsetLeft  = $( this ).offset().left - 1,
            thisSlideOffsetRight = $( this ).offset().left + 1 + $( this ).outerWidth(); 

            if ( thisSlideOffsetLeft > elOffsetLeft && thisSlideOffsetRight < elOffsetRight ) {
                $( this ).addClass( 'swiper-slide-active' ).removeClass( 'swiper-slide-uncentered' );
            } else {
                $( this ).removeClass( 'swiper-slide-active' ).addClass( 'swiper-slide-uncentered' );
            } 
        }
    } );
}

};

$( window ).on( 'elementor/frontend/init', function() {

    elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
        medicross_svg_color2($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_post_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_slider_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_team_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );
    
    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_client_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_text_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_image_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_testimonial_slip.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_tab_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_testimonial_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_partner_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_iconbox_carousel.default', function( $scope ) {
        pxl_swiper_handler($scope);
    } );

} );
} )( jQuery );