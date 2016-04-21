<?php
/**
 * Template Name: Blog - Timeline
 * 
 * @package marine
 * @since marine 1.0
 */

get_header();

//adhere to paging rules
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
$posts_per_page = get_post_meta(get_the_ID(), 'number_of_items', true);

if (!$posts_per_page) {
    $posts_per_page = get_option('posts_per_page');
}

global $query_string;

$blog_categories = get_post_meta(get_the_ID(), 'blog_categories', true);

$args = array(
    'numberposts' => '',
    'posts_per_page' => $posts_per_page,
    'offset' => 0,
    'category__in' => is_array($blog_categories) ? $blog_categories : '',
    'orderby' => 'date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'post_mime_type' => '',
    'post_parent' => '',
    'paged' => $paged,
    'post_status' => 'publish'
);
query_posts($args);
?>
    <script>
        var timelinePerPage = <?php echo $posts_per_page;?>;
        var timelineOffset = 0;
        var timelineOffsetNext = (   timelinePerPage * timelineOffset ) + timelinePerPage; // Current

        // Offset of page
        var currentMonth = null;
        var currentYear = null;
        var templateUrl = "<?php echo get_template_directory_uri();?>";

    </script>

    <section class="full-width-bg normal-padding medium-gray-bg ">
		<div class="timeline-container-wrap">
        <?php if (have_posts()) : ?>
        <?php /* Start the Loop */ ?>
        <?php
        $alternate_count = 0;
        $counter=0;
        while (have_posts()) :
			$counter++;

			the_post();

			if (!isset($this_month)) {
				$this_month = get_the_date("F");
				$this_year = get_the_date("Y");
			}
			$current_month = get_the_date("F");
			$current_year = get_the_date("Y");
			?>
			<?php if ($counter == 1): ?>
				<div class="timeline-date-tooltip">
					<span><?php echo get_the_date('F Y'); ?></span>
				</div>
				<div class="row timeline-row">
					<div class="masonry-container timeline-container">
			<?php else: ?>
				<?php
				if (($this_month == $current_month && $this_year == $current_year) || $counter == 1):

				else:
					$this_month = get_the_date("F");
					$this_year = get_the_date("Y");
					echo '
						</div></div>
						<div class="timeline-date-tooltip timeline-date-tooltip-top">
							<span>' . get_the_date('F Y') . '</span>
						</div>
						<div class="row timeline-row">
							<div class="masonry-container timeline-container">';
				endif;
			endif;
				?>
				<div class="col-lg-6 col-md-6 col-sm-6 masonry-box" data-year="<?php echo get_the_date('Y'); ?>" data-month="<?php echo get_the_date('F'); ?>">
					<div class="blog-post masonry timeline">
						<!-- POST FOOTER -->
						<div class="post-footer">
							<?php echo get_avatar(get_the_author_meta('user_email'), '60'); ?>
							<span class="post-date">
								<span class="post-day"><?php echo get_the_date('d M'); ?> </span>
								<?php echo get_the_date('Y'); ?>
							</span>
							<ul class="post-meta">
								<li> <?php _e('By', 'marine'); ?> <?php the_author(); ?> </li>
								<li><?php echo ts_post_categories(get_the_ID()); ?> </li>
							</ul>
						</div>
						<!-- END POST FOOTER -->
						<?php get_template_part('inc/timeline-content/content', get_post_format()); ?>
					</div>
				</div>

			<?php endwhile;
			wp_reset_query();
			wp_reset_postdata();?>
			<?php //ts_the_marine_navi(); ?>
			<?php else : //No posts were found ?>
				<?php get_template_part('no-results'); ?>
			<?php
			endif;
			?>
		</div>
	</div>
		
	
		
	

	</div> <!-- .masonry-container-wrapper -->	
		
		
		
		
	<div class="align-center load-more">
		<a class="button big blue button-load-more" id="timeline-load-more" href="#"><?php _e('Load More', 'marine'); ?></a>
	</div>
</section>
<?php get_footer(); ?>