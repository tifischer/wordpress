<?php
/*
 * Template Name: Portfolio 2 Column
 * 
 * @package marine
 * @since marine 1.0
 */
get_header();

$class = ts_check_if_any_sidebar(
	'col-lg-12 col-md-12 col-sm-12',
	'col-lg-9 col-md-8 col-sm-8',
	'');

if (ts_get_single_post_sidebar_position() == 'left') {
	$class .= ' col-md-push-4 col-lg-push-3';
}

$posts_per_page = get_post_meta(get_the_ID(), 'number_of_items', true);
if (!$posts_per_page) {
	$posts_per_page = -1;
}

if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
$portfolio_categories = get_post_meta(get_the_ID(), 'portfolio_categories', true);
?>

 <section id="projects-container" class="portfolio-2column normal-padding">
	<div class="sorting-tags light">
		<div><?php _e('Sort Portfolio','framework');?></div>
		<div class="filter" data-filter="all"><?php _e('All', 'marine');?></div>
		<?php $folio_cats = get_terms('portfolio-categories');
		foreach($folio_cats as $folio_cat):
			if (is_array($portfolio_categories) && !in_array($folio_cat -> term_id, $portfolio_categories)):
				continue;
			endif;
			?>
			<div class="filter" data-filter=".category-<?php echo $folio_cat->slug;?>"><?php echo $folio_cat->name; ?></div>
		<?php endforeach;?>
	</div>
	<div class="row">
		<div class="<?php echo $class ?>">
			<?php
			$args = array(
				'numberposts' => '',
				'posts_per_page' => $posts_per_page,
				'offset' => 0,
				'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
				'orderby' => 'date',
				'order' => 'DESC',
				'include' => '',
				'exclude' => '',
				'meta_key' => '',
				'meta_value' => '',
				'post_type' => 'portfolio',
				'post_mime_type' => '',
				'post_parent' => '',
				'paged' => $paged,
				'post_status' => 'publish'
			);
			
			if (is_array($portfolio_categories)):
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'portfolio-categories',
						'terms' => $portfolio_categories,
						'operator' => 'IN'
					)
				);
			endif;
			
			query_posts($args);
			
			$url = ts_get_theme_next_page_url();
			?>
			<?php if (have_posts()) : ?>
				<div id="post-items">
					<?php while(have_posts()):  
						the_post();
						$item_cats = wp_get_post_terms(get_the_ID(),'portfolio-categories');
						$cat = array();
						$cat1 = array();
						foreach($item_cats as $item_cat):
							if (is_array($portfolio_categories) && !in_array($item_cat -> term_id, $portfolio_categories)):
								continue;
							endif;
							$cat[] = 'category-'.$item_cat->slug;
							$cat1[] = $item_cat->name;
						endforeach;
						?>
						<div class="col-lg-6 col-md-6 col-sm-6 project-item mix <?php echo implode(' ',$cat);?>">
							<div class="project">
								<div class="project-image">
									<?php ts_the_resized_post_thumbnail('portfolio-1-col', get_the_title(),'img-responsive'); ?>
									<div class="project-hover">
										<a class="link-icon" href="<?php the_permalink(); ?>"></a>
										<a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>
									</div>
								</div>
								<div class="project-meta">
									<h4><?php the_title();?></h4>
									<span class="project-category"><?php echo implode(',',$cat1);?></span>
									<div class="project-like" data-post="<?php echo $post->ID; ?>">
										<i class=" icons icon-heart-7"></i>
										<span class="like-count"><?php echo ts_get_theme_likes(); ?></span>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_query();?>
				</div>
			<?php endif;?>
		</div>
		<?php ts_get_single_post_sidebar('left'); ?>
        <?php ts_get_single_post_sidebar('right'); ?>
	</div>
	<div class="align-center load-more">
		<?php 
		if (!empty($url)): ?>
			<a class="button big blue button-load-more" id="load-more" href="<?php echo $url; ?>" data-loading="<?php _e('Loading...', 'marine'); ?>"><?php _e('Load More', 'marine'); ?></a>
		<?php endif; ?>
	</div>
</section>
<?php get_footer();?>
