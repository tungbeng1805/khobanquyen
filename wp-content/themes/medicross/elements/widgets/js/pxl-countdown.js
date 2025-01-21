( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var PXLCountdownBarHandler = function( $scope, $ ) {
        
        $('.pxl-countdown').each(function () {
            var _this = $(this);
            var count_down = $(this).find('> div').data("count-down");
            setInterval(function () {
                var startDateTime = new Date().getTime();
                var endDateTime = new Date(count_down).getTime();
                var distance = endDateTime - startDateTime;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                var text_day = days !== 1 ? _this.attr('data-days') : _this.attr('data-day');
                var text_hour = hours !== 1 ? _this.attr('data-hours') : _this.attr('data-hour');
                var text_minu = minutes !== 1 ? _this.attr('data-minutes') : _this.attr('data-minute');
                var text_second = seconds !== 1 ? _this.attr('data-seconds') : _this.attr('data-second');
                days = days < 10 ? '0' + days : days;
                hours = hours < 10 ? '0' + hours : hours;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                var arrDays = [];
                var daysString = days.toString();
                for (var i = 0; i < daysString.length; i++) {
                    arrDays.push('<span>' + daysString[i] + '</span>');
                }

                var arrHours = [];
                var hoursString = hours.toString();
                for (var i = 0; i < hoursString.length; i++) {
                    arrHours.push('<span>' + hoursString[i] + '</span>');
                }

                var arrMinutes = [];
                var minutesString = minutes.toString();
                for (var i = 0; i < minutesString.length; i++) {
                    arrMinutes.push('<span>' + minutesString[i] + '</span>');
                }

                var arrSeconds = [];
                var secondsString = seconds.toString();
                for (var i = 0; i < secondsString.length; i++) {
                    arrSeconds.push('<span>' + secondsString[i] + '</span>');
                }

                _this.html(''
                    + '<div class="countdown-item countdown-day"><div class="countdown-item-inner"><div class="countdown-amount">' + arrDays.join() + ' </div><div class="countdown-period">' + text_day + '</div></div></div>'
                    + '<div class="countdown-item countdown-hour"><div class="countdown-item-inner"><div class="countdown-amount">' + arrHours.join() + '</div><div class="countdown-period">' + text_hour + '</div></div></div>'
                    + '<div class="countdown-item countdown-minute"><div class="countdown-item-inner"><div class="countdown-amount">' + arrMinutes.join() + '</div><div class="countdown-period">' + text_minu + '</div></div></div>'
                    + '<div class="countdown-item countdown-second"><div class="countdown-item-inner"><div class="countdown-amount">' + arrSeconds.join() + '</div><div class="countdown-period">' + text_second + '</div></div></div>'
                );
            }, 100);
        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_countdown.default', PXLCountdownBarHandler );
    } );
} )( jQuery );