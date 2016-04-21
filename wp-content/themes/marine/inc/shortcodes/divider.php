<?php
/**
 * Shortcode Title: Divider
 * Shortcode: divider
 * Usage: [divider  color="#FF0000"]
 */
add_shortcode('divider', 'ts_hr_func');

function ts_hr_func($atts, $content = null)
{

    extract(shortcode_atts(array(
            'color' => '',

        ),
        $atts));
    $html = null;

    $divider_style= array();
    if(!empty($color)){
        $divider_style[]= 'border-color:' . $color;
    }

    $divider_style_html=null;
    if(is_array($divider_style)){
        $divider_style_html = 'style="'.implode(';',$divider_style).'"';
    }

    $html .= '<hr class="divider col-xs-12" '.$divider_style_html.' >';
    return $html;
}