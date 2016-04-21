<?php
/**
 * Shortcode Title: Call to action
 * Shortcode: call_to_action
 * Usage: [call_to_action animation="bounceInUp" transparent_background="no" background_color="#FF0000"  text_color="#FFFFFF" button_color="#DADADA" button_bg="#DADADA"  icon="icon-search" border_color="#000" button_text="Click me" url="" target="" first_page="yes" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="10"]Your title here...[/[call_to_action]
 */
add_shortcode('call_to_action', 'ts_call_to_action_func');

function ts_call_to_action_func($atts, $content = null)
{
    extract(shortcode_atts(array(
            'animation' => '',
            'transparent_background' => '',
            "background_color" => '',
            "text_color" => '',
		
			"icon" => '',

            "button_color" => '',
            "button_bg" => '',

            "button_bg_hover" => '',
            'border_color' => '',
            "button_text" => '',

            "url" => '#',
            "target" => '_self',
            "first_page" => 'no',
            "last_page" => 'no',

            'padding_top' => '',
            'padding_bottom' => '',
            'margin_bottom' => '',
        ),
        $atts));

    $classes = array();
    if ($first_page == 'yes') {
        $classes[] = 'first-page';
    }
    if ($last_page == 'yes') {
        $classes[] = 'last-page';
    }
	
	if ($transparent_background == 'yes') {
		$classes[] = 'transparent';
	}
	
    $classes_html = '';
    if (is_array($classes)) {
        $classes_html = implode(' ', $classes);
    }


    $button_styles = array();
    if (!empty($button_color)) {
        $button_styles[] = 'color: ' . $button_color;
    }
    if (!empty($button_bg)) {
        $button_styles[] = 'background-color: ' . $button_bg;
    }
    $button_styles_html = '';
    if (count($button_styles) > 0) {
        $button_styles_html = 'style="' . implode(';', $button_styles) . '"';
    }

    $box_style = array();
	
	if ($transparent_background == 'yes') {
		$background_color = null;
	}
	
    if (!empty($background_color)) {
        $box_style[] = 'background: ' . $background_color . '';
    }
	
	$text_style = array();
    if (!empty($text_color)) {
        $text_style[] = 'color: ' . $text_color;
    }

    if (!empty($border_color)) {
        $box_style[] = 'border-top:1px solid ' . $border_color;
        $box_style[] = 'border-bottom:1px solid ' . $border_color;
    }


    if (intval($padding_top)) {
        $box_style[] = 'padding-top: ' . intval($padding_top) . 'px;';
    }

    if (intval($padding_bottom)) {
        $box_style[] = 'padding-bottom: ' . intval($padding_bottom) . 'px;';
    }

    if (intval($margin_bottom)) {
        $box_style[] = 'margin-bottom: ' . intval($margin_bottom) . 'px;';
    }


    $box_style_html = '';
    if (is_array($box_style)) {
        $box_style_html = 'style="' . implode(';', $box_style) . '"';
    }
	
	$text_style_html = '';
    if (is_array($text_style)) {
        $text_style_html = 'style="' . implode(';', $text_style) . '"';
    }
	
	$icon_html = '';
	if (!empty($icon) && $icon != 'no') {
		$icon_html = '<i class="icons '.$icon.'" '.(!empty($button_color) ? 'style="color: '.$button_color.'"' : '').'></i>';
	}

    $html = '
		<section class="sc-call-to-action full-width-bg light-gray-bg small-padding ' . $classes_html . ts_get_animation_class($animation) . '"  ' . $box_style_html . '>
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-9">
					<h2 class="big" '.$text_style_html.'>' . $content . '</h2>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 align-right">
					<a href="' . $url . '" target="' . $target . '" class="button biggest" ' . $button_styles_html . '>'.$icon_html . $button_text . '</a>
				</div>
			</div>
		</section>';

    return $html;
}