<?php
/**
 * Template Name: Portfolio Full Width
 * 
 * @package marine
 * @since marine 1.0
 */
get_header();

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
<section class="full-width projects-section dark-gray-bg">

	<div class="align-center">

		<h2 class="section-heading"><?php _e('Our Work','framework');?></h2>

		<div class="sorting-tags">
			<div class="filter" data-filter="all"><?php _e('All','framework');?></div>
			<?php $folio_cats = get_terms('portfolio-categories');

			foreach ($folio_cats as $folio_cat):
				if (is_array($portfolio_categories) && !in_array($folio_cat -> term_id, $portfolio_categories)):
					continue;
				endif;
				?>
				<div class="filter" data-filter=".category-<?php echo $folio_cat->slug; ?>"><?php echo $folio_cat->name; ?></div>
			<?php endforeach; ?>
		</div>

	</div>
	<div id="projects-container" class="full-width-portfolio">
		<?php
		$args = array(
			'numberposts' => '-1',
			'posts_per_page' => $posts_per_page,
			'offset' => 0,
			'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
			'cat' => '',
			'orderby' => 'id',
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

		?>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()):
				the_post();
				$item_cats = wp_get_post_terms(get_the_ID(), 'portfolio-categories');
				$cat = array();
				$cat1 = array();
				foreach ($item_cats as $item_cat) {
					if (is_array($portfolio_categories) && !in_array($item_cat -> term_id, $portfolio_categories)):
						continue;
					endif;
					$cat[] = 'category-' . $item_cat->slug;
					$cat1[] = $item_cat->name;
				}
				?>
				<!-- Project -->
				<div class="col-lg-3 col-md-3 col-sm-4 mix <?php echo implode(' ', $cat); ?>">
					<div class="project">
						<div class="project-image">
							<?php ts_the_resized_post_thumbnail('portfolio-3-col', get_the_title(), 'img-responsive'); ?>
							<div class="project-hover">
								<a class="link-icon" href="<?php the_permalink(); ?>"></a>
								<a class="search-icon" href="<?php echo ts_img_url(); ?>" rel="prettyPhoto"></a>
							</div>
						</div>
						<div class="project-meta">
							<h4><?php the_title(); ?></h4>
							<span class="project-category"><?php echo implode(',', $cat1); ?></span>
							<div class="project-like" data-post="<?php echo $post->ID; ?>">
								<i class=" icons icon-heart-7"></i>
								<span class="like-count"><?php echo ts_get_theme_likes(); ?></span>
							</div>
						</div>
					</div>
				</div>
				<!-- /Project -->
			<?php endwhile;
		endif;
		wp_reset_postdata();
		wp_reset_query();
		?>
	</div>
</section>
<section class="container">
	<div class="row">
		<?php if (have_posts()): 
			while (have_posts()): the_post(); ?>
				<div class="col-sm-12">
					<?php the_content(); ?>
				</div>
			<?php endwhile; 
		endif; ?>
	</div>
</section>
<?php get_footer(); ?>