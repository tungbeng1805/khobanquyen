;(function ($) {

    "use strict";
    
    var pxl_scroll_top;
    var pxl_window_height;
    var pxl_window_width;
    var pxl_scroll_status = '';
    var pxl_last_scroll_top = 0;
    var pxl_post_slip = false;

    $(window).on('load', function () {
        setTimeout(function() {
            $(".pxl-loader").addClass("is-loaded");
        }, 60);
        $('.pxl-swiper-slider, .pxl-header-mobile-elementor').css('opacity', '1');
        $('.pxl-gallery-scroll').parents('body').addClass('body-overflow').addClass('body-visible-sm');
        pxl_window_width = $(window).width();
        pxl_window_height = $(window).height();
        medicross_header_sticky();
        medicross_header_mobile();
        medicross_scroll_to_top();
        medicross_footer_fixed();
        medicross_shop_quantity();
        medicross_submenu_responsive();
        medicross_panel_anchor_toggle();
        medicross_slider_column_offset();
        medicross_height_ct_grid();
        medicross_bgr_parallax();
        medicross_shop_view_layout();
        medicross_menu_divider_move();
        medicross_fit_to_screen();
        medicross_el_parallax();
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
        medicross_header_sticky();
        medicross_scroll_to_top();
        medicross_footer_fixed();
        medicross_ptitle_scroll_opacity();
        if (pxl_scroll_top < 100) {
            $('.elementor > .pin-spacer').removeClass('scroll-top-active');
        }
    });
    

    $(window).on('resize', function () {
        pxl_window_height = $(window).height();
        pxl_window_width = $(window).width();
        medicross_submenu_responsive();
        medicross_height_ct_grid();
        medicross_header_mobile();
        medicross_slider_column_offset();
        medicross_fit_to_screen();
        setTimeout(function() {
            medicross_menu_divider_move();
        }, 500);
    });

    $(document).ready(function () {
        medicross_button_parallax();
        medicross_backtotop_progess_bar();
        medicross_bgr_hv();
        medicross_type_file_upload();
        medicross_zoom_point();
        medicross_scroll_checkp_blog();

        $('.pxl-circle-svg svg').each(function() {
            var linearGradient = $(this).find('.linear-dot1');
            if (linearGradient.length > 0) {
                var linearGradientId = linearGradient.attr('id');
            }
            var linearGradient1 = $(this).find('.linear-dot2');
            if (linearGradient1.length > 0) {
              var linearGradientId1 = linearGradient1.attr('id');
          }
          medicross_circle_svg(this,linearGradientId,linearGradientId1);
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

        $('li.pxl-megamenu').hover(function() {
            $(this).parents('.elementor-section').addClass('section-mega-active')
        }, function() {
            $(this).parents('.elementor-section').removeClass('section-mega-active')
        })
        
        $("#pxl-nav-mobile, .pxl-anchor-mobile-menu").on('click', function () {
            $(this).toggleClass('active');
            $('body').toggleClass('body-overflow');
            $('.pxl-header-menu').toggleClass('active');
        });

        $(".pxl-menu-close, .pxl-header-menu-backdrop, #pxl-header-mobile .pxl-menu-primary a.is-one-page").on('click', function () {
            $(this).parents('.pxl-header-main').find('.pxl-header-menu').removeClass('active');
            $('#pxl-nav-mobile').removeClass('active');
            $('body').toggleClass('body-overflow');
        });
    /* End Menu Mobile */

    /* Menu Vertical */
        $('.pxl-nav-vertical li.menu-item-has-children > a').append('<span class="pxl-arrow-toggle"><i class="flaticon-right-up"></i></span>');
        $('.pxl-nav-vertical li.menu-item-has-children > a').on('click', function () {
            if( $(this).hasClass('active')){
                $(this).next().toggleClass('active').slideToggle(); 
            }else{
                $(this).closest('ul').find('.sub-menu.active').toggleClass('active').slideToggle();
                $(this).closest('ul').find('a.active').toggleClass('active');
                $(this).find('.pxl-menu-toggle.active').toggleClass('active');
                $(this).toggleClass('active');
                $(this).next().toggleClass('active').slideToggle();
            }   
        });

        $(".comments-area .btn-submit").append('<i class="caseicon-comment-solid"></i>');
    /* Mega Menu Max Height */
        var m_h_mega = $('li.pxl-megamenu > .sub-menu > .pxl-mega-menu-elementor').outerHeight();
        var w_h_mega = $(window).height();
        var w_h_mega_css = w_h_mega - 120;
        if(m_h_mega > w_h_mega) {
            $('li.pxl-megamenu > .sub-menu > .pxl-mega-menu-elementor').css('max-height', w_h_mega_css + 'px');
            $('li.pxl-megamenu > .sub-menu > .pxl-mega-menu-elementor').css('overflow-x', 'scroll');
        }
        // Active Mega Menu Hover
        $('li.pxl-megamenu').hover(function(){
            $(this).parents('.elementor-section').addClass('section-mega-active');
        },function(){
            $(this).parents('.elementor-section').removeClass('section-mega-active');
        });
    /* End Mega Menu Max Height */
    /* Search Popup */
        var $search_wrap_init = $("#pxl-search-popup");
        var search_field = $('#pxl-search-popup .search-field');
        var $body = $('body');

        $(".pxl-search-popup-button").on('click', function(e) {
            if (!$search_wrap_init.hasClass('active')) {
                $search_wrap_init.addClass('active');
                setTimeout(function() { search_field.get(0).focus(); }, 500);
            } else if (search_field.val() === '') {
                $search_wrap_init.removeClass('active');
                search_field.get(0).focus();
            }
            e.preventDefault();
            return false;
        });

        $(".pxl-subscribe-popup .pxl-item--overlay, .pxl-subscribe-popup .pxl-item--close").on('click', function (e) {
            $(this).parents('.pxl-subscribe-popup').removeClass('pxl-active');
            e.preventDefault();
            return false;
        });

        $("#pxl-search-popup .pxl-item--overlay, #pxl-search-popup .pxl-item--close").on('click', function (e) {
            $body.addClass('pxl-search-out-anim');
            setTimeout(function () {
                $body.removeClass('pxl-search-out-anim');
            }, 800);
            setTimeout(function () {
                $search_wrap_init.removeClass('active');
            }, 800);
            e.preventDefault();
            return false;
        });

    /* Scroll To Top */
        $('.pxl-scroll-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 1200);
            $(this).parents('.pxl-wapper').find('.elementor > .pin-spacer').addClass('scroll-top-active');
            return false;
        });

    /* Animate Time Delay */

        


        $('.pxl-grid-masonry').each(function () {
            var eltime = 80;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .pxl-grid-item > .wow').each(function (index, obj) {
                $(this).css('animation-delay', eltime + 'ms');
                if (_elt === index) {
                    eltime = 80;
                    _elt = _elt + elt_inner;
                } else {
                    eltime = eltime + 80;
                }
            });
        });

        $('.btn-text-nina').each(function () {
            var eltime = 0.045;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .pxl--btn-text > span').each(function (index, obj) {
                $(this).css('transition-delay', eltime + 's');
                eltime = eltime + 0.045;
            });
        });

        $('.btn-text-nanuk').each(function () {
            var eltime = 0.05;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .pxl--btn-text > span').each(function (index, obj) {
                $(this).css('animation-delay', eltime + 's');
                eltime = eltime + 0.05;
            });
        });

        $('.btn-text-smoke').each(function () {
            var eltime = 0.05;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .pxl--btn-text > span > span > span').each(function (index, obj) {
                $(this).css('--d', eltime + 's');
                eltime = eltime + 0.05;
            });
        });

        $('.btn-text-reverse .pxl-text--front, .btn-text-reverse .pxl-text--back').each(function () {
            var eltime = 0.05;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('.pxl-text--inner > span').each(function (index, obj) {
                $(this).css('transition-delay', eltime + 's');
                eltime = eltime + 0.05;
            });
        });
        
    /* End Animate Time Delay */

        $('.label-text-fillter').on('click', function () {
           $(this).parents('.pxl-grid-filter').addClass('active');
       });
        $('.filter-item').on('click', function () {
           $('.pxl-grid-filter').removeClass('active');
       });


    /* Lightbox Popup */
        $('.pxl-action-popup').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        $('.pxl-gallery-lightbox').each(function () {
            $(this).magnificPopup({
                delegate: 'a.lightbox',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade',
            });
        });

    /* Page Title Parallax */
        if($('#pxl-page-title-default').hasClass('pxl--parallax')) {
            $(this).stellar();
        }

    /* Cart Sidebar Popup */
        $(".pxl-cart-sidebar-button").on('click', function () {
            $('body').addClass('body-overflow');
            $('#pxl-cart-sidebar').addClass('active');
        });
        $("#pxl-cart-sidebar .pxl-popup--overlay, #pxl-cart-sidebar .pxl-item--close").on('click', function () {
            $('body').removeClass('body-overflow');
            $('#pxl-cart-sidebar').removeClass('active');
        });
        $(".pxl-accordion1.style2 .pxl-accordion--content").find("br").remove();
    /* Hover Active Item */
        $('.pxl--widget-hover').each(function () {
            $(this).hover(function () {
                $(this).parents('.elementor-row').find('.pxl--widget-hover').removeClass('pxl--item-active');
                $(this).parents('.elementor-container').find('.pxl--widget-hover').removeClass('pxl--item-active');
                $(this).addClass('pxl--item-active');
            });
        });
        /* Hover Active button */

    /* Start Icon Bounce */
        var boxEls = $('.el-bounce, .pxl-image-effect1, .el-effect-zigzag');
        $.each(boxEls, function(boxIndex, boxEl) {
            loopToggleClass(boxEl, 'active');
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
                    waitFor(condition, callback, message, time);
                }, time);
            }
        }
    /* End Icon Bounce */

    /* Image Effect */
        if($('.pxl-image-tilt').length){
            $('.pxl-image-tilt').parents('.elementor-top-section').addClass('pxl-image-tilt-active');
            $('.pxl-image-tilt').each(function () {
                var pxl_maxtilt = $(this).data('maxtilt'),
                pxl_speedtilt = $(this).data('speedtilt'),
                pxl_perspectivetilt = $(this).data('perspectivetilt');
                VanillaTilt.init(this, {
                    max: pxl_maxtilt,
                    speed: pxl_speedtilt,
                    perspective: pxl_perspectivetilt
                });
            });
        }

    /* Select Theme Style */
        $('.widget.widget_search input').attr('required', true);
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

    /* Nice Select */
        $('.woocommerce-ordering .orderby, #pxl-sidebar-area select, .variations_form.cart .variations select, .pxl-open-table select, .pxl-nice-select').each(function () {
            $(this).niceSelect();
        });

        $('.pxl-post-list .nice-select').each(function () {
            $(this).niceSelect();
        });

    /* Typewriter */
        if($('.pxl-title--typewriter').length) {
            function typewriterOut(elements, callback)
            {
                if (elements.length){
                    elements.eq(0).addClass('is-active');
                    elements.eq(0).delay( 3000 );
                    elements.eq(0).removeClass('is-active');
                    typewriterOut(elements.slice(1), callback);
                }
                else {
                    callback();
                }
            }

            function typewriterIn(elements, callback)
            {
                if (elements.length){
                    elements.eq(0).addClass('is-active');
                    elements.eq(0).delay( 3000 ).slideDown(3000, function(){
                        elements.eq(0).removeClass('is-active');
                        typewriterIn(elements.slice(1), callback);
                    });
                }
                else {
                    callback();
                }
            }

            function typewriterInfinite(){
                typewriterOut($('.pxl-title--typewriter .pxl-item--text'), function(){ 
                    typewriterIn($('.pxl-title--typewriter .pxl-item--text'), function(){
                        typewriterInfinite();
                    });
                });
            }
            $(function(){
                typewriterInfinite();
            });
        }
    /* End Typewriter */

    /* Section Particles */      
        setTimeout(function() {
            $(".pxl-row-particles").each(function() {
                particlesJS($(this).attr('id'), {
                  "particles": {
                    "number": {
                        "value": $(this).data('number'),
                    },
                    "color": {
                        "value": $(this).data('color')
                    },
                    "shape": {
                        "type": "circle",
                    },
                    "size": {
                        "value": $(this).data('size'),
                        "random": $(this).data('size-random'),
                    },
                    "line_linked": {
                        "enable": false,
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
                        "direction": $(this).data('move-direction'),
                        "random": true,
                        "out_mode": "out",
                    }
                },
                "retina_detect": true
            });
            });
        }, 400);



    /* Get checked input - Mailchimpp */
        $('.mc4wp-form input:checkbox').change(function(){
            if($(this).is(":checked")) {
                $('.mc4wp-form').addClass("pxl-input-checked");
            } else {
                $('.mc4wp-form').removeClass("pxl-input-checked");
            }
        });

    /* Scroll to content */
        $('.pxl-link-to-section .btn').on('click', function(e) {
            var id_scroll = $(this).attr('href');
            var offsetScroll = $('.pxl-header-elementor-sticky').outerHeight();
            e.preventDefault();
            $("html, body").animate({ scrollTop: $(id_scroll).offset().top - offsetScroll }, 600);
        });

        // Hover Item Active
        $( ".pxl-post-modern1 .pxl-post--content .pxl-post--item" )
        .on( "mouseenter", function() {
            $(this).addClass("active");          
            $(".pxl-post-modern1 .pxl-post--images .pxl-post--featured").removeClass('active');       
            var selected_item = $(this).find(".pxl-content--inner").attr("data-image");
            $(selected_item).addClass('active').removeClass('non-active');
        } )
        .on( "mouseleave", function() {
            $(".pxl-post-modern1 .pxl-post--content .pxl-post--item").removeClass('active');
            $(".pxl-post-modern1 .pxl-post--images .pxl-post--featured").removeClass('non-active');
            var selected_item = $(this).find(".pxl-content--inner").attr("data-image");
            $(selected_item).removeClass('active').addClass('non-active');
        } 
        );

        // Hover Overlay Effect
        $('.pxl-overlay-shake').mousemove(function(event){ 
            var offset = $(this).offset();
            var W = $(this).outerWidth();
            var X = (event.pageX - offset.left);
            var Y = (event.pageY - offset.top);
            $(this).find('.pxl-overlay--color').css({
                'top' : + Y + 'px',
                'left' : + X + 'px'
            });
        });

        //Some Widget Default
        //$('.widget .cat-item a, .widget_archive li a').append('<span class="pxl-item--divider"></span>');

    /* Social Button Click */
        $('.pxl-social--button').on('click', function () {
            $(this).toggleClass('active');
        });
        $(document).on('click', function (e) {
            if (e.target.className == 'pxl-social--button active')
                $('.pxl-social--button').removeClass('active');
        });

        // Header Home 2
        $('#home-2-header').append('<span class="pxl-header-divider1"></span><span class="pxl-header-divider2"></span><span class="pxl-header-divider3"></span><span class="pxl-header-divider4"></span>');
        $('#home-2-header-sticky').append('<span class="pxl-header-divider2"></span><span class="pxl-header-divider4"></span>');

    });

