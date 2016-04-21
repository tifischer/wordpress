<?php
/**
 * Shortcode Title: Text
 * Shortcode: text
 * Usage: [text animation="bounceInUp"]Your text here...[/text]
 */
add_shortcode('text', 'ts_text_func');

function ts_text_func( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'animation' => ''
		),
	$atts));
	
	return '<div '.ts_get_animation_class($animation,true).' data-animation="'.$animation.'">'.do_shortcode($content).'</div>';
}