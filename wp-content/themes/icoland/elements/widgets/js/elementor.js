( function( $ ) {

	var pxl_widget_elementor_handler = function( $scope, $ ) {
		var spanElements1 = $scope.find('.pxl-chart');
		var data = {
			labels: [],
			datasets: [{
				label: 'My First Dataset',
				data: [],
				borderWidth: 0,
				backgroundColor: [],
			}]
		};
		var spanElements=$scope.find('.pxl-chart span');
		spanElements.each(function() {
			data.labels.push($(this).attr('chart_title'));
			data.datasets[0].data.push(parseInt($(this).attr('chart_value')));
			data.datasets[0].backgroundColor.push($(this).attr('chart_color'));
		});
		var pxl_chart_type = spanElements1.attr('type_canvas');
		var pxl_cutout = spanElements1.attr('cutout');
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
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', pxl_widget_elementor_handler );
	} );
} )( jQuery );