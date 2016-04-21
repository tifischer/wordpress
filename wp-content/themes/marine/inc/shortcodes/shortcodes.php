<?php
/**
 * Shortcodes
 *
 * @package framework
 * @since framework 1.0
 */

require_once get_template_directory() . '/inc/shortcodes/accordion.php';
require_once get_template_directory() . '/inc/shortcodes/col-offset.php';
require_once get_template_directory() . '/inc/shortcodes/content_box.php';

require_once get_template_directory() . '/inc/shortcodes/info_box.php';
require_once get_template_directory() . '/inc/shortcodes/icon_list.php';
require_once get_template_directory() . '/inc/shortcodes/contact_form.php';
require_once get_template_directory() . '/inc/shortcodes/blockquote.php';
require_once get_template_directory() . '/inc/shortcodes/project_gallery.php';
require_once get_template_directory() . '/inc/shortcodes/alerts.php';
require_once get_template_directory() . '/inc/shortcodes/banner.php';
require_once get_template_directory() . '/inc/shortcodes/button.php';
require_once get_template_directory() . '/inc/shortcodes/button_view.php';
require_once get_template_directory() . '/inc/shortcodes/columns.php';
require_once get_template_directory() . '/inc/shortcodes/call_to_action.php';
require_once get_template_directory() . '/inc/shortcodes/counter.php';
require_once get_template_directory() . '/inc/shortcodes/divider.php';
require_once get_template_directory() . '/inc/shortcodes/dropcaps.php';
require_once get_template_directory() . '/inc/shortcodes/featured_projects.php';
require_once get_template_directory() . '/inc/shortcodes/featured_projects_2.php';
require_once get_template_directory() . '/inc/shortcodes/featured_projects_3.php';
require_once get_template_directory() . '/inc/shortcodes/food_menu.php';
require_once get_template_directory() . '/inc/shortcodes/food_menu_2.php';
require_once get_template_directory() . '/inc/shortcodes/form.php';
require_once get_template_directory() . '/inc/shortcodes/headers.php';
require_once get_template_directory() . '/inc/shortcodes/highlight.php';
require_once get_template_directory() . '/inc/shortcodes/image.php';
require_once get_template_directory() . '/inc/shortcodes/latest_works.php';
require_once get_template_directory() . '/inc/shortcodes/list.php';
require_once get_template_directory() . '/inc/shortcodes/logos.php';
require_once get_template_directory() . '/inc/shortcodes/map_container.php';
require_once get_template_directory() . '/inc/shortcodes/multi_posts.php';
require_once get_template_directory() . '/inc/shortcodes/person.php';
require_once get_template_directory() . '/inc/shortcodes/person_slider.php';
require_once get_template_directory() . '/inc/shortcodes/pricing_table.php';
require_once get_template_directory() . '/inc/shortcodes/recent_news_big.php';
require_once get_template_directory() . '/inc/shortcodes/recent_posts.php';
require_once get_template_directory() . '/inc/shortcodes/skillbar.php';
require_once get_template_directory() . '/inc/shortcodes/social_icons.php';
require_once get_template_directory() . '/inc/shortcodes/space.php';
require_once get_template_directory() . '/inc/shortcodes/special_text.php';
require_once get_template_directory() . '/inc/shortcodes/tabs.php';
require_once get_template_directory() . '/inc/shortcodes/blogtimeline.php';
require_once get_template_directory() . '/inc/shortcodes/testimonial.php';
require_once get_template_directory() . '/inc/shortcodes/testimonials.php';
require_once get_template_directory() . '/inc/shortcodes/text.php';
require_once get_template_directory() . '/inc/shortcodes/tooltip.php';
require_once get_template_directory() . '/inc/shortcodes/video_player.php';

//shortcodes integration with visual composer plugin
if (function_exists('vc_map')) {
	require_once get_template_directory() . '/inc/shortcodes_vc.php';
}

/* PLEASE ADD every new shortcode to the get_shortcodes_help function below (all except columns shortcodes which are includes in inc/tinymce.js.php */

/**
 * Get shortcodes list
 *
 */
