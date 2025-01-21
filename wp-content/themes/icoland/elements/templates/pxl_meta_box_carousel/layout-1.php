<?php
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
$arrows = $widget->get_setting('arrows','false');
$pagination = $widget->get_setting('pagination','false');
$pagination_type = $widget->get_setting('pagination_type','bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay', '');
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite','false');
$speed = $widget->get_setting('speed', '500');
$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => '1',
    'slide_mode'                    => 'slide',
    'slides_to_show'                => $col_xl,
    'slides_to_show_xxl'             => $col_xxl,
    'slides_to_show_lg'             => $col_lg,
    'slides_to_show_md'             => $col_md,
    'slides_to_show_sm'             => $col_sm,
    'slides_to_show_xs'             => $col_xs,
    'slides_to_scroll'              => $slides_to_scroll,
    'arrow'                         => $arrows,
    'pagination'                    => $pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => $autoplay,
    'pause_on_hover'                => $pause_on_hover,
    'pause_on_interaction'          => 'true',
    'delay'                         => $autoplay_speed,
    'loop'                          => $infinite,
    'speed'                         => $speed
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
$img_size = '';
if(!empty($settings['img_size'])) {
    $img_size = $settings['img_size'];
} else {
    $img_size = 'full';
}
if(isset($settings['list']) && !empty($settings['list']) && count($settings['list'])): ?>
    <div class="pxl-swiper-sliders pxl-meta-box-carousel pxl-meta-box-carousel1 pxl-parent-transition pxl-swiper-arrow-show" data-arrow="<?php echo esc_attr($arrows); ?>">
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['list'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $image = isset($value['image']) ? $value['image'] : '';
                        $active = isset($value['active']) ? $value['active'] : '';
                        $it_active = isset($value['it_active']) ? $value['it_active'] : '';
                        $link = isset($value['link']) ? $value['link'] : '';
                        $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
                        $social = isset($value['social']) ? $value['social'] : '';
                        if ( ! empty( $link['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $link['url'] );

                            if ( $link['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $link['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key );
                        ?>
                        <div class="pxl-swiper-slide <?php echo esc_attr($active); ?> <?php echo esc_attr($it_active); ?>">
                            <div class="box"></div>
                            <div class="line"></div>
                            <div class="pxl-item--inner pxl-transtion <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <?php if(!empty($title)) : ?>
                                    <h5 class="pxl-item--title el-empty">
                                        <a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php echo pxl_print_html($title); ?></a>
                                    </h5>
                                <?php endif; ?>
                                <?php if(!empty($social)) : ?>
                                    <div class="pxl-item--content">
                                        <?php $team_social = json_decode($social, true);
                                        foreach ($team_social as $value): ?>
                                            <?php if(! empty($value['url'])){ ?><a href="<?php echo esc_url($value['url']); ?>" ><?php } ?>
                                            <span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.18786 16C8.59069 16 8.04723 15.7185 7.6914 15.223C7.46301 14.905 7.34228 14.5299 7.34228 14.1384V1.81015C7.34228 1.74557 7.32739 1.68063 7.29894 1.6224L7.27734 1.57809C7.08935 1.19235 6.72497 1.24313 6.61767 1.26779C6.50915 1.29281 6.15502 1.40878 6.15502 1.84811V11.0323C6.15502 11.7857 5.7041 12.4559 5.00634 12.7397C4.30859 13.0236 3.5177 12.8585 2.99182 12.3191C2.65417 11.9727 2.46826 11.5157 2.46826 11.0322V5.45761C2.46826 5.0787 2.17908 4.93051 2.09045 4.89401C2.00171 4.85763 1.69177 4.75985 1.42554 5.02951C1.31213 5.14437 1.24975 5.29635 1.24975 5.45761V10.0637C1.24975 10.4088 0.96997 10.6886 0.624877 10.6886C0.279785 10.6886 0 10.4088 0 10.0637V5.45761C0 4.96554 0.19043 4.50167 0.536254 4.15145C1.07641 3.60446 1.85388 3.44589 2.56506 3.738C3.27624 4.02987 3.71801 4.68893 3.71801 5.45761V11.0322C3.71801 11.188 3.77795 11.3352 3.88659 11.4466C4.14538 11.712 4.4486 11.6174 4.53552 11.5821C4.62219 11.5468 4.90527 11.4029 4.90527 11.0324V1.84811C4.90527 0.970303 5.48046 0.247646 6.33666 0.0501366C7.18945 -0.146641 8.01891 0.24728 8.40075 1.03048L8.42236 1.07492C8.53332 1.3027 8.59203 1.55697 8.59203 1.81027L8.59191 14.1385C8.59191 14.2668 8.63158 14.3897 8.70641 14.494C8.86254 14.7114 9.06237 14.7533 9.20275 14.7501C9.49743 14.7434 9.81054 14.5268 9.81054 14.1386V13.2506C9.81054 12.9054 10.0903 12.6257 10.4354 12.6257C10.7805 12.6257 11.0603 12.9054 11.0603 13.2506V14.1386C11.0603 15.2774 10.1302 15.9791 9.23107 15.9995C9.21667 15.9998 9.20226 16 9.18786 16ZM14.1539 12.8756C14.8461 12.875 15.4549 12.5031 15.7827 11.8809C15.9227 11.6148 15.9968 11.3153 15.9968 11.0146V6.5643C15.9968 6.2192 15.717 5.93942 15.3719 5.93942C15.0268 5.93942 14.7471 6.2192 14.7471 6.5643V11.0146C14.7471 11.1132 14.7228 11.2114 14.6769 11.2985C14.5345 11.5688 14.3133 11.6257 14.1529 11.6258C14.1527 11.6258 14.1526 11.6258 14.1523 11.6258C13.9892 11.6258 13.8292 11.5655 13.7132 11.4603C13.5907 11.349 13.5286 11.1991 13.5286 11.0146V5.45724C13.5286 4.76925 13.1687 4.16049 12.5661 3.8287C11.9635 3.49691 11.2567 3.5184 10.6753 3.88632C10.1338 4.22909 9.81054 4.81637 9.81054 5.45712V10.1261C9.81054 10.4713 10.0903 10.7509 10.4354 10.7509C10.7805 10.7509 11.0603 10.4713 11.0603 10.1261V5.45724C11.0603 5.24716 11.1662 5.05478 11.3437 4.94235C11.6183 4.76864 11.8685 4.8713 11.9634 4.92355C12.0582 4.97567 12.2788 5.13229 12.2788 5.45724V11.0146C12.2788 11.5509 12.49 12.0378 12.8734 12.3857C13.2165 12.6971 13.6825 12.8756 14.1523 12.8756H14.1539Z" fill="#C004DE"/>
                                            </svg>
                                            <?php echo pxl_print_html($value['content']); ?></span>
                                            <?php if(! empty($value['url'])){ ?></a><?php } ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php if($arrows !== 'false' || $pagination !== 'false'): ?>
            <div class="wp-arrow">
                <?php if($arrows !== 'false'): ?>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="icomoon icon-arrow-back-left- rtl-icon"></i></div>
                <?php endif; ?>
                <?php if($pagination !== 'false'): ?>
                    <div class="pxl-swiper-dots"></div>
                <?php endif; ?>
                <?php if($arrows !== 'false'): ?>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="icomoon icon-arrow-forward-ne1 rtl-icon"></i></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
