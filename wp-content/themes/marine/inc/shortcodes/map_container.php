<?php
/**
 * Shortcode Title: Map Container
 * Shortcode: map_container
 * Usage: [map_container address="" zoom="14" custom_marker="" full_width="no" grayscale="no" height="230" marker_offset="-140" first_page="no" last_page="yes"][wpgmappity id="x"][/map_container]
 */
add_shortcode('map_container', 'ts_map_container_func');

function ts_map_container_func( $atts, $content = null ) {
    
	extract(shortcode_atts(array(
		'full_width' => 'yes',
		'grayscale' => 'no',
		'zoom' => '14',
		'custom_marker' => '',
		'address' => '',
		'height' => '',
		'marker_offset' => '',
		'last_page' => '',
		'first_page' => ''
		), 
	$atts));
	
	$class = '';
	
	if ($full_width == 'yes') {
		$class .= ' full';
	}
	
	if ($last_page == 'yes') {
		$class .= ' last-page';
	}
	
	if ($first_page == 'yes') {
		$class .= ' first-page';
	}
	
	$styles = array();
	$styles_html_1 = '';
	if (!empty($height)) {
		$styles[] = 'height: '.(intval($height) + intval(abs($marker_offset))).'px';
		$styles_html_1 = 'style="height:'.$height.'px"';
	}
	
	if (!empty($marker_offset)) {
		$styles[] = 'margin-top: -'.intval(abs($marker_offset)).'px';
	}
	
	$styles_html_2 = '';
	if (count($styles) > 0) {
		$styles_html_2 = 'style="'.implode(';',$styles).'"';
	}
	
	//map
	$map = '';
	
	if (!empty($address)) {
		
		ob_start(); ?>
		<div class="ts-map">
			<div class="sc-google-map" <?php echo $styles_html_2; ?> 
				data-address="<?php echo esc_js($address); ?>" 
				data-zoom="<?php echo intval($zoom); ?>" 
				data-custom-marker="<?php echo esc_js($custom_marker); ?>"
				data-grayscale="<?php echo ($grayscale == 'yes' ? 'yes' : 'no'); ?>">
			</div>
		</div>
		 
		<?php 
		$map =  ob_get_contents();
		ob_end_clean();
	}
	
	return '
		<div class="sc-map '.$class.'" '.$styles_html_1.'>
			<div class="sc-map-container" '.$styles_html_2.'>
				'.$map.do_shortcode($content).'
			</div>
		</div>';
}