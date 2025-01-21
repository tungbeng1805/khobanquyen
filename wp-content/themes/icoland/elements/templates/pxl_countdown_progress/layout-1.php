<div class="pxl-countdown-progress">
	<?php if ($settings['title_box']): ?>
		<h4 class="title">
			<?php echo pxl_print_html($settings['title_box']); ?>
		</h4>
	<?php endif ?>
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
	if($layout == '1') {
		$hour = esc_html__('Hours', 'icoland');
		$hours = esc_html__('Hours', 'icoland');
		$minute = esc_html__('Mins', 'icoland');
		$minutes = esc_html__('Mins', 'icoland');
		$second = esc_html__('Secs', 'icoland');
		$seconds = esc_html__('Secs', 'icoland');
	}
	?>
	<div class="pxl-countdown" 
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
	<?php
	if(isset($settings['progressbar']) && !empty($settings['progressbar'])): ?>
		<div class="pxl-progressbar pxl-progressbar-1 style2">
			<?php foreach ($settings['progressbar'] as $key => $progressbar): ?>
				<div class="pxl--item <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
					<div class="pxl--meta">
						<h5 class="pxl--title el-empty pxl-mr-20"><?php echo pxl_print_html($progressbar['title']); ?></h5>
						<h5 class="pxl--title pxl--title-end el-empty pxl-mr-20"><?php echo pxl_print_html($progressbar['title_end']); ?></h5>
					</div>
					<div class="pxl--holder">
						<div class="pxl--progressbar" role="progressbar" data-valuetransitiongoal="<?php echo esc_attr($progressbar['percent']['size']); ?>">
							<div class="pxl--percentage">
								<?php if (!empty($progressbar['title_rp'])){
									echo pxl_print_html($progressbar['title_rp']);
								}
								else {
									echo pxl_print_html($progressbar['percent']['size']).'%'; 
								}
								?>
							</div>
						</div>
					</div>
					<?php if ($progressbar['vl1']): ?>
						<span class="pxl--value pxl--value1"><?php echo pxl_print_html($progressbar['vl1']); ?></span>
					<?php endif ?>
					<?php if ($progressbar['vl2']): ?>
						<span class="pxl--value pxl--value2"><?php echo pxl_print_html($progressbar['vl2']); ?></span>  
					<?php endif ?>
					<?php if ($progressbar['vl3']): ?>
						<span class="pxl--value pxl--value3"><?php echo pxl_print_html($progressbar['vl3']); ?></span>
					<?php endif ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php
	$is_new = \Elementor\Icons_Manager::is_migration_allowed();
	if(isset($settings['icons']) && !empty($settings['icons']) && count($settings['icons'])): ?>
		<div class="pxl-icon1">
			<?php foreach ($settings['icons'] as $key => $value):
				$icon_type = isset($value['icon_type']) ? $value['icon_type'] : '';
				$icon_image = isset($value['icon_image']) ? $value['icon_image'] : '';
				$icon_key = $widget->get_repeater_setting_key( 'pxl_icon', 'icons', $key );
				$widget->add_render_attribute( $icon_key, [
					'class' => $value['pxl_icon'],
					'aria-hidden' => 'true',
				] );
				$link_key = $widget->get_repeater_setting_key( 'icon_link', 'value', $key );
				if ( ! empty( $value['icon_link']['url'] ) ) {
					$widget->add_render_attribute( $link_key, 'href', $value['icon_link']['url'] );

					if ( $value['icon_link']['is_external'] ) {
						$widget->add_render_attribute( $link_key, 'target', '_blank' );
					}

					if ( $value['icon_link']['nofollow'] ) {
						$widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
					}
				}
				$link_attributes = $widget->get_render_attribute_string( $link_key ); ?>
				<?php if ( $icon_type == 'icon' && ! empty( $value['pxl_icon'] ) ) : ?>
					<a class="elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
						<?php if ( $is_new ):
							\Elementor\Icons_Manager::render_icon( $value['pxl_icon'], [ 'aria-hidden' => 'true' ] );
							elseif(!empty($value['pxl_icon'])): ?>
								<i class="<?php echo esc_attr( $value['pxl_icon'] ); ?>" aria-hidden="true"></i>
							<?php endif; ?>
						</a>
					<?php endif; ?>
					<?php if ( $icon_type == 'image' && !empty($icon_image['id']) ) : 
						$img_icon  = pxl_get_image_by_size( array(
							'attach_id'  => $icon_image['id'],
							'thumb_size' => 'full',
						) );
						$thumbnail_icon    = $img_icon['thumbnail']; ?>
						<a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
							<?php echo pxl_print_html($thumbnail_icon); ?>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>