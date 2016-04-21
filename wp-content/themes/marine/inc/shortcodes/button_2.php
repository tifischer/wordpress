<?php
/**
 * Shortcode Title: Button
 * Shortcode: button
 * Usage: [button_2 animation="bounceInUp" icon="icomoon-home" color="" url="http://yourdomain.com" target="_blank" ]Your content here...[/button_2]
 */
add_shortcode('button_2', 'ts_button_2_func');

function ts_button_2_func($atts, $content = null)
{
    extract(shortcode_atts(array(
		'animation' => '',
		"icon" => '',
		"color" => '',
		"url" => '',
		'target' => '_self'
	),
	$atts));

    
    if (empty($url)) {
        $url = '#';
    }

    $button_styles = array();
    if(!empty($color)){
        $button_styles[] = 'color: '.$color;
        $button_styles[] = 'border-color: '.$color;
    }
   
	$button_styles_html = '';
    if(count($button_styles) > 0){
        $button_styles_html = 'style="'.implode(';',$button_styles).'"';
    }

    $icon_html = '';
    if ($icon && $icon != 'no') {
        $icon_html = '<i class="icons '.$icon.'"></i>';
    }

    return '
		<a '.$button_styles_html.' href="' . $url . '" target="' . $target . '" class="button round '.ts_get_animation_class($animation).'">
			<span class="button-icon">
				'.$icon_html.'
			</span>
			<span class="button-label">'.$content.'</span>
		</a>';
}