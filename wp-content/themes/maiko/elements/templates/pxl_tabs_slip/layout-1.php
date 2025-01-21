<?php 
$number = 1;
$html_id = pxl_get_element_id($settings); 
if(isset($settings['tabs']) && !empty($settings['tabs']) && count($settings['tabs'])): 
    $tab_bd_ids = [];
?>
<div class="pxl-tabs-slip pxl-tabs-slip1 <?php echo esc_attr($settings['style']); ?>" >
    <div class="pxl-tabs--content" style="width: 300%;">
        <nav class="anchor-nav" role="navigation">
          <?php foreach ($settings['tabs'] as $key => $content) : ?>
            <a href="<?php echo esc_attr('#tab-item-'.$key); ?>" class="anchor"><?php echo esc_html($key + 1); ?></a>
        <?php endforeach; ?>
    </nav>
    <?php foreach ($settings['tabs'] as $key => $content) : ?>
        <div id="<?php echo esc_attr('tab-item-'.$key); ?>" class="pxl-item--content pxl-item--content-<?php echo esc_attr($number++); ?>">
            <?php 
            $tab_content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$content['content_template']);
            $tab_bd_ids[] = (int)$content['content_template'];
            pxl_print_html($tab_content);
            ?>        
        </div>
    <?php endforeach; ?>
</div>
</div>
<?php endif; ?>