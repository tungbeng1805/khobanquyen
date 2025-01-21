<?php
$default_settings = [
	'date' => '2030/10/10',
	'pxl_day' => '',
	'pxl_hour' => '',
	'pxl_minute' => '',
	'pxl_second' => '',
];
$html_id = pxl_get_element_id($settings);
$settings = array_merge($default_settings, $settings);
extract($settings); 
$month = esc_html__('Month', 'icoland');
$months = esc_html__('Months', 'icoland');
$day = esc_html__('Day', 'icoland');
$days = esc_html__('Days', 'icoland');
$hour = esc_html__('Hour', 'icoland');
$hours = esc_html__('Hours', 'icoland');
$minute = esc_html__('Minute', 'icoland');
$minutes = esc_html__('Minutes', 'icoland');
$second = esc_html__('Second', 'icoland');
$seconds = esc_html__('Seconds', 'icoland');
if($style == 'style3') {
	$hour = esc_html__('Hour', 'icoland');
	$hours = esc_html__('Hour', 'icoland');
	$minute = esc_html__('Min', 'icoland');
	$minutes = esc_html__('Min', 'icoland');
	$second = esc_html__('Sec', 'icoland');
	$seconds = esc_html__('Sec', 'icoland');
}
?>
<div class="wrap-countdown pxl-countdown-layout2 <?php echo esc_attr($settings['style']); ?>">
	<?php if ($settings['title_box']): ?>
		<h4 class="title"><?php echo pxl_print_html($settings['title_box']); ?></h4>
	<?php endif ?>
	<div class="pxl-countdown  <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo esc_attr($pxl_day.' '.$pxl_hour.' '.$pxl_minute.' '.$pxl_second); ?>" 
		data-month="<?php echo esc_attr($month) ?>"
		data-months="<?php echo esc_attr($months) ?>"
		data-day="<?php echo esc_attr($day) ?>"
		data-days="<?php echo esc_attr($days) ?>"
		data-hour="<?php echo esc_attr($hour) ?>"
		data-hours="<?php echo esc_attr($hours) ?>"
		data-minute="<?php echo esc_attr($minute) ?>"
		data-minutes="<?php echo esc_attr($minutes) ?>"
		data-second="<?php echo esc_attr($second) ?>"
		data-seconds="<?php echo esc_attr($seconds) ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
		<div class="pxl-countdown-inner" data-count-down="<?php echo esc_attr($date);?>"></div>
	</div>
</div>
