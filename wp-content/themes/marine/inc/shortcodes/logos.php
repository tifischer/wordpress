<?php
/*
 * Shortcode Title: Logos
 * Shortcode: logos
 *'Usage:[logos animation=""][logos_item]{content}[/logos_item][/logos]'
 */

add_shortcode('logos', 'ts_logos_func');

function ts_logos_func($atts, $content = null) {
	
	extract(shortcode_atts(array(
	    'animation' => ''
    ), $atts));
	
    global $shortcode_logos;
    $shortcode_logos = array(); // clear the array
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content

	$items = '';
	foreach ($shortcode_logos as $logo) {

		$items .= '<li '.ts_get_animation_class($animation, true).'>';
		if (!empty($logo['url'])) {
			$items .= '<a href="'.$logo['url'].'" target="'.$logo['target'].'">';
		}
		
		$items .= '<img src="'.$logo['image'].'" alt="'.$logo['title'].'" />';
		
		if (!empty($logo['url'])) {
			$items .= '</a>';
		}	
		$items .= '</li>';
	}
    $shortcode_logos = array();

	$html = '<ul class="shop-logos">'.$items.'</ul>';
	return $html;
}

add_shortcode('logos_item', 'ts_logos_item_func');

function ts_logos_item_func($atts, $content = null) {

    extract(shortcode_atts(array(
	    'title' => '',
	    'image' => '',
	    'url' => '',
	    'target' => '_self',
    ), $atts));
    global $shortcode_logos;
    $shortcode_logos[] = array(
		'title' => $title,
		'image' => ts_get_image_by_id($image),
		'url' => $url,
		'target' => $target,
	);
}