jQuery(document).ajaxComplete(function(event, xhr, settings){
    medicross_shop_quantity();
    medicross_height_ct_grid();
    medicross_bgr_hv();
});

jQuery( document ).on( 'updated_wc_div', function() {
    medicross_shop_quantity();
} );

/* Header Sticky */
function medicross_header_sticky() {
    if($('#pxl-header-elementor').hasClass('is-sticky')) {
        if (pxl_scroll_top > 100) {
            $('.pxl-header-elementor-sticky.pxl-sticky-stb').addClass('pxl-header-fixed');
            $('#pxl-header-mobile').addClass('pxl-header-mobile-fixed');
        } else {
            $('.pxl-header-elementor-sticky.pxl-sticky-stb').removeClass('pxl-header-fixed');
            $('#pxl-header-mobile').removeClass('pxl-header-mobile-fixed');
        }

        if (pxl_scroll_status == 'up' && pxl_scroll_top > 100) {
            $('.pxl-header-elementor-sticky.pxl-sticky-stt').addClass('pxl-header-fixed');
        } else {
            $('.pxl-header-elementor-sticky.pxl-sticky-stt').removeClass('pxl-header-fixed');
        }
    }

    $('.pxl-header-elementor-sticky').parents('body').addClass('pxl-header-sticky');
}

