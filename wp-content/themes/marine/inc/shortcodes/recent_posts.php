<?php

/*
  * Shortcode Title: Recent Posts
  * shortcode: recent_posts
 *  usage :[recent_posts animation="fade" length="100" count=10 ],
  */


add_shortcode('recent_posts', 'recent_posts_func');

function recent_posts_func($atts, $content = null)
{


    extract(shortcode_atts(array(
        'animation' => '',
        'count' => '',
        'length' => ''
    ), $atts));


    $html = '';
    if (!is_numeric($count)) {

        $count = 2;

    }

    if (empty($length)) {
        $length = 30;
    }


    $latest = new Wp_Query(

        array(

            'post_type' => 'post',

            'posts_per_page' => $count

        )

    );


    ob_start();

    if ($latest->have_posts()):

        while ($latest->have_posts()): $latest->the_post();?>
            <div class="blog-post recent-post <?php echo ts_get_animation_class($animation); ?>">
			
                <div class="post-image">
				
					<div class="recent-post-meta">
						<span class="post-date">
								<span class="post-day"><?php echo get_the_date('d'); ?></span><br>
							<?php echo get_the_date('M, Y'); ?>
						</span>
						<span class="post-format">
							<?php ts_post_icon(); ?>
						</span>
					</div>
				
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title());?>"><?php ts_the_resized_post_thumbnail('recent_posts_sc', get_the_title(), 'img-responsive'); ?></a>
                    </div>
					
                </div>

                <div class="post-content">
                    <ul class="post-meta">
                        <li><?php _e('By', 'marine'); ?><?php the_author(); ?></li>
                        <li><?php echo ts_post_categories(get_the_ID()); ?></li>
                        <li><?php comments_number('0 Comment', '0 Comment', '% Comments'); ?>.</li>
                        <li><a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'marine'); ?></a></li>
                    </ul>
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php echo ts_get_the_excerpt_theme($length); ?>
                </div>
            </div>
        <?php
        endwhile; 
	endif;

    wp_reset_postdata();
    $html = ob_get_contents();
    ob_end_clean();
    return $html;


}