<?php
/**
 * The Sidebar containing the left widget areas.
 *
 * @package marine
 * @since marine 1.0
 */
?>
<aside class="sidebar col-lg-3 col-md-4 col-sm-4 col-md-pull-8 col-lg-pull-9">
    <?php dynamic_sidebar( ts_get_single_post_sidebar_id('left_sidebar') ); ?>
</aside>