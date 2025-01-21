<?php
extract($settings);
$html_id = pxl_get_element_id($settings);
$tax = ['portfolio-category'];
$select_post_by = $widget->get_setting('select_post_by', '');
$source = $post_ids = [];
if($select_post_by === 'post_selected'){
    $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
}else{
    $source  = $widget->get_setting('source_'.$settings['post_type'], '');
}
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
$settings['layout']    = $settings['layout_'.$settings['post_type']];
extract(pxl_get_posts_of_grid('portfolio', [
    'source' => $source,
    'orderby' => $orderby,
    'order' => $order,
    'limit' => $limit,
    'post_ids' => $post_ids,
    'tax'=> $tax,
]));

$pxl_animate = $widget->get_setting('pxl_animate', '');
$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$col_xxl = $widget->get_setting('col_xxl', '');
if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

$arrows = $widget->get_setting('arrows', false);
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false); 
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite', false);
$speed = $widget->get_setting('speed', '500');
$center = $widget->get_setting('center', false);
$drap = $widget->get_setting('drap', false);

$img_size = $widget->get_setting('img_size');
$show_excerpt = $widget->get_setting('show_excerpt');
$show_category = $widget->get_setting('show_category');
$num_words = $widget->get_setting('num_words');
$show_button = $widget->get_setting('show_button');
$button_text = $widget->get_setting('button_text');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_percolumnfill'           => 1, 
    'slide_mode'                    => 'slide', 
    'center_slide'                  => false, 
    'slides_to_show'                => (int)$col_xl, 
    'slides_to_show_xxl'            => (int)$col_xxl, 
    'slides_to_show_lg'             => (int)$col_lg, 
    'slides_to_show_md'             => (int)$col_md, 
    'slides_to_show_sm'             => (int)$col_sm, 
    'slides_to_show_xs'             => (int)$col_xs, 
    'slides_to_scroll'              => (int)$slides_to_scroll,  
    'slides_gutter'                 => 30, 
    'arrow'                         => (bool)$arrows,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => $infinite,
    'speed'                         => (int)$speed,
    'center'                        => (bool)$center,
];

$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]); ?>

<?php if (is_array($posts)): ?>
    <div class="pxl-swiper-slider pxl-portfolio-carousel pxl-portfolio-carousel1 pxl-portfolio-style1 ">
        <?php if ($settings['filter']=='true') { ?>
            <div class="swiper-filter">
                <div class="container">
                    <div class="pxl-grid-filter normal style-1">
                        <div class="pxl--filter-inner">
                         <?php if(!empty($filter_default_title)): ?>
                            <span class="filter-item active" data-filter-target="all">
                                <span class="cat-name"><?php echo esc_html($filter_default_title); ?></span>
                                <span class="filter-item-count">
                                    <?php
                                    echo count($posts); 
                                    ?>
                                </span> 
                            </span>
                        <?php endif; ?>
                        <?php foreach ($categories as $category):
                            $category_arr = explode('|', $category);
                            $term = get_term_by('slug',$category_arr[0], $category_arr[1]);
                            $tax_count = 0;
                            foreach ($posts as $key => $post){
                                $this_terms = get_the_terms( $post->ID, 'portfolio-category' );
                                $term_list = [];
                                foreach ($this_terms as $t) {
                                    $term_list[] = $t->slug;
                                } 
                                if(in_array($term->slug,$term_list))
                                    $tax_count++;
                            } 
                            if($tax_count > 0): ?>
                                <span class="filter-item" data-filter-target="<?php echo esc_attr($term->slug); ?>">
                                    <span class="cat-name"><?php echo esc_html($term->name); ?></span>
                                    <span class="filter-item-count">
                                        <?php
                                        echo esc_html($tax_count); 
                                        ?>
                                    </span> 
                                </span>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                    
                </div>
            </div>
        </div>
    <?php  } ?>
    <div class="pxl-carousel-inner" >
        <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="pxl-swiper-wrapper">
                <?php
                foreach ($posts as $post):
                    $image_size = !empty($img_size) ? $img_size : '878x965';
                    $img_id       = get_post_thumbnail_id( $post->ID );
                    $img          = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $image_size
                    ) );
                    $thumbnail    = $img['thumbnail']; 
                    $thumbnail_url    = $img['url']; 
                    $filter_class = '';
                    if ($select_post_by === 'term_selected' )
                        $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
                    ?>
                    <div class="pxl-swiper-slide" data-filter="<?php echo esc_attr($filter_class); ?>" <?php if($drap !== false): ?>data-cursor-drap="<?php echo esc_html('Drag.', 'maiko'); ?>"<?php endif; ?>>
                        <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>">
                            <div class="pxl-post--holder">
                                <?php if($show_category == 'true'): ?>
                                    <div class="pxl-post--category">
                                        <?php the_terms( $post->ID, 'portfolio-category', '', '/ ' ); ?>
                                    </div>
                                <?php endif; ?>
                                <h5 class="pxl-post--title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                </h5>
                                <?php if($show_excerpt == 'true'): ?>
                                    <div class="pxl-post--content">
                                        <?php if($show_excerpt == 'true'): ?>
                                            <?php
                                            echo wp_trim_words( $post->post_excerpt, $num_words, $more = null );
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="btn-readmore">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                        <span class="btn--text">
                                            <?php if(!empty($button_text)) {
                                                echo pxl_print_html($button_text);
                                            } else {
                                                echo esc_html__('find out more', 'maiko');
                                            } ?>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" x="0" y="0" viewBox="0 0 1560 1560" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g transform="matrix(1,0,0,1,4.999999999999545,4.547473508864641e-13)"><path d="M1524 811.8H36c-17.7 0-32-14.3-32-32s14.3-32 32-32h1410.7l-194.2-194.2c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l248.9 248.9c9.2 9.2 11.9 22.9 6.9 34.9-5 11.9-16.7 19.7-29.6 19.7z" fill="#ffffff" opacity="1" data-original="#000000"></path><path d="M1274.8 1061c-8.2 0-16.4-3.1-22.6-9.4-12.5-12.5-12.5-32.8 0-45.3l249.2-249.2c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-249.2 249.2c-6.3 6.3-14.5 9.4-22.7 9.4z" fill="#ffffff" opacity="1" data-original="#000000"></path></g></svg>
                                    </a>
                                </div>
                            </div>
                            <div class="pxl-post--featured " style="background-image: url(<?php echo esc_url($thumbnail_url); ?>);">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                </a>    
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div> 

        </div>
        <div class="container wrap-arrow <?php echo esc_attr($settings['style-pa']) ?>">
            <?php if($pagination !== false): ?>
                <div class="pxl-swiper-dots style-1"></div>
            <?php endif; ?>
            <?php if($arrows !== false): ?>
                <div class="pxl-swiper-arrow-wrap style-1">
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="caseicon-long-arrow-right-three" style="transform: scalex(-1);"></i></div>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="caseicon-long-arrow-right-three"></i></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>