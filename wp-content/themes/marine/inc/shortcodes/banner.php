<?php
/**
 * Shortcode Title: Banner
 * Shortcode: banner
 * Usage: [banner animation="bounceInUp" style="1" image="image.png" title="Your title" subtitle="Your subtitle" button_text="Click me"  url="http://yourdomain.com" target="_blank"]
 */
add_shortcode('banner', 'ts_banner_func');

function ts_banner_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'style' => 1,
		'image' => '',
		'title' => '',
		'subtitle' => '',
		'button_text' => '',
		'url' => '',
		'target' => ''
		),
	$atts));
	
	$image_html = '';
	
	if ($image) {
		$image = ts_get_image_by_id($image);
		$image_html = '<img src="'.$image.'" />';
	}
	
	switch ($style) {
		case 2:
			$overlay = '
				<h3>'.$title.'</h3>
				<h4>'.$subtitle.'</h4><br>';
			break;
		
		case 1:
		default:
			$overlay = '
				<h2>'.$title.'</h2>
				<p>'.$subtitle.'</p>';
	}
	
	$button_html = '';
	if (!empty($button_text)) {
		$button_html = '<a href="'.$url.'" target="'.$target.'" class="button unfilled white">'.$button_text.'</a>';
	}
	
	return '
		<div class="shop-banner'.ts_get_animation_class($animation,true).'" data-animation="'.$animation.'">
			'.$image_html.'
			<div class="banner-content-wrapper">
				<div class="banner-content">
					<div class="banner-content-inner">
						<div class="overlay">
							'.$overlay.'
							'.$button_html.'
						</div>
					</div>
				</div>
			</div>
		</div>';
}