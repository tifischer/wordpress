<?php
/**
 * Shortcode Title: Food menu 2
 * Shortcode: food_menu_2
 * Usage: [food_menu_2 animation="bounceInUp" title="Your title" title_color="#FF0000" title_font="Arial" subtitle_color="#DDD" color="#FFFFFF" background_color="#000000"]
 */
add_shortcode('food_menu_2', 'ts_food_menu_2_func');

function ts_food_menu_2_func($atts, $content = null)
{
    global $post, $wp_query;

    extract(shortcode_atts(array(
		'animation' => '',
		'title' => '',
		'title_color' => '',
		'title_font' => '',
		'subtitle_color' => '',
		'color' => '',
		'background_color' => ''
	),
	$atts));

    $styles = array();
	$main_color_style = '';
	if (!empty($color)) {
		$styles[] = 'color: '.$color;
		$main_color_style = 'style="color: '.$color.'"';
	}
	if (!empty($title_font)) {
		$styles[] = 'font-family: '.$title_font;
	}
	$styles_html = '';
	if (count($styles) > 0) {
		$styles_html = 'style="'.implode(';',$styles).'"';
	}
	
	$subtitle_color_html = '';
	if (!empty($subtitle_color)) {
		$subtitle_color_html = 'style="color: '.$subtitle_color.'"';
	}
	
	//get categories
	$cat_args = array(
		'orderby'           => 'id', 
		'order'             => 'ASC',
		'hide_empty'        => true		
	); 
	$categories = get_terms('menu-categories', $cat_args);
	$categories = ts_get_sorted_terms($categories);
	
	ob_start();
	if ($categories && !is_wp_error($categories)): ?>
		
		<!-- Food Menu -->
		<section class="section full-width">

			<div class="food-menu-full" <?php echo !empty($background_color) ? 'style="background-color: '.$background_color.'"' : ''; ?>>

				<div class="container">

					<div class="row">

						<div class="col-lg-4 col-md-4 col-sm-5 col-lg-push-8 col-md-push-8 col-sm-push-7">

							<div class="food-menu-nav">
								
								<?php
								foreach ($categories as $category): 
									
									$image = get_option('ts_taxonomy_image'.$category -> term_id);
									?>
									<div class="food-menu-nav-item">
										<div class="nav-img">
											<?php if (!empty($image)): ?>
												<img src="<?php echo esc_url($image); ?>" alt="">
											<?php endif; ?>
										</div>
										<div class="nav-content">
											<h5><?php echo $category -> name; ?></h5>
											<span><?php echo $category -> description; ?></span>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>



						<div class="col-lg-8 col-md-8 col-sm-7 col-lg-pull-4 col-md-pull-4 col-sm-pull-5">

							<div class="flexslider food-menu-full-slider">

								<ul class="slides">
									
									<?php
									
									foreach ($categories as $category): 
										
										$args = array(
											'numberposts' => "",
											'posts_per_page' => -1,
											'offset' => 0,
											'orderby' => 'menu_order',
											'order' => 'ASC',
											'include' => '',
											'exclude' => '',
											'meta_key' => '',
											'meta_value' => '',
											'post_type' => 'food_menu',
											'post_mime_type' => '',
											'post_parent' => '',
											'paged' => 1,
											'post_status' => 'publish',
											'tax_query' => array(
												array(
													'taxonomy' => 'menu-categories',
													'field' => 'id',
													'terms' => array($category -> term_id)
												)
											)
										);

										$the_query = new WP_Query($args);

										if ($the_query->have_posts()): 

											//slide title
											$new_slide_title = '';
											if (!empty($title)):
												$slide_title = sprintf($title , $category -> name);
												if (!strstr($slide_title, $category -> name)) {
													$slide_title = $title.' '.$category -> name;
												}
												$slide_title_array = explode(' ',$slide_title,2);

												if (is_array($slide_title_array)):
													if (isset($slide_title_array[0])):
														$new_slide_title .= '<span class="orange" '.(!empty($title_color) ? 'style="color: '.$title_color.'"' : '').'>'.$slide_title_array[0].'</span>';
													endif;
													if (isset($slide_title_array[1])):
														$new_slide_title .= ' '.$slide_title_array[1];
													endif;
												else:
													$new_slide_title = $category -> name;
												endif;
											endif; 
											?>
											<li>

												<div class="food-menu-content">

													<h2 class="cursive-style2" <?php echo $styles_html; ?>><?php echo $new_slide_title; ?></h2>
													<span class="menu-period" <?php echo $subtitle_color_html; ?>><?php echo $category -> description; ?> </span>

													<div class="food-menu" <?php echo $styles_html; ?>>
														
														<?php while ($the_query->have_posts()):  

															$the_query->the_post(); ?>

															<div class="food-menu-item">
																<h6 class="food-name" <?php echo $main_color_style; ?>><?php the_title(); ?></h6>
																<div class="food-description">
																	<div class="details">
																		<span><?php echo get_post_meta($post -> ID, 'details', 'true'); ?></span>
																	</div>
																	<div class="dots"></div>
																	<div class="price">
																		<span><?php echo get_post_meta($post -> ID, 'price', 'true'); ?></span>
																	</div>
																</div>
															</div>

														<?php endwhile; ?>
													</div>

												</div>

											</li>
									
										<?php endif; ?>
											
									<?php endforeach; ?>
									
									

								</ul>

							</div>

						</div>

					</div>

				</div>

			</div>

		</section>
		<!-- /Food Menu -->
	<?php endif;
	
	$html = ob_get_contents();
    ob_end_clean();
	
    return $html;
}