/* Header Mobile */
function medicross_header_mobile() {
    var h_header_mobile = $('#pxl-header-elementor').outerHeight();
    if(pxl_window_width < 1199) {
        $('#pxl-header-elementor').css('min-height', h_header_mobile + 'px');
    }
}

/* Scroll To Top */
function medicross_scroll_to_top() {
    if (pxl_scroll_top < pxl_window_height) {
        $('.pxl-scroll-top').addClass('pxl-off').removeClass('pxl-on');
    }
    if (pxl_scroll_top > pxl_window_height) {
        $('.pxl-scroll-top').addClass('pxl-on').removeClass('pxl-off');
    }
}

/* Footer Fixed */
function medicross_footer_fixed() {
    setTimeout(function(){
        var h_footer = $('.pxl-footer-fixed #pxl-footer-elementor').outerHeight() - 1;
        $('.pxl-footer-fixed #pxl-main').css('margin-bottom', h_footer + 'px');
    }, 600);
}

/* WooComerce Quantity */
function medicross_shop_quantity() {
    "use strict";
    $('#pxl-wapper .quantity').append('<span class="quantity-icon quantity-down pxl-icon--minus"></span><span class="quantity-icon quantity-up pxl-icon--plus"></span>');
    $('.quantity-up').on('click', function () {
        $(this).parents('.quantity').find('input[type="number"]').get(0).stepUp();
        $(this).parents('.woocommerce-cart-form').find('.actions .button').removeAttr('disabled');
    });
    $('.quantity-down').on('click', function () {
        $(this).parents('.quantity').find('input[type="number"]').get(0).stepDown();
        $(this).parents('.woocommerce-cart-form').find('.actions .button').removeAttr('disabled');
    });
    $('.quantity-icon').on('click', function () {
        var quantity_number = $(this).parents('.quantity').find('input[type="number"]').val();
        var add_to_cart_button = $(this).parents( ".product, .woocommerce-product-inner" ).find(".add_to_cart_button");
        add_to_cart_button.attr('data-quantity', quantity_number);
        add_to_cart_button.attr("href", "?add-to-cart=" + add_to_cart_button.attr("data-product_id") + "&quantity=" + quantity_number);
    });
    $('.woocommerce-cart-form .actions .button').removeAttr('disabled');
}

