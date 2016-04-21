<?php
/**
 * Shortcode Title: Latest works
 * Shortcode: latest_works
 * Usage: [latest_works animation="bounceInUp" category="12" limit="10" ]
 */
add_shortcode('latest_works', 'ts_latest_works_func');

function ts_latest_works_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
		"category" => '',
		"limit" => 10,

		),
	$atts));

	$args = array(
		'numberposts'     => "",
		'posts_per_page'  => $limit,
		'meta_query'	  => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
		'offset'          => 0,
		'cat'			  =>  $category,
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'portfolio',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	$the_query = new WP_Query( $args );
	$html = '';
	if ( $the_query->have_posts() )
	{
		$list = '';
		$list2 = '';



		while ( $the_query->have_posts() )
		{
			$the_query->the_post();
			if (has_post_thumbnail(get_the_ID()))
			{
				$image = ts_get_resized_post_thumbnail(get_the_ID(),'latest-works',get_the_title(),'img-responsive');
			} else {
				continue;
			}

			$terms = strip_tags(get_the_term_list( get_the_ID(), 'portfolio-categories', '', ', ', '' ));



            $list.='	<li>
                <div class="project">

                    <div class="project-image">

                        '.$image.'
                        <div class="project-hover">

                            <a class="link-icon" href="'.get_permalink().'"></a>
                            <a class="search-icon" href="'.ts_img_url().'" rel="prettyPhoto"></a>

                        </div>

                    </div>

                    <div class="project-meta">

                        <h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
                        <span class="project-category">'.$terms.'</span>

                    </div>

                </div>
            </li>';

            $list2.= '<li>
											'.ts_get_resized_image(ts_img_url(),210,210,get_the_title(),'img-responsive',true);'
											<div class="carousel-item-hover">
												<i class="icons icon-search"></i>
											</div>
										</li>';
        };?>
<?php



		}
		if (!empty($list)) {
			$html = '<div class="projects-slider-carousel '.ts_get_animation_class($animation).'">

								<div class="flexslider products-slider">
									<ul class="slides">'.$list.'
									</ul>
								</div>

								<div class="flexslider products-carousel">
									<ul class="slides">
										'.$list2.'
									</ul>
									<ul class="carousel-arrows">
										<li class="arrow-left"></li>
										<li class="arrow-right"></li>
									</ul>
								</div>

							</div>';

		// Restor original Query & Post Data
		wp_reset_postdata();
	}
	return $html;
}