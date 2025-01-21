<?php 
$number = 1;
$html_id = pxl_get_element_id($settings); 
$list_text = [];

if (!empty($settings['texts'])): 
    foreach ($settings['texts'] as $key => $value):
        $btn_text = $value['text'] ?? '';
        if (!empty($btn_text)) {
            $chars = preg_split('//u', $btn_text, -1, PREG_SPLIT_NO_EMPTY);
            $list_text[] = $chars;
        }
    endforeach;

    $widget->add_render_attribute('lists_text', [
        'class' => 'pxl-texts-slip pxl-texts-slip1',
        'data-settings' => wp_json_encode($list_text)
    ]);
    ?>
    <div <?php pxl_print_html($widget->get_render_attribute_string('lists_text')); ?> >
        <div class="pxl-texts--content">
        </div>
    </div>
<?php endif; ?>
