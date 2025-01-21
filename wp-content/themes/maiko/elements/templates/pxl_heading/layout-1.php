<?php
$html_id = pxl_get_element_id($settings);
$editor_title = $widget->get_settings_for_display( 'title' );
if (!empty($editor_title)) {
    $editor_title = $widget->parse_text_editor($editor_title);
}

$sg_post_title = maiko()->get_page_opt('sg_post_title', 'default');
$sg_post_title_text = maiko()->get_page_opt('sg_post_title_text');
$sg_post_sub_title_text = maiko()->get_page_opt('sg_post_sub_title_text');

$sg_product_ptitle = maiko()->get_theme_opt('sg_product_ptitle', 'default');
$sg_product_ptitle_text = maiko()->get_theme_opt('sg_product_ptitle_text');

$sg_service_title = maiko()->get_theme_opt('sg_service_title', 'default');
$sg_service_title_text = maiko()->get_theme_opt('sg_service_title_text');
	
$sg_portfolio_title = maiko()->get_theme_opt('sg_portfolio_title', 'default');
$sg_portfolio_title_text = maiko()->get_theme_opt('sg_portfolio_title_text'); 

?>

<div id="pxl-<?php echo esc_attr($html_id) ?>" class="pxl-heading <?php echo esc_attr($settings['sub_title_style'].' '.$settings['h_title_style']); ?>-style <?php if(!empty($settings['highlight_text_image']['id'])) { echo 'highlight-text-image'; } ?>">
	<div class="pxl-heading--inner">
		<?php if(!empty($settings['sub_title'])) : ?>
			<div class="pxl-item--subtitle <?php if(!empty($settings['subtitle_split_text_anm'])){ echo 'pxl-split-text';} ?> <?php echo esc_attr($settings['sub_title_style'].' '.$settings['custom_font_sub'].' '.$settings['pxl_animate_sub'].' '.$settings['subtitle_split_text_anm']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_sub']); ?>ms">
				<span class="pxl-item--subtext">
					<?php if(!empty($settings['sub_title_number']) && $settings['sub_title_style'] == 'px-sub-title-number') { ?>
						<i class="pxl-item--number pxl-mr-10 pxl-pr-60"><?php echo esc_attr($settings['sub_title_number']); ?></i>
					<?php } elseif($sg_post_title == 'custom_text' && !empty($sg_post_sub_title_text) && $settings['source_type'] == 'title') { ?>
						<?php echo pxl_print_html($sg_post_sub_title_text); ?>
					<?php } else { ?>
						<?php echo esc_attr($settings['sub_title']); ?>
					<?php } ?>	
				</span>
			</div>
		<?php endif; ?>

		<<?php echo esc_attr($settings['title_tag']); ?> class="pxl-item--title <?php if(!empty($settings['title_split_text_anm'])){ echo 'pxl-split-text';} ?> <?php echo esc_attr($settings['h_title_style'].' '.$settings['custom_font'].' '.$settings['highlight_style'].' '.$settings['title_split_text_anm']); ?> <?php if($settings['pxl_animate'] !== 'wow letter') { echo esc_attr($settings['pxl_animate']); } ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
		<?php if( $sg_post_title == 'custom_text' && !empty($sg_post_title_text) && $settings['source_type'] == 'title') { ?>
			<?php echo pxl_print_html($sg_post_title_text); ?>

		<?php } elseif(is_singular('portfolio') && $sg_portfolio_title == 'custom_text' && !empty($sg_portfolio_title_text) && $settings['source_type'] == 'title') { ?>
			<?php echo pxl_print_html($sg_portfolio_title_text); ?>

		<?php } elseif(is_singular('service') && $sg_service_title == 'custom_text' && !empty($sg_service_title_text) && $settings['source_type'] == 'title') { ?>
			<?php echo pxl_print_html($sg_service_title_text); ?>

		<?php } elseif(is_singular('product') && $sg_product_ptitle == 'custom_text' && !empty($sg_product_ptitle_text) && $settings['source_type'] == 'title') { ?>
			<?php echo pxl_print_html($sg_product_ptitle_text); ?>

		<?php } else { ?>
			<?php if($settings['source_type'] == 'text' && !empty($editor_title)) {
				if($settings['h_title_style'] == 'style-outline') { ?>
					<span class="pxl-text-line-backdrop">
						<span><?php echo wp_kses_post($editor_title); ?></span>
						<svg stroke-width="2" class="svg-text-line"><text dominant-baseline="middle" text-anchor="middle" x="50%" y="50%"><?php echo wp_kses_post($editor_title); ?></text></svg>		
					</span>
				<?php } else {
					echo wp_kses_post($editor_title);
				}
			} elseif($settings['source_type'] == 'title') {
				$titles = maiko()->page->get_title();
				if(!empty($_GET['blog_title'])) {
					$blog_title = $_GET['blog_title'];
					$custom_title = explode('_', $blog_title);
					foreach ($custom_title as $index => $value) {
						$arr_str_b[$index] = $value;
					}
					$str = implode(' ', $arr_str_b);
					echo wp_kses_post($str);
				} else {
					pxl_print_html($titles['title']);
				}
			}?>	
		<?php } ?>	
		</<?php echo esc_attr($settings['title_tag']); ?>>

	</div>
</div>