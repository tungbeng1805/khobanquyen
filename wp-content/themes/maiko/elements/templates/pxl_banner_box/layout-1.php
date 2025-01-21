<?php 
$html_id = pxl_get_element_id($settings); 
if ( ! empty( $settings['link']['url'] ) ) {
	$widget->add_render_attribute( 'button', 'href', $settings['link']['url'] );

	if ( $settings['link']['is_external'] ) {
		$widget->add_render_attribute( 'button', 'target', '_blank' );
	}

	if ( $settings['link']['nofollow'] ) {
		$widget->add_render_attribute( 'button', 'rel', 'nofollow' );
	}
}
?>
<div class="pxl-banner pxl-banner1 <?php echo esc_attr($settings['style']); ?>">
	<div class="pxl-banner-inner">
		<?php if(!empty($settings['banner_image']['id'])) :
			$img = pxl_get_image_by_size( array(
				'attach_id'  => $settings['banner_image']['id'],
				'thumb_size' => '880x716',
			));
			$thumbnail = $img['thumbnail']; ?>
			<div class="pxl-item--image">
				<?php echo pxl_print_html($thumbnail); ?>
				<a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn-banner">
					<span class="button-arrow-hover">
						<?php if(!empty($settings['btn_icon']['value'])) {
							\elementor\icons_manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' );
							echo '<div>';
							\elementor\icons_manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' );
							echo '</div>';
						} ?>
					</span>
					<span class="pxl--btn-text"><?php echo pxl_print_html($settings['text']); ?></span>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>