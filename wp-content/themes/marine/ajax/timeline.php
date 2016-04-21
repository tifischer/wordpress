<?php
require '../../../../wp-load.php';
$pp = $_GET['posts_per_page'];
$offset = $_GET['offset'];

$current_month = $_GET['month'];
$current_year = $_GET['year'];

$args = array(
    'numberposts' => '',
    'posts_per_page' => $pp,
    'offset' => $offset,
    'cat' => '',
    'orderby' => 'date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'post_mime_type' => '',
    'post_parent' => '',
    'post_status' => 'publish'
);
$timeline = new Wp_Query($args);
if ($timeline->have_posts()):
    ob_start();
	$opened = false;
	$counter = 0;
    while ($timeline->have_posts()) :
        $timeline->the_post();
		$counter++;
        if (!isset($this_month)) {
            $this_month = get_the_date("F");
            $this_year = get_the_date("Y");
        }
		
		$current_month = get_the_date("F");
		$current_year = get_the_date("Y");
		
		if ($counter == 1) {
			$opened = true;
			echo '
				<div class="timeline-date-tooltip">
					<span>' . get_the_date('F Y') . '</span>
				</div>
				<div class="row timeline-row">
					<div class="masonry-container timeline-container">';
		} else if ($this_month == $current_month && $this_year == $current_year) {

        } else {
            $this_month = get_the_date("F");
            $this_year = get_the_date("Y");
			
			if ($opened == true) {
				echo '</div></div>';
			}			
			$opened = true;
			
            echo '
				<div class="timeline-date-tooltip">
					<span>' . get_the_date('F Y') . '</span>
				</div>
				<div class="row timeline-row">
					<div class="masonry-container timeline-container">';
        } ?>

        <div class="col-lg-6 col-md-6 col-sm-6 masonry-box" data-year="<?php echo get_the_date('Y'); ?>" data-month="<?php echo get_the_date('F'); ?>">
            <div class="blog-post masonry">
                <!-- POST FOOTER -->
                <div class="post-footer">
                    <?php echo get_avatar(get_the_author_meta('user_email'), '60'); ?>
                    <span class="post-date">
						<span class="post-day"><?php echo get_the_date('d'); ?> </span>
						<?php echo get_the_date('M, Y'); ?>
					</span>
                    <ul class="post-meta">
                        <li> By <?php the_author(); ?> </li>
                        <li><?php echo ts_post_categories(get_the_ID()); ?> </li>
                    </ul>
                </div>
                <!-- END POST FOOTER -->
                <?php get_template_part('inc/timeline-content/content', get_post_format()); ?>
            </div>
        </div>
    <?php endwhile;
	
	if ($opened):
		echo '</div></div>';
	endif;
	
else:
    echo 0;
    die;
endif;
$html = ob_get_clean();
echo $html;
