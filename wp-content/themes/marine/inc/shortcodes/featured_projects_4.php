<?php
/**
 * Shortcode Title: Featured projects 4
 * Shortcode: featured_projects_4
 * Usage: [featured_projects_4 animation="bounceInUp" category_filter="yes" category_filter_color="#FFF" category_filter_background="#333" category_filter_border="#DDD" category="" limit="6" title="Your title" title_color="#FFF" subtitle="Your subtitle" subtitle_color="#DDD" hover_color="#FF0000"]
 */
add_shortcode('featured_projects_4', 'ts_featured_projects_4_func');

function ts_featured_projects_4_func($atts, $content = null)
{

    global $post;

    extract(shortcode_atts(array(
		'animation' => '',
		'category_filter' => '',
		'category_filter_color' => '',
		'category_filter_background' => '',
		'category_filter_border' => '',
		'category' => '',
		'limit' => 10,
		'hover_color' => '',
	),
	$atts));
	
	$category_filter_style_arr = array();
    if (!empty($category_filter_color)) {
        $category_filter_style_arr[] = 'color: ' . $category_filter_color;
    }
	
    if (!empty($category_filter_background)) {
        $category_filter_style_arr[] = 'background-color: ' . $category_filter_background;
    }
	
	if (!empty($category_filter_border)) {
        $category_filter_style_arr[] = 'border-color: ' . $category_filter_border;
    }
	
	$category_filter_style = '';
	if (count($category_filter_style_arr) > 0) {
		$category_filter_style = 'style="'.implode(';',$category_filter_style_arr).'"';
	}
	
    $hover_style = '';
    if (!empty($hover_color)) {
        $hover_style = 'style="background-color: ' . ts_hex_to_rgb($hover_color,'0.9') . '"';
    }
	
    if(empty($limit)) {
        $limit=6;
    }
    $html = '';
    $args = array(
        'posts_per_page' => $limit,
        'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
        'offset' => 0,
        'orderby' => 'date',
        'order' => 'DESC',
        'include' => '',
        'exclude' => '',
        'meta_key' => '',
        'meta_value' => '',
        'post_type' => 'portfolio',
        'post_mime_type' => '',
        'post_parent' => '',
        'paged' => 1,
        'post_status' => 'publish'
    );

    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio-categories',
                'field' => 'id',
                'terms' => explode(',', $category)
            ),
        );
    }

    $the_query = new WP_Query($args);

	ob_start();

    if ($the_query->have_posts()) : 
		
		$taxonomies = array('portfolio-categories');
		$terms = get_terms( $taxonomies ); ?>

		<!-- Featured projects 4 -->
		<div class="align-center">
			<?php if ($category_filter == 'yes'): ?>
				<div class="sorting-tags style2" <?php echo $category_filter_style; ?>>
					<div class="filter" data-filter="all"><?php _e('All', 'marine'); ?></div>
					<?php if (is_array($terms) && !is_wp_error($terms)):
						foreach ($terms as $term): ?>
							<div class="filter" data-filter=".category-<?php echo $term -> slug; ?>" ><?php echo $term -> name; ?></div>
						<?php endforeach;
					endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="projects-container projects-style3">
			<?php while ($the_query->have_posts()):  

				$the_query->the_post();

				$cat = array();
				$cat1 = array();

				$item_cats = wp_get_post_terms(get_the_ID(), 'portfolio-categories');
				foreach ($item_cats as $item_cat) {
					$cat[] = 'category-' . $item_cat->slug;
					$cat1[] = $item_cat->name;
				}

				$cat_html = '';
				if(is_array($cat)){
					$cat_html = implode(' ',$cat);
				}

				$cat1_html = '';
				if(is_array($cat1)){
					$cat1_html = implode(' ',$cat1);
				} ?>
				
				<!-- Project -->
				<div class="col-lg-4 col-md-4 col-sm-4 mix <?php echo $cat_html; ?>">
					<div class="project style2">
						<div class="project-image">
							<?php ts_the_resized_post_thumbnail('featured_projects_4', get_the_title(), 'img-responsive'); ?>
							<div class="project-hover" <?php echo $hover_style; ?>>
								<div class="project-description">
									<div>
										<h4><?php echo ts_get_shortened_string_by_letters(get_the_title(), 20); ?></h4>
										<span><?php echo ts_get_shortened_string_by_letters($cat1_html, 30); ?></span>
									</div>
								</div>
								<div class="project-buttons">
									<a class="link-icon" href="<?php the_permalink(); ?>"></a>
									<a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Project -->
			<?php endwhile; ?>
		</div>
		<div class="clearfix"></div>
		<!-- /Featured projects 4 -->
        <?php wp_reset_postdata(); ?>
    <?php endif;

    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}