<?php
add_gt3_code('gt3_categories', 'gt3_categories_function', '');

function gt3_categories_function($settings, $value) {
	$gt3_return = '<div class="gt3_categories_wrapper"><div class="gt3_categories_inner">';
	$taxonomy = isset($settings['taxonomy']) ? $settings['taxonomy'] : 'gallerycat';

	if ($taxonomy == 'postcat') {
        $args = array(
            'type' => 'post'
        );
        $categories = get_categories($args);
		
		$gt3_return .= '<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="gt3_categ_value gt3_elpos_value_base wpb_vc_param_value" value="'. $value .'">';
		$val_array = explode(" ", $value);
		
        if (count($categories) > 0) {
            foreach ($categories as $cat) {
				$this_slug = $cat->slug;
				if (in_array($this_slug, $val_array)) {
					$checked = "checked";
				} else {
					$checked = "";
				}
				$gt3_return .= "<div class='gt3_categ_block'><input class='category_part gt3_categ_checkbox' type='checkbox' ". $checked ." data-val='". $this_slug ."' name='". esc_attr($settings['param_name']) . $this_slug . "'> <span class='gt3_categselect_span'>" . $cat->name . "</span></div>";
            }
        } else {
            $compile .= __("No category available. Please add new category in the posts section.", "sohopro");
        }
	} else {
		$args = array('taxonomy' => 'Category');
		$terms = get_terms($taxonomy, $args);
		$gt3_return .= '<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="gt3_categ_value gt3_elpos_value_base wpb_vc_param_value" value="'. $value .'">';
		$val_array = explode(" ", $value);
		if (is_array($terms) && count($terms) > 0) {
			foreach ($terms as $cat) {
				//gt3_pre($cat);
				$this_slug = $cat->slug;
				if (in_array($this_slug, $val_array)) {
					$checked = "checked";
				} else {
					$checked = "";
				}
				$gt3_return .= "<div class='gt3_categ_block'><input class='category_part gt3_categ_checkbox' type='checkbox' ". $checked ." data-val='". $this_slug ."' name='". esc_attr($settings['param_name']) . $this_slug . "'> <span class='gt3_categselect_span'>" . $cat->name . "</span></div>";
			}
		} else {
			$gt3_return .= esc_html__("No category available. Please add new category in the gallery section.", "sohopro");
		}
	}
	$gt3_return .= "</div></div>";
	return $gt3_return;
	
}
?>