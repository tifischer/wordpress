<?php
/**
 * Shortcode Title: Info Box
 * shortcode:  info_box
 * Usage: [info_box animation="fade" box_title="title" box_subtitle="subtitle" box_bg="#fff" textColor="#fff"  buttonText="#fff" buttonBg="#fff" buttonColor="#fff" url="http://youdomian.com" target="_self" ]
 */

add_shortcode('info_box', 'ts_info_box_func');
function ts_info_box_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'animation' => '',
        'box_bg' => '',
        'text_color' => '',
        'box_title' => '',
        'box_subtitle' => '',
        'button_bg' => '',
        'button_color' => '',
        'button_text' => '',
        'url' => '',
        'target' => ''
    ), $atts));

    $box_style_arr = array();
	if (!empty($box_bg)) {
		$box_style_arr[]  = 'background:' . $box_bg;
	}
	if (!empty($text_color)) {
		$box_style_arr[]  = 'color:' . $text_color;
	}
	$box_style = '';
	if (count($box_style_arr) > 0) {
		$box_style = 'style="'.implode(';', $box_style_arr).'"';
	}
	
	$btn_style_arr = array();
	if (!empty($button_bg)) {
		$btn_style_arr[] = 'background:' . $button_bg;
	}
	if (!empty($button_color)) {
		$btn_style_arr[] = 'color:' . $button_color;
	}
	
	$btn_style = '';
	if (count($btn_style_arr) > 0) {
		$btn_style = 'style="'.implode(';', $btn_style_arr).'"';
	}
	
    $html = '
		<div class="info-box ' . ts_get_animation_class($animation) . '"'. $box_style .'>
			<h4>' . $box_title . '</h4>
			<p>' . $box_subtitle . '</p>
			<a href="' . $url . '" target="' . $target . '" class="button big" ' . $btn_style . '>' . $button_text . '</a>
		</div>';
    return $html;
}