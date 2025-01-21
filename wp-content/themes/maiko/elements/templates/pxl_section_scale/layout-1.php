<div class="pxl-section-scale pxl-bg-prx-effect-pinned-zoom-clipped">
	<div class="clipped-bg-pinned">
		<div class="clipped-bg">
			<?php 
			$image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';			
			if ($settings['bg_type'] == 'f_img' && has_post_thumbnail()) {
				$img_id = get_post_thumbnail_id(get_the_ID());
				$img  = pxl_get_image_by_size( array(
					'attach_id'  => $img_id,
					'thumb_size' => $image_size,
					'class' => 'no-lazyload'
				) );
				$thumbnail_url    = $img['url'];
			}
			?>
			<div class="pxl-sticky-mask">
				<div class="pxl-sticky-parallax <?php echo esc_attr($settings['bg_type']); ?>" style="<?php if ($settings['bg_type'] == 'f_img') { ?>background-image: url(<?php echo esc_url($thumbnail_url); ?>);<?php } ?>" data-parallax='{"y":-100}'>
					<?php if ($settings['bg_type'] == 'video_button') { ?>
						<a class="pxl--label btn-balloon pxl-action-popup" href="<?php echo esc_url($settings['bg_video']); ?>">
							<i class="caseicon-play1"></i>
							<span class="line-video-animation line-video-1"></span>
							<span class="line-video-animation line-video-2"></span>
							<span class="line-video-animation line-video-3"></span>
						</a>
					<?php } ?>						
					<?php  if ($settings['bg_type'] != 'video_button') { ?>					
						<video loop autoplay>
							<source src="<?php echo esc_url($settings['bg_video']); ?>" type="video/mp4">
							</video>
						<?php } ?>
						<div class="pxl-section-overlay"></div>
					</div>
				</div>
			</div>
		</div>
	</div>