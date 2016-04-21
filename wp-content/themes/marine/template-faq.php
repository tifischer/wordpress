<?php
/*
 * Template Name: FAQ
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
?>

<div class="faq-filters">
	<ul>
		<li class="filter" data-filter="all"><?php _e('All', 'framework'); ?></li>
		<?php $cats = get_terms('faq-categories');
		foreach ($cats as $cat):
			?>
			<li class="filter" data-filter=".faq-<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></li>
		<?php endforeach; ?>
	</ul>
</div>

<div class="row">
	<section class="main-content <?php echo $class; ?> small-padding">
		<div class="accordions faq-accordions">
			<?php
                $args = array(
                    'posts_per_page' => $posts_per_page,
                    'offset' => 0,
                    'cat' => '',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'include' => '',
                    'exclude' => '',
                    'meta_key' => '',
                    'meta_value' => '',
                    'post_type' => 'faq',
                    'post_mime_type' => '',
                    'post_parent' => '',
                    'paged' => $paged,
                    'post_status' => 'publish'
                );
                query_posts($args);
            ?>
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()):
					the_post();
					$item_cats = wp_get_post_terms(get_the_ID(), 'faq-categories');
					$cat = array();
					foreach ($item_cats as $item_cat):
						$cat[] = 'faq-' . $item_cat->slug;
					endforeach;
					?>
					<!-- Accordion -->
					<div class="accordion mix <?php echo implode(' ',$cat); ?>">
						<div class="accordion-header">
							<div class="accordion-icon"></div>
							<h5><?php the_title(); ?></h5>
						</div>
						<div class="accordion-content"><?php the_content(); ?></div>		
					</div>
					<!-- /Accordion -->
				<?php endwhile;
			endif;
			wp_reset_query();
			wp_reset_postdata(); ?>
		</div>
	</section>
	<?php ts_get_single_post_sidebar('left'); ?>
	<?php ts_get_single_post_sidebar('right'); ?>
</div>
<?php get_footer(); ?>