<?php
/**
 * Shortcode Title: Tabs
 * Shortcode: tabs
 * Usage: [person_slider animation="bounceInUp" title="Your title here..." title_first_word_color="#FF0000" title_color="#FF0000" title_font="Arial" background_color="#000000"][person_slide id="12" image=""][/person_slider]
 */
add_shortcode('person_slider', 'ts_person_slider_func');

function ts_person_slider_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'title' => '',
		'title_first_word_color' => '',
		'title_color' => '',
	    'title_font' => '',
	    'background_color' => ''
    ), $atts));

	
	global $shortcode_person_slides;
    $shortcode_person_slides = array();
    do_shortcode($content);
	
	$styles = array();
	if (!empty($title_color)) {
		$styles[] = 'color: '.$title_color;
	}
	if (!empty($title_font)) {
		$styles[] = 'font-family: '.$title_font;
	}
	if (count($styles) > 0) {
		$styles_html = 'style="'.implode(';',$styles).'"';
	}  
	
	$slides = '';
	$i = 0;
	foreach ($shortcode_person_slides as $slide) {

		$post = get_post($slide['id']);
		$content;
		if (is_object($post)) {
			$content = apply_filters('the_content', $post -> post_content);
		}
		
		$item_title = get_the_title($slide['id']);
		
		$slides .= '
			<li>
				<div class="chef-slide">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">

							<div class="chef-item">
								<div class="chef-header">
									<div class="chef-avatar">
										'.ts_get_resized_post_thumbnail($slide['id'], 'person-slider-avatar', get_the_title()).'
									</div>
									<div class="chef-heading">
										<h4>'.$item_title.'</h4>
										<span>'.get_post_meta($slide['id'],'team_position', true).'</span>
									</div>
								</div>
								'.$content.'
							</div>

						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 chef-image">
							'.ts_get_resized_image_by_size($slide['image'], 'person-slider', $item_title, '', false, $item_title).'
						</div>
					</div>
				</div>
			</li>';
		


	}
    $shortcode_person_slides = array();
	
	if (!empty($title_first_word_color)) {
		$title_arr = explode(' ',$title, 2);
		
		
		if (is_array($title_arr) && isset($title_arr[0])) {
			$title = '<span style="color: '.$title_first_word_color.'">'.$title_arr[0].'</span> ';
			
			if (isset($title_arr[1])) {
				$title .= $title_arr[1];
			}
		}
	}
	
	$content = ' 
		<!-- Chefs Slider -->
		<section class="full-width team-members-slider" '.(!empty($background_color) ? 'style="background-color: '.$background_color.'"' : '').'>
			<div class="team-members-inner">
				<div class="container">

					<h2 class="cursive-style2" '.$styles_html.'>'.$title.'</h2>

						<!-- Chef Carousel -->
						<div class="flexslider chefs-slider">

							<ul class="slides">
								'.$slides.'
							</ul>

						</div>
						<!-- /Chef Carousel -->
				</div>
			</div>
		</section>
		<!-- /Chefs Slider -->';
	return $content;
}

/**
 * Shortcode Title: Person slide - can be used only with person_slider shortcode
 * Shortcode: person_slide
 * Usage: [person_slider animation="bounceInUp" title_color="#FF0000" title_font="Arial" background_color="#000000"][person_slide id="12" image=""][/person_slider]
 */
add_shortcode('person_slide', 'ts_person_slide_func');
function ts_person_slide_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'id' => '',
	    'image' => ''
    ), $atts));
    global $shortcode_person_slides;
    $shortcode_person_slides[] = array(
		'id' => $id, 
		'image' => $image);
}