<?php
/**
 * Shortcode Title: Food menu
 * Shortcode: food_menu
 * Usage: [food_menu animation="bounceInUp" title="Your title" title_color="#FF0000" title_font="Arial" color="#FFFFFF"]
 */
add_shortcode('food_menu', 'ts_food_menu_func');

function ts_food_menu_func($atts, $content = null)
{
    global $post, $wp_query;

    extract(shortcode_atts(array(
		'animation' => '',
		'title' => '',
		'title_color' => '',
		'title_font' => '',
		'color' => ''
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
		
		<!-- Menu Slider -->
		<div class="flexslider food-menu-slider">

			<ul class="slides">
				<?php foreach ($categories as $category):

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

							<div class="food-menu-slider-item">

								<h2 class="cursive-style2" <?php echo $styles_html; ?>><?php echo $new_slide_title; ?></h2>

								<div class="row">

									<?php 
									$column = ceil($the_query->found_posts / 2);

									$i = 0;
									$closed = true;
									while ($the_query->have_posts()):  

										$the_query->the_post(); 

										if ($i % $column == 0): 
											$closed = false; ?>
											<div class="col-lg-6 col-md-6 col-sm-6">
										<?php endif; ?>

										<div class="food-menu" <?php echo $main_color_style; ?>>
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
										</div>

										<?php if ($i % $column == ($column - 1)): 
											$closed = true; ?>
											</div>
										<?php endif; ?>

									<?php 
										$i ++;
									endwhile; 
									if (!$closed):
										echo '</div>';
									endif; ?>
								</div>

							</div>

						</li>

					<?php endif;
					wp_reset_postdata(); 
				endforeach; ?>
			</ul>
		</div>
		<!-- /Menu Slider -->
	<?php endif;
	
	$html = ob_get_contents();
    ob_end_clean();
	
    return $html;
}