function ts_get_shortcodes_list()
{
    $aHelp = array(
        /*
        array(
        'shortcode' => '',
        'name' => 'Title',
        'description' => Description,  can be an array,
        'usage' => 'Example usage, can be an array',
        ),
        */
        array(
            'shortcode' => 'accordion',
            'name' => __('Accordion', 'framework'),
            'description' => '',
            'usage' => '[accordion animation="bounceInUp" open="yes"][accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle][/accordion]',
            'code' => '[accordion animation="{animation}" open="{open}"]{child}[/accordion]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'open' => array(
                    'type' => 'select',
                    'label' => __('Open first', 'framework'),
                    'desc' => '',
                    'values' => array(
                        'yes' => __('yes', 'framework'),
                        'no' => __('no', 'framework')
                    )
                )
            ),
            'add_child_button' => __('Add Item', 'framework'),
            'child' => array(
                'fields' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Title', 'framework'),
                        'desc' => ''
                    ),
                    'content' => array(
                        'type' => 'textarea',
                        'label' => __('Content', 'framework'),
                        'desc' => ''
                    ),
                ),
                'name' => __('Accordion item', 'framework'),
                'code' => '[accordion_toggle title="{title}"]{content}[/accordion_toggle]',
            )
        ),

        array(
            'shortcode' => 'alerts',
            'name' => __('Alert', 'framework'),
            'description' => '',
            'usage' => '[alert animation="fade" message="error message" style="info" icon="" close_btn="yes"]',
            'code' => '[alert  animation="{animation}" message="{message}" style="{style}" icon="{icon}" close_btn="{closeBtn}" ]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'style' => array(
                    'type' => 'select',
                    'desc' => '',
                    'label' => __('Style', 'framework'),
                    'values' => array(
                        'info' => __('Info', 'framework'),
                        'error' => __('Error', 'framework'),
                        'notice' => __('Notice', 'framework'),
                        'success' => __('Success', 'framework'),

                    )
                ),
                'icon' => array(
                    'type' => 'select',
                    'values' => ts_getFontAwesomeArray(),
                    'class' => 'icons-dropdown',
                    'label' => __('Icon', 'framework'),
                    'desc' => ''
                ),
                'closeBtn' => array(
                    'type' => 'select',
                    'label' => __('Show Close Button', 'framework'),
                    'desc' => '',
                    'default' => 'yes',
                    'values' => array(
                        'yes' => __('Yes', 'framework'),
                        'no' => __('No', 'framework'),


                    )
                ),

                'message' => array(
                    'type' => 'text',
                    'label' => __('Message', 'framework'),
                    'default' => '',
                    'desc' => '',

                ),
            )
        ),
        array(
            'shortcode' => 'blockquote',
            'name' => __('Blockquote', 'framework'),
            'description' => '',
            'usage' => '[blockquote animation="bounceInUp" author="Andy" ]Your content here...[/blockquote]',
            'code' => '[blockquote animation="{animation}" author="{author}" ]{content}[/blockquote]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'author' => array(
                    'type' => 'text',
                    'label' => __('Author', 'framework'),
                    'desc' => ''
                ),
                'content' => array(
                    'type' => 'textarea',
                    'label' => __('Content', 'framework'),
                    'desc' => ''
                ),
            )
        ),
        array(
            'shortcode' => 'blog_timeline',
            'description'=>'',
            'name' => 'Blog Timeline',
            'usage' => '[blog_timeline posts_per_page="10" load_more="Load more"]',
            'code' => '[blog_timeline posts_per_page="{postsPerPage}" load_more="{loadMore}" ]',
            'fields' => array(
                'postsPerPage' => array(
                    'type' => 'text',
                    'desc' => '',
                    'label' => __('Post per page', 'framework')
                ),

                'loadMore' => array(
                    'type' => 'text',
                    'desc' => '',
                    'label' => __('Load More Label', 'framework')
                ),

            )

        ),
		array(
            'shortcode' => 'banner',
            'name' => __('Banner', 'framework'),
            'description' => '',
            'usage' => '[banner animation="bounceInUp" style="1" image="image.png" title="Your title" subtitle="Your subtitle" button_text="Click me"  url="http://yourdomain.com" target="_blank"]',
            'code' => '[banner animation="{animation}" style="{style}" image="{image}" title="{title}" subtitle="{subtitle}" button_text="{buttontext}" url="{url}" target="{target}"]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'style' => array(
                    'type' => 'select',
                    'label' => __('Style', 'framework'),
                    'values' => array(
                        '1' => '1',
                        '2' => '2'
                    ),
                    'default' => '1',
                    'desc' => ''
                ),
				'image' => array(
                    'type' => 'upload',
                    'label' => __('Image', 'framework'),
                    'desc' => ''
                ),
				'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'framework'),
                    'desc' => ''
                ),
				'subtitle' => array(
                    'type' => 'text',
                    'label' => __('Subtitle', 'framework'),
                    'desc' => ''
                ),
                'buttontext' => array(
                    'type' => 'text',
                    'label' => __('Button text (no button if empty)', 'framework'),
                    'desc' => ''
                ),
                'url' => array(
                    'type' => 'text',
                    'label' => __('URL', 'framework'),
                    'desc' => ''
                ),
                'target' => array(
                    'type' => 'select',
                    'label' => __('Target', 'framework'),
                    'values' => array(
                        '_blank' => __('_blank', 'framework'),
                        '_parent' => __('_parent', 'framework'),
                        '_self' => __('_self', 'framework'),
                        '_top' => __('_top', 'framework')
                    ),
                    'default' => '_self',
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'button',
            'name' => __('Button', 'framework'),
            'description' => '',
            'usage' => '[button animation="bounceInUp" variant="1" icon="icomoon-home" background="#CCFFEE" color="#555555" size="small" url="http://yourdomain.com" target="_blank" ]Your content here...[/button]',
            'code' => '[button animation="{animation}" variant="{variant}" icon="{icon}" background="{background}" color="{color}" size="{size}" target="{target}" url="{url}"]{content}[/button]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
				'variant' => array(
                    'type' => 'select',
                    'label' => __('Variant', 'framework'),
                    'values' => array(
                        '1' => '1',
                        '2' => '2'
                    ),
                    'default' => '',
                    'desc' => ''
                ),
                'icon' => array(
                    'type' => 'select',
                    'label' => __('Icon', 'framework'),
                    'values' => ts_getFontAwesomeArray(true),
                    'default' => '',
                    'desc' => '',
                    'class' => 'icons-dropdown'
                ),
                'background' => array(
                    'type' => 'colorpicker',
                    'label' => __('Background color', 'framework'),
                    'desc' => ''
                ),
                'color' => array(
                    'type' => 'colorpicker',
                    'label' => __('Text color', 'framework'),
                    'desc' => ''
                ),
                'size' => array(
                    'type' => 'select',
                    'label' => __('Size', 'framework'),
                    'values' => array(
                        'small' => __('small', 'framework'),
                        'large' => __('large', 'framework')
                    ),
                    'default' => 'small',
                    'desc' => ''
                ),
                'content' => array(
                    'type' => 'text',
                    'label' => __('Button text', 'framework'),
                    'desc' => ''
                ),
                'url' => array(
                    'type' => 'text',
                    'label' => __('URL', 'framework'),
                    'desc' => ''
                ),
                'target' => array(
                    'type' => 'select',
                    'label' => __('Target', 'framework'),
                    'values' => array(
                        '_blank' => __('_blank', 'framework'),
                        '_parent' => __('_parent', 'framework'),
                        '_self' => __('_self', 'framework'),
                        '_top' => __('_top', 'framework')
                    ),
                    'default' => '_self',
                    'desc' => ''
                ),

            )
        ),
		array(
            'shortcode' => 'button_view',
            'name' => __('Button View', 'framework'),
            'description' => '',
            'usage' => '[button_view animation="bounceInUp" type="black" url="http://yourdomain.com" target="_blank"]Your content here...[/button_view]',
            'code' => '[button_view animation="{animation}" type="{type}" url="{url}" target="{target}"]{text}[/button_view]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'type' => array(
                    'type' => 'select',
                    'label' => __('Type', 'framework'),
                    'values' => array(
                        'black' => __('Black', 'framework'),
                        'white' => __('White', 'framework')
                    ),
                    'default' => 'black',
                    'desc' => ''
                ),
                'text' => array(
                    'type' => 'text',
                    'label' => __('Text', 'framework'),
                    'desc' => ''
                ),
                'url' => array(
                    'type' => 'text',
                    'label' => __('URL', 'framework'),
                    'desc' => ''
                ),
                'target' => array(
                    'type' => 'select',
                    'label' => __('Target', 'framework'),
                    'values' => array(
                        '_blank' => __('_blank', 'framework'),
                        '_parent' => __('_parent', 'framework'),
                        '_self' => __('_self', 'framework'),
                        '_top' => __('_top', 'framework')
                    ),
                    'default' => '_self',
                    'desc' => ''
                ),

            )
        ),
        array(
            'shortcode' => 'call_to_action',
            'name' => __('Call To Action', 'framework'),
            'description' => '',
            'usage' => '[call_to_action animation="bounceInUp" transparent_background="no" background_color="#FF0000"  text_color="#FFFFFF" button_color="#DADADA" button_bg="#DADADA"  icon="icon-search" border_color="#000" button_text="Click me" url="" target="" first_page="yes" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="10"]Your title here...[/[call_to_action]',
            'code' => '[call_to_action animation="{animation}" transparent_background="{transparentbackground}" background_color="{backgroundcolor}"  text_color="{textcolor}" button_color="{buttoncolor}" button_bg="{buttonBg}" icon="{icon}" border_color="{borderColor}" button_text="{buttontext}" url="{url}" target="{target}" first_page="{firstpage}" last_page="{lastpage}" padding_top="{paddingTop}" padding_bottom="{paddingBottom}" margin_bottom="{marginBottom}"]{title}[/call_to_action]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
				'transparentbackground' => array(
                    'type' => 'select',
                    'label' => __('Transparent background', 'framework'),
                    'values' => array(
                        'no' => __('no', 'framework'),
                        'yes' => __('yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
                'backgroundcolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Background color', 'framework'),
                    'desc' => ''
                ),

                'textcolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Text color', 'framework'),
                    'desc' => ''
                ),
                'buttoncolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Button color', 'framework'),
                    'desc' => ''
                ),
                'buttonBg' => array(
                    'type' => 'colorpicker',
                    'label' => __('Button Background', 'framework'),
                    'desc' => ''
                ),
				
				'icon' => array(
                    'label' => __('Icon', 'framework'),
                    'default' => 'icon',
                    'desc' => '',
                    'type' => 'select',
                    'values' => ts_getFontAwesomeArray(true),
                    'class' => 'icons-dropdown'
                ),


                'borderColor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Border color', 'framework'),
                    'desc' => ''
                ),


                'buttontext' => array(
                    'type' => 'text',
                    'label' => __('Button label', 'framework'),
                    'desc' => ''
                ),
                'title' => array(
                    'type' => 'wp_editor',
                    'label' => __('Title', 'framework'),
                    'desc' => ''
                ),

                'url' => array(
                    'type' => 'text',
                    'label' => __('URL', 'framework'),
                    'desc' => ''
                ),
                'target' => array(
                    'type' => 'select',
                    'label' => __('Target', 'framework'),
                    'values' => array(
                        '_blank' => __('_blank', 'framework'),
                        '_parent' => __('_parent', 'framework'),
                        '_self' => __('_self', 'framework'),
                        '_top' => __('_top', 'framework')
                    ),
                    'default' => '_self',
                    'desc' => ''
                ),

                'paddingTop'=>array(
                    'type'=>'text',
                    'label'=>__('Padding Top','framework'),
                    'desc'=>''
                ),
                'paddingBottom'=>array(
                    'type'=>'text',
                    'label'=>__('Padding Bottom','framework'),
                    'desc'=>''
                ),
                'marginBottom'=>array(
                    'type'=>'text',
                    'label'=>__('Margin Bottom','framework'),
                    'desc'=>''
                ),

                'firstpage' => array(
                    'type' => 'select',
                    'label' => __('First element on a page', 'framework'),
                    'values' => array(
                        'no' => __('no', 'framework'),
                        'yes' => __('yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
                'lastpage' => array(
                    'type' => 'select',
                    'label' => __('Last element on a page', 'framework'),
                    'values' => array(
                        'no' => __('no', 'framework'),
                        'yes' => __('yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'col_offset',
            'description'=>'',
            'name' => __('Column With Offset','framework'),
            'usage' => '[col_offset cols="5" offset="3"][/col_offset]',
            'code' => '[col_offset cols="{cols}" offset="{offset}"]Content Here....[/col_offset]',
            'fields' => array(
                'cols' => array(
                    'label' => 'Columns',
                    'type' => 'select',
                    'values' => array(
                        '1' => 'Col 1',
                        '2' => 'Col 2',
                        '3' => 'Col 3',
                        '4' => 'Col 4',
                        '5' => 'Col 5',
                        '6' => 'Col 6',
                        '7' => 'Col 7',
                        '8' => 'Col 8',
                        '9' => 'Col 9',
                        '10' => 'Col 10',
                        '11' => 'Col 11',
                        '12' => 'Col 12',
                    )

                ),
                'offset' => array(
                    'label' => 'Columns Offset',
                    'type' => 'select',
                    'values' => array(
                        '1' => 'Col Offset 1',
                        '2' => 'Col Offset 2',
                        '3' => 'Col Offset 3',
                        '4' => 'Col Offset 4',
                        '5' => 'Col Offset 5',
                        '6' => 'Col Offset 6',
                        '7' => 'Col Offset 7',
                        '8' => 'Col Offset 8',
                        '9' => 'Col Offset 9',
                        '10' => 'Col Offset  10',
                        '11' => 'Col Offset  11',
                        '12' => 'Col Offset  12',
                    )

                )
            )
        ),

        array(
            'shortcode' => 'contact_form',
            'description'=>'',
            'name' => __('Contact Form','framework'),
            'usage' => '[contact_form animation="fade"  name_label="Name" name_icon="fa-user" email_label="your@email.com" email_icon="fa-envelope" message_label="Message" send_label="Send" clear_label="Clear" skin="1" button_align="left" ]',
            'code' => '[contact_form animation="{animation}"  name_label="{name}" name_icon="{nameIcon}" email_label="{email}" email_icon="{emailIcon}" message_label="{message}" send_label="{send}" clear_label="{clear}" skin="{skin}" button_align="{btnAlign}" ]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'name' => array(
                    'label' => __('Name Field Label', 'framework'),
                    'default' => 'Name',
                    'desc' => '',
                    'type' => 'text'
                ),
                'nameIcon' => array(
                    'label' => __('Icon for Name Field', 'framework'),
                    'default' => 'icon-user-1',
                    'desc' => '',
                    'type' => 'select',
                    'values' => ts_getFontAwesomeArray(),
                    'class' => 'icons-dropdown'
                ),
                'email' => array(
                    'label' => __('Email Field Label', 'framework'),
                    'default' => 'email',
                    'desc' => '',
                    'type' => 'text'
                ),
                'emailIcon' => array(
                    'label' => __('Icon for Email Field', 'framework'),
                    'default' => 'icon-mail-4',
                    'desc' => '',
                    'type' => 'select',
                    'values' => ts_getFontAwesomeArray(),
                    'class' => 'icons-dropdown'
                ),
                'message' => array(
                    'label' => __('Message Field Label', 'framework'),
                    'desc' => '',
                    'type' => 'text'
                ),
                'send' => array(
                    'label' => __('Send Button label', 'framework'),
                    'default' => 'Send',
                    'desc' => '',
                    'type' => 'text'
                ),
                'clear' => array(
                    'label' => __('Clear Button label', 'framework'),
                    'default' => 'Clear',
                    'desc' => '',
                    'type' => 'text'
                ),
				'skin' => array(
                    'desc' => '',
                    'label' => 'Skin',
                    'type' => 'select',
                    'values' => array(
                        '1' => '1',
                        '2' => '2'
                    )
                ),
                'btnAlign' => array(
                    'desc' => '',
                    'label' => 'Button Alignment',
                    'type' => 'select',
                    'values' => array(
                        'left' => __('Left', 'framework'),
                        'right' => __('Right', 'framework'),
                        'center' => __('Center', 'framework')
                    )
                )
            )
        ),
        array(
            'shortcode' => 'content_box',
            'description'=>'',
            'name' => __('Content Box','framework'),
            'usage' => '[content_box  title="Your title" icon="fa-search" icon_color="#FF0000" icon_bg="#F3F3F3" title_color=>"#D3D3D3" text_color="#D3D3D3" style="style1"]Your content...[/content_box]',
            'code' => '[content_box  title="{title}" icon="{icon}" icon_color="{iconColor}" icon_bg="{iconBg}" title_color="{titleColor}" text_color="{textColor}" style="{style}"]{content}[/content_box]',
            'fields' => array(
                'style' => array(
                    'label' => __('Style', 'framework'),
                    'desc' => '',
                    'type' => 'select',
                    'values' => array(
                        'style1' => __('Style 1', 'framework'),
                        'style2' => __('Style 2', 'framework'),
                        'style3' => __('Style 3', 'framework'),
                    )
                ),
                'icon' => array(
                    'type' => 'select',
                    'label' => __('Icon', 'framework'),
                    'desc' => '',
                    'values' => ts_getFontAwesomeArray(true),
                    'class' => 'icons-dropdown'
                ),
                'iconBg' => array(
                    'type' => 'colorpicker',
                    'label' => __('Icon Background Color','framework'),
                    'desc' => '',
                ),
                'iconColor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Icon Color','framework'),
                    'desc' => '',
                ),

                'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'framework'),
                    'desc' => ''
                ),
                'titleColor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Title Color','framework'),
                    'desc' => '',
                ),
                'textColor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Text Color','framework'),
                    'desc' => '',
                ),

                'content' => array(
                    'type' => 'textarea',
                    'label' => __('Content', 'framework'),
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'counter',
            'name' => __('Counter', 'framework'),
            'description' => '',
            'usage' => '[counter animation="bounceInUp" bgcolor="#fff" fgcolor="#ff0000" textcolor="#fff" title="Your title" quantity="1000"]',
            'code' => '[counter animation="{animation}" bgcolor="{bgcolor}" fgcolor="{fgcolor}" textcolor="{textcolor}" title="{title}" quantity="{quantity}"]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'framework'),
                    'desc' => ''
                ),
                'quantity' => array(
                    'type' => 'text',
                    'label' => __('Quantity', 'framework'),
                    'desc' => ''
                ),
                'fgcolor' => array(
                    'type' => 'colorpicker',
                    'desc' => '',
                    'label' => __('Foreground Color', 'framework'),

                ),

                'bgcolor' => array(
                    'type' => 'colorpicker',
                    'desc' => '',
                    'label' => __('Background Color', 'framework'),
                ),
                'textcolor' => array(
                    'type' => 'colorpicker',
                    'desc' => '',
                    'label' => __('Text Color', 'framework'),
                )
            )
        ),
        array(
            'shortcode' => 'divider',
            'name' => __('Horizontal Line', 'framework'),
            'description' => '',
            'usage' => '[divider  color="#FF0000"  ]',
            'code' => '[divider   color="{color}"  ]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'color' => array(
                    'type' => 'colorpicker',
                    'label' => __('Color', 'framework'),
                    'desc' => ''
                ),

            )

        ),
		array(
            'shortcode' => 'dropcaps',
            'name' => __('Dropcaps', 'framework'),
            'description' => array(
                __('type - circle - optional', 'framework')
            ),
            'usage' => '[dropcaps animation="bounceInUp" style="1" color="#C4C4C4" background="#A4A4A4"]Your text here...[/dropcaps]',
            'code' => '[dropcaps animation="{animation}" style="{style}" color="{color}" background="{background}"]{content}[/dropcaps]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'style' => array(
                    'type' => 'select',
                    'label' => __('Style', 'framework'),
                    'values' => array(
                        '1' => '1',
                        '2' => '2'
                    ),
                    'default' => '1',
                    'desc' => ''
                ),
				'color' => array(
                    'type' => 'colorpicker',
                    'label' => __('Color', 'framework'),
                    'desc' => ''
                ),
                'background' => array(
                    'type' => 'colorpicker',
                    'label' => __('Background color', 'framework'),
                    'desc' => ''
                ),
                'content' => array(
                    'type' => 'textarea',
                    'label' => __('Content', 'framework'),
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'heading',
            'name' => __('Heading', 'framework'),
            'description' => '',
            'usage' => '[heading animation="bounceInUp" color="#fff" type="1" align="center"]Your text here...[/heading]',
            'code' => '[heading animation="{animation}" color="{color}" type="{type}" align="{align}"]{content}[/heading]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'type' => array(
                    'type' => 'select',
                    'label' => __('Type', 'framework'),
                    'values' => array(
                        '1' => 'H1',
                        '2' => 'H2',
                        '3' => 'H3',
                        '4' => 'H4',
                        '5' => 'H5'
                    ),
                    'default' => '1',
                    'desc' => ''
                ),
                'color'=>array(
                    'type'=>'colorpicker',
                    'label'=>__('Color','framework'),
                    'desc'=>''
                ),
                'align' => array(
                    'type' => 'select',
                    'label' => __('Align', 'framework'),
                    'values' => array(
                        'left' => __('Left (default)', 'framework'),
                        'center' => __('Center', 'framework'),
                        'right' => __('Right', 'framework')
                    ),
                    'default' => '1',
                    'desc' => ''
                ),
                'content' => array(
                    'type' => 'text',
                    'label' => __('Content', 'framework'),
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'featured_projects',
            'name' => __('Featured projects', 'framework'),
            'description' => '',
            'usage' => '[featured_projects full="no" animation="bounceInUp" full="yes" category="" limit="6" ][/featured_projects]',
            'code' => '[featured_projects animation="{animation}" full="{full}" category="{category}" limit="{limit}" ][/featured_projects]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'full' => array(
                    'type' => 'select',
                    'label' => __('Full Width','framework'),
                    'desc' => '',
                    'values' => array(
                        'yes' => __('Yes', 'framework'),
                        'no' => __('No', 'framework'),
                    )
                ),
                'category' => array(
                    'type' => 'text',
                    'label' => __('Category ID', 'framework'),
                    'desc' => ''
                ),
                'limit' => array(
                    'type' => 'text',
                    'label' => __('Limit', 'framework'),
                    'desc' => ''
                ),

            )
        ),
		array(
            'shortcode' => 'featured_projects_2',
            'name' => __('Featured projects 2', 'framework'),
            'description' => '',
            'usage' => '[featured_projects_2 animation="bounceInUp" category_filter="yes" category_filter_color="#FFF" category_filter_background="#333" category_filter_border="#DDD" category="" limit="6" title="Your title" title_color="#FFF" subtitle="Your subtitle" subtitle_color="#DDD"]',
            'code' => '[featured_projects_2 animation="{animation}" category_filter="{categoryfilter}" category_filter_color="{categoryfiltercolor}" category_filter_background="{categoryfilterbackground}" category_filter_border="{categoryfilterborder}" category="{category}" limit="{limit}" title="{title}" title_color="{titlecolor}" subtitle="{subtitle}" subtitle_color="{subtitlecolor}"]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'categoryfilter' => array(
                    'type' => 'select',
                    'label' => __('Category filter','framework'),
                    'desc' => '',
                    'values' => array(
                        'yes' => __('Yes', 'framework'),
                        'no' => __('No', 'framework'),
                    )
                ),
				'categoryfiltercolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Category filter color', 'framework'),
                    'desc' => ''
                ),
				'categoryfilterbackground' => array(
                    'type' => 'colorpicker',
                    'label' => __('Category filter background color', 'framework'),
                    'desc' => ''
                ),
				'categoryfilterborder' => array(
                    'type' => 'colorpicker',
                    'label' => __('Category filter border', 'framework'),
                    'desc' => ''
                ),
                'category' => array(
                    'type' => 'text',
                    'label' => __('Category ID', 'framework'),
                    'desc' => ''
                ),
                'limit' => array(
                    'type' => 'text',
                    'label' => __('Limit', 'framework'),
                    'desc' => ''
                ),
				'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'framework'),
                    'desc' => ''
                ),
				'titlecolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Title color', 'framework'),
                    'desc' => ''
                ),
				'subtitle' => array(
                    'type' => 'text',
                    'label' => __('Subtitle', 'framework'),
                    'desc' => ''
                ),
				'subtitlecolor' => array(
                    'type' => 'text',
                    'label' => __('Subtitle color', 'framework'),
                    'desc' => ''
                )
            )
        ),
		array(
            'shortcode' => 'featured_projects_3',
            'name' => __('Featured projects 3', 'framework'),
            'description' => '',
            'usage' => '[featured_projects_3 animation="bounceInUp" category_filter="yes" category_filter_color="#FFF" category_filter_background="#333" category_filter_border="#DDD" category="" limit="6" title="Your title" title_color="#FFF" subtitle="Your subtitle" subtitle_color="#DDD"]',
            'code' => '[featured_projects_3 animation="{animation}" category_filter="{categoryfilter}" category_filter_color="{categoryfiltercolor}" category_filter_background="{categoryfilterbackground}" category_filter_border="{categoryfilterborder}" category="{category}" limit="{limit}" title="{title}" title_color="{titlecolor}" subtitle="{subtitle}" subtitle_color="{subtitlecolor}" items_per_row="{itemsperrow}"]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'categoryfilter' => array(
                    'type' => 'select',
                    'label' => __('Category filter','framework'),
                    'desc' => '',
                    'values' => array(
                        'yes' => __('Yes', 'framework'),
                        'no' => __('No', 'framework'),
                    )
                ),
				'categoryfiltercolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Category filter color', 'framework'),
                    'desc' => ''
                ),
				'categoryfilterbackground' => array(
                    'type' => 'colorpicker',
                    'label' => __('Category filter background color', 'framework'),
                    'desc' => ''
                ),
				'categoryfilterborder' => array(
                    'type' => 'colorpicker',
                    'label' => __('Category filter border', 'framework'),
                    'desc' => ''
                ),
                'category' => array(
                    'type' => 'text',
                    'label' => __('Category ID', 'framework'),
                    'desc' => ''
                ),
                'limit' => array(
                    'type' => 'text',
                    'label' => __('Limit', 'framework'),
                    'desc' => ''
                ),
				'title' => array(
                    'type' => 'text',
                    'label' => __('Title', 'framework'),
                    'desc' => ''
                ),
				'titlecolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Title color', 'framework'),
                    'desc' => ''
                ),
				'subtitle' => array(
                    'type' => 'text',
                    'label' => __('Subtitle', 'framework'),
                    'desc' => ''
                ),
				'subtitlecolor' => array(
                    'type' => 'text',
                    'label' => __('Subtitle color', 'framework'),
                    'desc' => ''
                ),
				'itemsperrow' => array(
                    'desc' => '',
                    'label' => __('Items per row'),
                    'type' => 'select',
                    'values' => array(
                        '3' => '3',
                        '4' => '4',
                        '5' => '5'
                    )
                )
            )
        ),
		array(
            'shortcode' => 'food_menu',
            'name' => __('Food menu slider', 'framework'),
            'description' => '',
            'usage' => '[food_menu animation="bounceInUp" title="Your title" title_color="#FF0000" title_font="Arial" color="#FFFFFF"]',
            'code' => '[food_menu animation="{animation}" title="{title}" title_color="{titlecolor}" title_font="{titlefont}" color="{color}"]',
            'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'title' => array(
                    'label' => __('Title', 'framework'),
                    'type' => 'text',
                    'desc' => __('Title will be added to the category name. Example of use: "Our %s" where %s will be replace with category name', 'framework')
                ),
				'titlecolor' => array(
                    'label' => __('Title color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
				'titlefont' => array(
                    'type' => 'select',
                    'label' => __('Title font', 'framework'),
                    'desc' => '',
                    'values' => ts_get_font_choices(true)
                ),
				'color' => array(
                    'label' => __('Color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                )
            )
        ),
		array(
            'shortcode' => 'food_menu_2',
            'name' => __('Food menu slider 2', 'framework'),
            'description' => '',
            'usage' => '[food_menu_2 animation="bounceInUp" title="Your title" title_color="#FF0000" title_font="Arial" subtitle_color="#DDD" color="#FFFFFF" background_color="#000000"]',
            'code' => '[food_menu_2 animation="{animation}" title="{title}" title_color="{titlecolor}" title_font="{titlefont}" subtitle_color="{subtitlecolor}" color="{color}" background_color="{backgroundcolor}"]',
            'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'title' => array(
                    'label' => __('Title', 'framework'),
                    'type' => 'text',
                    'desc' => __('Title will be added to the category name. Example of use: "Our %s" where %s will be replace with category name', 'framework')
                ),
				'titlecolor' => array(
                    'label' => __('Title color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
				'titlefont' => array(
                    'type' => 'select',
                    'label' => __('Title font', 'framework'),
                    'desc' => '',
                    'values' => ts_get_font_choices(true)
                ),
				'subtitlecolor' => array(
                    'label' => __('Subtitle color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
				'color' => array(
                    'label' => __('Color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
				'backgroundcolor' => array(
                    'label' => __('Background color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                )
            )
        ),
		array(
			'shortcode' => 'form',
			'name' => __('Form','framework'),
			'description' => '',
			'usage' => '[form animation="bounceInUp" skin="1" title="Your title" success_message="Thank you! Form was sent!" send_button="Send" clear_button="Clear"][field name="Your name" type="text" required="yes" icon="icon-glass"][/form]',
			'code' => '[form animation="{animation}" skin="{skin}" title="{title}" success_message="{successmessage}" send_button="{sendbutton}" clear_button="{clearbutton}"]{child}[/form]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'skin' => array(
                    'desc' => '',
                    'label' => 'Skin',
                    'type' => 'select',
                    'values' => array(
                        '1' => '1',
                        '2' => '2'
                    )
                ),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'successmessage' => array(
					'type' => 'text',
					'label' => __('Success message', 'framework'),
					'desc' => ''
				),
				'sendbutton' => array(
					'type' => 'text',
					'label' => __('Send button text', 'framework'),
					'desc' => ''
				),
				'clearbutton' => array(
					'type' => 'text',
					'label' => __('Clear button text', 'framework'),
					'desc' => ''
				)
			),
			'add_child_button' => __('Add Field', 'framework'),
			'child' => array(
				'name' => __('Field','framework'),
				'code' => '[field name="{name}" type="{type}" required="{required}" icon="{icon}"]',
				'fields' => array(
					'name' => array(
						'type' => 'text',
						'label' => __('Name', 'framework'),
						'default' => '',
						'desc' => ''
					),
					'type' => array(
						'type' => 'select',
						'label' => __('Type', 'framework'),
						'values' => array(
							'text' => __('Text','framework'),
							'textarea' => __('Textarea','framework'),
							'email' => __('Email','framework'),
						),
						'default' => '',
						'desc' => ''
					),
					'required' => array(
						'type' => 'select',
						'label' => __('Required', 'framework'),
						'values' => array(
							'no' => __('No','framework'),
							'yes' => __('Yes','framework')
						),
						'default' => '',
						'desc' => ''
					),
					'icon' => array(
						'type' => 'select',
						'label' => __('Icon', 'framework'),
						'values' => ts_getFontAwesomeArray(true),
						'default' => '',
						'desc' => '',
						'class' => 'icons-dropdown'
					)
				)
			)
		),
        array(
            'shortcode' => 'highlight',
            'name' => __('Highlight', 'framework'),
            'description' => '',
            'usage' => '[highlight animation="bounceInUp" color="#ebebeb" border_color="#dedede" background_image="image.png" background_attachment="scroll" horizontal_position="left" vertical_position="top" background_stretch="no" background_video="video.avi" background_video_format="ogg" background_pattern="grid" background_pattern_color="#FF0000" background_pattern_color_transparency="20" min_height="100" first_page="no" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="0" fullwidth="yes"]Your text here...[/highlight]',
            'code' => '[highlight animation="{animation}" color="{color}" border_color="{bordercolor}" background_image="{backgroundimage}" background_attachment="{backgroundattachment}" background_position="{backgroundposition}" background_stretch="{backgroundstretch}" background_video="{backgroundvideo}" background_video_format="{backgroundvideoformat}" background_pattern="{backgroundpattern}" background_pattern_color="{backgroundpatterncolor}" background_pattern_color_transparency="{backgroundpatterncolortransparency}" min_height="{minheight}" first_page="{firstpage}" last_page="{lastpage}" padding_top="{paddingtop}" padding_bottom="{paddingbottom}" margin_bottom="{marginbottom}" fullwidth="{fullwidth}"]{content}[/highlight]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'color' => array(
                    'type' => 'colorpicker',
                    'label' => __('Color', 'framework'),
                    'desc' => ''
                ),
                'bordercolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Border color', 'framework'),
                    'desc' => ''
                ),
                'backgroundimage' => array(
                    'type' => 'upload',
                    'label' => __('Background image', 'framework'),
                    'desc' => ''
                ),
                'backgroundattachment' => array(
                    'type' => 'select',
                    'label' => __('Background attachment', 'framework'),
                    'values' => array(
                        'scroll' => __('scroll', 'framework'),
                        'fixed' => __('fixed', 'framework')
                    ),
                    'default' => 'yes',
                    'desc' => ''
                ),
                'backgroundposition' => array(
                    'type' => 'select',
                    'label' => __('Background position', 'framework'),
                    'values' => array(
                        'left top' => __('left top', 'framework'),
                        'left center' => __('left center', 'framework'),
                        'left bottom' => __('left bottom', 'framework'),
                        'right top' => __('right top', 'framework'),
                        'right center' => __('right center', 'framework'),
                        'right bottom' => __('right bottom', 'framework'),
                        'center top' => __('center top', 'framework'),
                        'center center' => __('center center', 'framework'),
                        'center bottom' => __('center bottom', 'framework')
                    ),
                    'default' => 'left top',
                    'desc' => ''
                ),
                'backgroundstretch' => array(
                    'type' => 'select',
                    'label' => __('Background stretch', 'framework'),
                    'values' => array(
                        'yes' => __('yes', 'framework'),
                        'no' => __('no', 'framework')
                    ),
                    'default' => 'yes',
                    'desc' => ''
                ),
                'backgroundvideo' => array(
                    'type' => 'upload',
                    'label' => __('Background video', 'framework'),
                    'desc' => ''
                ),
                'backgroundvideoformat' => array(
                    'type' => 'select',
                    'label' => __('Video format', 'framework'),
                    'values' => array(
                        'mp4' => __('MP4', 'framework'),
                        'webm' => __('WebM', 'framework'),
                        'ogg' => __('Ogg', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
                'backgroundpattern' => array(
                    'type' => 'select',
                    'label' => __('Background pattern', 'framework'),
                    'values' => array(
                        'no' => __('No pattern', 'framework'),
                        'grid' => __('Grid', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
                'backgroundpatterncolor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Background pattern color', 'framework'),
                    'desc' => ''
                ),
                'backgroundpatterncolortransparency' => array(
                    'type' => 'select',
                    'label' => __('Background pattern color transparency (%)', 'framework'),
                    'values' => ts_get_percentage_select_values(true),
                    'default' => 'no',
                    'desc' => ''
                ),
                'minheight' => array(
                    'type' => 'text',
                    'label' => __('Minimum height (px)', 'framework'),
                    'default' => '',
                    'desc' => ''
                ),
                'firstpage' => array(
                    'type' => 'select',
                    'label' => __('First element on a page', 'framework'),
                    'values' => array(
                        'no' => __('no', 'framework'),
                        'yes' => __('yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
                'lastpage' => array(
                    'type' => 'select',
                    'label' => __('Last element on a page', 'framework'),
                    'values' => array(
                        'no' => __('no', 'framework'),
                        'yes' => __('yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
                'paddingtop' => array(
                    'type' => 'text',
                    'label' => __('Padding top (px)', 'framework'),
                    'default' => '',
                    'desc' => ''
                ),
                'paddingbottom' => array(
                    'type' => 'text',
                    'label' => __('Padding bottom (px)', 'framework'),
                    'default' => '',
                    'desc' => ''
                ),
                'marginbottom' => array(
                    'type' => 'text',
                    'label' => __('Margin bottom (px)', 'framework'),
                    'default' => '',
                    'desc' => ''
                ),
                'fullwidth' => array(
                    'type' => 'select',
                    'label' => __('Full width', 'framework'),
                    'values' => array(
                        'yes' => __('yes', 'framework'),
                        'no' => __('no', 'framework')
                    ),
                    'default' => 'yes',
                    'desc' => ''
                ),
                'content' => array(
                    'type' => 'wp_editor',
                    'label' => __('Content', 'framework'),
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'icon_list',
            'description'=>'',
            'name' => __('Icon list','framework'),
            'usage' => '[icon_list animation="bounceInUp"][icon_list_item icon="fa-search" icon_upload="icon.png" icon_color="#FF0000" title="Your title" title_color="#D3D3D3" content_color="#D3D3D3" border_color="#D3D3D3"]Your content[/icon_list_item][/icon_list]',
            'code' => '[icon_list animation="{animation}"]{child}[/icon_list]',
			'fields' => array(
                'animation' => ts_get_animation_effects_settings()
			),
            'add_child_button' => __('Add Item', 'framework'),
            'child' => array(
                'name' => __('Icon List item', 'framework'),
                'code' => '[icon_list_item icon="{icon}" icon_upload="{iconupload}" icon_color="{iconColor}" title="{title}" title_color="{titleColor}" content_color="{contentColor}" border_color="{borderColor}"]{content}[/icon_list_item]',
                'fields' => array(
                    'icon' => array(
                        'type' => 'select',
                        'label' => __('Icon (choose or upload below)', 'framework'),
                        'values' => ts_getFontAwesomeArray(true),
                        'desc' => '',
                        'class' => 'icons-dropdown'
                    ),
					'iconupload' => array(
						'type' => 'upload',
						'label' => __('Upload icon', 'framework'),
						'desc' => ''
					),
					'iconColor' => array(
                        'type' => 'colorpicker',
                        'label' => __('Icon Color', 'framework'),
                        'desc' => ''
                    ),
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Title', 'framework'),
                        'desc' => ''
                    ),
                    'titleColor' => array(
                        'type' => 'colorpicker',
                        'label' => __('Title Color', 'framework'),
                        'desc' => ''
                    ),

                    'content' => array(
                        'type' => 'textarea',
                        'label' => __('Content', 'framework'),
                        'desc' => ''
                    ),
                    'contentColor' => array(
                        'type' => 'colorpicker',
                        'label' => __('Content Color', 'framework'),
                        'desc' => ''
                    ),
					'borderColor' => array(
                        'type' => 'colorpicker',
                        'label' => __('Border Color', 'framework'),
                        'desc' => ''
                    ),

                ),
            )

        ),
        array(
            'shortcode' => 'image',
            'name' => __('Image', 'framework'),
            'description' => '',
            'usage' => '[image animation="bounceInUp" size="half" align="alignleft" url="http://...." target="_blank"]image.png[/image]',
            'code' => '[image animation="{animation}" size="{size}" align="{align}" url="{url}" target="{target}"]{image}[/image]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'image' => array(
                    'type' => 'upload',
                    'label' => __('Image', 'framework'),
                    'desc' => ''
                ),
                'size' => array(
                    'type' => 'select',
                    'label' => __('Image width', 'framework'),
                    'values' => array(
                        'dont_scale' => __('dont scale', 'framework'),
                        'full' => __('full', 'framework'),
                        'half' => __('half', 'framework'),
                        'one_third' => __('1/3', 'framework'),
                        'one_fourth' => __('1/4', 'framework')
                    ),
                    'default' => 'dont_scale',
                    'desc' => ''
                ),
                'align' => array(
                    'type' => 'select',
                    'label' => __('Align', 'framework'),
                    'values' => array(
                        'alignnone' => __('none', 'framework'),
                        'alignleft' => __('left', 'framework'),
                        'alignright' => __('right', 'framework'),
                        'aligncenter' => __('center', 'framework')
                    ),
                    'default' => 'alignnone',
                    'desc' => ''
                ),
				'url' => array(
                    'type' => 'text',
                    'label' => __('Url', 'framework'),
                    'desc' => ''
                ),
                'target' => array(
                    'type' => 'select',
                    'label' => __('Target', 'framework'),
					'desc' => '',
                    'values' => array(
                        '_blank' => __('_blank', 'framework'),
                        '_parent' => __('_parent', 'framework'),
                        '_self' => __('_self', 'framework'),
                        '_top' => __('_top', 'framework')
                    )
                )
            )
        ),
        array(
            'shortcode' => 'info_box',
            'description'=>'',
            'name' => __('Info Box','framework'),
            'usage' => '[info_box animation="bounceInUp" box_title="Your title" box_subtitle="Your subtitle" box_bg="#D3D3D3" text_color="#FFFFFF"
             button_text="Click me" button_bg="#34F334" button_color="#F4F4F4" url="http://yourdomain.com" target="_blank" ]',

            'code' => '[info_box animation="{animation}" box_title="{boxTitle}" box_subtitle="{boxSubtitle}" box_bg="{boxBg}" text_color="{textColor}"
             button_text="{buttonText}" button_bg="{buttonBg}" button_color="{buttonColor}" url="{url}" target="{target}" ]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'boxTitle' => array(
                    'type' => 'text',
                    'label' => __('Title', 'framework'),
                    'desc' => ''
                ),
                'boxSubtitle' => array(
                    'type' => 'text',
                    'label' => __('Sub-title', 'framework'),
                    'desc' => ''
                ),
                'boxBg' => array(
                    'type' => 'colorpicker',
                    'label' => __('Box Background', 'framework'),
                    'desc' => ''
                ),
                'textColor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Text Color', 'framework'),
                    'desc' => ''
                ),
                'buttonText' => array(
                    'type' => 'text',
                    'label' => __('Button Text', 'framework'),
                    'desc' => ''
                ),
                'buttonBg' => array(
                    'type' => 'colorpicker',
                    'label' => __('Button Background', 'framework'),
                    'desc' => ''
                ),
                'buttonColor' => array(
                    'type' => 'colorpicker',
                    'label' => __('Button Text Color', 'framework'),
                    'desc' => ''
                ),
                'url' => array(
                    'type' => 'text',
                    'label' => __('Url', 'framework'),
                    'desc' => ''
                ),
                'target' => array(
                    'type' => 'select',
                    'label' => __('Target', 'framework'),
					'desc' => '',
                    'values' => array(
                        '_blank' => __('_blank', 'framework'),
                        '_parent' => __('_parent', 'framework'),
                        '_self' => __('_self', 'framework'),
                        '_top' => __('_top', 'framework')
                    )
                )
            )
        ),
        array(
            'shortcode' => 'latest_works',
            'name' => __('Latest works', 'framework'),
            'description' => '',
            'usage' => '[latest_works animation="bounceInUp" category="12" limit="10" hover_color="#FF0000"]',
            'code' => '[latest_works animation="{animation}" category="{category}" limit="{limit}"]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'category' => array(
                    'type' => 'text',
                    'label' => __('Category ID', 'framework'),
                    'desc' => ''
                ),
                'limit' => array(
                    'type' => 'text',
                    'label' => __('Limit', 'framework'),
                    'desc' => ''
                ),

            )
        ),
        array(
            'shortcode' => 'list',
            'name' => __('List', 'framework'),
            'description' => '',
            'usage' => '[list animation="bounceInUp"][list_item icon="home"]Your content...[/list_item][/list]',
            'code' => '[list animation="{animation}"]{child}[/list]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings()
            ),
            'add_child_button' => __('Add List Item', 'framework'),
            'child' => array(
                'name' => __('List item', 'framework'),
                'code' => '[list_item icon="{icon}"]{content}[/list_item]',
                'fields' => array(
                    'icon' => array(
                        'type' => 'select',
                        'label' => __('Icon', 'framework'),
                        'values' => ts_getFontAwesomeArray(),
                        'desc' => '',
                        'class' => 'icons-dropdown'
                    ),
                    'content' => array(
                        'type' => 'text',
                        'label' => __('Content', 'framework'),
                        'desc' => ''
                    ),
                ),

            )
        ),
		array(
            'shortcode' => 'logos',
            'name' => __('Logos', 'framework'),
            'description' => '',
            'usage' => '[logos animation="fadein"][logos_item title="Your title" image="logo.png" url="http://test.com" target="_blank"][/logos]',
            'code' => '[logos animation="{animation}"]{child}[/logos]',
            'fields' => array(
				'animation' => ts_get_animation_effects_settings()
            ),
            'add_child_button' => __('Add Item', 'framework'),
            'child' => array(
                'name' => __('Item', 'framework'),
                'code' => '[logos_item title="{title}" image="{image}" url="{url}" target="{target}"]',
                'fields' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Title', 'framework'),
                        'desc' => ''
                    ),
					'image' => array(
                        'type' => 'upload',
                        'label' => __('Image', 'framework'),
                        'desc' => ''
                    ),
					'url' => array(
                        'type' => 'text',
                        'label' => __('URL', 'framework'),
                        'desc' => ''
                    ),
                    'target' => array(
						'type' => 'select',
						'label' => 'Target',
						'desc' => '',
						'values' => array(
							'_blank' => __('_blank', 'framework'),
							'_parent' => __('_parent', 'framework'),
							'_self' => __('_self', 'framework'),
							'_top' => __('_top', 'framework')
						),
						'default' => '_self',
					)
                )
            )
        ),
		array(
			'shortcode' => 'map_container',
			'name' => __('Map container','framework'),
			'description' => 'Full width map container. Works with Google Maps made Simple plugin.',
			'usage' => '[map_container address="Your address" zoom="14" custom_marker="" full_width="no" height="230" marker_offset="-140" first_page="no" last_page="yes"][wpgmappity id="x"][/map_container]',
			'code' => '[map_container address="{address}" zoom="14" custom_marker="{custommarker}" full_width="{fullwidth}" height="{height}" marker_offset="{markeroffset}" first_page="{firstpage}" last_page="{lastpage}"][/map_container]',
			'fields' => array(
				'address' => array(
					'type' => 'text',
					'label' => __('Address', 'framework'),
					'desc' => __('Leave empty if you want to use Google Maps plugin', 'framework'),
				),
				'zoom' => array(
					'type' => 'text',
					'label' => __('Zoom', 'framework'),
					'desc' => __('Zoom level, default: 14', 'framework'),
				),
				'custommarker' => array(
					'type' => 'text',
					'label' => __('Custom marker URL', 'framework'),
					'desc' => '',
				),
				'fullwidth' => array(
                    'type' => 'select',
                    'label' => __('Full width', 'framework'),
                    'values' => array(
                        'no' => __('no', 'framework'),
                        'yes' => __('yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
				'height' => array(
					'type' => 'text',
					'label' => __('Height', 'framework'),
					'desc' => ''
				),
				'markeroffset' => array(
					'type' => 'text',
					'label' => __('Marker offset', 'framework'),
					'desc' => __('Moves marker to the top', 'framework')
				),
				'firstpage' => array(
                    'type' => 'select',
                    'label' => __('First element on a page', 'framework'),
                    'values' => array(
                        'no' => __('no', 'framework'),
                        'yes' => __('yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
                'lastpage' => array(
                    'type' => 'select',
                    'label' => __('Last element on a page', 'framework'),
                    'values' => array(
                        'no' => __('no', 'framework'),
                        'yes' => __('yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                )
			)
		),
		array(
            'shortcode' => 'multi_posts',
            'name' => __('Multi Posts', 'framework'),
            'description' => '',
            'usage' => '[multi_posts animation="bounceInUp" limit="2"]',
            'code' => '[multi_posts animation="{animation}" limit="{limit}"]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'limit' => array(
                    'type' => 'text',
                    'label' => __('Limit', 'framework'),
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'person',
            'name' => __('Person', 'framework'),
            'description' => '',
            'usage' => '[person animation="bounceInUp" link="url" title_color="#000" sub_title_color="#000" text_color="#000" divider_color="#000" icon_color="#000" target="_self"  style="style1" id=1]',
            'code' => '[person animation="{animation}" link="{link}" title_color="{titleColor}" sub_title_color="{subTitleColor}" text_color="{textColor}" divider_color="{dividerColor}" icon_color="{iconColor}" target="{target}" style="{style}" id="{id}"]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'id' => array(
                    'type' => 'text',
                    'label' => __('Person ID', 'framework'),
                    'desc' => ''
                ),
                'style' => array(
                    'type' => 'select',
                    'label' => __('Style', 'framework'),
                    'desc' => '',
                    'values' => array(
                        'style1' => __('Style 1', 'framework'),
                        'style2' => __('Style 2', 'framework'),
                    )
                ),

                'titleColor' => array(
                    'label' => __('Title Color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
                'subTitleColor' => array(
                    'label' => __('Sub Title Color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
                'textColor' => array(
                    'label' => __('Text Color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),

                'dividerColor' => array(
                    'label' => __('Divider Color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
                'iconColor' => array(
                    'label' => __('Social Icon Color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
                'link' => array(
                    'type' => 'text',
                    'label' => __('Url', 'framework'),
                    'desc' => '',
                ),
                'target' => array(
                    'type' => 'select',
                    'label' => 'Target',
                    'desc' => '',
                    'values' => array(
                        '_blank' => __('_blank', 'framework'),
                        '_parent' => __('_parent', 'framework'),
                        '_self' => __('_self', 'framework'),
                        '_top' => __('_top', 'framework')
                    ),
                    'default' => '_self',
                )

            )
        ),
		array(
            'shortcode' => 'person_slider',
            'name' => __('Person slider', 'framework'),
            'description' => '',
            'usage' => '[person_slider animation="bounceInUp" title="Your title here..." title_first_word_color="#FF0000" title_color="#FFF" title_font="Arial" background_color="#000000"][person_slide id="12" image=""][/person_slider]',
            'code' => '[person_slider animation="{animation}" title="{title}" title_first_word_color="{titlefirstwordcolor}" title_color="{titlecolor}" title_font="{titlefont}" background_color="{backgroundcolor}"]{child}[/person_slider]',
            'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'title' => array(
                    'label' => __('Title', 'framework'),
                    'type' => 'text',
                    'desc' => ''
                ),
				'titlefirstwordcolor' => array(
                    'label' => __('Title first word color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
				'titlecolor' => array(
                    'label' => __('Title color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                ),
				'titlefont' => array(
                    'type' => 'select',
                    'label' => __('Title font', 'framework'),
                    'desc' => '',
                    'values' => ts_get_font_choices(true)
                ),
				'backgroundcolor' => array(
                    'label' => __('Background color', 'framework'),
                    'type' => 'colorpicker',
                    'desc' => ''
                )
            ),
            'add_child_button' => __('Add Person', 'framework'),
            'child' => array(
                'name' => __('Person', 'framework'),
                'code' => '[person_slide id="{id}" image="{image}"]',
                'fields' => array(
                    'id' => array(
                        'type' => 'text',
                        'label' => __('ID', 'framework'),
                        'desc' => ''
                    ),
					'image' => array(
                        'type' => 'upload',
                        'label' => __('Image', 'framework'),
                        'desc' => ''
                    )
                )
            )
        ),
        array(
            'shortcode' => 'pricing_table',
            'name' => __('Pricing table', 'framework'),
            'description' => '',
            'usage' => '[pricing_table animation="bounceInUp" style="style1"][pricing_table_column featured="no" title="Your title" price="12" currency="$" period="per month" buttontext="Buy" url="http://yourdomain.com"][pricing_table_item value="text" text="Your text"][/pricing_table_column][/pricing_table]',
            'code' => '[pricing_table animation="{animation}" style="{style}"]{child}[/pricing_table]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'style' => array(
                    'type' => 'select',
                    'label' => 'Style',
                    'values' => array(
                        'style1' => __('Style 1','framework'),
                        'style2' => __('Style 2','framework')

                    ),
                    'default' => 'style1',
                    'desc' => '',
                    'class' => 'pt_style'
                ),


            ),

            'add_child_button' => __('Add Column', 'framework'),
            'child' => array(
                'name' => __('Column', 'framework'),
                'code' => '[pricing_table_column featured="{featured}" title="{title}" price="{price}" currency="{currency}" period="{period}" buttontext="{buttontext}" url="{url}"]{child}[/pricing_table_column]',
                'fields' => array(
                    'featured' => array(
                        'type' => 'select',
                        'label' => __('Featured (only one column should be featured)', 'framework'),
                        'values' => array(
                            'no' => __('No', 'framework'),
                            'yes' => __('Yes', 'framework')
                        ),
                        'default' => 'no',
                        'desc' => ''
                    ),
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Title', 'framework'),
                        'desc' => ''
                    ),
                    'price' => array(
                        'type' => 'text',
                        'label' => __('Price', 'framework'),
                        'desc' => ''
                    ),
                    'currency' => array(
                        'type' => 'text',
                        'label' => __('Currency', 'framework'),
                        'desc' => ''
                    ),
                    'period' => array(
                        'type' => 'text',
                        'label' => __('Period', 'framework'),
                        'desc' => ''
                    ),
                    'buttontext' => array(
                        'type' => 'text',
                        'label' => __('Button Text', 'framework'),
                        'desc' => ''
                    ),
                    'url' => array(
                        'type' => 'text',
                        'label' => __('URL', 'framework'),
                        'desc' => ''
                    ),
                ),
                'add_child_button' => __('Add Row', 'framework'),
                'child' => array(
                    'name' => __('Row', 'framework'),
                    'code' => '[pricing_table_item value="{value}" text="{text}"]',
                    'fields' => array(
                        'value' => array(
                            'type' => 'select',
                            'label' => __('Value', 'framework'),
                            'desc' => '',
                            'values' => array(
                                'text' => __('Text', 'framework'),
                                'checked' => __('Checked', 'framework'),
                                'notchecked' => __('Not checked', 'framework')
                            ),
                            'default' => '',
                        ),
                        'text' => array(
                            'type' => 'text',
                            'label' => __('Text', 'framework'),
                            'desc' => ''
                        )
                    )
                )
            )
        ),
        array(
            'shortcode' => 'project_gallery',
            'name' => __('Project Gallery', 'framework'),
            'description' => '',
            'usage' => '[project_gallery animation="pulse"][image_item tooltip="Your text..."]image.png[/image_item][/project_gallery]',
            'code' => '[project_gallery animation="{animation}"]{child}[/project_gallery]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),

            ),
            'add_child_button' => __('Add Slider Item', 'framework'),
            'child' => array(
                'name' => __('Sliders item', 'framework'),
                'code' => '[image_item tooltip="{tooltip}"]{image}[/image_item]',
                'fields' => array(
					'image' => array(
                        'type' => 'upload',
                        'label' => __('Image', 'framework'),
                        'desc' => ''
                    ),
					'tooltip' => array(
                        'type' => 'text',
                        'label' => __('Tooltip', 'framework'),
                        'desc' => ''
                    )
                )
            )
        ),
		array(
            'shortcode' => 'recent_news_big',
            'name' => __('Recent News Big','framework'),
            'description'=>'',
            'usage' => '[recent_news_big animation="fade" limit="100"]',
            'code' => '[recent_news_big animation="{animation}" limit="{limit}" ]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'limit' => array(
                    'label' => __('Limit', 'framework'),
                    'type' => 'text',
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'recent_posts',
            'name' => __('Recent Posts','framework'),
            'description'=>'',
            'usage' => '[recent_posts animation="fade" length="100" count=10 ]',
            'code' => '[recent_posts animation="{animation}" length="{length}"  count="{count}" ]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'length'=>array(
                    'label'=>'Excerpt Length',
                    'type'=>'text',
                    'desc'=>''
                ),
                'count' => array(
                    'label' => __('Limit', 'framework'),
                    'type' => 'text',
                    'desc' => ''
                )
            )
        ),
		array(
            'shortcode' => 'skillbar',
            'name' => __('Skill bars', 'framework'),
            'description' => '',
            'usage' => '[skillbar animation="bounceInUp" style="style1"  border_color="#fff" text_color="#fff" ][skillbar_item percentage="80" title="Cooking"][/skillbar]',
            'code' => '[skillbar animation="{animation}" style="{style}" border_color="{borderColor}" text_color="{textColor}"]{child}[/skillbar]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'style'=>array(
                    'type'=>'select',
                    'desc'=>'',
                    'label'=>__('Style','framework'),
                    'values'=>array(
                        'style1'=> '1',
                        'style2'=> '2'
                    )
                ),
                'textColor' => array(
                    'type' => 'colorpicker',
                    'desc' => '',
                    'label' => __('Text Color', 'framework')
                ),
                'borderColor' => array(
                    'type' => 'colorpicker',
                    'desc' => '',
                    'label' => __('Border Color', 'framework')
                )
            ),
            'add_child_button' => __('Add Skill Bar', 'framework'),
            'child' => array(
                'name' => __('Skill bar', 'framework'),
                'code' => '[skillbar_item percentage="{percentage}" title="{title}" ]',
                'fields' => array(
                    'percentage' => array(
                        'type' => 'select',
                        'label' => __('Percentage', 'framework'),
                        'values' => ts_get_percentage_select_values(),
                        'desc' => ''
                    ),
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Title', 'framework'),
                        'desc' => ''
                    )
                )
            )
        ),
		array(
			'shortcode' => 'social_icons',
			'name' => __('Social icons','framework'),
			'description' => '',
			'usage' => '[social_icons animation="bounceInUp"][social_icon icon="icon-facebook" title="Facebook" url="http://facebook.com" target="_blank"][/social_icons]',
			'code' => '[social_icons animation="{animation}" style="{style}"]{child}[/social_icons]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings()
			),
			'add_child_button' => __('Add Item', 'framework'),
			'child' => array(
				'name' => __('Item','framework'),
				'code' => '[social_icon icon="{icon}" title="{title}" url="{url}" target="{target}"]',
				'fields' => array(
					'icon' => array(
						'type' => 'select',
						'label' => __('Icon', 'framework'),
						'values' => array(
							'icon-dribbble' => 'Dribbble',
							'icon-facebook' => 'Facebook',
							'icon-pinterest' => 'Pinterest',
							'icon-linkedin' => 'LinkedIn',
							'icon-instagram' => 'Instagram',
							'icon-googleplus' => 'Google+',
							'icon-github' => 'Github',
							'icon-rss' => 'Rss',
							'icon-tumblr' => 'Tumblr',
							'icon-twitter' => 'Twitter',
							'icon-skype' => 'Skype',
							'icon-flickr' => 'Flickr',
							'icon-vk' => 'VK',
							'icon-youtube' => 'Youtube'
						),
						'default' => '',
						'desc' => ''
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'url' => array(
						'type' => 'text',
						'label' => __('Url', 'framework'),
						'desc' => ''
					),
					'target' => array(
						'type' => 'select',
						'label' => __('Target', 'framework'),
						'values' => array(
							'_blank' => __('_blank', 'framework'),
							'_parent' => __('_parent', 'framework'),
							'_self' => __('_self', 'framework'),
							'_top' => __('_top', 'framework')
						),
						'default' => '_self',
						'desc' => ''
					)
				)
			)
		),
        array(
            'shortcode' => 'space',
            'name' => __('Space', 'framework'),
            'description' => '',
            'usage' => '[space height="20"]',
            'code' => '[space height="{height}"]',
            'fields' => array(
                'height' => array(
                    'type' => 'text',
                    'label' => __('Height (px)', 'framework'),
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'special_text',
            'name' => __('Special text', 'framework'),
            'description' => '',
            'usage' => '[special_text animation="bounceInUp" tagname="h2" color="#FF0000" font_size="12" font_weight="bold" font="Arial" margin_top="10" margin_bottom="10" align="left"]Your text here...[/special_text]',
            'code' => '[special_text animation="{animation}" tagname="{tagname}" color="{color}" font_size="{fontsize}" font_weight="{fontweight}" font="{font}" margin_top="{margintop}" margin_bottom="{marginbottom}" align="{align}"]{content}[/special_text]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'tagname' => array(
                    'type' => 'select',
                    'label' => __('Tag name', 'framework'),
                    'values' => array(
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                    ),
                    'default' => 'h1',
                    'desc' => ''
                ),
                'color' => array(
                    'type' => 'colorpicker',
                    'label' => __('Font color', 'framework'),
                    'desc' => ''
                ),
                'fontsize' => array(
                    'type' => 'text',
                    'label' => __('Font size', 'framework'),
                    'desc' => ''
                ),
                'fontweight' => array(
                    'type' => 'select',
                    'label' => __('Font weight', 'framework'),
                    'values' => array(
                        'default' => __('Default', 'framework'),
                        'normal' => __('Normal', 'framework'),
                        'bold' => __('Bold', 'framework'),
                        'bolder' => __('Bolder', 'framework'),
                        '300' => __('Light', 'framework')
                    ),
                    'default' => 'default',
                    'desc' => ''
                ),
                'font' => array(
                    'type' => 'select',
                    'label' => __('Font', 'framework'),
                    'desc' => '',
                    'values' => ts_get_font_choices(true)
                ),
                'margintop' => array(
                    'type' => 'text',
                    'label' => __('Margin top (px)', 'framework'),
                    'desc' => ''
                ),
                'marginbottom' => array(
                    'type' => 'text',
                    'label' => __('Margin bottom (px)', 'framework'),
                    'desc' => ''
                ),
                'align' => array(
                    'type' => 'select',
                    'label' => __('Align', 'framework'),
                    'values' => array(
                        'left' => __('Left', 'framework'),
                        'center' => __('Center', 'framework'),
                        'right' => __('Right', 'framework')
                    ),
                    'default' => 'left',
                    'desc' => ''
                ),
                'content' => array(
                    'type' => 'textarea',
                    'label' => __('Content', 'framework'),
                    'desc' => ''
                ),
            )
        ),
        array(
            'shortcode' => 'tabs',
            'name' => __('Tabs', 'framework'),
            'description' => '',
            'usage' => '[tabs  orientation="horizontal"  animation="fadein"][tab url="http://test.com" target="_blank"]Your text here...[/tab][/tabs]',
            'code' => '[tabs  orientation="{orientation}"   animation="{animation}"]{child}[/tabs]',
            'fields' => array(

                'orientation' => array(
                    'type' => 'select',
                    'label' => __('Orientation', 'framework'),
                    'values' => array(
                        'horizontal' => __('horizontal', 'framework'),
                        'vertical' => __('vertical', 'framework')
                    ),
                    'desc' => ''
                ),

                'animation' => array(
                    'type' => 'select',
                    'label' => __('Animation', 'framework'),
                    'values' => array(
                        'fadeIn' => __('fadeIn', 'framework'),
                        'slideDown' => __('slideDown', 'framework')
                    ),
                    'desc' => ''
                )
            ),
            'add_child_button' => __('Add Tab', 'framework'),
            'child' => array(
                'name' => __('Tab', 'framework'),
                'code' => '[tab title="{title}" icon="{icon}"]{content}[/tab]',
                'fields' => array(
                    'icon' => array(
                        'type' => 'select',
                        'label' => __('Icon', 'framework'),
                        'values' => ts_getFontAwesomeArray(true),
                        'default' => '',
                        'desc' => '',
                        'class' => 'icons-dropdown'
                    ),

                    'title' => array(
                        'type' => 'text',
                        'label' => __('Title', 'framework'),
                        'desc' => ''
                    ),
                    'content' => array(
                        'type' => 'textarea',
                        'label' => __('Content', 'framework'),
                        'desc' => ''
                    ),
                )
            )
        ),
        array(
            'shortcode' => 'testimonial',
            'name' => __('Testimonial', 'framework'),
            'description' => '',
            'usage' => '[testimonial animation="bounceInUp" id="2"]',
            'code' => '[testimonial animation="{animation}" id="{id}"]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'id' => array(
                    'type' => 'text',
                    'label' => __('Testimonial ID', 'framework'),
                    'desc' => ''
                )
            )
        ),
		array(
			'shortcode' => 'testimonials',
			'name' => __('Testimonials','framework'),
			'description' => '',
			'usage' => '[testimonials animation="bounceInUp" category="3" limit="3" text_color="#444" info_color="#777" nav_style="light"]',
			'code' => '[testimonials animation="{animation}" category="{category}" limit="{limit}" text_color="{textcolor}" info_color="{infocolor}" nav_style="{navstyle}"]',
			'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
				'category' => array(
					'type' => 'text',
					'label' => __('Category ID', 'framework'),
					'desc' => ''
				),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				),
                'textcolor' => array(
					'type' => 'colorpicker',
					'label' => __('Text color', 'framework'),
					'desc' => ''
				),
                'infocolor' => array(
					'type' => 'colorpicker',
					'label' => __('Info color', 'framework'),
					'desc' => ''
				),
				'navstyle' => array(
                    'type' => 'select',
                    'label' => __('Navigation style', 'framework'),
                    'desc' => '',
                    'values' => array(
                        'light' => __('Light', 'framework'),
						'dark' => __('Dark', 'framework')
                    )
                ),
			)
		),
        array(
            'shortcode' => 'text',
            'name' => __('Text', 'framework'),
            'description' => '',
            'usage' => '[text animation="bounceInUp"]Your text here...[/text]',
            'code' => '[text animation="{animation}"]{text}[/text]',
            'fields' => array(
                'animation' => ts_get_animation_effects_settings(),
                'text' => array(
                    'type' => 'wp_editor',
                    'label' => __('Content', 'framework'),
                    'desc' => ''
                )
            )
        ),
        array(
            'shortcode' => 'tooltip',
            'name' => __('Tooltip','framework'),
            'description'=>'',
            'usage' => '[tooltip position="top" tooltip="Tooltip Message" link="http://google.com" ][/tooltip]',
            'code' => '[tooltip position="{position}" tooltip="{tooltip}" link="{link}" ]{label}[/tooltip]',
            'fields' => array(
                'label' => array(
                    'label' => __('Label', 'framework'),
                    'type' => 'text',
                    'desc' => '',
                    'default' => '#'
                ),
                'tooltip' => array(
                    'label' => __('Tooltip', 'framework'),
                    'type' => 'text',
                    'desc' => '',
                 ),
                'position' => array(
                    'type' => 'select',
                    'label' => __('Position', 'framework'),
                    'desc' => '',
                    'values' => array(
                        'top' => __('Top', 'framework'),
                        'bottom' => __('Bottom', 'framework'),
                        'left' => __('Left', 'framework'),
                        'right' => __('Right', 'framework'),
                    )
                ),
                'link' => array(
                    'label' => __('Link', 'framework'),
                    'type' => 'text',
                    'desc' => '',
                    'defauly' => '#'
                )
            )
        ),
		array(
            'shortcode' => 'video_player',
            'name' => __('Video player','framework'),
            'description'=>'',
            'usage' => '[video_player animation="bounceInUp" url="http://google.com" autoplay="no" align="left"]',
            'code' => '[video_player animation="{animation}" url="{url}" autoplay="{autoplay}" align="{align}"]',
            'fields' => array(
				'animation' => ts_get_animation_effects_settings(),
                'url' => array(
                    'label' => __('URL', 'framework'),
                    'type' => 'upload',
                    'desc' => '',
                    'default' => '#'
                ),
				'autoplay' => array(
                    'type' => 'select',
                    'label' => __('Autoplay', 'framework'),
                    'values' => array(
                        'no' => __('No', 'framework'),
						'yes' => __('Yes', 'framework')
                    ),
                    'default' => 'no',
                    'desc' => ''
                ),
				'align' => array(
                    'type' => 'select',
                    'label' => __('Align', 'framework'),
                    'values' => array(
                        'left' => __('Left', 'framework'),
                        'center' => __('Center', 'framework'),
                        'right' => __('Right', 'framework')
                    ),
                    'default' => 'left',
                    'desc' => ''
                )
            )
        )
    );

//adding custom items which are not shortcodes but are required for popup.php (eg. nav-menus.php icons)
    if (isset($_GET['custom_popup_items']) && $_GET['custom_popup_items'] == 1 && function_exists('ts_get_custom_popup_items')) {
        $custom_items = ts_get_custom_popup_items();
        if (is_array($custom_items)) {
            $aHelp = array_merge($aHelp, $custom_items);
        }
    }

    return $aHelp;
}

function ts_get_percentage_select_values($add_zero = false)
{
    $a = array();

    if ($add_zero) {
        $start_from = 0;
    } else {
        $start_from = 1;
    }

    for ($i = $start_from; $i <= 100; $i++) {
        $a[$i] = $i;
    }
    return $a;
}

function ts_get_animation_effects_settings()
{

    return array(
        'type' => 'select',
        'label' => __('Animation', 'framework'),
        'desc' => '',
        'values' => ts_get_animation_effects_list()
    );
}

function ts_get_vc_animation_effects_settings()
{
	return array(
		'type' => 'dropdown',
		'heading' => __( 'Animation', 'framework' ),
		'param_name' => 'animation',
		'admin_label' => true,
		'value' => ts_get_animation_effects_list(true),
		'description' => ''
	);
}

function ts_get_animation_effects_list($flip = false)
{

    $animations = array(
        'bounce',
        'flash',
        'pulse',
        'shake',
        'swing',
        'tada',
        'wobble',
        'bounceIn',
        'bounceInDown',
        'bounceInLeft',
        'bounceInRight',
        'bounceInUp',
        'bounceOut',
        'bounceOutDown',
        'bounceOutLeft',
        'bounceOutRight',
        'bounceOutUp',
        'fadeIn',
        'fadeInDown',
        'fadeInDownBig',
        'fadeInLeft',
        'fadeInLeftBig',
        'fadeInRight',
        'fadeInRightBig',
        'fadeInUp',
        'fadeInUpBig',
        'fadeOut',
        'fadeOutDown',
        'fadeOutDownBig',
        'fadeOutLeft',
        'fadeOutLeftBig',
        'fadeOutRight',
        'fadeOutRightBig',
        'fadeOutUp',
        'fadeOutUpBig',
        'flip',
        'flipInX',
        'flipInY',
        'flipOutX',
        'flipOutY',
        'lightSpeedIn',
        'lightSpeedOut',
        'rotateIn',
        'rotateInDownLeft',
        'rotateInDownRight',
        'rotateInUpLeft',
        'rotateInUpRight',
        'rotateOut',
        'rotateOutDownLeft',
        'rotateOutDownRight',
        'rotateOutUpLeft',
        'rotateOutUpRight',
        'slideInDown',
        'slideInLeft',
        'slideInRight',
        'slideOutLeft',
        'slideOutRight',
        'slideOutUp',
        'hinge',
        'rollIn',
        'rollOut'
    );
    $animation_effects = array();
	
	if ($flip == true) {
		$animation_effects[__('None', 'framework')] = '';
	} else {
		$animation_effects[''] = __('None', 'framework');
	}
	
    
    foreach ($animations as $animation) {
        $animation_effects[$animation] = $animation;
    }

    return $animation_effects;
}