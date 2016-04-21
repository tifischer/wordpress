<?php
/**
 * Shortcode Title: Icon
 * Shortcode: icon
 * Usage: [icon animation="bounceInUp" icon="icon1.png" icon_upload="" icon_color="" title="Your title" title_size="11" title_font_weight="bold" title_color="" content_size="12" content_color=""]Your content here...[/icon]
 */
add_shortcode('icon', 'ts_icon_func');

function ts_icon_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'icon' => '',
		'icon_color' => '',
		'icon_upload' => '',
		'title' => '',
		'title_size' => '',
		'title_font_weight' => '',
		'title_color' => '',
		'content_size' => '',
		'content_color' => '',
	),
	$atts));
	
	if(!empty($icon_color)){
        $i_style = 'style="color:'.esc_attr($icon_color).'"';
    }
	$h3_style = '';
	$h3_style_arr = array();
    if(!empty($title_size) && intval($title_size) > 0){
        $h3_style_arr[] = 'font-size:'.intval($title_size).'px';
    }
	if(!empty($title_font_weight)){
        $h3_style_arr[] = 'font-weight:'.esc_attr($title_font_weight);
    }
	if(!empty($title_color)){
        $h3_style_arr[] = 'color:'.esc_attr($title_color);
	}
	if(count($h3_style_arr) > 0){
        $h3_style = 'style="'.implode(';', $h3_style_arr).'"';
    }
	
	
	$p_style = '';
	$p_style_arr = array();
    if(!empty($content_size) && intval($content_size) > 0){
        $p_style_arr[] = 'font-size:'.intval($content_size).'px';
    }
	if(!empty($content_color)){
        $p_style_arr[] = 'color:'.$content_color;
	}
	if(count($p_style_arr) > 0){
        $p_style = 'style="'.implode(';', $p_style_arr).'"';
    }
	
	$icon_html = '';
	if (!empty($icon_upload)) {
		$icon_upload = ts_get_image_by_id($icon_upload);
		$icon_html = '<img class="icons" src="'.$icon_upload.'" />';
	} else {
		$icon_html = '<i '.$i_style.' class="icons ' . $icon . '"></i>';
	}
	
	return '
		<div class="sc-icon '.ts_get_animation_class($animation).'">
			'.$icon_html.'
			<h3 '.$h3_style.'>' . $title . '</h3>
			<p '.$p_style.'>' . $content . '</p>
		</div>';
}