/* Menu Responsive Dropdown */
function medicross_submenu_responsive() {
    var $medicross_menu = $('.pxl-header-elementor-main, .pxl-header-elementor-sticky');
    $medicross_menu.find('.pxl-menu-primary li').each(function () {
        var $medicross_submenu = $(this).find('> ul.sub-menu');
        if ($medicross_submenu.length == 1) {
            if ( ($medicross_submenu.offset().left + $medicross_submenu.width() + 0 ) > $(window).width()) {
                $medicross_submenu.addClass('pxl-sub-reverse');
            }
        }
    });
}

function medicross_panel_anchor_toggle(){
    'use strict';
    $(document).on('click','.pxl-anchor-button',function(e){
        e.preventDefault();
        e.stopPropagation();
        var target = $(this).attr('data-target');
        $(target).toggleClass('active');
        $('body').addClass('body-overflow');
        $('.pxl-popup--conent .wow').addClass('animated').removeClass('aniOut');
        $('.pxl-popup--conent .fadeInPopup').removeClass('aniOut');
        if($(target).find('.pxl-search-form').length > 0){
            setTimeout(function(){
                $(target).find('.pxl-search-form .pxl-search-field').focus();
            },1000);
        }
    });

    $(document).ready(function() {
        $('.pxl-post-taxonomy .pxl-count').each(function() {
            var content = $(this).html();
        if (content) { // Ensure content is not null or undefined
            var newContent = content.replace('(', '');
            var newContent2 = newContent.replace(')', '');
            $(this).html(newContent2);
        }
    });
    });


    $('.pxl-anchor-button').each(function () {
        var t_target = $(this).attr('data-target');
        var t_delay = $(this).attr('data-delay-hover');
        $(t_target).find('.pxl-popup--conent').css('transition-delay', t_delay + 'ms');
        $(t_target).find('.pxl-popup--overlay').css('transition-delay', t_delay + 'ms');
    });

    $(".pxl-hidden-panel-popup .pxl-popup--overlay, .pxl-hidden-panel-popup .pxl-close-popup").on('click', function () {
        $('body').removeClass('body-overflow');
        $('.pxl-hidden-panel-popup').removeClass('active');
        $('.pxl-popup--conent .wow').addClass('aniOut').removeClass('animated');
        $('.pxl-popup--conent .fadeInPopup').addClass('aniOut');
    });





    $(".pxl-icon-box6 .btn-show-more").on('click', function () {
        $(this).parents('.pxl-icon-box6').addClass('active');
        $(this).parents('.pxl-icon-box6').find('.content-2').addClass('active');
    });


    $(".pxl-popup--close").on('click', function () {
        $('body').removeClass('body-overflow');
        $(this).parent().removeClass('active');
    });
    $(".pxl-close-popup").on('click', function () {
        $('body').removeClass('body-overflow');
        $('.pxl-page-popup').removeClass('active');
    });
}

