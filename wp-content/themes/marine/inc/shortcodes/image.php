<?php
/**
 * Shortcode Title: Image
 * Shortcode: image
 * Usage: [image animation="bounceInUp" size="half" align="alignleft" url="http://...." target="_blank"]image.png[/image]
 */
add_shortcode('image', 'ts_image_func');

function ts_image_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'size' => '',
		'align' => '',
		'url' => '',
		'target' => ''
		),
	$atts));
	
	$content = ts_get_image_by_id($content);

	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
	$content = str_replace('&#215;','x',$content);

	$class = ' img-responsive '.$align.' '.$size.' '.ts_get_animation_class($animation);
	switch ($size) {
		case 'full':
			$image = ts_get_resized_image_sidebar($content,array('full','one-sidebar','two-sidebars'), '', $class);
			break;

		case 'half':
			$image = ts_get_resized_image_sidebar($content,array('half-full','half-one-sidebar','half-two-sidebars'), '', $class);
			break;

		case 'one_third':
			$image = ts_get_resized_image_sidebar($content,array('third-full','third-one-sidebar','third-two-sidebars'), '', $class);
			break;

		case 'one_fourth':
			$image = ts_get_resized_image_sidebar($content,array('fourth-full','fourth-one-sidebar','fourth-two-sidebars'), '', $class);
			break;

		default:
			$image = '<img src="'.$content.'" class="'.$class.'" data-animation="'.$animation.'" alt="">';
			break;
	}
	
	if (!empty($url)) {
		return '<a href="'.  esc_url($url).'" target="'.esc_attr($target).'">'.$image.'</a>';
	}
	return $image;
}