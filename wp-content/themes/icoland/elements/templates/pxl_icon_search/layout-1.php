<div class="pxl-search">
	<?php if($settings['style'] != 'form' && $settings['style'] != 'form_2' && $settings['style'] != 'form_3') : ?>
		<div class="pxl-search-popup-button <?php echo esc_attr($settings['style']); ?>">
			<?php if(!empty($settings['pxl_icon']['value'])) {
				\Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' );
			} else { ?>
				<i class="far fa-search"></i>
			<?php } ?>
		</div>
	<?php endif; ?>
	<?php if($settings['style'] == 'form') : ?>
		<div class="pxl-header-search-form ">
			<form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
				<input type="text" placeholder="<?php esc_attr_e('Type Your Questions Here', 'icoland'); ?>" name="s" class="search-field" />
				<button type="submit" class="search-submit">
					<?php if(!empty($settings['pxl_icon']['value'])) {
						\Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' );
					} else { ?>
						<i class="far fa-search"></i>
					<?php } ?>
				</button>
			</form>
		</div>
	<?php endif; ?>
	<?php if($settings['style'] == 'form_2') : ?>
		<div class="pxl-header-search-form-2">
			<form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
				<input type="text" placeholder="<?php esc_attr_e('Search Items Here...', 'icoland'); ?>" name="s" class="search-field" />
			</form>
		</div>
	<?php endif; ?>
	<?php if($settings['style'] == 'form_3') : ?>
		<div class="pxl-header-search-form-3">
			<form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
				<input type="text" placeholder="<?php esc_attr_e('Search Items Here...', 'icoland'); ?>" name="s" class="search-field" />
			</form>
		</div>
	<?php endif; ?>
</div>
<?php  add_action( 'pxl_anchor_target', 'icoland_hook_anchor_search'); ?>