/* Page Title Scroll Opacity */
function medicross_ptitle_scroll_opacity() {
    var divs = $('#pxl-page-title-elementor.pxl-scroll-opacity .elementor-widget'),
    limit = $('#pxl-page-title-elementor.pxl-scroll-opacity').outerHeight();
    if (pxl_scroll_top <= limit) {
        divs.css({ 'opacity' : (1 - pxl_scroll_top/limit)});
    }
}

/* Slider Column Offset */
function medicross_slider_column_offset() {
    var content_w = ($('#pxl-main').width() - 1200) / 2;
    if (pxl_window_width > 1200) {
        $('.pxl-slider2 .pxl-item--left').css('padding-left', content_w + 'px');
    }
}

/* Preloader Default */
$.fn.extend({
    jQueryImagesLoaded: function () {
      var $imgs = this.find('img[src!=""]')

      if (!$imgs.length) {
        return $.Deferred()
        .resolve()
        .promise()
    }

    var dfds = []

    $imgs.each(function () {
        var dfd = $.Deferred()
        dfds.push(dfd)
        var img = new Image()
        img.onload = function () {
            dfd.resolve()
        }
        img.onerror = function () {
            dfd.resolve()
        }
        img.src = this.src
    })

    return $.when.apply($, dfds)
}
})


function medicross_circle_svg(element, linearGradientId, linearGradientId1) {
    var activeWidth = window.innerWidth || document.documentElement.clientWidth;
    if (activeWidth <= 1200) {
        return;
    }
    var svgEl = Snap(element);
    if (!svgEl) {
        return;
    }
    var size = 4;
    var filter = svgEl.filter(Snap.filter.shadow(0, 4, 30, 'rgba(0, 255, 255, 0.6)')).addClass('filter1');
    var filter1 = svgEl.filter(Snap.filter.shadow(0, 4, 30, 'rgba(0, 255, 255, 0.1)')).addClass('filter2');
    var circle1 = svgEl.circle(0, 0, size * 1);
    var linearGradient = svgEl.select('.pxl-circle-svg svg .' + linearGradientId);

    circle1.attr({ id: 'circle1', class: 'dot', fill: 'url(#' + linearGradientId + ')' });
    circle1.attr({ filter: filter });

    var circle2 = svgEl.circle(0, 0, size * 1);
    circle2.attr({ id: 'circle2', class: 'dot', fill: 'url(#' + linearGradientId1 + ')' });
    circle2.attr({ filter: filter1 });

    var dotEl1 = svgEl.select('#circle1');
    var dotEl2 = svgEl.select('#circle2');

    var motionPath1 = svgEl.select('path').getTotalLength();
    var motionPath2 = svgEl.select('path').getTotalLength();

    var motionPath1Partial = motionPath1 * 0.7;
    var motionPath2Partial = motionPath2 * 0.7;

    dotEl1.transform('t0,0');
    dotEl2.transform('t0,0');

    var carouselInnerEl = $(".pxl-carousel-inner,.pxl-swiper-arrow");
    var animation1, animation2;
    var isHovered = false;

    function animateDot1(forward) {
        var fromVal, toVal;
        if (forward) {
            fromVal = 0;
            toVal = motionPath1;
        } else {
            fromVal = motionPath2;
            toVal = 0;
        }

        animation1 = Snap.animate(fromVal, toVal, function (val) {
            var point = svgEl.select("path").getPointAtLength(val);
            dotEl1.attr({ cx: point.x, cy: point.y });
        }, 15000, function () {
            if (!isHovered) {
                dotEl1.transform('t0,0');
                animateDot1(true);
            }
        });
    }

    function animateDot2(forward) {
        var fromVal, toVal;
        if (forward) {
            fromVal = motionPath1;
            toVal = 0;
        } else {
            fromVal = 0;
            toVal = motionPath2;
        }

        animation2 = Snap.animate(fromVal, toVal, function (val) {
            var point = svgEl.select("path").getPointAtLength(motionPath2 - val);
            dotEl2.attr({ cx: point.x, cy: point.y });
        }, 15000, function () {
            if (!isHovered) {
                dotEl2.transform('t0,0');
                animateDot2(false);
            }
        });
    }

// carouselInnerEl.on("mouseenter", function () {
//     isHovered = true;
//     if (animation1) {
//       animation1.pause();
//   }
//   if (animation2) {
//       animation2.pause();
//   }
// });

// carouselInnerEl.on("mouseleave", function () {
//     isHovered = false;
//     if (animation1) {
//       animation1.stop();
//   }
//   if (animation2) {
//       animation2.stop();
//   }
//   dotEl1.transform('t0,0');
//   dotEl2.transform('t0,0');
//   animateDot1(true);
//   animateDot2(false);
// });

    animateDot1(true);
    animateDot2(false);
}


