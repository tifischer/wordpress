<?php
/**
 * Shortcode Title: Featured projects
 * Shortcode: featured_projects
 * Usage: [featured_projects animation="bounceInUp" full="yes" category="6" limit="6" ]Your text here...[/featured_projects]
 */
add_shortcode('featured_projects', 'ts_featured_projects_func');

function ts_featured_projects_func($atts, $content = null)
{
    global $post;

    extract(shortcode_atts(array(
            'animation' => '',
            'full' => '',
            'category' => '',
            'limit' => 10,
        ),
        $atts));

    $header_color_style = '';
    if (!empty($header_color)) {
        $header_color_style = 'style="color: ' . $header_color . '"';
    }

    $text_color_style = '';
    if (!empty($text_color)) {
        $text_color_style = 'style="color: ' . $text_color . '"';
    }

    $item_text_color_style = '';
    if (!empty($item_text_color)) {
        $item_text_color_style = 'style="color: ' . $item_text_color . '"';
    }
    if($limit==''){
        $limit=5;
    }
    $html = '';
    $args = array(
        'numberposts' => "",
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

    if ($the_query->have_posts()) : ob_start(); ?>
        <?php 
			$image_size = 'featured_projects';
			if($full=='yes'):
				$image_size = 'featured_projects_full';
				?>
				<section class="full-width projects-section dark-gray-bg <?php ts_get_animation_class($animation);?>">
            <?php endif;?>
        <?php while ($the_query->have_posts()):  $the_query->the_post();
            $item_cats = wp_get_post_terms(get_the_ID(), 'portfolio-categories');
            foreach ($item_cats as $item_cat) {
                $cat[] = 'category-' . $item_cat->slug;
                $cat1[] = $item_cat->name;
            }

            if(is_array($cat)){
                $cat_html = implode(' ',$cat);
            }

            if(is_array($cat1)){
                $cat1_html = implode(' ',$cat1);
            }

            ?>
            <?php if($full=='yes') {
                $class= 'col-lg-3 col-md-3 col-sm-6';
            }else{
                $class = 'col-lg-3 col-md-3 col-sm-6 project-item mix '.$cat_html;
            }?>
            <div class="<?php echo $class;?>">
                <div class="project">
                    <div class="project-image wow animated fadeInLeft">
                        <?php ts_the_resized_post_thumbnail($image_size, get_the_title(), 'img-responsive'); ?>
                        <div class="project-hover">
                            <a class="link-icon" href="<?php the_permalink(); ?>"></a>
                            <a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>
                        </div>
                    </div>

                    <div class="project-meta wow animated fadeInLeft" data-wow-offset="0">
                        <h4><?php echo ts_get_shortened_string_by_letters(get_the_title(), 16); ?></h4>
                        <span class="project-category"><?php echo ts_get_shortened_string_by_letters($cat1_html, 20); ?></span>
                        <div class="project-like" data-post="<?php echo $post->ID; ?>">
                            <i class=" icons icon-heart-7"></i>
                            <span class="like-count"><?php echo ts_get_theme_likes(); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile;
		wp_reset_postdata(); 
		
		if($full=='yes'):?>
           </section>
        <?php endif;?>
		<div class="clearfix"></div>
    <?php endif;

    $html = ob_get_contents();
    ob_end_clean();
	
    return $html;
}