<?php
/**
 * Shortcode Content Box
 * Shortcode: content_box
 * Usage :[content_box  title="Your title" icon="fa-search" icon_color="#FF0000" icon_bg="#F3F3F3" title_color=>"#D3D3D3" text_color="#D3D3D3" style="style1"]Your content...[/content_box]
 */
add_shortcode('content_box', 'ts_content_box_func');

function ts_content_box_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'animation' => '',
        'style' => 'style1',
        'icon' => '',
        'icon_color' => '',
        'icon_bg' => '',
        'title' => '',
        'title_color' => '',
        'text_color' => ''
    ), $atts));

    $html = null;
    $rand_class="cb_".time();

    $content_box_style = '';
    if(!empty($text_color)){
        $content_box_style = 'style="color: '.$text_color.'"';
    }

	$icon_i_style ='';
	if(!empty($icon_color)){
		$icon_i_style = 'style="color:'.$icon_color.'"';
	}

	$icon_h4_style='';
	if(!empty($title_color)){
		$icon_h4_style = 'style="color:'.$title_color.'"';
	}
	
	$icon_bg_style = '';
	if (!empty($icon_bg) && $style == 'style1') {
		$icon_bg_style = 'style="background-color: '.$icon_bg.'"';
	}

    if ($style == 'style3') {
        $html .= '
			<div class="iconic-service '.$rand_class.' '.ts_get_animation_class($animation).'">
				<i  class="icons ' . $icon . '" '.$icon_i_style.'></i>
				<h4 '.$icon_h4_style.'>' . $title . '</h4>
			 <div class="content_box" '.$content_box_style.'>'. nl2br($content) . '</div>
			</div>';
        return $html;

    }

    $html .= '
		<div class="service '.ts_get_animation_class($animation). $style . '">
			<div class="service-icon" '.$icon_bg_style.'>
				<i '.$icon_i_style.' class="icons ' . $icon . '"></i>
			</div>
			<h3 style="color:'.$title_color.'">' . $title . '</h3>
			<div class="content_box" '.$content_box_style.'>'. nl2br($content) . '</div>
		</div>';
    return $html;
}