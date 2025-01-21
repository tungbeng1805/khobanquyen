( function( $ ) {

    var pxl_widget_tabs_handler = function( $scope, $ ) {
        $scope.find(".pxl-tabs.tab-effect-slide .pxl-item--title").on("click", function(e){
            e.preventDefault();
            var target = $(this).data("target");
            var parent = $(this).parents(".pxl-tabs");
            parent.find(".pxl-tabs--content .pxl-item--content").slideUp(300);
            parent.find(".pxl-tabs--title .pxl-item--title").removeClass('active');
            $(this).addClass("active");
            $(target).slideDown(300);
        });

        $scope.find(".pxl-tabs.tab-effect-fade .pxl-item--title").on("click", function(e){
            e.preventDefault();
            var target = $(this).data("target");
            var parent = $(this).parents(".pxl-tabs");
            parent.find(".pxl-tabs--content .pxl-item--content").removeClass("active");
            parent.find(".pxl-tabs--title .pxl-item--title").removeClass('active');
            $(this).addClass("active");
            $(target).addClass("active");
        });
    };
    
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_tabs.default', pxl_widget_tabs_handler );
    } );

} )( jQuery );
