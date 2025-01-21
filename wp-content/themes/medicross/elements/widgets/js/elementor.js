( function( $ ) {

    function medicross_section_start_render(){
        var _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;
        
        _elementor.hooks.addFilter( 'pxl_section_start_render', function( html, settings, el ) {

            if(typeof settings.pxl_parallax_bg_img != 'undefined' && settings.pxl_parallax_bg_img.url != ''){
                html += '<div class="pxl-section-bg-parallax"></div>';
            }

            if(typeof settings.pxl_color_offset != 'undefined' && settings.pxl_color_offset != 'none'){
                html += '<div class="pxl-section-overlay-color"></div>';
            }

            if(typeof settings.pxl_overlay_img != 'undefined' && settings.pxl_overlay_img.url != ''){
                html += '<div class="pxl-overlay--image pxl-overlay--imageLeft"><div class="bg-image"></div></div>';
            }

            if(typeof settings.pxl_overlay_img2 != 'undefined' && settings.pxl_overlay_img2.url != ''){
                html += '<div class="pxl-overlay--image pxl-overlay--imageRight"><div class="bg-image"></div></div>';
            }

            return html;
        } );

        $('.pxl-section-bg-parallax').parent('.elementor-element').addClass('pxl-section-parallax-overflow');
    }

    function medicross_column_before_render(){
        var _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;
        _elementor.hooks.addFilter( 'pxl-custom-column/before-render', function( html, settings, el ) {
            if(typeof settings.pxl_column_parallax_bg_img != 'undefined' && settings.pxl_column_parallax_bg_img.url != ''){
                html += '<div class="pxl-column-bg-parallax"></div>';
            }
            return html;
        } );
    }

    function medicross_css_inline_js(){
        var _inline_css = "<style>";
        $(document).find('.pxl-inline-css').each(function () {
            var _this = $(this);
            _inline_css += _this.attr("data-css") + " ";
            _this.remove();
        });
        _inline_css += "</style>";
        $('head').append(_inline_css);
    }

    function medicross_section_before_render(){
        var _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;
        _elementor.hooks.addFilter( 'pxl-custom-section/before-render', function( html, settings, el ) {
            if (typeof settings['row_divider'] !== 'undefined') {
                if(settings['row_divider'] == 'angle-top' || settings['row_divider'] == 'angle-bottom' || settings['row_divider'] == 'angle-top-right' || settings['row_divider'] == 'angle-bottom-left') {
                    html =  '<svg class="pxl-row-angle" style="fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" height="130px"><path stroke="" stroke-width="0" d="M0 100 L100 0 L200 100"></path></svg>';
                    return html;
                }
                if(settings['row_divider'] == 'angle-top-bottom' || settings['row_divider'] == 'angle-top-bottom-left') {
                    html =  '<svg class="pxl-row-angle pxl-row-angle-top" style="fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" height="130px"><path stroke="" stroke-width="0" d="M0 100 L100 0 L200 100"></path></svg><svg class="pxl-row-angle pxl-row-angle-bottom" style="fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" height="130px"><path stroke="" stroke-width="0" d="M0 100 L100 0 L200 100"></path></svg>';
                    return html;
                }
                if(settings['row_divider'] == 'wave-animation-top' || settings['row_divider'] == 'wave-animation-bottom') {
                    html =  '<svg class="pxl-row-angle" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1440 150" fill="#fff"><path d="M 0 26.1978 C 275.76 83.8152 430.707 65.0509 716.279 25.6386 C 930.422 -3.86123 1210.32 -3.98357 1439 9.18045 C 2072.34 45.9691 2201.93 62.4429 2560 26.198 V 172.199 L 0 172.199 V 26.1978 Z"><animate repeatCount="indefinite" fill="freeze" attributeName="d" dur="10s" values="M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z; M0 86.3149C316 86.315 444 159.155 884 51.1554C1324 -56.8446 1320.29 34.1214 1538 70.4063C1814 116.407 2156 188.408 2560 86.315V232.317L0 232.316V86.3149Z; M0 53.6584C158 11.0001 213 0 363 0C513 0 855.555 115.001 1154 115.001C1440 115.001 1626 -38.0004 2560 53.6585V199.66L0 199.66V53.6584Z; M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z"></animate></path></svg>';
                    return html;
                }
                if(settings['row_divider'] == 'curved-top' || settings['row_divider'] == 'curved-bottom') {
                    html =  '<svg class="pxl-row-angle" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 1920 128" version="1.1" preserveAspectRatio="none" style="fill:#ffffff"><path stroke-width="0" d="M-1,126a3693.886,3693.886,0,0,1,1921,2.125V-192H-7Z"></path></svg>';
                    return html;
                }
            }
        } );
    } 

    function medicross_svg_color($scope) {
        "use strict";

        jQuery($scope).find('.pxl-grid .pxl-post--icon img').each(function () {
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
    var PXL_Icon_Contact_Form = function( $scope, $ ) {

        setTimeout(function () {
            $('.pxl--item').each(function () {
                var icon_input = $(this).find(".pxl--form-icon"),
                control_wrap = $(this).find('.wpcf7-form-control');
                control_wrap.before(icon_input.clone());
                icon_input.remove();
            });
        }, 10);

    };



    function medicross_split_text($scope){

        setTimeout(function () {

            var st = $scope.find(".pxl-split-text");
            if(st.length == 0) return;
            gsap.registerPlugin(SplitText);
            st.each(function(index, el) {
                el.split = new SplitText(el, { 
                    type: "lines,words,chars",
                    linesClass: "split-line"
                });
                gsap.set(el, { perspective: 400 });

                if( $(el).hasClass('split-in-fade') ){
                    gsap.set(el.split.chars, {
                        opacity: 0,
                        ease: "Back.easeOut",
                    });
                }
                if( $(el).hasClass('split-in-right') ){
                    gsap.set(el.split.chars, {
                        opacity: 0,
                        x: "50",
                        ease: "Back.easeOut",
                    });
                }
                if( $(el).hasClass('split-in-left') ){
                    gsap.set(el.split.chars, {
                        opacity: 0,
                        x: "-50",
                        ease: "circ.out",
                    });
                }
                if( $(el).hasClass('split-in-up') ){
                    gsap.set(el.split.chars, {
                        opacity: 0,
                        y: "80",
                        ease: "circ.out",
                    });
                }
                if( $(el).hasClass('split-in-down') ){
                    gsap.set(el.split.chars, {
                        opacity: 0,
                        y: "-80",
                        ease: "circ.out",
                    });
                }
                if( $(el).hasClass('split-in-rotate') ){
                    gsap.set(el.split.chars, {
                        opacity: 0,
                        rotateX: "50deg",
                        ease: "circ.out",
                    });
                }
                if( $(el).hasClass('split-in-scale') ){
                    gsap.set(el.split.chars, {
                        opacity: 0,
                        scale: "0.5",
                        ease: "circ.out",
                    });
                }
                el.anim = gsap.to(el.split.chars, {
                    scrollTrigger: {
                        trigger: el,
                        toggleActions: "restart pause resume reverse",
                        start: "top 90%",
                    },
                    x: "0",
                    y: "0",
                    rotateX: "0",
                    scale: 1,
                    opacity: 1,
                    duration: 0.8, 
                    stagger: 0.02,
                });
            });

        }, 200);
    }

    function medicross_scroll_trigger($scope){
        ScrollTrigger.matchMedia({
            "(min-width: 1401px)": function() {
                let t2 = gsap.timeline({
                    scrollTrigger: {
                        trigger: ".pxl-section-scale",
                        scrub: true,
                        start: "top top",
                        end: "bottom bottom",
                        pin: ".pxl-section-sticky",
                    },
                });
                t2.to(".pxl-section-slide", {
                    padding: "7.5rem"
                }, ">");
                t2.to(".pxl-sticky-mask", {
                    borderRadius: "2rem"
                }, "<");
                t2.from(".is-shape-1", {
                    right: "-10%"
                }, "<");
                t2.from(".is-shape-2", {
                    left: "-10%"
                }, "<");
            },
            "(max-width: 1400px)": function() {
                let t2 = gsap.timeline({
                    scrollTrigger: {
                        trigger: ".pxl-section-scale",
                        scrub: true,
                        start: "top top",
                        end: "bottom bottom",
                        pin: ".pxl-section-sticky",
                    },
                });
                t2.to(".pxl-section-slide", {
                    padding: "4.8rem"
                }, ">");
                t2.to(".pxl-sticky-mask", {
                    borderRadius: "1.6rem"
                }, "<");
                t2.from(".is-shape-1", {
                    right: "-10%"
                }, "<");
                t2.from(".is-shape-2", {
                    left: "-10%"
                }, "<");
            },
            "(max-width: 991px)": function() {
                let t2 = gsap.timeline({
                    scrollTrigger: {
                        trigger: ".pxl-section-scale",
                        scrub: true,
                        start: "top bottom",
                        end: "bottom top",
                    },
                });
                t2.to(".pxl-section-slide", {
                    padding: "2rem"
                }, ">");
                t2.to(".pxl-sticky-mask", {
                    borderRadius: "2rem"
                }, "<");
                t2.from(".is-shape-1", {
                    right: "-10%"
                }, "<");
                t2.from(".is-shape-2", {
                    left: "-10%"
                }, "<");

            },
        });
        gsap.to(".pxl-sticker-shape.is-rotate", {
            rotation: "800",
            scrollTrigger: {
                trigger: "#pxl-content-main",
                scrub: true,
                start: "top top",
                end: "bottom bottom",
            },
        });
    }

    function medicross_zoom_point(){
        elementorFrontend.waypoint($(document).find('.pxl-zoom-point'), function () {
            var offset = $(this).offset();
            var offset_top = offset.top;
            var scroll_top = $(window).scrollTop();
        }, {
            offset: -100,
            triggerOnce: true
        });
    }


    function medicross_logo_marquee($scope){
        const logos = $scope.find('.pxl-item--marquee');
        gsap.set(logos, { autoAlpha: 1 })

        logos.each(function(index, el) {
            gsap.set(el, { xPercent: 100 * index });
        }); 

        if (logos.length > 2) {
            const logosWrap = gsap.utils.wrap(-100, ((logos.length - 1) * 100));
            const durationNumber = logos.data('duration');
            const slipType = logos.data('slip-type');
            var slipResult = `-=${logos.length * 100}`;
            if(slipType == 'right') {
                slipResult = `+=${logos.length * 100}`;
            }
            gsap.to(logos, {
                xPercent: slipResult,
                duration: durationNumber,
                repeat: -1,
                ease: 'none',
                modifiers: {
                    xPercent: xPercent => logosWrap(parseFloat(xPercent))
                }
            });
        }             
    }

    function medicross_text_marquee($scope){

        const text_marquee = $scope.find('.pxl-text--marquee');

        const boxes = gsap.utils.toArray(text_marquee);

        const loop = text_horizontalLoop(boxes, {paused: false,repeat: -1,});

        function text_horizontalLoop(items, config) {
            items = gsap.utils.toArray(items);
            config = config || {};
            let tl = gsap.timeline({repeat: config.repeat, paused: config.paused, defaults: {ease: "none"}, onReverseComplete: () => tl.totalTime(tl.rawTime() + tl.duration() * 100)}),
            length = items.length,
            startX = items[0].offsetLeft,
            times = [],
            widths = [],
            xPercents = [],
            curIndex = 0,
            pixelsPerSecond = (config.speed || 1) * 100,
            snap = config.snap === false ? v => v : gsap.utils.snap(config.snap || 1),
            totalWidth, curX, distanceToStart, distanceToLoop, item, i;
            gsap.set(items, {
                xPercent: (i, el) => {
                    let w = widths[i] = parseFloat(gsap.getProperty(el, "width", "px"));
                    xPercents[i] = snap(parseFloat(gsap.getProperty(el, "x", "px")) / w * 100 + gsap.getProperty(el, "xPercent"));
                    return xPercents[i];
                }
            });
            gsap.set(items, {x: 0});
            totalWidth = items[length-1].offsetLeft + xPercents[length-1] / 100 * widths[length-1] - startX + items[length-1].offsetWidth * gsap.getProperty(items[length-1], "scaleX") + (parseFloat(config.paddingRight) || 0);
            for (i = 0; i < length; i++) {
                item = items[i];
                curX = xPercents[i] / 100 * widths[i];
                distanceToStart = item.offsetLeft + curX - startX;
                distanceToLoop = distanceToStart + widths[i] * gsap.getProperty(item, "scaleX");
                tl.to(item, {xPercent: snap((curX - distanceToLoop) / widths[i] * 100), duration: distanceToLoop / pixelsPerSecond}, 0)
                .fromTo(item, {xPercent: snap((curX - distanceToLoop + totalWidth) / widths[i] * 100)}, {xPercent: xPercents[i], duration: (curX - distanceToLoop + totalWidth - curX) / pixelsPerSecond, immediateRender: false}, distanceToLoop / pixelsPerSecond)
                .add("label" + i, distanceToStart / pixelsPerSecond);
                times[i] = distanceToStart / pixelsPerSecond;
            }
            function toIndex(index, vars) {
                vars = vars || {};
                (Math.abs(index - curIndex) > length / 2) && (index += index > curIndex ? -length : length);
                let newIndex = gsap.utils.wrap(0, length, index),
                time = times[newIndex];
                if (time > tl.time() !== index > curIndex) { 
                    vars.modifiers = {time: gsap.utils.wrap(0, tl.duration())};
                    time += tl.duration() * (index > curIndex ? 1 : -1);
                }
                curIndex = newIndex;
                vars.overwrite = true;
                return tl.tweenTo(time, vars);
            }
            tl.next = vars => toIndex(curIndex+1, vars);
            tl.previous = vars => toIndex(curIndex-1, vars);
            tl.current = () => curIndex;
            tl.toIndex = (index, vars) => toIndex(index, vars);
            tl.times = times;
            tl.progress(1, true).progress(0, true);
            if (config.reversed) {
                tl.vars.onReverseComplete();
                tl.reverse();
            }
            return tl;
        }
    }

    function medicross_scroll_fixed_section(){
        const fixed_section_top = $('.pxl-section-fix-top');
        if (fixed_section_top.length > 0) {
            ScrollTrigger.matchMedia({
                "(min-width: 991px)": function() {
                    const pinnedSections = ['.pxl-section-fix-top'];
                    pinnedSections.forEach(className => {
                        gsap.to(".pxl-section-fix-bottom", {
                            scrollTrigger: {
                                trigger: ".pxl-section-fix-bottom",
                                scrub: true,
                                pin: className,
                                pinSpacing: false,
                                start: 'top bottom',
                                end: "bottom top",
                            },
                        });
                        gsap.to(".pxl-section-fix-bottom .pxl-section-overlay-color", {
                            scrollTrigger: {
                                trigger: ".pxl-section-fix-bottom",
                                scrub: true,
                                pin: className,
                                pinSpacing: false,
                                start: 'top bottom',
                                end: "bottom top",
                            },
                        });
                    });
                }
            });
        }

        const section_overlay_color = $('.pxl-section-overlay-color');
        if (section_overlay_color.length > 0) {
            const space_top = section_overlay_color.data('space-top');
            const space_left = section_overlay_color.data('space-left');
            const space_right = section_overlay_color.data('space-right');
            const space_bottom = section_overlay_color.data('space-bottom');

            const radius_top = section_overlay_color.data('radius-top');
            const radius_left = section_overlay_color.data('radius-left');
            const radius_right = section_overlay_color.data('radius-right');
            const radius_bottom = section_overlay_color.data('radius-bottom');

            const overlay_radius = radius_top + 'px ' + radius_right + 'px ' + radius_bottom + 'px ' + radius_left + 'px ';

            ScrollTrigger.matchMedia({
                "(min-width: 991px)": function() {
                    const pinnedSections = ['.pxl-bg-color-scroll'];
                    pinnedSections.forEach(className => {
                        gsap.to(".overlay-type-scroll", {
                            scrollTrigger: {
                                trigger: ".pxl-bg-color-scroll",
                                scrub: true,
                                pinSpacing: false,
                                start: 'top bottom',
                                end: "bottom top",
                            },
                            left: space_left + "px",
                            right: space_right + "px",
                            top: space_top + "px",
                            bottom: space_bottom + "px",
                            borderRadius: overlay_radius,
                        });
                    });
                }
            });
        }
    }
    function medicross_scroll_checkp($scope){
        $scope.find('.pxl-el-divider').each(function () {
            var wcont1 = $(this);


            function checkScrollPosition() {
                var pxl_scroll_top = $(window).scrollTop(),
                viewportBottom = pxl_scroll_top + $(window).height(),
                elementTop = wcont1.offset().top,
                elementBottom = elementTop + wcont1.outerHeight();

                if (elementTop < viewportBottom && elementBottom > pxl_scroll_top) {
                    wcont1.addClass('visible');
                }
            }

            checkScrollPosition();

            $(window).on('scroll', function () {
                checkScrollPosition();
            });

        });
    }

    function medicross_history($scope){

        $scope.find('.pxl-history').find('.scroll-next').on('click', function() {
            $('.pxl-wrap-date').animate({ scrollLeft: '+=100px' }, 300);
        });
        $scope.find('.pxl-history').find('.scroll-back').on('click', function() {
            $('.pxl-wrap-date').animate({ scrollLeft: '-=100px' }, 300);
        });

        $scope.find('.pxl-history').each(function() {
            $('.pxl-history .pxl-year .pxl-item-date:first-child').addClass('active');
            $('.pxl-history .pxl-content .entry-body:first-child').addClass('active');
            $('.pxl-item-date').on('click', function() {
                $('.pxl-item-date').removeClass('active');
                $(this).addClass('active');
                $('.entry-body').removeClass('active');
                var itemClass = $(this).attr('class').split(' ').filter(function(cls) {
                    return cls.startsWith('item-');
                })[0];
                $('.entry-body.' + itemClass).addClass('active');
            });
        });

        
    }


    var pxl_widget_elementor_handler = function( $scope, $ ) {
        var spanElements1 = $scope.find('.pxl-chart');
        var pxl_chart_type = spanElements1.attr('type_canvas');
        var pxl_chart_bordercolor = spanElements1.attr('chart_border_color');
        var pxl_chart_borderwidth = spanElements1.attr('chart_border_width');
        var label_line_title = spanElements1.attr('label_line_title');
        var pxl_cutout = spanElements1.attr('cutout');

        var data = {
            labels: [],
            datasets: [{
                label: [],
                data: [],
                borderWidth: [],
                backgroundColor: [],
                tension: 0.4,
                borderColor: [],
            }]
        };


        var spanElements=$scope.find('.pxl-chart span');
        spanElements.each(function() {
            data.labels.push($(this).attr('chart_title'));
            data.datasets[0].data.push(parseInt($(this).attr('chart_value')));
            data.datasets[0].backgroundColor.push($(this).attr('chart_color'));
            //data.datasets[0].label.push($(this).attr('label_line_title'));
            data.datasets[0].borderColor.push($(this).attr('chart_border_color'));
            data.datasets[0].borderWidth.push($(this).attr('chart_border_width'));
        });


        var config3 = { 
            type: pxl_chart_type,
            data: data,
            options: {
                width: 1000,
                responsive: true,
                maintainAspectRatio: true,
                cutout: pxl_cutout,
                plugins: {
                    legend: false 
                },
                scales: { 

                }   
            }
        };

        var chartElement = $scope.find('canvas');
        if (chartElement.length > 0) {
            var chartId = chartElement.attr('id');
            var chart = Chart.getChart(chartId);

            if (chart) {
                chart.destroy();
            }

            var myChartv3 = new Chart(
                chartElement[0],
                config3
                );
        }
        
    };
    function medicross_section_start_render2(){

        var _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;

        _elementor.hooks.addFilter( 'pxl_section_start_render', function( html, settings, el ) {

            if(typeof settings.pxl_parallax_bg_img != 'undefined' && settings.pxl_parallax_bg_img.url != ''){

                html += '<div class="pxl-section-bg-parallax"></div>';

            }

            return html;

        } );

    } 
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
            medicross_svg_color($scope);
            medicross_scroll_checkp($scope);
        } );
        medicross_section_start_render();
        medicross_section_start_render2();
        medicross_column_before_render();
        medicross_css_inline_js();
        medicross_section_before_render();
        medicross_zoom_point();
        medicross_scroll_fixed_section();
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_contact_form.default', PXL_Icon_Contact_Form );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/global', pxl_widget_elementor_handler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_heading.default', function( $scope ) {
            medicross_split_text($scope);
        } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_history.default', function( $scope ) {
            medicross_history($scope);

        } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_post_slip.default', function( $scope ) {
            medicross_split_text($scope);
        } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_section_scale.default', function( $scope ) {
            medicross_scroll_trigger($scope);
        } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_logo_marquee.default', function( $scope ) {
            medicross_logo_marquee($scope);
        } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_text_marquee.default', function( $scope ) {
            medicross_text_marquee($scope);
        } );
    } );
} )( jQuery );
