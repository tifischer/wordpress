<?php
/**
 * Shortcode Title: Person
 * Shortcode: person
 * Usage: [person animation="bounceInUp" link="url" title_color="#000" sub_title_color="#000" text_color="#000" divider_color="#000" icon_color="#000" target="_self"  style="style1" id=1]
 */
add_shortcode('person', 'ts_person_func');

function ts_person_func($atts, $content = null)
{	
    extract(shortcode_atts(array(
        'animation' => '',
        'id' => 0,
        'style' => '',
        'link' => '',
        'target' => '',
        'title_color' => '',
        'sub_title_color' => '',
        'text_color' => '',
        'divider_color' => '',
        'icon_color' => ''
    ), $atts));

    global $post;
    $html='';

    $title_style = '';
    if (!empty($title_color)) {
        $title_style = 'style=" color: ' . $title_color . ' "';
    }

    $sub_title_style = '';
    if (!empty($sub_title_color)) {
        $sub_title_style = 'style=" color: ' . $sub_title_color . ' "';
    }

    $text_style = '';
    if (!empty($text_color)) {
        $text_style = 'style=" color: ' . $text_color . ' "';
    }

    $icon_color_style = '';
    if(!empty($icon_color)){
        $icon_color_style .= 'style="color: ' . $icon_color . '"';
    }
	
	$divider_color_style = ''; 
	if (!empty($divider_color)) {
		$divider_color_style = 'style="border-top-color:' . $divider_color . '"';
	}

    $new_post = null;
    if (!empty($id)) {
        $new_post = get_post($id);
    }
    if ($new_post) {
        $old_post = $post;
        $post = $new_post;


        setup_postdata($post);
        $image = '';
        if (has_post_thumbnail($post->ID)) {
            $image = ts_get_resized_post_thumbnail($post->ID, 'person', 'img-responsive', 'img-responsive');
        }

        $html .= '
			<div class="team-member ' . ts_get_animation_class($animation) . '" data-animation="' . $animation . '">
				<a  href="' . $link . '" target="' . $target . '" title="' . esc_attr(get_the_title()) . '">
					' . $image . '
				</a>
        ';
        if ($style == 'style1') {
			
			$member_content = apply_filters('the_content',get_the_content());
			
			$html .= '
				<a class="read-more"></a>
				<h4 ' . $title_style . ' class="post-title">' . get_the_title() . '</h4>
				<span ' . $sub_title_style . '  class="job-title">' . get_post_meta($post->ID, 'team_position', true) . '</span>
				<div class="text-content" ' . $text_style . '>' . $member_content . '</div> 
				<span class="small-line" '.$divider_color_style.'></span>';
        }

        $html .= '<ul class="social-media">';
        $xs_social_icons = array(
            'facebook',
            'twitter',
            'skype',
            'google',
            'vimeo',
            'linkedin',
            'instagram'
        );
        foreach ($xs_social_icons as $social_icon) {
            $social_url = null;
            $social_url = get_post_meta($post->ID, 'xs_' . $social_icon, true);
            if ($social_url == '') {
                continue;
            }
            $html .= '<li><a href="' . $social_url . '" '.$icon_color_style.'><i class="icon-' . $social_icon . '"></i></a></li>';
		}
        $html .= '</ul></div>';
        wp_reset_postdata();
        $post = $old_post;
    }
	return $html;
}