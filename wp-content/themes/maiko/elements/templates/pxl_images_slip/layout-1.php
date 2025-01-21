<?php 
$number = 1;
$img_size = isset($value['img_size']) ? $value['img_size'] : '780x580';
$html_id = pxl_get_element_id($settings); 
if(isset($settings['images']) && !empty($settings['images']) && count($settings['images'])): 
    ?>
<div class="pxl-images-slip pxl-images-slip1" >
    <div class="pxl-images--content">
        <?php foreach ($settings['images'] as $key => $value) :
            $image = isset($value['image']) ? $value['image'] : '';
            ?>
            <div id="<?php echo esc_attr($html_id.'-'.$value['_id']); ?>" class="pxl-item--content pxl-item--content-<?php echo esc_attr($number++); ?>">
               <?php if(!empty($image['id'])) { 
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $image['id'],
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
                ?>
                <div class="pxl-item--image ">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
            <?php } ?>
        </div>
    <?php endforeach; ?>
</div>
</div>
<?php endif; ?>