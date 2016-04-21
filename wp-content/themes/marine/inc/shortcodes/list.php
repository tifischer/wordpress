<?php
/**
 * Shortcode Title: List
 * Shortcode: list
 * Usage: [list animation="bounceInUp"][list_icon icon="home"]Your content...[/list_icon][/list]
 */

add_shortcode('list', 'ts_list_func');

function ts_list_func( $atts, $content = null ) {
	
	 extract(shortcode_atts(array(
	    'animation' => ''
    ), $atts));

	$pattern = '/<ul[^.]*<\/ul>/';
	if (preg_match($pattern, $content)) {
		return do_shortcode($content);
	}
	
	global $shortcode_list_item;
	
    $shortcode_list_item = array();
    do_shortcode($content);

	$items = '';
	foreach ($shortcode_list_item as $item) {
		$items .= '<li class="'.esc_attr($item['icon']).'">'.$item['content'].'</li>';


	}
    $shortcode_list_item = array();
	return '<ul class="list '.ts_get_animation_class($animation).'">'.$items.'</ul>';
}

/**
 * Shortcode Title: List item
 * Shortcode: list_item
 * Usage: 
 */
add_shortcode('list_item', 'ts_list_item_func');
function ts_list_item_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'icon' => ''
    ), $atts));
    global $shortcode_list_item;
    $shortcode_list_item[] = array(
		'icon' => $icon, 
		'content' => trim(do_shortcode($content)));
}