<?php
/**
 * Shortcode Title: Project gallery
 * Shortcode: image_slider
 * Usage: [project_gallery animation="pulse"][image_item tooltip="Your text..."]image.png[/image_item][/project_gallery]
 */
add_shortcode('project_gallery', 'ts_project_gallery_func');

function ts_project_gallery_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'animation' => '',
        'size'=>''
   ), $atts));

	global $shortcode_image_slider_size;

	$shortcode_image_slider_size = $size;

	return '
		<div class="flexslider flexslider-thumbnail-gallery ">
			<ul class="slides">'.do_shortcode(shortcode_unautop($content)).'</ul>
		</div>';
}

/**
 * Shortcode Title: Image item - can be used only with project_gallery shortcode
 * Shortcode: image_item
 * Usage: [image_item tooltip="Your text..."]image.png[/image_item]
 */
add_shortcode('image_item', 'image_item_func');
function image_item_func( $atts, $content = null )
{
	 extract(shortcode_atts(array(
	    'tooltip' => '',
    ), $atts));
 
	$content = ts_get_image_by_id($content);
	 
	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
	$content = str_replace('&#215;','x',$content);

	$item = '<li data-tooltip="'.$tooltip.'" data-thumb="'.ts_get_resized_image($content,110,73,'','',true,true).'">';
	$item .= ts_get_resized_image_by_size($content,'slider','','img-responsive');
	$item .= '
		<div class="project-hover">
			<a class="search-icon" href="'.$content.'" rel="prettyPhoto[project-gallery]"></a>
		</div>';

	$item .= '</li>';

	return $item;
}