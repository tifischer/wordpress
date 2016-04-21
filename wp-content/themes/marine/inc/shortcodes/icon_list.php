<?php
/*
 * Shortcode Title: Icons list
 * Shortcode: icon_list
 *'Usage:[icon_list animation="bounceInUp"][icon_list_item icon="fa-search" icon_color="#FF0000" title="Your title" title_color="#D3D3D3" content_color="#D3D3D3" border_color="#D3D3D3"]Your content[/icon_list_item][/icon_list]'
 */
$global_icon_list_animation = null;

add_shortcode('icon_list_item', 'ts_icon_list_item_func');

function ts_icon_list_item_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'animation' => '',
        'icon' => '',
        'icon_upload' => '',
        'icon_color' => '',
        'title' => '',
        'title_color' => '',
        'content_color' => '',
        'border_color' => ''
    ), $atts));

    $i_style =  '';
    $h3_style = '';
    $p_style = '';
	$b_style = '';
    if(!empty($icon_color)){
        $i_style = 'style="color:'.$icon_color.'"';
    }
    if(!empty($title_color)){
        $h3_style = 'style="color:'.$title_color.'"';
    }
    if(!empty($content_color)){
        $p_style = 'style="color:'.$content_color.'"';
    }
	if(!empty($border_color)){
        $b_style = 'style="border-color:'.$border_color.'"';
    }
	
	$icon_html = '';
	if (!empty($icon_upload)) {
		$icon_upload = ts_get_image_by_id($icon_upload);
		$icon_html = '<img class="icons" src="'.$icon_upload.'" />';
	} else {
		$icon_html = '<i '.$i_style.' class="icons ' . $icon . '"></i>';
	}
	
    return '<li '.$b_style.'>
				'.$icon_html.'
				<h3 '.$h3_style.'>' . $title . '</h3>
				<p '.$p_style.'>' . $content . '</p>
			</li>';
}



add_shortcode('icon_list', 'ts_icon_list_func');



function ts_icon_list_func($atts, $content = null)
{ 
	extract(shortcode_atts(array(
        'animation' => ''
    ), $atts));

    return '<ul class="services-list ' . ts_get_animation_class($animation) . '">' . do_shortcode($content) . '</ul>';



}

