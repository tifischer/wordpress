<?php
/**
 * Shortcode Title: Counter
 * Shortcode: counter
 * Usage: [counter animation="bounceInUp" bgcolor="#fff" fgcolor="#ff0000" textcolor="#fff" title="Your title" quantity="1000"]
 */
add_shortcode('counter', 'counter_func');

function counter_func($atts, $content = null)
{

    extract(shortcode_atts(array(
            'animation' => '',
            'bgcolor' => '',
            'fgcolor' => '',
            'textcolor' => '',
            'title' => '',
            'quantity' => ''
        ),
        $atts));
    return '<div class="circular-counter '.ts_get_animation_class($animation).'"><input type="text" class="circular-progressbar" value="' . $quantity . '" data-readOnly="true" data-displayInput="false" data-thickness="0.03" data-fgColor="'.$fgcolor.'" data-bgColor="'.$bgcolor.'" data-textcolor="'.$textcolor.'" data-title="' . $title . '"></div>';


}