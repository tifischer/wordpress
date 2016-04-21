<?php
/*
  * Shortcode Name : Column Offset
  * shortcode:  col_offset
  * Usage: [col_offset cols="5" offset="2"]
  */

add_shortcode('col_offset', 'ts_col_offset_func');
function ts_col_offset_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'cols' => '',
        'offset' => ''
    ), $atts));

    return '<div  class="col-lg-' . $cols . ' col-md-' . $cols . ' col-sm-' . $cols . ' col-lg-push-' . $offset . ' col-md-push-' . $offset . ' col-sm-push-' . $offset . '">' . do_shortcode($content) . '</div>';
}