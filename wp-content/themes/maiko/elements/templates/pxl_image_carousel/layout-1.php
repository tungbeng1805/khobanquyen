 <?php
 $styleMappings = array(
    'style1' => 'displacements-01.jpg',
    'style2' => 'displacements-02.jpg',
    'style3' => 'displacements-03.jpg',
    'style4' => 'displacements-04.jpg',
    'style5' => 'displacements-05.jpg',
    'style6' => 'displacements-06.jpg',
    'style7' => 'displacements-07.jpg',
    'style8' => 'displacements-08.jpg',
    'style9' => 'displacements-09.jpg',
    'style' => 'webgl-01.jpg',
);
 $imgds = isset($styleMappings[$settings['effect_style']]) ? $styleMappings[$settings['effect_style']] : '';

 $col_xs = $widget->get_setting('col_xs', '');
 $col_sm = $widget->get_setting('col_sm', '');
 $col_md = $widget->get_setting('col_md', '');
 $col_lg = $widget->get_setting('col_lg', '');
 $col_xl = $widget->get_setting('col_xl', '');
 $col_xxl = $widget->get_setting('col_xxl', '');
 if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$grid_masonry = $widget->get_setting('grid_masonry');
$images_size = !empty($img_size) ? $img_size : 'full';
$slides_to_scroll = $widget->get_setting('slides_to_scroll');
$arrows = $widget->get_setting('arrows', false);  
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite', false);  
$speed = $widget->get_setting('speed', '500');
$drap = $widget->get_setting('drap', false);  
$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show'                => $col_xl,
    'slides_to_show_xxl'            => $col_xxl, 
    'slides_to_show_lg'             => $col_lg, 
    'slides_to_show_md'             => $col_md, 
    'slides_to_show_sm'             => $col_sm, 
    'slides_to_show_xs'             => $col_xs, 
    'slides_to_scroll'              => (int)$slides_to_scroll,
    'arrow'                         => (bool)$arrows,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
$cursor_arrow_cls = 'cursor-arrow';
$pxl_g_id = uniqid();
if(isset($settings['image']) && !empty($settings['image']) && count($settings['image'])): ?>
    <div id="pxl-gallery-<?php echo esc_attr($pxl_g_id); ?>" class="pxl-swiper-slider pxl-image-carousel pxl-image-carousel1 <?php if($settings['effect_slide'] == 'true') { echo 'pxl-slider-carousel-effect'; } ?> <?php echo esc_attr($settings['style']); ?>" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_attr('DRAG');?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">

            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['image'] as $key => $value):
                        $image = isset($value['image']) ? $value['image'] : '';
                        $img_size = isset($value['img_size']) ? $value['img_size'] : '';

                        if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                            $img_size_m = $grid_masonry[$key]['img_size_m'];

                            if(!empty($img_size_m)) {
                                $images_size = $img_size_m;                                
                            }
                        } elseif (!empty($img_size)) {
                            $images_size = $img_size;
                        }
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <?php if(!empty($image['id'])) { 
                                    $img = pxl_get_image_by_size( array(
                                        'attach_id'  => $image['id'],
                                        'thumb_size' => $images_size,
                                        'class' => 'no-lazyload',
                                    ));
                                    $thumbnail = $img['thumbnail'];
                                    $thumbnail_url = $img['url'];
                                    ?>
                                    <?php if ($settings['style_img'] == 'image') { ?>
                                        <div class="pxl-item--image ">
                                            <?php if ($settings['image_parallax'] == true) { ?>
                                                <img src="<?php echo esc_attr($thumbnail_url); ?>" data-swiper-parallax-x="15%" alt="img-<?php echo $key; ?>">
                                            <?php } else { ?>
                                                <?php echo wp_kses_post($thumbnail); ?>
                                            <?php } ?>
                                            <?php if ($settings['style'] == 'style-2'): ?>
                                                <a href="<?php echo esc_url($thumbnail_url); ?>" class="lightbox" data-elementor-lightbox-slideshow="pxl-gallery-<?php echo esc_attr($pxl_g_id); ?>"><i class="fas fa-eye"></i></a>
                                            <?php endif ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($settings['style_img'] == 'bgr') { ?>
                                        <div class="pxl-item--image " style="background-image: url(<?php echo esc_attr($thumbnail_url); ?>);">
                                            <?php if ($settings['style'] == 'style-2'): ?>
                                                <a href="<?php echo esc_url($thumbnail_url); ?>" class="lightbox" data-elementor-lightbox-slideshow="pxl-gallery-<?php echo esc_attr($pxl_g_id); ?>"><i class="fas fa-eye"></i></a>
                                            <?php endif ?>
                                        </div>
                                    <?php } ?>
                                    
                                <?php } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if($arrows !== false): ?>
                <div class="pxl-swiper-arrow-wrap <?php echo esc_attr($settings['arr_style']); ?>">
                    <?php if ($settings['arr_style'] == 'style-2') { ?>
                        <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 20 20" height="16" viewBox="0 0 20 20" width="18"><path d="m12 2-1.4 1.4 5.6 5.6h-16.2v2h16.2l-5.6 5.6 1.4 1.4 8-8z" fill="rgb(0,0,0)"/></svg></div>
                        <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 20 20" height="16" viewBox="0 0 20 20" width="18"><path d="m12 2-1.4 1.4 5.6 5.6h-16.2v2h16.2l-5.6 5.6 1.4 1.4 8-8z" fill="rgb(0,0,0)"/></svg></div>
                    <?php } else { ?>
                        <div class="pxl-swiper-arrow pxl-swiper-arrow-prev <?php echo esc_attr($cursor_arrow_cls.'-prev') ?>"></div>
                        <div class="pxl-swiper-arrow pxl-swiper-arrow-next <?php echo esc_attr($cursor_arrow_cls.'-next') ?>"></div>
                    <?php } ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if($pagination !== false): ?>
            <div class="pxl-swiper-bottom pxl-flex-middle">
                <?php if($pagination !== false): ?>
                    <div class="pxl-swiper-dots style-1"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ($settings['effect_slide'] == 'true'): ?>
            <img src="<?php echo esc_url( get_template_directory_uri().'/assets/img/'.$imgds ); ?>" class="pxl-image-webgl" alt="image displacements" data-sampler="map">            
        <?php endif ?>
    </div>
<?php endif; ?>
