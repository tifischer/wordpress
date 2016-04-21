<?php
/**
 * The Sidebar containing the right widget areas.
 *
 * @package marine
 * @since marine 1.0
 */
?>
<aside class="sidebar col-lg-3 col-md-4 col-sm-4">
    <?php dynamic_sidebar( ts_get_single_post_sidebar_id('right_sidebar') ); ?>
</aside>