<?php

add_gt3_code( 'gt3_dropdown', 'gt3_image_select', '');

function gt3_image_select($settings, $value) {
    $dependency = '';
    $uid = uniqid();
    $fields = isset($settings['fields']) ? $settings['fields'] : '';
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';

    $output = '<input type="hidden" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.' '.$value.'" value="'.$value.'" id="trace-'.$uid.'"/>';

    $output .='<div id="gt3-icon-'.$uid.'" >';
    foreach($fields as $field_name => $field_value) {
        $output .= '<label class="'.($field_name == $value ? 'selected' : '').'""><img class="current-field-image" src="' . $field_value['image'] . '" alt="'. esc_html__('selected image', 'sohopro').'"/><input type="radio" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'" value="'.$field_name.'" style="display:none;"/><span>' . $field_value['descr'] . '</span></label>';
    }
    $output .='</div>';

    $output .= '<script type="text/javascript">

            jQuery("#gt3-icon-'.$uid.' label").on("click", function() {
                jQuery(this).attr("class","selected").siblings().removeAttr("class");
                var cur_src = jQuery(this).find("img").attr("src"),
                    prev_value = jQuery("#trace-'.$uid.'").val(),
                    cur_value = jQuery(this).find("input").attr("value");
                jQuery("#trace-'.$uid.'").val(cur_value).removeClass(prev_value).addClass(cur_value);
            });
    </script>';
    $output .= '<style type="text/css">';
    $output .= '
        #gt3-icon-'.$uid.' label{
            position: relative;
            z-index: 1;
            display: inline-block;
            padding: 5px;
            margin: 5px;
        }
        #gt3-icon-'.$uid.' label>* {
            display: block;
            text-align: center;
            margin: 0 auto;
        }
        #gt3-icon-'.$uid.' label.selected:before {
            content: "";
            display: block;
            position: absolute;
            z-index: -1;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 174, 240, 0.5);
        }
        ';
    $output .= '</style>';
    return $output;
}

?>