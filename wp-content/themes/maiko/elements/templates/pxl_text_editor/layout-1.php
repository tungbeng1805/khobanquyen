<?php
$editor_content = $widget->get_settings_for_display( 'text_ed' );
$editor_content = $widget->parse_text_editor( $editor_content );

$sg_post_title = maiko()->get_page_opt('sg_post_title', 'default');
$sg_post_des_text = maiko()->get_page_opt('sg_post_des_text');
?>
<div class="pxl-text-editor <?php if(!empty($settings['split_text_anm'])){ echo 'pxl-split-text';} ?> <?php echo esc_attr($settings['split_text_anm']); ?>">
	<div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?> <?php echo esc_attr($settings['custom_font']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
		<?php if( $sg_post_title == 'custom_text' && !empty($sg_post_des_text)) { ?>
			<?php echo pxl_print_html($sg_post_des_text); ?>
		<?php } else { ?>
			<?php echo wp_kses_post($editor_content); ?>	
		<?php } ?>
	</div>
</div>