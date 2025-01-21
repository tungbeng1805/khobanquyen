<div class="wrap-navigation-carousel">
	<?php if ($settings['title']) {?>
		<div class="title">
			<?php echo pxl_print_html($settings['title']); ?>
		</div>
	<?php } ?>
	<div class="pxl-navigation-carousel <?php echo esc_attr($settings['style']); ?>">
		<div class="pxl-navigation-arrow pxl-navigation-arrow-prev"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/arr1.png'); ?>" alt="<?php echo esc_attr__('arr1', 'icoland'); ?>" /></div>
		<div class="pxl-navigation-arrow pxl-navigation-arrow-next"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/arr2.png'); ?>" alt="<?php echo esc_attr__('arr2', 'icoland'); ?>" /></div>
	</div>	
</div>
