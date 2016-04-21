<?php
/**
 * Shortcode Tooltip
 * Shortcode: tooltip
 * Usage: [tooltip position="top" tooltip="tooltip title" link="http://google.com"]Your content goes here...[/tooltip]
 */

add_shortcode('tooltip', 'ts_tooltip_func');
function ts_tooltip_func($atts, $content = null)
{
    extract(shortcode_atts(array(
        'link' => '#',
        'tooltip' => '',
        'position' => 'top'
    ), $atts));

    return '<a title="' . $tooltip . '" data-placement="' . $position . '" data-toggle="tooltip" class="hover-tooltip" href="'.$link.'" data-original-title="Text Tooltip">' . $content . '</a>';
}