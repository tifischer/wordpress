<?php
/**
 * Shortcode Title: Blockquote
 * Shortcode: blockquote
 * Usage: [blockquote animation="bounceInUp" author="John"]Your content here...[/blockquote]
 */
add_shortcode('blockquote', 'ts_blockquote_func');

function ts_blockquote_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'author' => '',
		'animation' => ''
		),
	$atts));

	return '<blockquote '.ts_get_animation_class($animation,true).' data-animation="'.$animation.'"><p>'.do_shortcode(nl2br($content)).'</p><span class="author">'.$author.'</span></blockquote>';
}