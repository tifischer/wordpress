<?php
/**
 * Shortcode Title: Button
 * Shortcode: button
 * Usage: [button animation="bounceInUp" variant="1" icon="icomoon-home" background="#CCFFEE" color="#555555" size="small" url="http://yourdomain.com" target="_blank" ]Your content here...[/button]
 */
add_shortcode('button', 'ts_button_func');

function ts_button_func($atts, $content = null)
{
    extract(shortcode_atts(array(
            'animation' => '',
            'variant' => '1',
            "icon" => '',
            "background" => '',
            "color" => '',
            "size" => '',
            "url" => '',
            'target' => '_self'
        ),
        $atts));

    switch ($size) {

        case 'large':
            $size = 'biggest ';
            break;

        case 'small':
        default:
            $size = 'medium';
            break;
    }
	
	switch ($variant) {

		case 2: 
			$variant = 'variant2';
			break;

        case 1:
        default:
            $variant = '';
            break;
    }
	
    $button_class = 'button ' . $size.' '.$variant;
	
    if (empty($url)) {
        $url = '#';
    }

    $button_styles = array();
    if(!empty($color)){
        $button_styles[] = 'color: '.$color;
    }
    if(!empty($background)){
        $button_styles[] = 'background-color: '.$background;
    }
	$button_styles_html = '';
    if(count($button_styles) > 0){
        $button_styles_html = 'style="'.implode(';',$button_styles).'"';
    }

    $icon_html = '';
    if ($icon && $icon != 'no') {
        $icon_html = '<i class="icons '.$icon.'"></i>';
    }

    return '<a class="' . $button_class . ' ' . ts_get_animation_class($animation) . '" data-animation="' . $animation . '" href="' . $url . '" target="' . $target . '" '.$button_styles_html.'>' . $icon_html . $content . '</a>';
}