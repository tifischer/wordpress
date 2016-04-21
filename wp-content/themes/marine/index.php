<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package marine
 * @since marine 1.0
 */
get_header();

$url = ts_get_theme_next_page_url();
?>
<div class="row">
	<section class="main-content col-lg-9 col-md-9 col-sm-8 small-padding">
		<?php if (have_posts()) : ?>
			<div id="post-items" class="row">
				<?php /* Start the Loop */
				while (have_posts()) : the_post(); ?>
					<?php get_template_part('content', get_post_format()); ?>
				<?php endwhile; ?>
			</div>
			<div class="row">
				<div class="align-center load-more">
					<?php 
					if (!empty($url)): ?>
						<a class="button big blue button-load-more" id="load-more" href="<?php echo $url; ?>" data-loading="<?php _e('Loading...', 'marine'); ?>"><?php _e('Load More', 'marine'); ?></a>
					<?php endif; ?>
				</div>
			</div>
		<?php else : //No posts were found ?>
			<?php get_template_part('no-results'); ?>
		<?php endif; ?>
	</section>
	
	<?php get_sidebar(); ?>
</div>
<?php get_footer();