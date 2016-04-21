<?php
/**
 * The default template for displaying content
 *
 * @package marine
 * @since marine 1.0
 */

  $blog_style = ot_get_option('blog_style','list');
switch($blog_style){
    case 'grid': break;
    case 'alternate':

        get_template_part('inc/blog-types/alternate');
        break;
    case 'timeline':break;
    case 'list':
    default:
        get_template_part('inc/blog-types/list');
}