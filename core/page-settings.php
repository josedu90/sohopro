<?php

#REGISTER PAGE BUILDER
function gt3_page_settings($post)
{
    $gt3_theme_pagebuilder = gt3pb_get_plugin_pagebuilder($post->ID);
    if (!is_array($gt3_theme_pagebuilder)) {
        $gt3_theme_pagebuilder = array();
    }
    $now_post_type = get_post_type();
	
	#get all sidebars
    $media_for_this_post = gt3pb_get_media_for_this_post(get_the_ID());
		$js_for_pb = "
		<script>
			var post_id = " . get_the_ID() . ";
			var show_img_media_library_page = 1;
		</script>";
	
		echo (($js_for_pb));
		echo "
	<!-- popup background -->
	<div class='popup-bg'></div>
	<div class='waiting-bg'><div class='waiting-bg-img'></div></div>
	";

	#SUBTITLE AREA
	if ($now_post_type == "page" && get_page_template_slug() !== "page-coming-soon.php") {
		echo "
            <!-- SUBTITLE SETTINGS -->
            <div class='padding-cont pt_" . $now_post_type . " pt20 pb20'>
                <div class='strip_cont gt3settings_box'>
                    <div class='gt3settings_box_title'><h2>" . esc_html__('Page Options', 'sohopro') . "</h2></div>
                    <div class='gt3settings_box_content'>
                        <div class='boxed_options no_boxed'>
							<div class='subtitle_area pb10 pt10'>
								<h2>" . esc_html__('Page Sub-Title:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[page_settings][subtitle]' value='" . (isset($gt3_theme_pagebuilder['page_settings']['subtitle']) ? esc_attr($gt3_theme_pagebuilder['page_settings']['subtitle']) : '') . "'>
							</div>
							<div class='subtitle_area pb10 pt10'>
								<h2>" . esc_html__('Footer State:', 'sohopro') . "</h2>
								<select name='pagebuilder[page_settings][footer_state]' class='admin_newselect selectBox' style='width:200px;'>";
									$select_slider_type = array("show" => "Show", "hide" => "Hide");
									foreach ($select_slider_type as $var_data => $var_caption) {
										echo "<option " . ((isset($gt3_theme_pagebuilder['page_settings']['footer_state']) && $gt3_theme_pagebuilder['page_settings']['footer_state'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
									}
				echo "
								</select>
							</div>
                        </div><!-- boxed_options no_boxed -->
                    </div><!-- gt3settings_box_content -->
                </div><!-- strip_cont gt3settings_box landing -->
            </div><!-- padding-cont -->
            <!-- END SETTINGS -->
        ";
	}
	
	#COUNTDOWN TEMPLATE
    if ($now_post_type == "page" && get_page_template_slug() == "page-coming-soon.php") {

        echo "
            <!-- COMING SOON SETTINGS -->
            <div class='padding-cont pt_" . $now_post_type . " pt20 pb20'>
                <div class='strip_cont gt3settings_box countdown'>
                    <div class='gt3settings_box_title'><h2>" . esc_html__('Page Options', 'sohopro') . "</h2></div>
                    <div class='gt3settings_box_content'>                        
                        <h2 style='font-size:13px;'>" . esc_html__('Background Options:', 'sohopro') . "</h2>
                        <div class='boxed_options no_boxed'>
                            <input type='hidden' class='custom_select_img_attachid' name='pagebuilder[page_settings][page_layout][img][attachid]' value='".(isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']) ? $gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'] : '')."'>
                            <div class='custom_select_img_preview' style='width: 25%;'>";
								if (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'])) {
									$img_attachment = wp_get_attachment_image_src( $gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'], "large" );
									if ($img_attachment[0] == '') {
									} else {
										echo "<img style='width: 100%;' src='".$img_attachment[0]."' alt=''>";
									}
								}
								echo "
                            </div>
                            <div>
                                <div class='add_image_from_wordpress_library_popup'>" . esc_html__('Add Image', 'sohopro') . "</div>
                            </div>
                            <div class='clear pb20'></div>
                            <hr class='date_hr'>
							<div class='subtitle_area pb20'>
								<h2>" . esc_html__('Counter Title:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[countdown][count_title]' value='" . (isset($gt3_theme_pagebuilder['countdown']['count_title']) ? esc_attr($gt3_theme_pagebuilder['countdown']['count_title']) : "") . "'>
							</div>
                            <div class='subtitle_area pb20'>
								<h2>" . esc_html__('Shortcode Title:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[countdown][shortcode_title]' value='" . (isset($gt3_theme_pagebuilder['countdown']['shortcode_title']) ? esc_attr($gt3_theme_pagebuilder['countdown']['shortcode_title']) : "") . "'>
                            </div>
                            <hr class='date_hr'>
                            <div class='fs_fit_select pb20'>
                                <h2>" . esc_html__('Enter Date:', 'sohopro') . "</h2>
                                <input type='text' placeholder='". esc_html__('Enter year. Ex.:2020', 'sohopro') ."' class='medium textoption type1 date_input' name='pagebuilder[countdown][year]' value='" . (isset($gt3_theme_pagebuilder['countdown']['year']) ? esc_attr($gt3_theme_pagebuilder['countdown']['year']) : "") . "'>
                                <input type='text' placeholder='". esc_html__('Enter day. Ex.:27', 'sohopro') ."' class='medium textoption type1 date_input' name='pagebuilder[countdown][day]' value='" . (isset($gt3_theme_pagebuilder['countdown']['day']) ? esc_attr($gt3_theme_pagebuilder['countdown']['day']) : "") . "'>
                                <input type='text' placeholder='". esc_html__('Enter month. Ex.:11', 'sohopro') ."' class='medium textoption type1 date_input' name='pagebuilder[countdown][month]' value='" . (isset($gt3_theme_pagebuilder['countdown']['month']) ? esc_attr($gt3_theme_pagebuilder['countdown']['month']) : "") . "'>
                            </div>
                            <hr class='date_hr'>
                            <h2>" . esc_html__('Form Shortcode:', 'sohopro') . "</h2>
                            <input type='text' class='medium textoption type1' name='pagebuilder[countdown][shortcode]' value='" . (isset($gt3_theme_pagebuilder['countdown']['shortcode']) ? esc_attr($gt3_theme_pagebuilder['countdown']['shortcode']) : "") . "'>                            
                        </div><!-- boxed_options no_boxed -->
                    </div><!-- gt3settings_box_content -->
                </div><!-- strip_cont gt3settings_box countdown -->
            </div><!-- padding-cont -->
            <!-- END SETTINGS -->
            <style>
                .composer-switch, #postdivrich, #postimagediv, #side_sidebar_settings_meta_box, #page_subtitle, #side_bg_settings_meta_box, .edit-form-section {
                    display: none!important;
                }
            </style>
        ";
    }

    #GALLERY AREA
    if ($now_post_type == "gallery") {
        echo "
        <!-- SLIDER SETTINGS -->
		
		<div class='page_settings_box_wrapper padding-cont pt_" . $now_post_type . " pt20'>		
			<!-- SELECT SLIDER OPTION -->
			<div class='page_settings_box gt3settings_box ribbon_settings'>
				<div class='gt3settings_box_title'>
					<h2>" . esc_html__('Gallery Type', 'sohopro') . "</h2>
				</div>
				<div class='gt3settings_box_content'>
					<div class='boxed_options no_boxed'>
						<div class='padding-cont fullscreen_slider_settings'>
							<div class='fs_fit_select'>
								<select name='pagebuilder[sliders][fullscreen][slider_type]' class='strip_select select_gallery_type'>";
									$select_slider_type = array(
														"fs_slider" => "Fullscreen Slider", 
														"ribbon" => "Ribbon Slider", 
														"flow" => "Flow Slider", 
														"grid" => "Grid/Masonry Gallery", 
														"packery" => "Packery Gallery");
									foreach ($select_slider_type as $var_data => $var_caption) {
										echo "<option " . ((isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slider_type']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['slider_type'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
									}
				echo "
								</select>
							</div>
						</div>						
					</div>
				</div>				
			</div>
		</div>
		
		<div class='page_settings_box_wrapper padding-cont pt_" . $now_post_type . " pt20'>		
			
			<!-- RIBBON OPTIONS  -->
			<div class='page_settings_box gt3settings_box gallery_type_settings gallery_type_ribbon'>
				<div class='gt3settings_box_title'>
					<h2>" . esc_html__('Slider Settings', 'sohopro') . "</h2>
				</div>
				<div class='gt3settings_box_content'>
					<div class='boxed_options no_boxed'>
						<div class='padding-cont fullscreen_slider_settings'>
							<div class='caption gt3_galsettings_left'>
								<h2>" . __('Autoplay:', 'sohopro') . "</h2>
							</div>
							<div class='radio_selector gt3_galsettings_right'>
								" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][ribbon][autoplay]', (isset($gt3_theme_pagebuilder['sliders']['ribbon']['autoplay']) ? $gt3_theme_pagebuilder['sliders']['ribbon']['autoplay'] : ''), 'on') . "
							</div>
							<div class='clear'></div>
							<br />

							<div class='caption gt3_galsettings_left'>
								<h2>" . __('Title State:', 'sohopro') . "</h2>
							</div>
							<div class='radio_selector gt3_galsettings_right'>
								" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][ribbon][title_state]', (isset($gt3_theme_pagebuilder['sliders']['ribbon']['title_state']) ? $gt3_theme_pagebuilder['sliders']['ribbon']['title_state'] : ''), 'on') . "
							</div>
							<div class='clear'></div>
							<br />

							<div class='caption gt3_galsettings_left'>
								<h2 style='display:inline-block'>" . __('Padding Around Items in PX:', 'sohopro') . "</h2>
							</div>
							<div class='gt3_galsettings_right'>
								<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][ribbon][items_padding]' value='" . (isset($gt3_theme_pagebuilder['sliders']['ribbon']['items_padding']) ? absint($gt3_theme_pagebuilder['sliders']['ribbon']['items_padding']) : "0") . "'>
							</div>
							<div class='clear'></div>
							<br />
															
							<div class='caption gt3_galsettings_left'>
								<h2 style='display:inline-block'>" . __('Slide Interval In Milliseconds:', 'sohopro') . "</h2>
							</div>
							<div class='gt3_galsettings_right'>
								<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][ribbon][interval]' value='" . (isset($gt3_theme_pagebuilder['sliders']['ribbon']['interval']) ? absint($gt3_theme_pagebuilder['sliders']['ribbon']['interval']) : "4000") . "'>
							</div>
							<div class='clear'></div>
							<br />

							<div class='caption gt3_galsettings_left'>
								<h2 style='display:inline-block'>" . __('Slide Transition In Milliseconds:', 'sohopro') . "</h2>
							</div>
							<div class='gt3_galsettings_right'>
								<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][ribbon][transition_time]' value='" . (isset($gt3_theme_pagebuilder['sliders']['ribbon']['transition_time']) ? absint($gt3_theme_pagebuilder['sliders']['ribbon']['transition_time']) : "1000") . "'>
							</div>
							<div class='clear'></div>
							<br>
														
						</div>						
					</div>
				</div>				
			</div>

			<!-- FS SLIDER OPTIONS  -->
			<div class='page_settings_box gt3settings_box gallery_type_settings gallery_type_fs_slider'>
				<div class='gt3settings_box_title'>
					<h2>" . esc_html__('Slider Settings', 'sohopro') . "</h2>
				</div>
				<div class='gt3settings_box_content'>
					<div class='boxed_options no_boxed'>
					
						<div class='padding-cont fullscreen_slider_settings'>
							<div class=''>						
								<div class='gt3_galsettings_left'>
									<h2 style='width: 194px;'>" . __('Fit Style:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<select name='pagebuilder[sliders][fullscreen][fit_style]' class='strip_select'>";
										$fs_fit_style = array("no_fit" => "Cover Slide", "fit_always" => "Fit Always", "fit_width" => "Fit Horizontal", "fit_height" => "Fit Vertical");
										foreach ($fs_fit_style as $var_data => $var_caption) {
											echo "<option " . ((isset($gt3_theme_pagebuilder['sliders']['fullscreen']['fit_style']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['fit_style'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
										}
					echo "
									</select>
								</div>
								<div class='clear'></div>
								<br />

								<div class='gt3_galsettings_left'>
									<h2 style='width: 194px;'>" . __('Animation Style:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<select name='pagebuilder[sliders][fullscreen][anim_style]' class='strip_select'>";
										$fs_anim_style = array("fade" => "Fade In/Out", "slip" => "Slip in Side");
										foreach ($fs_anim_style as $var_data => $var_caption) {
											echo "<option " . ((isset($gt3_theme_pagebuilder['sliders']['fullscreen']['anim_style']) && $gt3_theme_pagebuilder['sliders']['fullscreen']['anim_style'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
										}
					echo "
									</select>
								</div>
								<div class='clear'></div>
								<br />

								<div class='gt3_galsettings_left'>
									<h2>" . __('Cover Video Slides:', 'sohopro') . "</h2>
								</div>
								<div class='radio_selector gt3_galsettings_right'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][fullscreen][video_cover]', (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover']) ? $gt3_theme_pagebuilder['sliders']['fullscreen']['video_cover'] : ''), 'on') . "
								</div>
								<div class='clear'></div>
								<br />
																
								<div class='gt3_galsettings_left'>
									<h2>" . __('Show Controls & Titles:', 'sohopro') . "</h2>
								</div>
								<div class='radio_selector gt3_galsettings_right'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][fullscreen][controls]', (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['controls']) ? $gt3_theme_pagebuilder['sliders']['fullscreen']['controls'] : ''), 'on') . "
								</div>
								<div class='clear'></div>
								<br />

								<div class='caption gt3_galsettings_left'>
									<h2>" . __('Show Thumbs:', 'sohopro') . "</h2>
								</div>
								<div class='radio_selector gt3_galsettings_right'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][fullscreen][thumbs]', (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs']) ? $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbs'] : ''), 'on') . "
								</div>
								<div class='clear'></div>
								<br />
	
								<div class='gt3_galsettings_left'>
									<h2>" . __('Autoplay:', 'sohopro') . "</h2>
								</div>
								<div class='radio_selector gt3_galsettings_right'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][fullscreen][autoplay]', (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay']) ? $gt3_theme_pagebuilder['sliders']['fullscreen']['autoplay'] : ''), 'on') . "
								</div>
								<div class='clear'></div>
								<br />
																
								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Slide Interval In Milliseconds:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][fullscreen][interval]' value='" . (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['interval']) ? absint($gt3_theme_pagebuilder['sliders']['fullscreen']['interval']) : "4000") . "'>
								</div>
								<div class='clear'></div>
								<br />
				
								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Slide Transition In Milliseconds:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][fullscreen][transition_time]' value='" . (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['transition_time']) ? absint($gt3_theme_pagebuilder['sliders']['fullscreen']['transition_time']) : "1000") . "'>
								</div>
								<div class='clear'></div>
								<br>

							</div><!-- .radio_block -->
						</div><!-- .fullscreen_slider_settings -->
														
					</div><!-- boxed_options no_boxed -->
				</div><!-- gt3settings_box_content -->
			</div><!-- strip_cont gt3settings_box slider -->
			
			<!-- GRID OPTIONS  -->
			<div class='page_settings_box gt3settings_box gallery_type_settings gallery_type_grid'>
				<div class='gt3settings_box_title'>
					<h2>" . esc_html__('Gallery Settings', 'sohopro') . "</h2>
				</div>
				<div class='gt3settings_box_content'>
					<div class='boxed_options no_boxed'>
						<div class='padding-cont fullscreen_slider_settings'>
							<div class=''>
								<div class='caption gt3_galsettings_left'>
									<h2>" . __('Masonry:', 'sohopro') . "</h2>
								</div>
								<div class='radio_selector gt3_galsettings_right'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][grid][masonry]', (isset($gt3_theme_pagebuilder['sliders']['grid']['masonry']) ? $gt3_theme_pagebuilder['sliders']['grid']['masonry'] : ''), 'on') . "
								</div>
								<div class='clear'></div>
								<br />

								<div class='caption gt3_galsettings_left'>
									<h2>" . __('Items in Row:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<select name='pagebuilder[sliders][grid][items_in_row]' class='strip_select'>";
										$fs_anim_style = array("1" => "1 Item", "2" => "2 Items", "3" => "3 Items", "4" => "4 Items", "5" => "5 Items", "6" => "6 Items");
										foreach ($fs_anim_style as $var_data => $var_caption) {
											echo "<option " . ((isset($gt3_theme_pagebuilder['sliders']['grid']['items_in_row']) && $gt3_theme_pagebuilder['sliders']['grid']['items_in_row'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
										}
					echo "
									</select>
								</div>
								<div class='clear'></div>
								<br>

								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Items on Start:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][grid][items_on_start]' value='" . (isset($gt3_theme_pagebuilder['sliders']['grid']['items_on_start']) ? absint($gt3_theme_pagebuilder['sliders']['grid']['items_on_start']) : "12") . "'>
								</div>
								<div class='clear'></div>
								<br>

								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Items per Load:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][grid][items_per_load]' value='" . (isset($gt3_theme_pagebuilder['sliders']['grid']['items_per_load']) ? absint($gt3_theme_pagebuilder['sliders']['grid']['items_per_load']) : "4") . "'>
								</div>
								<div class='clear'></div>
								<br>
					
								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Padding around Items:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][grid][items_padding]' value='" . (isset($gt3_theme_pagebuilder['sliders']['grid']['items_padding']) ? $gt3_theme_pagebuilder['sliders']['grid']['items_padding'] : "30px") . "'>
								</div>
								<div class='clear'></div>
								<br>

								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Load More Button Text:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][grid][button_title]' value='" . (isset($gt3_theme_pagebuilder['sliders']['grid']['button_title']) ? $gt3_theme_pagebuilder['sliders']['grid']['button_title'] :  __('Load More', 'sohopro')) . "'>
								</div>
								<div class='clear'></div>
								<br>

							</div><!-- .radio_block -->
						</div><!-- .fullscreen_slider_settings -->
														
					</div><!-- boxed_options no_boxed -->
				</div><!-- gt3settings_box_content -->
			</div><!-- strip_cont gt3settings_box slider -->

			
			<!-- PACKERY OPTIONS  -->
			<div class='page_settings_box gt3settings_box gallery_type_settings gallery_type_packery'>
				<div class='gt3settings_box_title'>
					<h2>" . esc_html__('Gallery Settings', 'sohopro') . "</h2>
				</div>
				<div class='gt3settings_box_content'>
					<div class='boxed_options no_boxed'>
						<div class='padding-cont fullscreen_slider_settings'>
							<div class=''>
			
								<div class='caption gt3_galsettings_none'>
									<h2>" . __('Select Layout:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_packery_ls' style='display:inline-block; vertical-align:middle;'>
									<div class='gt3_packery_ls_cont gt3_packery_ls_cont_builder' data-value='pls_4items'>
										<input name='pagebuilder[sliders][packery][layout]' class='gt3_packery_ls_value' value='" . (isset($gt3_theme_pagebuilder['sliders']['packery']['layout']) ? $gt3_theme_pagebuilder['sliders']['packery']['layout'] : "pls_4items") . "' type='hidden'>
										<div class='gt3_packery_ls_item gt3_packery_ls_item3 pls_3items' data-value='pls_3items'></div>
										<div class='gt3_packery_ls_item gt3_packery_ls_item4 pls_4items' data-value='pls_4items'></div>
										<div class='gt3_packery_ls_item gt3_packery_ls_item5 pls_5items' data-value='pls_5items'></div>
										<div class='gt3_packery_ls_item gt3_packery_ls_item6 pls_6items' data-value='pls_6items'></div>
									</div>
								</div>
								<div class='clear'></div>
								<br />
					
								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Layouts on Start:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][packery][on_start]' value='" . (isset($gt3_theme_pagebuilder['sliders']['packery']['on_start']) ? absint($gt3_theme_pagebuilder['sliders']['packery']['on_start']) : "1") . "'>
								</div>
								<div class='clear'></div>
								<br>
					
								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Layouts per Load:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][packery][per_load]' value='" . (isset($gt3_theme_pagebuilder['sliders']['packery']['per_load']) ? absint($gt3_theme_pagebuilder['sliders']['packery']['per_load']) : "1") . "'>
								</div>
								<div class='clear'></div>
								<br>
					
								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Padding around Items:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][packery][items_padding]' value='" . (isset($gt3_theme_pagebuilder['sliders']['packery']['items_padding']) ? $gt3_theme_pagebuilder['sliders']['packery']['items_padding'] : "30px") . "'>
								</div>
								<div class='clear'></div>
								<br>
					
								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Load More Button Text:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][packery][button_title]' value='" . (isset($gt3_theme_pagebuilder['sliders']['packery']['button_title']) ? $gt3_theme_pagebuilder['sliders']['packery']['button_title'] :  __('Load More', 'sohopro')) . "'>
								</div>
								<div class='clear'></div>
								<br>

							</div><!-- .radio_block -->
						</div><!-- .fullscreen_slider_settings -->
														
					</div><!-- boxed_options no_boxed -->
				</div><!-- gt3settings_box_content -->
			</div><!-- strip_cont gt3settings_box slider -->


			<!-- FLOW OPTIONS  -->
			<div class='page_settings_box gt3settings_box gallery_type_settings gallery_type_flow'>
				<div class='gt3settings_box_title'>
					<h2>" . esc_html__('Slider Settings', 'sohopro') . "</h2>
				</div>
				<div class='gt3settings_box_content'>
					<div class='boxed_options no_boxed'>
						<div class='padding-cont fullscreen_slider_settings'>
							<div class=''>

								<div class='caption gt3_galsettings_left'>
									<h2>" . __('Lightbox:', 'sohopro') . "</h2>
								</div>
								<div class='radio_selector gt3_galsettings_right'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][flow][lightbox]', (isset($gt3_theme_pagebuilder['sliders']['flow']['lightbox']) ? $gt3_theme_pagebuilder['sliders']['flow']['lightbox'] : ''), 'on') . "
								</div>
								<div class='clear'></div>
								<br />
						
								<div class='caption gt3_galsettings_left'>
									<h2>" . __('Show Title & Caption:', 'sohopro') . "</h2>
								</div>
								<div class='radio_selector gt3_galsettings_right'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][flow][title_state]', (isset($gt3_theme_pagebuilder['sliders']['flow']['title_state']) ? $gt3_theme_pagebuilder['sliders']['flow']['title_state'] : ''), 'on') . "
								</div>
								<div class='clear'></div>
								<br />
	
								<div class='caption gt3_galsettings_left'>
									<h2>" . __('Autoplay:', 'sohopro') . "</h2>
								</div>
								<div class='radio_selector gt3_galsettings_right'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[sliders][flow][autoplay]', (isset($gt3_theme_pagebuilder['sliders']['flow']['autoplay']) ? $gt3_theme_pagebuilder['sliders']['flow']['autoplay'] : ''), 'on') . "
								</div>
								<div class='clear'></div>
								<br />
																
								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Slide Interval In Milliseconds:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][flow][interval]' value='" . (isset($gt3_theme_pagebuilder['sliders']['flow']['interval']) ? absint($gt3_theme_pagebuilder['sliders']['flow']['interval']) : "4000") . "'>
								</div>
								<div class='clear'></div>
								<br>

								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Slide Transition In Milliseconds:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][flow][transition_time]' value='" . (isset($gt3_theme_pagebuilder['sliders']['flow']['transition_time']) ? absint($gt3_theme_pagebuilder['sliders']['flow']['transition_time']) : "600") . "'>
								</div>
								<div class='clear'></div>
								<br>

								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Slider Image Width:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][flow][img_width]' value='" . (isset($gt3_theme_pagebuilder['sliders']['flow']['img_width']) ? absint($gt3_theme_pagebuilder['sliders']['flow']['img_width']) : "1383") . "'>
								</div>
								<div class='clear'></div>
								<br>							

								<div class='caption gt3_galsettings_left'>
									<h2 style='display:inline-block'>" . __('Slider Image Height:', 'sohopro') . "</h2>
								</div>
								<div class='gt3_galsettings_right'>
									<input type='text' class='medium textoption type1 slider_interval_input' name='pagebuilder[sliders][flow][img_height]' value='" . (isset($gt3_theme_pagebuilder['sliders']['flow']['img_height']) ? absint($gt3_theme_pagebuilder['sliders']['flow']['img_height']) : "1000") . "'>
								</div>
								<div class='clear'></div>
								<br>							

							</div><!-- .radio_block -->
						</div><!-- .fullscreen_slider_settings -->
														
					</div><!-- boxed_options no_boxed -->
				</div><!-- gt3settings_box_content -->
			</div><!-- strip_cont gt3settings_box slider -->

			<!-- END SLIDER TYPES -->						
		</div>
                <div class='padding-cont  stand-s pt_" . esc_attr($now_post_type) . "'>
                    <div class='bg_or_slider_option slider_type active'>
                        <input type='hidden' name='settings_type' value='fullscreen' class='settings_type'>
                        <div class='hideable-area'>
                            <div class='padding-cont help text-shadow2'></div>
                            <div class='padding-cont'>
                                <div class='selected_media'>
                                    <div class='append_block'>
                                         <ul class='sortable-img-items'>
                                           " . gt3_get_slider_items("fullscreen", (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) ? $gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] : '')) . "
                                         </ul>
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='hr_double style2'></div>
                            <div class='padding-cont gt3_pb20 gt3_mt20'>
								<div class='gt3settings_box no-margin'>
									<div class='gt3settings_box_title'><h2>" . esc_html__('Select media', 'sohopro') . "</h2></div>
									<div class='gt3settings_box_content'>
										<div class='available_media'>
											<div class='ajax_cont'>
												" . gt3_get_media_html($media_for_this_post, "small") . "
											</div>
											<div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
												<div class='img-preview'>
												</div>
											</div><!-- .img-item -->
											<div class='img-item style_small add_video_slider'>
												<div class='img-preview'>
													<div class='previmg' data-full-url='" . get_template_directory_uri() . "/core/admin/img/video_item.png'></div>
												</div>
											</div><!-- .img-item -->
											<div class='clear'></div>
										</div>
									</div>
								</div>
                            </div>
                            <div class='hr_double style2'></div>
                            <div class='padding-cont'>
                                <div class='radio_block'>
                                    <div class='gt3_w190 caption'><h2 class='text-shadow2 gt3_color-a1a1a1'>" . esc_html__('show thumbnails', 'sohopro') . "</h2></div>
                                    <div class='radio_selector'>
                                        " . gt3pb_toggle_radio_on_off('pagebuilder[sliders][fullscreen][thumbnails]', (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['thumbnails']) ? $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbnails'] : ''), 'on') . "
                                    </div>
                                    <div class='help_here help text-shadow2'>
                                        &nbsp;
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SETTINGS -->";
    }
	