/* Button Parallax */
function medicross_button_parallax() {
    $('.btn-text-parallax, .pxl-blog-style2, .pxl-hover-parallax').on('mouseenter', function() {
        $(this).addClass('hovered');
    });

    $('.btn-text-parallax, .pxl-blog-style2, .pxl-hover-parallax').on('mouseleave', function() { 
        $(this).removeClass('hovered');
    });

    $('.btn-text-parallax').on('mousemove', function(e) {
        const bounds = this.getBoundingClientRect();
        const centerX = bounds.left + bounds.width / 2;
        const centerY = bounds.top + bounds.height;
        const deltaX = Math.floor((centerX - e.clientX)) * 0.222;
        const deltaY = Math.floor((centerY - e.clientY)) * 0.333;
        $(this).find('.pxl--btn-text').css({
            transform: 'translate3d('+ deltaX * 0.32 +'px, '+ deltaY * 0.32 +'px, 0px)'
        });
    });

    $('.pxl-blog-style2 .pxl-post--featured, .pxl-hover-parallax').on('mousemove', function(e) {
        const bounds = this.getBoundingClientRect();
        const centerX = bounds.left + bounds.width / 2;
        const centerY = bounds.top + bounds.height;
        const deltaX = Math.floor((centerX - e.clientX)) * 0.222;
        const deltaY = Math.floor((centerY - e.clientY)) * 0.333;
        $(this).find('.pxl-item-parallax, .pxl-post--button').css({
            transform: 'translate3d('+ deltaX * 0.32 +'px, '+ deltaY * 0.32 +'px, 0px)'
        });
    });
}
function medicross_bgr_parallax() {
    setTimeout(function(){
        jarallax(document.querySelectorAll('.pxl-section-bg-parallax'), {
            speed: 0.2,
        });
    }, 300);
}

function medicross_el_parallax() {
    $('.el-parallax-wrap').on({
        mouseenter: function() {
            const $this = $(this);
            $this.addClass('hovered');
            $this.find('.el-parallax-item').css({
                transition: 'none'
            });
        },
        mouseleave: function() {
            const $this = $(this);
            $this.removeClass('hovered');
            $this.find('.el-parallax-item').css({
                transition: 'transform 0.5s ease',
                transform: 'translate3d(0px, 0px, 0px)'
            });
        },
        mousemove: function(e) {
            const $this = $(this);
            const bounds = this.getBoundingClientRect();
            const centerX = bounds.left + bounds.width / 2;
            const centerY = bounds.top + bounds.height / 2;
            const deltaX = (centerX - e.clientX) * 0.07104;
            const deltaY = (centerY - e.clientY) * 0.10656; 
            
            requestAnimationFrame(() => {
                $this.find('.el-parallax-item').css({
                    transform: `translate3d(${deltaX}px, ${deltaY}px, 0px)`
                });
            });
        }
    });
}

function medicross_bgr_hv() {
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
}
/* Menu Divider Move */
function medicross_menu_divider_move() {
    $('.pxl-nav-menu1.fr-style-box, .pxl-nav-menu1.fr-style-box2').each(function () {
        var current = $(this).find('.pxl-menu-primary > .current-menu-item, .pxl-menu-primary > .current-menu-parent, .pxl-menu-primary > .current-menu-ancestor');
        if(current.length > 0) {
            var marker = $(this).find('.pxl-divider-move');
            marker.css({
                left: current.position().left,
                width: current.outerWidth(),
                display: "block"
            });
            marker.addClass('active');
            current.addClass('pxl-shape-active');
            if (Modernizr.csstransitions) {
                $(this).find('.pxl-menu-primary > li').mouseover(function () {
                    var self = $(this),
                    offsetLeft = self.position().left,
                    width = self.outerWidth() || current.outerWidth(),
                    left = offsetLeft == 0 ? 0 : offsetLeft || current.position().left;
                    marker.css({
                        left: left,
                        width: width,
                    });
                    marker.addClass('active');
                    current.removeClass('pxl-shape-active');
                });
                $(this).find('.pxl-menu-primary').mouseleave(function () {
                    marker.css({
                        left: current.position().left,
                        width: current.outerWidth()
                    });
                    current.addClass('pxl-shape-active');
                });
            }
        } else {
            var marker = $(this).find('.pxl-divider-move');
            var current = $(this).find('.pxl-menu-primary > li:nth-child(1)');
            marker.css({
                left: current.position().left,
                width: current.outerWidth(),
                display: "block"
            });
            if (Modernizr.csstransitions) {
                $(this).find('.pxl-menu-primary > li').mouseover(function () {
                    var self = $(this),
                    offsetLeft = self.position().left,
                    width = self.outerWidth() || current.outerWidth(),
                    left = offsetLeft == 0 ? 0 : offsetLeft || current.position().left;
                    marker.css({
                        left: left,
                        width: width,
                    });
                    marker.addClass('active');
                });
                $(this).find('.pxl-menu-primary').mouseleave(function () {
                    marker.css({
                        left: current.position().left,
                        width: current.outerWidth()
                    });
                    marker.removeClass('active');
                });
            }
        }
    });
}

