<?php
/*
 * Template Name: Blog - Grid Style
 * 
 * @package marine
 * @since marine 1.0
 */
get_header();
//adhere to paging rules
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$posts_per_page = get_post_meta(get_the_ID(),'number_of_items',true);
if (!$posts_per_page) {
    $posts_per_page = get_option('posts_per_page');
}

$blog_categories = get_post_meta(get_the_ID(), 'blog_categories', true);

global $query_string;
$args = array(
    'numberposts'     => '',
    'posts_per_page' => $posts_per_page,
    'offset'          => 0,
    'category__in' => is_array($blog_categories) ? $blog_categories : '',
    'orderby'         => 'date',
    'order'           => 'DESC',
    'include'         => '',
    'exclude'         => '',
    'meta_key'        => '',
    'meta_value'      => '',
    'post_type'       => 'post',
    'post_mime_type'  => '',
    'post_parent'     => '',
    'paged'				=> $paged,
    'post_status'     => 'publish'
);
query_posts( $args );

$url = ts_get_theme_next_page_url();
?>
<section class="row">
	<div class="masonry-container">
		<?php if (have_posts()) : ?>
			<div id="post-items">
				<?php /* Start the Loop */ 
				while (have_posts()) : the_post(); ?>
					<?php   get_template_part('inc/post-content/content',get_post_format());?>
				<?php endwhile;  ?>
			</div>
			<?php wp_reset_query(); ?>
		<?php else : //No posts were found ?>
			<?php get_template_part('no-results'); ?>
		<?php endif; ?>
	</div>
</section>
<div class="row">
	<div class="align-center load-more">
		<?php 
		if (!empty($url)): ?>
			<a class="button big blue button-load-more" id="load-more" href="<?php echo $url; ?>" data-loading="<?php _e('Loading posts', 'marine'); ?>"><?php _e('Load More', 'marine'); ?></a>
		<?php endif; ?>
	</div>
</div>
<?php get_footer();?>