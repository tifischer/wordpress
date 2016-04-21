<?php
/**
 * Shortcode Title: Button
 * Shortcode: button
 * Usage: [button animation="bounceInUp" type="white" url="http://yourdomain.com" target="_blank"]Your content here...[/button]
 */
add_shortcode('button_view', 'ts_button_view_func');

function ts_button_view_func($atts, $content = null)
{
    extract(shortcode_atts(array(
		'animation' => '',
		'type' => '',
		'url' => '',
		'target' => ''
	),
	$atts));

    return '<a href="'.$url.'" target="'.$target.'" class="button view-more unfilled '.(empty($type) ? 'black' : $type).'">'.$content.'</a>';
}