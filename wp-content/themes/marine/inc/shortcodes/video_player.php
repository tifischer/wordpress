<?php
/**
 * Shortcode Title: Video Player
 * Shortcode: video_player
 * Usage: [video_player animation="bounceInUp" url="http://google.com" autoplay="no" align="left"]
 */
add_shortcode('video_player', 'ts_video_player_func');

function ts_video_player_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'url' => '',
		'autoplay' => 'no',
		'align' => ''
		),
	$atts));
	
	$embadded_video = '';
	if (!empty($url)) {
		$embadded_video = ts_get_embaded_video($url,true);
	}
	
	if ($embadded_video) {
		return '
			<div class="sc-videp-popup-wrapper '.$align.'">
				<a href="#" class="sc-open-video icon-button white"><img src="'. get_template_directory_uri() .'/img/icon-play.png" alt=""></a>
				<div class="sc-video-popup" data-url="'.esc_attr($embadded_video).'" data-autoplay="'.$autoplay.'">
					<div class="sc-close-video"><i class="icons icon-cancel-circled"></i></div>
				</div>
			</div>
			<div class="clearfix"></div>';
	}
	return '';
}