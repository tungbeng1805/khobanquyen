;(function ($) {

    "use strict";
    
    var pxl_scroll_top;
    var pxl_window_height;
    var pxl_window_width;
    var pxl_scroll_top = $(window).scrollTop();
    var pxl_scroll_status = '';
    var pxl_last_scroll_top = 0;
    $(window).on('load', function () {
        $(".pxl-loader").fadeOut("slow");
        $('.pxl-element-slider').css('opacity', '1');
        $('.pxl-element-slider').css('transition-delay', '300ms');
        pxl_window_width = $(window).width();
        icoland_header_sticky();
        icoland_scroll_to_top();
        icoland_footer_fixed();
        icoland_quantity_icon();
        icoland_login();
        icoland_svg_color();
        //icoland_popover();
        icoland_opacity_sc();
        $('.page-section').each(function(i) {
            if ($(this).position().top <= pxl_scroll_top + 50) {
                $('.pxl-header-elementor-main .pxl-menu-primary > li.page-active').removeClass('page-active');
                $('.pxl-header-elementor-sticky .pxl-nav-menu .pxl-menu-primary > li.page-active').removeClass('page-active');
                $('.pxl-header-elementor-main .pxl-menu-primary > li').eq(i).addClass('page-active');
                $('.pxl-header-elementor-sticky .pxl-nav-menu .pxl-menu-primary > li').eq(i).addClass('page-active');
            }
        });
    });
    $( document ).ready( function() {
        /* For Shop */
        icoland_shop_view_layout();
        icoland_svg_color();
    });
    $(window).on('scroll', function () {
        pxl_scroll_top = $(window).scrollTop();
        pxl_window_height = $(window).height();
        pxl_window_width = $(window).width();
        if (pxl_scroll_top < pxl_last_scroll_top) {
            pxl_scroll_status = 'up';
        } else {
            pxl_scroll_status = 'down';
        }
        pxl_last_scroll_top = pxl_scroll_top;
        icoland_header_sticky();
        icoland_scroll_to_top();
        icoland_footer_fixed();
        $('.page-section').each(function(i) {
            if ($(this).position().top <= pxl_scroll_top + 50) {
                $('.pxl-header-elementor-main .pxl-menu-primary > li.page-active').removeClass('page-active');
                $('.pxl-header-elementor-sticky .pxl-nav-menu .pxl-menu-primary > li.page-active').removeClass('page-active');
                $('.pxl-header-elementor-main .pxl-menu-primary > li').eq(i).addClass('page-active');
                $('.pxl-header-elementor-sticky .pxl-nav-menu .pxl-menu-primary > li').eq(i).addClass('page-active');
            }
        });
    });

    $(document).ready(function () {
        dropdown('#item_category');
        dropdown('#item_collection');
        dropdown('#buy_category');
        togglePasswordVisibility();
        
        dropdown('#items_type');
        icoland_bgr_parallax();
        /* Menu Responsive Dropdown */
        var $icoland_menu = $('.pxl-header-elementor-main');
        $icoland_menu.find('.pxl-menu-primary li').each(function () {
            var $icoland_submenu = $(this).find('> ul.sub-menu');
            if ($icoland_submenu.length == 1) {
                $(this).hover(function () {
                    if ($icoland_submenu.offset().left + $icoland_submenu.width() > $(window).width()) {
                        $icoland_submenu.addClass('pxl-sub-reverse');
                    } else if ($icoland_submenu.offset().left < 0) {
                        $icoland_submenu.addClass('pxl-sub-reverse');
                    }
                }, function () {
                    $icoland_submenu.removeClass('pxl-sub-reverse');
                });
            }
        });

        /* Start Menu Mobile */
        $('.pxl-header-menu li.menu-item-has-children').append('<span class="pxl-menu-toggle"></span>');
        $('.pxl-menu-toggle').on('click', function () {
            if( $(this).hasClass('active')){
                $(this).closest('ul').find('.pxl-menu-toggle.active').toggleClass('active');
                $(this).closest('ul').find('.sub-menu.active').toggleClass('active').slideToggle();    
            }else{
                $(this).closest('ul').find('.pxl-menu-toggle.active').toggleClass('active');
                $(this).closest('ul').find('.sub-menu.active').toggleClass('active').slideToggle();
                $(this).toggleClass('active');
                $(this).parent().find('> .sub-menu').toggleClass('active');
                $(this).parent().find('> .sub-menu').slideToggle();
            }      
        });

        

        $("#pxl-nav-mobile").on('click', function () {
            $(this).toggleClass('active');
            $('.pxl-header-menu').toggleClass('active');
        });

        $(".pxl-menu-close, .pxl-header-menu-backdrop").on('click', function () {
            $(this).parents('.pxl-header-main').find('.pxl-header-menu').removeClass('active');
            $('#pxl-nav-mobile').removeClass('active');
        });
        /* End Menu Mobile */

        /* Elementor Header */
        $('.pxl-type-header-clip > .elementor-container').append('<div class="pxl-header-shape"><span></span></div>');

        /* Scroll To Top */
        $('.pxl-scroll-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 300);
            return false;
        });

        /* Animate Time Delay */
        $('.pxl-grid-masonry').each(function () {
            var eltime = 100;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .pxl-grid-item > .wow').each(function (index, obj) {
                $(this).css('animation-delay', eltime + 'ms');
                if (_elt === index) {
                    eltime = 100;
                    _elt = _elt + elt_inner;
                } else {
                    eltime = eltime + 60;
                }
            });
        });

        $('.pxl-item--text').each(function () {
            var pxl_time = 0;
            var pxl_item_inner = $(this).children().length;
            var _elt = pxl_item_inner - 1;
            $(this).find('> .pxl-text--slide > .wow').each(function (index, obj) {
                $(this).css('transition-delay', pxl_time + 'ms');
                if (_elt === index) {
                    pxl_time = 0;
                    _elt = _elt + pxl_item_inner;
                } else {
                    pxl_time = pxl_time + 80;
                }
            });
        });
           // custom dropdown
    // --------------------------------------------------   
    function dropdown(e){
        var obj = $(e+'.dropdown');
        var btn = obj.find('.btn-selector');
        var dd = obj.find('ul');
        var opt = dd.find('li');
        
        obj.on("mouseenter", function() {
            dd.show();
            $(this).css("z-index",1000);
        }).on("mouseleave", function() {
            dd.hide();
            $(this).css("z-index","auto")
        })
        
        opt.on("click", function() {
            dd.hide();
            var txt = $(this).text();
            opt.removeClass("active");
            $(this).addClass("active");
            btn.text(txt);
        });
    }   
    /* Lightbox Popup */
    $('.btn-video, .pxl-video-popup').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    $('.images-light-box').each(function () {
        $(this).magnificPopup({
            delegate: 'a.light-box',
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade',
        });
    });
    /* Comment Reply */
    $('.comment-reply a').append( '' );

    /* Parallax */
    if($('#pxl-page-title-default').hasClass('pxl--parallax')) {
        $(this).stellar();
    }

    /* Animate Time */
    $('.btn-nina').each(function () {
        var eltime = 0.045;
        var elt_inner = $(this).children().length;
        var _elt = elt_inner - 1;
        $(this).find('> .pxl--btn-text > span').each(function (index, obj) {
            $(this).css('transition-delay', eltime + 's');
            eltime = eltime + 0.045;
        });
    });

    /* Search Popup */
    $(".pxl-search-popup-button").on('click', function () {
            // $('body').addClass('body-overflow');
            $('#pxl-search-popup').addClass('active');
            $('#pxl-search-popup .search-field').focus();
        });
    $(".pxl-item--close").on('click', function () {
        $('body').removeClass('body-overflow');
        $('#pxl-search-popup').removeClass('active');
    });
    /* Cart Popup */
    $(".pxl-cart-popup-button").on('click', function () {
        console.log('asddas');
            //$('body').toggleClass('body-overflow');
            $('.pxl-widget-cart-wrap').toggleClass('open');
            $('.pxl-widget-cart-wrap').focus();
        });
    $(".pxl-cart-popup-button .pxl-item--close").on('click', function () {
            //$('body').removeClass('body-overflow');
            $('.pxl-widget-cart-wrap').removeClass('open');
        });
    $(".pxl-menu-close, .pxl-header-menu-backdrop").on('click', function () {
     $('body').removeClass('body-overflow');
     $('.pxl-widget-cart-wrap').removeClass('open');
 });
    /* Hidden Sidebar */
    $(".pxl-hidden-button").on('click', function () {
        $('body').addClass('body-overflow');
        $('#pxl-hidden-sidebar').addClass('active');
    });
    $("#pxl-hidden-sidebar .pxl-item--overlay, #pxl-hidden-sidebar .pxl-item--close").on('click', function () {
        $('body').removeClass('body-overflow');
        $('#pxl-hidden-sidebar').removeClass('active');
    });

    /* Hover Active Item */
    $('.pxl--widget-hover').each(function () {
        $(this).hover(function () {
            $(this).parents('.elementor-row').find('.pxl--widget-hover').removeClass('pxl--item-active');
            $(this).parents('.elementor-container').find('.pxl--widget-hover').removeClass('pxl--item-active');
            $(this).addClass('pxl--item-active');
        });
    });

    /* Click Active Item */
    $('.pxl--widget-click').each(function () {
        $(this).on('click', function () {
            $(this).parents('.elementor-row').find('.pxl--widget-click').removeClass('pxl--item-active');
            $(this).parents('.elementor-container').find('.pxl--widget-click').removeClass('pxl--item-active');
            $(this).addClass('pxl--item-active');
        });
    });

    /* Hover Button */
    $('.btn-plus-text').hover(function () {
        $(this).find('span').toggle(300);
    });

    /* Nav Logo */
    $(".pxl-nav-button").on('click', function () {
        $(this).toggleClass('active');
        $(this).parent().find('.pxl-nav-wrap').toggle(400);
    });

    /* Button Mask */
    $('.pxl-btn-effect4').append('<span class="pxl-btn-mask"></span>');

    /* Start Icon Bounce */
    var boxEls = $('.el-bounce, .pxl-image-effect1');
    $.each(boxEls, function(boxIndex, boxEl) {
        loopToggleClass(boxEl, 'bounce-active');
    });

    function loopToggleClass(el, toggleClass) {
        el = $(el);
        let counter = 0;
        if (el.hasClass(toggleClass)) {
            waitFor(function () {
                counter++;
                return counter == 2;
            }, function () {
                counter = 0;
                el.removeClass(toggleClass);
                loopToggleClass(el, toggleClass);
            }, 'Deactivate', 1000);
        } else {
            waitFor(function () {
                counter++;
                return counter == 3;
            }, function () {
                counter = 0;
                el.addClass(toggleClass);
                loopToggleClass(el, toggleClass);
            }, 'Activate', 1000);
        }
    }

    function waitFor(condition, callback, message, time) {
        if (message == null || message == '' || typeof message == 'undefined') {
            message = 'Timeout';
        }
        if (time == null || time == '' || typeof time == 'undefined') {
            time = 100;
        }
        var cond = condition();
        if (cond) {
            callback();
        } else {
            setTimeout(function() {
                console.log(message);
                waitFor(condition, callback, message, time);
            }, time);
        }
    }
    /* End Icon Bounce */
    /* Slider - Group align center */
    setTimeout(function(){
        $('.md-align-center').parents('.rs-parallax-wrap').addClass('pxl-group-center');
    }, 300);

    /* Image Effect */
    if($('.pxl-image-tilt').length){
        $('.pxl-image-tilt').each(function () {
            var pxl_maxtilt = $(this).data('maxtilt'),
            pxl_speedtilt = $(this).data('speedtilt');
            $(this).tilt({
                maxTilt: pxl_maxtilt,
                speed: pxl_speedtilt,
            });
        });
    }

    /* Team */
    $('.pxl-item--button').on('click', function () {
        $(this).toggleClass('active');
        $(this).parent().toggleClass('active');
    });

    /* Image Box */
    // $( ".pxl-image-box2 .pxl-item--inner" ).hover(
    //   function() {
    //     $( this ).find('.pxl-item--description').slideToggle(220);
    // }, function() {
    //     $( this ).find('.pxl-item--description').slideToggle(220);
    // }
    // );

    /* Select Theme Style */
    $('.wpcf7-select').each(function(){
        var $this = $(this), numberOfOptions = $(this).children('option').length;

        $this.addClass('pxl-select-hidden'); 
        $this.wrap('<div class="pxl-select"></div>');
        $this.after('<div class="pxl-select-higthlight"></div>');

        var $styledSelect = $this.next('div.pxl-select-higthlight');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'pxl-select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('div.pxl-select-higthlight.active').not(this).each(function(){
                $(this).removeClass('active').next('ul.pxl-select-options').addClass('pxl-select-lists-hide');
            });
            $(this).toggleClass('active');
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
        });

    });
    
});
    //api price eth
    
    //shop display
    function icoland_shop_view_layout(){

        $(document).on('click','.pxl-view-layout .view-icon a', function(e){
            e.preventDefault();
            if(!$(this).parent('li').hasClass('active')){
                $('.pxl-view-layout .view-icon').removeClass('active');
                $(this).parent('li').addClass('active');
                $(this).parents('.pxl-content-area').find('ul.products').removeAttr('class').addClass($(this).attr('data-cls'));
            }
        });
    }
    function icoland_opacity_sc(){

        $(document).ready(function(){
            $(window).scroll(function(){
                $('.el-opacity').css("opacity", 1 - $(window).scrollTop() / 700)
            })
        });
    }

    setTimeout(function(){
        $('.pxl-close, .pxl-close .pxl-icon-close').click(function (e) {
            e.preventDefault();
            $(this).parents('.pxl-widget-cart-wrap').removeClass('open');
            $(this).parents('.pxl-modal').addClass('remove').removeClass('open');
            $(this).parents('#page').find('.site-overlay').removeClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });
    }, 300);
