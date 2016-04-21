<?php
/**
 * Shortcode Title: Dropcaps
 * Shortcode: dropcaps
 * Usage: [dropcaps animation="bounceInUp" style="1" color="#C4C4C4" background="#A4A4A4"]Your text here...[/dropcaps]
 */
add_shortcode('dropcaps', 'ts_dropcaps_func');

function ts_dropcaps_func( $atts, $content = null )
{
	if (empty($content))
	{
		return '';
	}

	extract(shortcode_atts(array(
		'animation' => '',
		'style' => '',
		'color' => '',
		'background' => '',
		),
	$atts));

	switch ($style) {
		case 2:
			$style_class = 'style2';
			break;
		
		case 1:
		default:
			$style_class = '';
	}
	
	$styles = array();
	if ($color)
	{
		$styles[] = 'color: '.$color;
	}
	if ($background)
	{
		$styles[] = 'background-color: '.$background;
	}
	$styles_html = '';
	if (count($styles) > 0)
	{
		$styles_html = 'style="'.implode(';', $styles).'"';
	}

	$letter = substr($content,0,1);
	$content = substr($content,1);

	return "<p ".ts_get_animation_class($animation,true)."><span class='dropquote ".$style_class."' ".$styles_html.">".$letter."</span>".$content." </p>";
}