/* Back To Top Progress Bar */
function medicross_backtotop_progess_bar() {
    if($('.pxl-scroll-top').length > 0){
        var progressPath = document.querySelector('.pxl-scroll-top path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';      
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);   
        var offset = 50;
        var duration = 550;
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > offset) {
                $('.pxl-scroll-top').addClass('active-progress');
            } else {
                $('.pxl-scroll-top').removeClass('active-progress');
            }
        });
    }
}

/* Custom Type File Upload*/
function medicross_type_file_upload() {

    var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
    isIE = /msie/i.test( navigator.userAgent );

    $.fn.pxl_custom_type_file = function() {

        return this.each(function() {

            var $file = $(this).addClass('pxl-file-upload-hidden'),
            $wrap = $('<div class="pxl-file-upload-wrapper">'),
            $button = $('<button type="button" class="pxl-file-upload-button">Choose File</button>'),
            $input = $('<input type="text" class="pxl-file-upload-input" placeholder="No File Choose" />'),
            $label = $('<label class="pxl-file-upload-button" for="'+ $file[0].id +'">Choose File</label>');
            $file.css({
                position: 'absolute',
                opacity: '0',
                visibility: 'hidden'
            });

            $wrap.insertAfter( $file )
            .append( $file, $input, ( isIE ? $label : $button ) );

            $file.attr('tabIndex', -1);
            $button.attr('tabIndex', -1);

            $button.click(function () {
                $file.focus().click();
            });

            $file.change(function() {

                var files = [], fileArr, filename;

                if ( multipleSupport ) {
                    fileArr = $file[0].files;
                    for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                        files.push( fileArr[i].name );
                    }
                    filename = files.join(', ');
                } else {
                    filename = $file.val().split('\\').pop();
                }

                $input.val( filename )
                .attr('title', filename)
                .focus();
            });

            $input.on({
                blur: function() { $file.trigger('blur'); },
                keydown: function( e ) {
                    if ( e.which === 13 ) {
                        if ( !isIE ) { 
                            $file.trigger('click'); 
                        }
                    } else if ( e.which === 8 || e.which === 46 ) {
                        $file.replaceWith( $file = $file.clone( true ) );
                        $file.trigger('change');
                        $input.val('');
                    } else if ( e.which === 9 ){
                        return;
                    } else {
                        return false;
                    }
                }
            });

        });

    };
    $('.wpcf7-file[type=file]').pxl_custom_type_file();
}


    //divider blog
function medicross_scroll_checkp_blog($scope){
    $('.pxl-icon-list.style-5,.pxl-icon-box7').each(function () {
        var wcont1 = $(this);


        function checkScrollPosition() {
            var pxl_scroll_top = $(window).scrollTop(),
            viewportBottom = pxl_scroll_top + $(window).height(),
            elementTop = wcont1.offset().top,
            elementBottom = elementTop + wcont1.outerHeight();

            if (elementTop < viewportBottom && elementBottom > pxl_scroll_top) {
                wcont1.addClass('animated');
            }
        }

        checkScrollPosition();

        $(window).on('scroll', function () {
            checkScrollPosition();
        });

    });
}

 //Shop View Grid/List
function medicross_shop_view_layout(){

    $(document).on('click','.pxl-view-layout .view-icon a', function(e){
        e.preventDefault();
        if(!$(this).parent('li').hasClass('active')){
            $('.pxl-view-layout .view-icon').removeClass('active');
            $(this).parent('li').addClass('active');
            $(this).parents('.pxl-content-area').find('ul.products').removeAttr('class').addClass($(this).attr('data-cls'));
        }
    });
}

function medicross_height_ct_grid($scope){
    $('.pxl-portfolio-grid-layout1 .pxl-grid-item,.pxl-portfolio-carousel2 .pxl-swiper-slide').each(function () {
        var elementHeight = $(this).find(".pxl-post-content-hide").height();
        $(this).find(".pxl-post-content-hide").css("margin-bottom",  "-"+elementHeight + "px");     
    });

    $('.pxl-icon-box7').each(function () {
        var elementHeight2 = $(this).find(".pxl-item--description").height();
        $(this).find(".pxl-item--description").css("margin-bottom",  "-"+elementHeight2 + "px");     
    });
}
    // Zoom Point