// preloader - start
        // --------------------------------------------------
        // --------------------------------------------------
        // begin prelaoder script
        window.onload = function () {
            if($('#pxl-loadding').length != 0){
                $('body').jpreLoader({
                    splashID: "#jSplash",
            splashFunction: function () {  //passing Splash Screen script to jPreLoader
                var timer = setInterval(function () {
                    splashRotator();
                }, 1);
            }
        }, function () {    //jPreLoader callback function
            clearInterval();
            $(function () {
                var v_url = document.URL;

                if (v_url.indexOf('#') != -1) {
                    var v_hash = v_url.substring(v_url.indexOf("#") + 1);


                    $('html, body').animate({
                        scrollTop: $('#' + v_hash).offset().top - 70
                    }, 200);
                    return false;
                }
            });
        });
            }else{
                $('#jpreOverlay').css('display','none');
                $('#jpreLoader').css('display','none');
            }

        }
        // End of jPreLoader script
        function splashRotator() {
            var cur = $('#jSplash').children('.selected');
            var next = $(cur).next();

            if ($(next).length != 0) {
                $(next).addClass('selected');
            } else {
                $('#jSplash').children('section:first-child').addClass('selected');
                next = $('#jSplash').children('section:first-child');
            }

            $(cur).removeClass('selected').fadeOut(100, function () {
                $(next).fadeIn(100);
            });
        }
        /* Header Sticky */
        function icoland_header_sticky() {
            if($('#pxl-header-elementor').hasClass('is-sticky')) {
                if (pxl_scroll_top > 100) {
                    $('.pxl-header-elementor-sticky.pxl-sticky-stb').addClass('pxl-header-fixed');
                } else {
                    $('.pxl-header-elementor-sticky.pxl-sticky-stb').removeClass('pxl-header-fixed');   
                }

                if (pxl_scroll_status == 'up' && pxl_scroll_top > 100) {
                    $('.pxl-header-elementor-sticky.pxl-sticky-stt').addClass('pxl-header-fixed');
                } else {
                    $('.pxl-header-elementor-sticky.pxl-sticky-stt').removeClass('pxl-header-fixed');
                }
            }

            $('.pxl-header-elementor-sticky').parents('body').addClass('pxl-header-sticky');
        }

        function icoland_svg_color(){
            "use strict";
            jQuery('img.pxl-svg').each(function(){
                var $img = jQuery(this);
                var imgID = $img.attr('id');
                var imgClass = $img.attr('class');
                var imgURL = $img.attr('src');
                
                jQuery.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');
                
                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }
                
                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');
                
                // Check if the viewport is set, else we gonna set it if we can.
                if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    //$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                    $svg.attr('viewBox', '0 0 24 24')
                }
                
                // Replace image with new SVG
                $img.replaceWith($svg);
                
            }, 'xml');
                
            });
        }
        /* Scroll To Top */
        function icoland_scroll_to_top() {
            if (pxl_scroll_top < pxl_window_height) {
                $('.pxl-scroll-top').addClass('pxl-off').removeClass('pxl-on');
            }
            if (pxl_scroll_top > pxl_window_height) {
                $('.pxl-scroll-top').addClass('pxl-on').removeClass('pxl-off');
            }
        }
        /* Scroll To Top */
        function icoland_bgr_parallax() {
            setTimeout(function(){
                jarallax(document.querySelectorAll('.pxl-section-bg-parallax'), {
                    speed: 0.4,
                });
            }, 300);
        }
        /* Footer Fixed */
        function icoland_footer_fixed() {
            setTimeout(function(){
                var h_footer = $('.pxl-footer-fixed #pxl-footer-elementor').outerHeight() - 1;
                $('.pxl-footer-fixed #pxl-main').css('margin-bottom', h_footer + 'px');
            }, 600);
        }
    // login
    function icoland_login() {
        $('#to-login').click(function(){
            $('.pxl-user-register').addClass('hide');
            $('.pxl-user-login').removeClass('hide');
        })
        $('#to-register').click(function(){
            $('.pxl-user-login').addClass('hide');
            $('.pxl-user-register').removeClass('hide');
        })
    }


    function togglePasswordVisibility() {
        var passwordInput = $("#pass");
        var showPasswordIcon = $("#showPasswordIcon");

        $('#showPasswordIcon').on('click', function () {
            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                showPasswordIcon.removeClass("fas fa-eye");
                showPasswordIcon.addClass("fas fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                showPasswordIcon.removeClass("fas fa-eye-slash");
                showPasswordIcon.addClass("fas fa-eye");
            }
        });



        var passwordInput2 = $("#res_pass1");
        var showPasswordIcon2 = $("#showPasswordIcon2");

        $('#showPasswordIcon2').on('click', function () {
            if (passwordInput2.attr("type") === "password") {
                passwordInput2.attr("type", "text");
                showPasswordIcon2.removeClass("fas fa-eye");
                showPasswordIcon2.addClass("fas fa-eye-slash");
            } else {
                passwordInput2.attr("type", "password");
                showPasswordIcon2.removeClass("fas fa-eye-slash");
                showPasswordIcon2.addClass("fas fa-eye");
            }
        });

        var passwordInput3 = $("#res_pass2");
        var showPasswordIcon3 = $("#showPasswordIcon3");

        $('#showPasswordIcon3').on('click', function () {
            if (passwordInput3.attr("type") === "password") {
                passwordInput3.attr("type", "text");
                showPasswordIcon3.removeClass("fas fa-eye");
                showPasswordIcon3.addClass("fas fa-eye-slash");
            } else {
                passwordInput3.attr("type", "password");
                showPasswordIcon3.removeClass("fas fa-eye-slash");
                showPasswordIcon3.addClass("fas fa-eye");
            }
        });


    }
    /* ====================
     WooComerce Quantity
     ====================== */
     function icoland_quantity_icon() {
        $('#pxl-main .quantity').append('<span class="quantity-icon"><i class="quantity-down fas fa-sort-down"></i><i class="quantity-up fas fa-sort-up"></i></span>');
        $('.quantity-up').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepUp();
        });
        $('.quantity-down').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepDown();
        });
        $('.woocommerce-cart-form .actions .button').removeAttr('disabled');
    }

    $('.pxl-related-post .pxl-related-post-inner').slick({
        dots: false,
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        responsive: [
        {
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 1,
            }
        },
        ]
    });
    $('.widget.widget_search input').attr('required', true);
    $('.searchform-wrap input').attr('required', true);



    var gallery_vertical_product = $(".woocommerce-tabs").clone();  
    $(".woocommerce-tabs").remove();
    $(".product .summary").append(gallery_vertical_product);            

    jQuery( document ).on( 'updated_wc_div', function() {
        icoland_quantity_icon();

    } );
    

})(jQuery);

