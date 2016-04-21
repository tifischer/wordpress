<?php
/**
 * Shortcode Title: Social icons
 * Shortcode: social_icons
 * Usage: [social_icons animation="bounceInUp" style="1"][social_icon icon="icon-facebook" title="Facebook" subtitle="{subtitle}" url="http://facebook.com" target="_blank"][/social_icons]
 */
add_shortcode('social_icons', 'ts_social_icons_func');

function ts_social_icons_func( $atts, $content = null ) {

	global $shortcode_icons;
	
	extract(shortcode_atts(array(
		'animation' => ''
    ), $atts));
	
    $shortcode_icons = array(); // clear the array
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content
	
	$html = '';
	
	foreach ($shortcode_icons as $link) {
		
		$html .= '<li><a class="'.$link['icon'].' '.ts_get_animation_class($animation).'" href="'.$link['url'].'" target="'.$link['target'].'" title="'.esc_attr($link['title']).'"></a></li>';
	}
    $shortcode_icons = array();
	
	
	return '
		<ul class="social-media style2">
        	'.$html.'
        </ul>';
}

/**
 * Shortcode Title: Social link - can be used only with social_icons shortcode
 * Shortcode: social_icon
 * Usage: [social_icon icon="icon-facebook" title="Facebook" url="http://facebook.com" target="_blank"]
 */
add_shortcode('social_icon', 'ts_social_icon_func');
function ts_social_icon_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'icon' => 'no',
	    'title' => '',
	    'url' => '',
	    'target' => ''
    ), $atts));
	
	global $shortcode_icons;
    
	$shortcode_icons[] = array(
		'icon' => $icon, 
		'title' => $title, 
		'url' => $url, 
		'target' => $target);
}