function medicross_zoom_point() {
    $(".pxl-zoom-point").each(function () {

        let scaleOffset = $(this).data('offset');
        let scaleAmount = $(this).data('scale-mount');

        function scrollZoom() {
            const images = document.querySelectorAll("[data-scroll-zoom]");
            let scrollPosY = 0;
            scaleAmount = scaleAmount / 100;

            const observerConfig = {
                rootMargin: "0% 0% 0% 0%",
                threshold: 0
            };

            images.forEach(image => {
                let isVisible = false;
                const observer = new IntersectionObserver((elements, self) => {
                    elements.forEach(element => {
                        isVisible = element.isIntersecting;
                    });
                }, observerConfig);

                observer.observe(image);

                image.style.transform = `scale(${1 + scaleAmount * percentageSeen(image)})`;

                window.addEventListener("scroll", () => {
                    if (isVisible) {
                        scrollPosY = window.pageYOffset;
                        image.style.transform = `scale(${1 +
                        scaleAmount * percentageSeen(image)})`;
                    }
                });
            });

            function percentageSeen(element) {
                const parent = element.parentNode;
                const viewportHeight = window.innerHeight;
                const scrollY = window.scrollY;
                const elPosY = parent.getBoundingClientRect().top + scrollY + scaleOffset;
                const borderHeight = parseFloat(getComputedStyle(parent).getPropertyValue('border-bottom-width')) + parseFloat(getComputedStyle(element).getPropertyValue('border-top-width'));
                const elHeight = parent.offsetHeight + borderHeight;

                if (elPosY > scrollY + viewportHeight) {
                    return 0;
                } else if (elPosY + elHeight < scrollY) {
                    return 100;
                } else {
                    const distance = scrollY + viewportHeight - elPosY;
                    let percentage = distance / ((viewportHeight + elHeight) / 100);
                    percentage = Math.round(percentage);

                    return percentage;
                }
            }
        }

        scrollZoom();

    });
}

$(document).ready(function(){
  $(".btn-svg").on("mouseenter", function(){
    $(this).addClass("active"); 
}).on("mouseleave", function(){
    $(this).removeClass("active"); 
});
});
$(document).ready(function(){
    var svgPaths = $('.pxl-icon-list.style-5 svg path, .pxl-icon-list.style-5 svg line, .pxl-icon-list.style-5 svg circle,.pxl-icon-box7 .pxl-item--icon svg path,.pxl-icon-box7 .pxl-item--icon svg line,.pxl-icon-box7 .pxl-item--icon svg rect,.pxl-icon-box7 .pxl-item--icon svg circle');
    var svgPaths_load = $('.pxl-icon-list.style-5 .animated svg path, .pxl-icon-list.style-5 .animated svg line, .pxl-icon-list.style-5 .animated svg circle');

    svgPaths.each(function() {
        var totalLength = this.getTotalLength();

        $(this).attr({
            'stroke-dashoffset': totalLength,
            'stroke-dasharray': totalLength,
        });
    });
});



    // Fit to Screen
function medicross_fit_to_screen() {
    $('.pxl-gallery-scroll.h-fit-to-screen').each(function () {
        var h_adminbar = 0;
        var h_section_header = 0;
        var h_section_footer = 0;
        if ($('#wpadminbar').length == 1) {
            h_adminbar = $('#wpadminbar').outerHeight();
        }
        if ($('#pxl-header-elementor').length == 1) {
            h_section_header = $('#pxl-header-elementor').outerHeight();
        }
        if ($('#pxl-footer-elementor').length == 1) {
            h_section_footer = $('#pxl-footer-elementor').outerHeight();
        }
        var h_total = pxl_window_height - (h_adminbar + h_section_header + h_section_footer);
        $(this).css('height', h_total + 'px');
    });
}


$(document).ready(function() {
    $('.form-contact-qrcode button').click(function() {
        // Lấy giá trị từ các input
        $('#qrcode').empty();
        var name = $('.form-contact-qrcode #your-name').val();
        var email = $('.form-contact-qrcode #your-email').val();
        var phone = $('.form-contact-qrcode #your-phone').val();
        var treatments = $('.form-contact-qrcode .treatments').val();
        var doctor = $('.form-contact-qrcode .doctor').val();
        var date = $('.form-contact-qrcode .date').val();
        var messeage = $('.form-contact-qrcode .your-messeage').val();

        // Chuẩn bị dữ liệu để đưa vào QR code (có thể tùy chỉnh)
        var qrData = "Name: " + name + "\nEmail: " + email + "\nPhone: " + phone+ "\nTreatments: " + treatments + "\nDoctor: " + doctor + "\nDate: " + date + "\nNote: " + messeage;

        // Xóa mã QR cũ (nếu có)

        // Tạo mã QR mới
        var qr = new QRious({   
            element: document.getElementById('#qrcode'),
            value: qrData,
            size: 256, // kích thước mã QR
            level: 'L' // mức độ chính xác (L, M, Q, H)
        });
    });
});
})(jQuery);