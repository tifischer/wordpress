<?php

/*
  * Shortcode Name: Blogtimeline
  * Shortcode: blogtimeline
  * Usage: [blogtimeline load_more="Load More" posts_per_page="10"]
  */

add_shortcode('blog_timeline', 'ts_blogtimeline_func');

function ts_blogtimeline_func($atts, $content = null)
{

    extract(shortcode_atts(array(

        'load_more' => '',

        'posts_per_page' => ''

    ), $atts));


    $posts_per_page = $posts_per_page ? $posts_per_page : 10;

    $load_more = $load_more ? $load_more : __('Load More', 'marine');


    global $query_string;

    $args = array(
        'numberposts' => '',
        'posts_per_page' => $posts_per_page,
        'offset' => 0,
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

    query_posts($args);

    ob_start();

    ?>



    <script>

        var timelinePerPage = <?php echo $posts_per_page;?>;

        var timelineOffset = 0;

        var timelineOffsetNext = (   timelinePerPage * timelineOffset ) + timelinePerPage; // Current

        // Offset of page

        var currentMonth = null;

        var currentYear = null;

        var templateUrl = "<?php echo get_template_directory_uri();?>"

    </script>









    <div class="timeline-container-wrap">


        <?php if (have_posts()) : ?>

        <?php /* Start the Loop */ ?>

        <?php

        $counter1 = 0;
        while (have_posts()) :

        $counter1++;

        the_post();

        if (!isset($this_month)) {

            $this_month = get_the_date("F");

            $this_year = get_the_date("Y");

        }


        $current_month = get_the_date("F");

        $current_year = get_the_date("Y");



        ?>

        <?php if ($counter1 == 1): ?>

        <div class="timeline-date-tooltip">

            <span><?php echo get_the_date('F Y'); ?></span>

        </div>

        <div class="row timeline-row">

            <div class="masonry-container timeline-container">

                <?php else: ?>



                    <?php

                    if (($this_month == $current_month && $this_year == $current_year)) {


                    } else {

                        $this_month = get_the_date("F");

                        $this_year = get_the_date("Y");


                        echo '</div></div><div class="timeline-date-tooltip timeline-date-tooltip-top">

            <span>' . get_the_date('F Y') . '</span>

        </div>

        <div class="row timeline-row">

            <div class="masonry-container timeline-container">';

                    }

                endif;

                ?>



                <div class="col-lg-6 col-md-6 col-sm-6 masonry-box" data-year="<?php echo get_the_date('Y'); ?>" data-month="<?php echo get_the_date('F'); ?>">

                    <div class="blog-post masonry">

                        <!-- POST FOOTER -->

                        <div class="post-footer">


                            <?php echo get_avatar(get_the_author_meta('user_email'), '50'); ?>



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
                endif;

                wp_reset_postdata();

                wp_reset_query();

                ?>


            </div>

        </div>


    </div>

    <div class="align-center load-more">

        <a class="button big blue button-load-more" id="timeline-load-more" href="#"><?php echo $load_more; ?></a>

    </div>


    <?php

    $html =  ob_get_contents();

    ob_end_clean();
    return $html;

}