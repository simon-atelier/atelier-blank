<?php 

$style_string = "";
if (array_key_exists('style', $block)) {
	if (array_key_exists('padding', $block['style']['spacing'])) {
		if (array_key_exists('top', $block['style']['spacing']['padding'])) {
			$padding_top = $block['style']['spacing']['padding']['top'];
			$padding_top_array = explode("|", $padding_top);
			$style_string .= " padding-top:" . $padding_top_array[2] . "px;";
		}
		if (array_key_exists('bottom', $block['style']['spacing']['padding'])) {
			$padding_bottom = $block['style']['spacing']['padding']['bottom'];
			$padding_bottom_array = explode("|", $padding_bottom);
			$style_string .= " padding-bottom:" . $padding_bottom_array[2] . "px;";
		}
		if (array_key_exists('left', $block['style']['spacing']['padding'])) {
			$padding_left = $block['style']['spacing']['padding']['left'];
			$padding_left_array = explode("|", $padding_left);
			$style_string .= " padding-left:" . $padding_left_array[2] . "px;";
		}
		if (array_key_exists('right', $block['style']['spacing']['padding'])) {
			$padding_right = $block['style']['spacing']['padding']['right'];
			$padding_right_array = explode("|", $padding_right);
			$style_string .= " padding-right:" . $padding_right_array[2] . "px;";
		}
	}
	if (array_key_exists('margin', $block['style']['spacing'])) {
		if (array_key_exists('top', $block['style']['spacing']['margin'])) {
			$margin_top = $block['style']['spacing']['margin']['top'];
			$margin_top_array = explode("|", $margin_top);
			$style_string .= " margin-top:" . $margin_top_array[2] . "px;";
		}
		if (array_key_exists('bottom', $block['style']['spacing']['margin'])) {
			$margin_bottom = $block['style']['spacing']['margin']['bottom'];
			$margin_bottom_array = explode("|", $margin_bottom);
			$style_string .= " margin-bottom:" . $margin_bottom_array[2] . "px;";
		}
		if (array_key_exists('left', $block['style']['spacing']['margin'])) {
			$margin_left = $block['style']['spacing']['margin']['left'];
			$margin_left_array = explode("|", $margin_left);
			$style_string .= " margin-left:" . $margin_left_array[2] . "px;";
		}
		if (array_key_exists('right', $block['style']['spacing']['margin'])) {
			$margin_right = $block['style']['spacing']['margin']['right'];
			$margin_right_array = explode("|", $margin_right);
			$style_string .= " margin-right:" . $margin_right_array[2] . "px;";
		}
	}
}

?>