#POSTFORMATS FOR POST (PORTFOLIO). VISIBLE ONLY ON GT3 THEMES.
    if ($now_post_type == "post" || $now_post_type == "port") {
        echo "
		<div class='pb-cont page-settings-container'>
			<div class='pb10'>
				<div class='hideable-content'>
					<div class='post-formats-container'>
						<!-- Video post format -->
						<div id='video_sectionid_inner'>
							<h2>Post Format Video URL:</h2>
							<input type='text' class='medium textoption type1' name='pagebuilder[post-formats][videourl]' value='" . (isset($gt3_theme_pagebuilder['post-formats']['videourl']) ? $gt3_theme_pagebuilder['post-formats']['videourl'] : "") . "'>
							<div class='example'>Examples:<br>Youtube - http://www.youtube.com/watch?v=6v2L2UGZJAM<br>Vimeo - http://vimeo.com/47989207</div>";
						echo "</div>";
						if ($now_post_type == "post") {
							echo "
						<!-- Audio post format -->
						<div id='audio_sectionid_inner'>
							<h2>Post Format Audio Code:</h2>";
							echo '<textarea class="enter_text1 audio_textarea" name="pagebuilder[post-formats][audiourl]">' . (isset($gt3_theme_pagebuilder['post-formats']['audiourl']) ? $gt3_theme_pagebuilder['post-formats']['audiourl'] : "") . '</textarea>';

							echo "
							<div class='example'>Examples:<br>
								&lt;iframe src='https://w.soundcloud.com/player/?url=https://api.soundcloud.com/tracks/141816093&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true' height='166'&gt;&lt;/iframe&gt;
							</div>
						</div>
		
						<!-- Link post format -->
						<div id='link_sectionid_inner'>
							<div class='video-pf'>
								<h2>" . esc_html__('Link Description:', 'sohopro') . "</h2>
								<textarea class='large textoption type1 audio_textarea' name='pagebuilder[post-formats][link_text]'>" . (isset($gt3_theme_pagebuilder['post-formats']['link_text']) ? $gt3_theme_pagebuilder['post-formats']['link_text'] : '') . "</textarea>
								<div class='clear'></div>
								<br>
								<h2 class='gt3_mb5'>" . esc_html__('Link Url:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[post-formats][linkurl]' value='" . (isset($gt3_theme_pagebuilder['post-formats']['linkurl']) ? $gt3_theme_pagebuilder['post-formats']['linkurl'] : "") . "'>
								<div class='clear'></div>
								<br>
								<div class='gt3_w190 caption'><h2 class='gt3_mb5'>" . esc_html__('Open in New Window:', 'sohopro') . "</h2></div>
								<div class='radio_selector'>
									" . gt3pb_toggle_radio_on_off('pagebuilder[countdown][logo]', (isset($gt3_theme_pagebuilder['countdown']['logo']) ? $gt3_theme_pagebuilder['countdown']['logo'] : ''), 'on') . "							
								</div>
							</div>
						</div>
						
						<!-- Quote post format -->
						<div id='quote_sectionid_inner'>
							<div class='portslides_sectionid_title'><h2>" . esc_html__('Quote Settings:', 'sohopro') . "</h2></div>
							<div class='video-pf'>
								<h2 class='gt3_mb5'>" . esc_html__('Quote Text:', 'sohopro') . "</h2>
								<textarea class='large textoption type1 audio_textarea' name='pagebuilder[post-formats][quote_text]'>" . (isset($gt3_theme_pagebuilder['post-formats']['quote_text']) ? $gt3_theme_pagebuilder['post-formats']['quote_text'] : '') . "</textarea>
								<div class='clear height10'></div>
								<h2 class='gt3_mb5'>" . esc_html__('Quote Author:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[post-formats][quote_author]' value='" . (isset($gt3_theme_pagebuilder['post-formats']['quote_author']) ? $gt3_theme_pagebuilder['post-formats']['quote_author'] : "") . "'>							
								<div class='clear'></div>
							</div>
						</div>
						";
						}
						echo "
						<!-- Image post format -->
						<div id='portslides_sectionid_inner'>
							<div class='portslides_sectionid_title'><h2>Slider Images</h2></div>
							<div class='selected-images-for-pf'>
								" . gt3pb_get_selected_pf_images_for_admin($gt3_theme_pagebuilder) . "
							</div>
							<hr class='img_seperator'>
							<div class='available-images-for-pf available_media'>
								<div class='ajax_cont'>
									" . gt3pb_get_media_html($media_for_this_post, "small") . "
								</div>
								<div class='for_post_fomrats img-item style_small add_image_to_sliders_available_media cboxElement'>
									<div class='img-preview'>
										<img alt='' src='" . THEMEROOTURL . "/core/admin/img/add_image.png'>
									</div>
								</div><!-- .img-item -->
							</div>
							<input type='hidden' name='settings_type' value='fullscreen' class='settings_type'>					
						</div>
					</div>
					<div class='clear'></div>
				</div>
			</div>
		</div>";
	}


	#POST AREA
	if ($now_post_type == "post") {
		echo "
			<div class='gt3settings_post_advanced_wrapper'>
				<div class='gt3settings_box gt3settings_post_advanced'>
					<div class='gt3settings_box_title'><h2>" . esc_html__('Advanced options', 'sohopro') . "</h2></div>
					<div class='gt3settings_box_content'>
						<div class='post_layout_option'>
							<h2 style='margin-bottom:10px'>" . esc_html__('Select Post Layout:', 'sohopro') . "</h2>
							<div class='fs_fit_select'>
								<select name='pagebuilder[page_settings][post_layout]' class='admin_newselect' style='width:250px;'>";
									$select_slider_type = array(
										"simple" => "Simple",
										"fullwidth" => "Fullwidth"
									);
									foreach ($select_slider_type as $var_data => $var_caption) {
										echo "<option " . ((isset($gt3_theme_pagebuilder['page_settings']['post_layout']) && $gt3_theme_pagebuilder['page_settings']['post_layout'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
									}
									echo "
								</select>							
							</div>
							<h2 style='margin:20px 0 10px 0'>" . esc_html__('Fullwidth Layout Height:', 'sohopro') . "</h2>
							<div class='fs_fit_select' style='width:250px'>
								<input type='text' class='medium textoption type1' name='pagebuilder[page_settings][post_pft_height]' value='" . (isset($gt3_theme_pagebuilder['page_settings']['post_pft_height']) ? $gt3_theme_pagebuilder['page_settings']['post_pft_height'] : "") . "'>							
							</div>
						</div>					
					</div>
				</div>
			</div>
            <!-- END SETTINGS -->";
	}

	#PORTFOLIO AREA
	if ($now_post_type == "port") {
		echo "
            <div class='page-settings-container pt_" . $now_post_type . "'>

				<div class='partners_cont gt3settings_box gt3settings_box2'>
					<div class='gt3settings_box_title'><h2>" . esc_html__('Advanced options', 'sohopro') . "</h2></div>
					<div class='gt3settings_box_content'>
						<div class='append_items'>
							<label for='work_link' class='label_type1'>" . esc_html__('Link to the work:', 'sohopro') . "</label><br><input type='text' value='" . (isset($gt3_theme_pagebuilder['page_settings']['port']['work_link']) ? esc_url($gt3_theme_pagebuilder['page_settings']['port']['work_link']) : '') . "' id='work_link' name='pagebuilder[page_settings][port][work_link]' class='work_link itt_type1'>
						</div>
						<hr>
						<br />
						<div class='gt3_galsettings_left'>
							<h2 style='width: 194px;'>" . __('Content Layout:', 'sohopro') . "</h2>
						</div>
						<div class='gt3_galsettings_right'>
							<select name='pagebuilder[port][layout]' class='strip_select'>";
								$port_option = array("simple" => "Simple", "half" => "Side by Side");
								foreach ($port_option as $var_data => $var_caption) {
									echo "<option " . ((isset($gt3_theme_pagebuilder['port']['layout']) && $gt3_theme_pagebuilder['port']['layout'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
								}
			echo "
							</select>
						</div>
						<div class='clear'></div>
						<br />

						<div class='gt3_galsettings_left'>
							<h2 style='width: 194px;'>" . __('Post Media State:', 'sohopro') . "</h2>
						</div>
						<div class='gt3_galsettings_right'>
							<select name='pagebuilder[port][media_state]' class='strip_select'>";
								$port_option = array("show" => "Show", "hide" => "Hide");
								foreach ($port_option as $var_data => $var_caption) {
									echo "<option " . ((isset($gt3_theme_pagebuilder['port']['media_state']) && $gt3_theme_pagebuilder['port']['media_state'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
								}
			echo "
							</select>
						</div>
						<div class='clear'></div>
						<br />

						<div class='gt3_galsettings_left'>
							<h2 style='width: 194px;'>" . __('Simple Media Height:', 'sohopro') . "</h2>
						</div>
						<div class='gt3_galsettings_right'>
							<input class='medium textoption type1 slider_interval_input' type='text' value='" . (isset($gt3_theme_pagebuilder['port']['media_height']) ? $gt3_theme_pagebuilder['port']['media_height'] : '555') . "' id='work_link' name='pagebuilder[port][media_height]'>						
							<div class='gt3_option_hint'>" . __('For Simple layout only', 'sohopro') . "</div>
						</div>
						<div class='clear'></div>
						<br>

						<div class='gt3_galsettings_left'>
							<h2 style='width: 194px;'>" . __('Content Position:', 'sohopro') . "</h2>
						</div>
						<div class='gt3_galsettings_right'>
							<select name='pagebuilder[port][content_position]' class='strip_select'>";
								$port_option = array("right" => "Right", "left" => "Left");
								foreach ($port_option as $var_data => $var_caption) {
									echo "<option " . ((isset($gt3_theme_pagebuilder['port']['content_position']) && $gt3_theme_pagebuilder['port']['content_position'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
								}
			echo "
							</select>
							<div class='gt3_option_hint'>" . __('For Side by Side layout only', 'sohopro') . "</div>
						</div>
						<div class='clear'></div>
						<br />

						<div class='gt3_galsettings_left'>
							<h2 style='width: 194px;'>" . __('Title State:', 'sohopro') . "</h2>
						</div>
						<div class='gt3_galsettings_right'>
							<select name='pagebuilder[port][title_state]' class='strip_select'>";
								$port_option = array("show" => "Show Title", "hide" => "Hide Title");
								foreach ($port_option as $var_data => $var_caption) {
									echo "<option " . ((isset($gt3_theme_pagebuilder['port']['title_state']) && $gt3_theme_pagebuilder['port']['title_state'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
								}
			echo "
							</select>
						</div>
						<div class='clear'></div>
						<br />

						<div class='gt3_galsettings_left'>
							<h2 style='width: 194px;'>" . __('Categories State:', 'sohopro') . "</h2>
						</div>
						<div class='gt3_galsettings_right'>
							<select name='pagebuilder[port][categs_state]' class='strip_select'>";
								$port_option = array("show" => "Show Categories", "hide" => "Hide Categories");
								foreach ($port_option as $var_data => $var_caption) {
									echo "<option " . ((isset($gt3_theme_pagebuilder['port']['categs_state']) && $gt3_theme_pagebuilder['port']['categs_state'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
								}
			echo "
							</select>
						</div>
						<div class='clear'></div>
						<br />

						<div class='gt3_galsettings_left'>
							<h2 style='width: 194px;'>" . __('Title Alignment:', 'sohopro') . "</h2>
						</div>
						<div class='gt3_galsettings_right'>
							<select name='pagebuilder[port][title_align]' class='strip_select'>";
								$port_option = array("align_left" => "Left", "align_center" => "Center", "align_right" => "Right");
								foreach ($port_option as $var_data => $var_caption) {
									echo "<option " . ((isset($gt3_theme_pagebuilder['port']['title_align']) && $gt3_theme_pagebuilder['port']['title_align'] == $var_data) ? 'selected="selected"' : '') . " value='" . $var_data . "'>" . $var_caption . "</option>";
								}
			echo "
							</select>
						</div>
						<div class='clear'></div>
						
					</div>
				</div>

            </div>
            <!-- END SETTINGS -->";
	}

	#LANDING AREA
	if ($now_post_type == "page" && get_page_template_slug() == "page-landing.php") {
		echo "
            <!-- LANDING SETTINGS -->
            <div class='padding-cont pt_" . $now_post_type . " pt20 pb20'>
                <div class='strip_cont gt3settings_box countdown'>
                    <div class='gt3settings_box_title'><h2>" . esc_html__('Landing Page Options', 'sohopro') . "</h2></div>
                    <div class='gt3settings_box_content'>
                        <h2 style='font-size:13px;'>" . esc_html__('Background Options:', 'sohopro') . "</h2>
                        <div class='boxed_options no_boxed'>
                            <input type='hidden' class='custom_select_img_attachid' name='pagebuilder[page_settings][landing][img][attachid]' value='".(isset($gt3_theme_pagebuilder['page_settings']['landing']['img']['attachid']) ? $gt3_theme_pagebuilder['page_settings']['landing']['img']['attachid'] : '')."'>
                            <div class='custom_select_img_preview' style='width: 25%;'>";
								if (isset($gt3_theme_pagebuilder['page_settings']['landing']['img']['attachid'])) {
									$img_attachment = wp_get_attachment_image_src( $gt3_theme_pagebuilder['page_settings']['landing']['img']['attachid'], "large" );
									if ($img_attachment[0] == '') {
									} else {
										echo "<img style='width: 100%;' src='".$img_attachment[0]."' alt=''>";
									}
								}
								echo "
                            </div>
                            <div>
                                <div class='add_image_from_wordpress_library_popup'>" . esc_html__('Add Image', 'sohopro') . "</div>
                            </div>
                            <div class='clear pb20'></div>
                            <hr class='date_hr'>
							<div class='subtitle_area pb10 pt10'>
								<h2>" . esc_html__('Title:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[landing][title]' value='" . (isset($gt3_theme_pagebuilder['landing']['title']) ? esc_attr($gt3_theme_pagebuilder['landing']['title']) : esc_html__('Bradley', 'sohopro')) . "'>
							</div>
                            <div class='subtitle_area pb10'>
								<h2>" . esc_html__('Subtitle:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[landing][subtitle]' value='" . (isset($gt3_theme_pagebuilder['landing']['subtitle']) ? esc_attr($gt3_theme_pagebuilder['landing']['subtitle']) : esc_html__('Professional Photography', 'sohopro')) . "'>
                            </div>
                            <div class='subtitle_area pb10'>
								<h2>" . esc_html__('Button Text:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[landing][btntext]' value='" . (isset($gt3_theme_pagebuilder['landing']['btntext']) ? esc_attr($gt3_theme_pagebuilder['landing']['btntext']) : esc_html__('Enter', 'sohopro')) . "'>
                            </div>
                            <div class='subtitle_area pb10'>
								<h2>" . esc_html__('Button URL:', 'sohopro') . "</h2>
								<input type='text' class='medium textoption type1' name='pagebuilder[landing][btnurl]' value='" . (isset($gt3_theme_pagebuilder['landing']['btnurl']) ? esc_attr($gt3_theme_pagebuilder['landing']['btnurl']) : "#") . "'>
                            </div>
                        </div><!-- boxed_options no_boxed -->
                    </div><!-- gt3settings_box_content -->
                </div><!-- strip_cont gt3settings_box landing -->
            </div><!-- padding-cont -->
            <!-- END SETTINGS -->
            <style>
                .composer-switch, #postdivrich, #postimagediv, #side_sidebar_settings_meta_box, #page_subtitle, #side_bg_settings_meta_box, .edit-form-section, #postexcerpt, #commentsdiv {
                    display: none!important;
                }
            </style>
        ";
	}

}