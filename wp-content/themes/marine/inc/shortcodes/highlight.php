<?php
/**
 * Shortcode Title: Highlight
 * Shortcode: highlight
 * Usage: [highlight animation="bounceInUp" color="#ebebeb" border_color="#dedede" background_image="image.png" background_attachment="scroll" horizontal_position="left" vertical_position="top" background_stretch="no" background_video="video.avi" background_video_format="ogg" background_pattern="grid" min_height="100" first_page="no" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="0" fullwidth="yes"]Your text here...[/highlight]
 */
add_shortcode('highlight', 'highlight_func');

function highlight_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'fullwidth' => 'yes',
		'color' => '',
		'border_color' => '',
        'background_color' => '',
		'background_image' => '',
		'background_attachment' => '',
		'background_position' => '',
		'background_stretch' => '',
		'background_video' => '',
		'background_video_format' => '',
		'background_pattern' => '',
		'background_pattern_color' => '',
		'background_pattern_color_transparency' => '',
		'min_height' => '',
		'first_page' => '',
		'last_page' => '',
		'padding_top' => '',
		'padding_bottom' => '',
		'margin_bottom' => ''
		),
	$atts));

	$classes = array();
	$styles = array();

	if ($fullwidth == 'yes')
	{
		$classes[] = 'full-width-bg';
	}
	else
	{
		$classes[] = 'sc-highlight-standard';
	}

    if(!empty($background_color)){
        $styles[] = 'background-color:'.$background_color.';';
    }

	if (!empty($color)) {
		$styles[] = 'background-color: '.$color.';';
	}

	if (!empty($border_color)) {
		$styles[] = 'border: 1px solid '.$border_color.';';
	}

	if (!empty($background_image)) {
		$background_image = ts_get_image_by_id($background_image);
		$styles[] = 'background-image: url('.$background_image.');';
	}

	if (!empty($background_attachment)) {
		$styles[] = 'background-attachment: '.$background_attachment.';';
	}

	if (intval($min_height)) {
		$styles[] = 'min-height: '.intval($min_height).'px;';
	}

	if (!empty($background_position)) {
		$styles[] = 'background-position: '.$background_position.';';
	}

	if (!empty($background_stretch)) {
		if($background_stretch == 'yes') {
			$background_size = '100%';
		}
		//$styles[] = 'background-size: 100% '.$background_size. ';';
	}

	if ($background_stretch == 'yes') {
		$styles[] = 'background-size: 100% 100%;';
	}

	if ($first_page == 'yes') {
		$styles[] = 'margin-top: -40px;';
	}

	if (intval($padding_top)) {
		$styles[] = 'padding-top: '.intval($padding_top).'px;';
	}

	if (intval($padding_bottom)) {
		$styles[] = 'padding-bottom: '.intval($padding_bottom).'px;';
	}

	if (intval($margin_bottom)) {
		$styles[] = 'margin-bottom: '.intval($margin_bottom).'px;';
	}
	else if ($last_page == 'yes') {
		$styles[] = 'margin-bottom: -41px;';
	}

	$background_video_html = '';
	if (!empty($background_video)) {
		$background_video_html = '
			<div class="mobile-video-bg" style="background-image: url('.$background_image.');"></div>
			<video preload="auto" loop="true" autoplay="true" src="'.$background_video.'">
				<source type="video/'.$background_video_format.'" src="'.$background_video.'">
			</video>
			';
	}
	$background_pattern_html = '';
	if (!empty($background_pattern) && $background_pattern != 'no') {

		$transparency = round((100 - $background_pattern_color_transparency)/100,2);

		$bcp = '';
		if (!empty($background_pattern_color)) {
			$bcp = 'style="background-color: '.ts_hex_to_rgb($background_pattern_color,$transparency).'"';
		}

		switch ($background_pattern) {
			case 'grid':
			default:
				$background_pattern_html = '<div class="video-pattern" '.$bcp.'></div>';
		}
	}

	return '
		<div class="full_bg '.implode(' ',$classes).' '.ts_get_animation_class($animation).'" data-animation="'.$animation.'" style="'.implode(' ',$styles).'">
			'.$background_video_html.'
			'.$background_pattern_html.'
			 '.do_shortcode($content).'<div class="clearfix"></div>
		</div>';
}