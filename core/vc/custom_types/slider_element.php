<?php

add_gt3_code( 'gt3_slide', 'gt3_slider_element', '');

function gt3_slider_element($settings, $value) {
  $img_url = get_template_directory_uri() . '/img/gt3_composer_addon/';
  $dependency = '';
  $uid = uniqid();
  $value = isset($value) ? $value : $settings['value'];
  $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
  $type = isset($settings['type']) ? $settings['type'] : '';
  $class = isset($settings['class']) ? $settings['class'] : '';

  $output = '<input type="hidden" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'" value="'.$value.'" id="trace-'.$uid.'"/>';
  $output .='<div id="gt3-slides-'.$uid.'" >';
  $output .= '<ul class="gt3-slides-list">';

  $tmp_values = json_decode(urldecode($value), true );
  foreach($tmp_values as $key => $cur_value) {
    if (!isset($cur_value['slide_url'])) $cur_value['slide_url'] = '';
    $output .= '<li>';
    if ($cur_value['slide_type'] == 'image') {
      $output .= "
      <div class='img-item vc-slide-item' data-type='image' data-url='".$cur_value['slide_url']."'>
        <div class='vc-img-preview '>
          <img alt='' src='" . esc_url(aq_resize(wp_get_attachment_url($cur_value['slide_url']), "150", "150", true, true, true)) . "'>
          <div class='hover-container'>
            <div class='inter_x_2'></div>
          </div>
        </div>
      </div>
      ";
    } else if ($cur_value['slide_type'] == 'video') {
      if (!isset($cur_value['slide_url'])) $cur_value['slide_url'] = '';
      if (!isset($cur_value['slide_title'])) $cur_value['slide_title'] = '';
      if (!isset($cur_value['slide_caption'])) $cur_value['slide_caption'] = '';
      if (!isset($cur_value['slide_cover'])) $cur_value['slide_cover'] = '';
      $cur_url     = isset($cur_value['slide_url']) ? $cur_value['slide_url'] : '';
      $cur_title   = isset($cur_value['slide_title']) ? $cur_value['slide_title'] : '';
      $cur_caption = isset($cur_value['slide_caption']) ? $cur_value['slide_caption'] : '';
      $cur_cover   = isset($cur_value['slide_cover']) ? $cur_value['slide_cover'] : '';

      $output .= "
      <div class='video-item vc-slide-item' data-type='video' data-url='".$cur_url."' data-title='".$cur_title."' data-caption='".$cur_caption."' data-cover='".$cur_cover."'>
        <div class='vc-img-preview '>
          <img alt='' src='".$img_url."video_item.png'>
          <div class='hover-container'>
            <div class='inter_x_2'></div>
            <div class='inter_edit_2'></div>
          </div>
        </div>
      </div>
      ";
    }
    $output .= '</li>';
  }
  $output .='</ul>';
  $output .= '<div class="slides-divider"></div>';
  $output .= '<div class="vc-add-slide-image"><div class="inner"></div></div>';
  $output .= '<div class="vc-add-slide-video"><div class="inner"></div></div>';
  $output .='</div>';
  

  $output .= '<script type="text/javascript">
    gt3_update_slider_value(jQuery(".gt3-slides-list"));

    jQuery(".gt3-slides-list").sortable({ 
      placeholder:"ui-state-highlight", 
      handle:".vc-slide-item",
      update: function(event, ui) {
        gt3_update_slider_value(jQuery(event.target));
      }
    });
  </script>';

  $output .= '<style type="text/css">';
  $output .= '
    .gt3-slides-list {
      width: 100%;
      padding: 15px 8px 11px 14px;
      margin-bottom: 15px;
      border: 1px solid #bbb;
      box-sizing: border-box;
      min-height: 50px;
    }

    .gt3-slides-list::after {
      display: block;
      content: "";
      width: 0;
      height: 0;
      clear: both;
    }

    .gt3-slides-list > li {
      display: inline-block;
      position: relative;
      margin-right: 5px;
      margin-bottom: 5px;
      float: left;
    }

    .gt3-slides-list .vc-slide-item {
      cursor: pointer;
    }

    .vc-img-preview {
      width: 76px;
      height: 76px;
    }

    .vc-img-preview img {
      width: 100%;
      height: auto;
    }

    .vc-add-slide-image,
    .vc-add-slide-video {
      display: inline-block;
      margin: 6px 4px;
    }
    .vc-add-slide-image .inner,
    .vc-add-slide-video .inner {
      height: 66px;
      position: relative;
      width: 66px;
      border: #bbbbbb 1px solid;
      border-radius: 2px;
      cursor: pointer;
    }
    .vc-add-slide-image .inner {
      background: url('.$img_url.'btn_add_img.png'.') no-repeat top;
    }

    .vc-add-slide-video .inner {
      background: url('.$img_url.'btn_add_video.png'.') no-repeat top;
    }

    .vc-add-slide-image .inner:hover,
    .vc-add-slide-video .inner:hover {
      background-position-y: -63px;
    }

    .gt3-slides-list .hover-container {
      position: absolute;
      top: 26px;
      left: 0px;
    }

    .gt3-slides-list .hover-container .inter_x_2 {
      display: none;
      border-radius: 2px;
      box-shadow: 0 0 4px #4b4b4b;
      background-color: #ffffff !important;
      background: url('.$img_url.'inter_x.png'.') no-repeat scroll 0 0 transparent;
      height: 28px;
      top: 0px;
      left: 8px;
      position: absolute;
      width: 28px;
      cursor: pointer;
    }

    .gt3-slides-list .img-item .hover-container .inter_x_2 {
      left: 24px;
    }

    .gt3-slides-list .hover-container .inter_edit_2 {
      display: none;
      border-radius: 2px;
      box-shadow: 0 0 4px #4b4b4b;
      background-color: #ffffff !important;
      background: url('.$img_url.'inter_edit.png'.') no-repeat scroll 0 0 transparent;
      height: 28px;
      top: 0px;
      left: 42px;
      position: absolute;
      width: 28px;
      cursor: pointer;
    }

    .gt3-slides-list > li:hover .hover-container .inter_x_2,
    .gt3-slides-list > li:hover .hover-container .inter_edit_2 {
      display: block;
    }

    .gt3-slides-list .ui-state-highlight {
      border: 2px #cccccc dashed;
      width: 76px;
      height: 76px;
      margin-bottom: 5px;
      background: #ffffff;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      float: left;
    }

    .vc-video-popup {
      border: 1px solid #bbb;
      padding: 15px 15px 5px;
      margin-bottom: 15px;
    }

    .vc-video-popup input[type="button"] {
      width: auto;
      color: #fff;
      background-color: #bcbcbc;
      border-radius: 3px;
      -webkit-border-radius: 3px;
      display: inline-block;
      margin: 0;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      box-sizing: border-box;
      word-wrap: break-word;
      user-select: none;
      text-decoration: none;
      position: relative;
      -webkit-transition-property: color,background,border,opacity,-webkit-transform;
      transition-property: color,background,border,opacity,transform;
      transition-duration: .2s;
      transition-timing-function: ease-in-out;
      font-weight: 400;
      font-size: 14px;
      padding: 10px 15px;
      border: 1px solid transparent;
      min-width: 120px;
      outline: none;
      margin-bottom: 10px;
      margin-right: 4px;
    }

    .vc-video-popup input[type="button"]:hover {
      background-color: #afafaf;
    }

    .vc-video-popup input[name="select_image"] {
      display: block;
    }

    .vc-video-popup input[name="save_vc_video_popup"],
    .vc-video-popup input[name="save_vc_edit_video_popup"] {
      background-color: #305288;
    }

    .vc-video-popup input[name="save_vc_video_popup"]:hover,
    .vc-video-popup input[name="save_vc_edit_video_popup"]:hover {
      background-color: #2c4b7d;
    }

    .video-image-preview {
      margin-bottom: 10px;
      width: 76px;
      height: 76px;
      border: 1px solid #bbb;
      cursor: pointer;
    }

    .video-image-preview img {
      width: 100%;
      height: auto;
    }
    
    ';
  $output .= '</style>';
  return $output;
}

?>