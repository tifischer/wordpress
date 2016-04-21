<?php
/**
 * Shortcode Title: Testimonials
 * Shortcode: testimonials
 * Usage: [testimonials animation="bounceInUp" variant="default" category="3" limit="3" text_color="#444" info_color="#777" nav_style="light"]
 */
add_shortcode('testimonials', 'ts_testimonials_func');

function ts_testimonials_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		'variant' => 'default',
		'category' => '',
		'limit' => '',
        'text_color' => '',
        'info_color' => '',
        'nav_style' => ''
		),
	$atts));
	
    $text_color_style = '';
    if (!empty($text_color)) {
        $text_color_style = 'style="color: '.$text_color.'"';
    }
    
    $info_color_style = '';
    if (!empty($info_color)) {
        $info_color_style = 'style="color: '.$info_color.'"';
    }
	
	switch ($variant) {
		case 'modern':
			$variant_class = 'style2';
			break;
		
		case 'default':
		default:
			$variant_class = '';
	}
	
	$nav_class = 'nav-light';
	if ($nav_style == 'dark') {
		$nav_class = 'nav-dark';
	}
    
	if (empty($limit)) {
		$limit = -1;
	}

	global $query_string, $post;
	$args = array(
		'posts_per_page'  => $limit,
		'offset'          => 0,
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'testimonial',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	
	if (!empty($category)):
		$args['tax_query'] = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'testimonial-category',
				'terms' => $category,
				'operator' => 'IN'
			)
		);
	endif;
	
	$the_query = new WP_Query( $args );

	$slides = '';
	
	if ( $the_query->have_posts() ) {
		global $post;
		
		$i = 1;
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();

			$position = get_post_meta($post->ID, 'position', true);
			$company = get_post_meta($post->ID, 'company', true);
			$author = get_the_title($post -> ID);

			
			if (!empty($company) && !empty($position)) {
				$company = ', '.$company;
			}
			
			$post_content = stripslashes($post -> post_content);
			
			$slides .= '
				<li>
					<div class="testimonial-slide">';
			
			switch ($variant) {
				case 'modern':
					$slides .= '
						<div class="testimonial-author">
							'.ts_get_resized_post_thumbnail($post ->ID, 'testimonials', get_the_title()).'
							<div>
								<span class="author" '.$text_color_style.'>'.$author.'</span>
								<span class="job" '.$info_color_style.'>'.$position.$company.'</span>
							</div>
						</div>
						<div class="testimonial-content">
							<p '.$text_color_style.'>'.$post_content.'</p>
						</div>';
					break;

				case 'default':
				default:
					$slides .= '
						<i class="icons icon-quote" '.$text_color_style.'></i>
						<p '.$text_color_style.'>'.$post_content.'</p>
						<span class="author" '.$text_color_style.'>'.$author.'</span>
						<span class="job" '.$info_color_style.'>'.$position.$company.'</span>';
			}
			
						
								
			$slides .= '					
					</div>
				</li>';
			
			$i++;
		}
	}
	wp_reset_postdata();
	
	if (empty($slides)) {
		return;
	}
	
	return '
		<div class="flexslider testimonial-slider '.$variant_class.' '.$nav_class.' '.ts_get_animation_class($animation).'">						
			<ul class="slides">
				'.$slides.'
			</ul>
		</div>';
}