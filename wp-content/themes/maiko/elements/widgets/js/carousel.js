( function( $ ) {
    function maiko_svg_color2($scope) {
        "use strict";

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
                // mousewheel: true,
                parallax:true,
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
                    init: function (swiper) {
                      const totalSlides = swiper.slides.length; 
                      const progress = 0; 
                      animateFilterWhileDragging(progress);
                  },
                  slideChangeTransitionStart : function (swiper){
                    var activeIndex = this.activeIndex;
                },

                slideChange: function (swiper) { 

                  const currentIndex = swiper.activeIndex; 
                  const totalSlides = swiper.slides.length;
                  const progress = currentIndex / (totalSlides - 1);

                  animateFilterWhileDragging(progress);
              },

              sliderMove: function (swiper) { 

                var activeIndex = this.activeIndex; 
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
        var loop = $scope.find(".pxl-swiper-thumbs").data("loop");

        var thumb_carousel_settings = {
            effect: 'slide',
            direction: 'horizontal',
            spaceBetween: 11,
            slidesPerView: thumb_settings['slides_to_show'],
            centeredSlides: false,                    
            freeMode: true,
            loop: loop,
            watchSlidesProgress: true,
            slideToClickedSlide: true,
        };  

        var slide_thumbs = new Swiper($this.find('.pxl-swiper-thumbs')[0], thumb_carousel_settings);
        carousel_settings['thumbs'] = { swiper: slide_thumbs };
    }
            // End Swiper Thumbnail

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

                        // Initialize custom Three.js effects if applicable
    if ($scope.find('.pxl-slider-carousel-effect').length > 0) {
        if (window.innerWidth > 767) {
            initializeThreeJsEffects($scope, swiper, settings);
        } 
    }

    if ($scope.find('.pxl-service-carousel').length > 0) {
        maiko_svg_color();
    }

            // Scroll Section Slip
    $(window).scroll(function() {
        pxl_window_height = $(window).innerHeight();

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

                    /* Arrow Custom */
    var section_tab = $('.pxl-pagination-carousel').parents('.elementor-section:not(.elementor-inner-section)').addClass('pxl--hide-arrow');
    var target = section_tab.find('.pxl-swiper-slider .pxl-swiper-dots');

    var target_tab = target.parents('.elementor-section.pxl--hide-arrow').find('.pxl-pagination-carousel');
    target_tab.empty(); 

    var target_clone = target.clone();
    target_tab.append(target_clone);

    target_tab.find('.pxl-swiper-pagination-bullet').each(function(index) {
        var stepText = 'Step ' + (index + 1) +'.'; 
        $(this).text(stepText);
    });

    target_tab.find('.pxl-swiper-pagination-bullet').on('click', function () {
        var $this = $(this);
        var $section = $this.parents('.elementor-section.pxl--hide-arrow');

        $section.find('.pxl-pagination-carousel .pxl-swiper-pagination-bullet').removeClass('swiper-pagination-bullet-active').attr('aria-current', 'false');
        $section.find('.pxl-swiper-slider .pxl-swiper-pagination-bullet').removeClass('swiper-pagination-bullet-active').attr('aria-current', 'false');

        $this.addClass('swiper-pagination-bullet-active').attr('aria-current', 'true');
        var index = $this.index(); 
        $section.find('.pxl-swiper-slider .pxl-swiper-pagination-bullet').eq(index).addClass('swiper-pagination-bullet-active').attr('aria-current', 'true');

        $section.find('.pxl-swiper-slider .pxl-swiper-pagination-bullet').eq(index).trigger('click');
    });
    // 

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

function animateFilterWhileDragging(progress) {
    if (window.innerWidth <= 767) return;
    const filterElements = document.querySelectorAll('.pxl-portfolio-carousel3 .swiper-filter');

    filterElements.forEach((filterElement) => {
        let translateX = progress * -1000;
        let rotateY = progress * -1000;
        let translateZ = 5*progress * -1000;

        gsap.to(filterElement, {
          duration: 0.5,
          x: translateX,
          z: translateZ,
          rotateY: rotateY,
          opacity: 1,
          ease: 'power3.out' 
      });
    });
}



function maiko_svg_color() {
    $('.pxl-service-carousel1 .pxl-post--icon img').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        if (imgURL) {
            setTimeout(function () {
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
            }, 500); 
        }
    });
    setTimeout(function () {
        var svgPaths = $('.pxl-service-carousel1 .pxl-post--icon svg path,.pxl-service-carousel1 .pxl-post--icon svg line,.pxl-service-carousel1 .pxl-post--icon svg circle');
        var svgPaths_load = $('.pxl-service-carousel1 .pxl-post--icon .animated svg path, .pxl-service-carousel1 .pxl-post--icon .animated svg line, .pxl-service-carousel1 .pxl-post--icon .animated svg circle');
        console.log(svgPaths);
        svgPaths.each(function() {
            var totalLength = this.getTotalLength();

            $(this).attr({
                'stroke-dashoffset': totalLength,
                'stroke-dasharray': totalLength,
            });
        });
    }, 500); 

}

function initializeThreeJsEffects($scope, swiper, settings) {
    var postSlider = $scope.find('.pxl-slider-carousel-effect');
    postSlider.each(function () {
        const sliderContainer = $(this);
        var vertex = `
        varying vec2 vUv;
        void main() {
            vUv = uv;
            gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );
        }
        `;

        var fragment = `
        varying vec2 vUv;
        uniform sampler2D currentImage;
        uniform sampler2D nextImage;
        uniform sampler2D disp;
        uniform float dispFactor;
        float intensity = 0.25;
        void main() {
            vec2 uv = vUv;
            vec4 disp = texture2D(disp, uv);
            vec2 distortedPosition = vec2(uv.x + dispFactor * (disp.r * intensity), uv.y);
            vec2 distortedPosition2 = vec2(uv.x - (1.0 - dispFactor) * (disp.r * intensity), uv.y);
            vec4 _currentImage = texture2D(currentImage, distortedPosition);
            vec4 _nextImage = texture2D(nextImage, distortedPosition2);
            vec4 finalTexture = mix(_currentImage, _nextImage, dispFactor);
            gl_FragColor = finalTexture;
        }
        `;

        let scene = new THREE.Scene();
        let imgs = Array.from(sliderContainer.find('.pxl-item--image img'));
        const sliderImages = [];
        let imgWidth = sliderContainer.find('.pxl-item--image img').width();
        let imgHeight = sliderContainer.find('.pxl-item--image img').height();
        let renderWidth = imgWidth * window.devicePixelRatio;
        let renderHeight = imgHeight * window.devicePixelRatio;
        let renderSize = (($(window).height()) / imgWidth);
        function getCanvasSize(renderWidth, renderHeight, renderSize) {
            let multiplier = 0;
            if (window.innerHeight < 767) {
                multiplier = 1.4;
            } else if (window.innerWidth < 991) {
                multiplier = 0.6;
            } else if (window.innerWidth < 1200) {
                multiplier = 0.8;
            } else {
                multiplier = 1;
            }
            let imgCanvasSize = (renderWidth / renderHeight) * renderSize * multiplier;
            return imgCanvasSize;
        }
        let imgCanvasSize = getCanvasSize(renderWidth, renderHeight, renderSize);
        const camera = new THREE.PerspectiveCamera(55, imgCanvasSize, 1, 100);
        camera.position.z = 1;

        let renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setClearColor(0x23272A, 1.0);
        renderer.setSize(renderWidth, renderHeight);
        sliderContainer.append(renderer.domElement);

        let textureLoader = new THREE.TextureLoader();
        textureLoader.crossOrigin = "anonymous";
        imgs.forEach(function (img) {
            let image = textureLoader.load($(img).attr('src'));
            image.magFilter = image.minFilter = THREE.LinearFilter;
            image.anisotropy = renderer.capabilities.getMaxAnisotropy();
            sliderImages.push(image);
        });

        let dispImgElement = sliderContainer.find('.pxl-image-webgl');
        let dispImgSrc = dispImgElement.attr('src');
        let dispImg = textureLoader.load(dispImgSrc);
        dispImg.wrapS = dispImg.wrapT = THREE.RepeatWrapping;

        let activeSlideIndex = 0;
        if (settings['loop'] === 'true') {
            activeSlideIndex = 1;
        }

        let mat = new THREE.ShaderMaterial({
            uniforms: {
                dispFactor: { type: "f", value: 0.0 },
                currentImage: { type: "t", value: sliderImages[activeSlideIndex] },
                nextImage: { type: "t", value: sliderImages[1] },
                disp: { type: "t", value: dispImg },
            },
            vertexShader: vertex,
            fragmentShader: fragment,
            transparent: true,
            opacity: 1.0
        });

        let geometry = new THREE.PlaneBufferGeometry(2.4, 1.16);
        let object = new THREE.Mesh(geometry, mat);
        object.position.set(0, 0, 0);
        scene.add(object);

        $(window).resize(function () {
            imgWidth = sliderContainer.find('.pxl-item--image img').width();
            imgHeight = sliderContainer.find('.pxl-item--image img').height();
            renderWidth = imgWidth * window.devicePixelRatio;
            renderHeight = imgHeight * window.devicePixelRatio;
            renderer.setSize(renderWidth, renderHeight);
            camera.aspect = (renderWidth / renderHeight);
            camera.updateProjectionMatrix();
        });

        let animate = () => {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        };
        animate();

        let index = 0;

        const animateDisplace = () => {
            mat.uniforms.nextImage.value = sliderImages[index];
            mat.uniforms.nextImage.needsUpdate = true;

            TweenLite.to(mat.uniforms.dispFactor, 1, {
                value: 1,
                ease: 'Sine.easeInOut',
                onComplete: () => {
                    mat.uniforms.currentImage.value = sliderImages[index];
                    mat.uniforms.currentImage.needsUpdate = true;
                    mat.uniforms.dispFactor.value = 0.0;
                }
            });
        };

        swiper.on('slideChange', function () {
            index = this.activeIndex;
            animateDisplace();
        });

        swiper.on('slideChangeTransitionStart', function () {
            swiper.allowTouchMove = false;
            postSlider.addClass('pxl-pointerev-none');
        });

        swiper.on('slideChangeTransitionEnd', function () {
            setTimeout(function () {
                swiper.allowTouchMove = true;
                postSlider.removeClass('pxl-pointerev-none');
            }, 0);
        });
    });
}

};

$( window ).on( 'elementor/frontend/init', function() {

    elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
        maiko_svg_color2($scope);
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