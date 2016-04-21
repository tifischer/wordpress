<?php

/**
 * Meta boxes definitions
 *
 * @package framework
 * @since framework 1.0
 */

/**
 * Enque scripts for post options metaboxes
 *
 */
add_action("admin_head-post.php", 'ts_framework_post_scripts');
add_action("admin_head-post-new.php", 'ts_framework_post_scripts');

function ts_framework_post_scripts()
{
    wp_register_script('screwdefaultbuttons', get_template_directory_uri() . '/framework/js/jquery.screwdefaultbuttonsV2.min.js', array('jquery'));
    wp_enqueue_script('screwdefaultbuttons');

    wp_register_script('metaboxes_options', get_template_directory_uri() . '/framework/js/meta-boxes-options.js', array('jquery'));
    wp_enqueue_script('metaboxes_options');

    wp_register_script('page_builder', get_template_directory_uri() . '/framework/js/page-builder.js', array('jquery'));
    wp_enqueue_script('page_builder');
}

/**
 * Get script which replaces sidebar radio buttons with images
 *
 */
function ts_get_sidebar_radio_buttons_replacement_script()
{
    return '
		<script type="text/javascript">
			jQuery(document).ready(function() {

				var $radios = jQuery("input:radio[name=sidebar_position_single]");
				if($radios.is(":checked") === false) {
					$radios.filter("[value=no]").prop("checked", true);
				}

				jQuery(\'input:radio[name="sidebar_position_single"][value="left"]\').screwDefaultButtons({
					image: "url(' . get_template_directory_uri() . '/framework/images/sidebar-left.png)",
					width:	 100,
					height:	 64
				});


				jQuery(\'input:radio[name="sidebar_position_single"][value="right"]\').screwDefaultButtons({
					image: "url(' . get_template_directory_uri() . '/framework/images/sidebar-right.png)",
					width:	 100,
					height:	 64
				});



				jQuery(\'input:radio[name="sidebar_position_single"][value="no"]\').screwDefaultButtons({
					image: "url(' . get_template_directory_uri() . '/framework/images/sidebar-no.png)",
					width:	 100,
					height:	 64
				});
			});
		</script>';
}

/**
 * Get shortcodes meta box content
 *
 */
function ts_get_shortcodes_meta_box_cotent()
{
    $content = __('Available shortcodes:', 'framework');

    $aHelp = ts_get_shortcodes_list();

    if (is_array($aHelp)) {
        $iCount = count($aHelp);
        $i = 0;
        $col1 = '';
        $col2 = '';
        foreach ($aHelp as $aShortcode) {
            $col = '
				<div class="framework-box">
					<div class="toggle-shortcode" title="' . __('Click to toggle', 'framework') . '"><br></div>
					<h3><span>' . $aShortcode['name'] . '</span></h3>
					<div class="box-description">';

            $usage = $aShortcode['usage'];
            if (!is_array($aShortcode['usage'])) {
                $usage = array();
                $usage[] = $aShortcode['usage'];
            }
            foreach ($usage as $item) {
                $col .= '<div class="shortcode-usage">' . $item . '</div>';
            }
            $description = $aShortcode['description'];
            if (!is_array($aShortcode['description'])) {
                $description = array();
                $description[] = $aShortcode['description'];
            }
            foreach ($description as $item) {
                $col .= '<p>' . $item . '</p>';
            }
            $col .= '
					</div>
				</div>';

            if ($iCount / 2 > $i) {
                $col1 .= $col;
            } else {
                $col2 .= $col;
            }
            $i++;
        }
    }

    $content .= '
		<div id="framework-shortcodes-help">
			<div class="col">
				<div class="colpad1">
					' . $col1 . '
				</div>
			</div>
			<div class="col">
				<div class="colpad2">
					' . $col2 . '
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		';

    return $content;
}

/**
 * Meta boxes definition
 *
 */
add_action('admin_init', 'ts_custom_meta_boxes');

function ts_custom_meta_boxes()
{
    $sidebar_choices = array();
    $sidebar_choices[] = array(
        'label' => __('Main', 'framework'),
        'value' => 'main',
        'src' => ''
    );

    $user_sidebars = ot_get_option('user_sidebars');

    if (is_array($user_sidebars)) {
        foreach ($user_sidebars as $sidebar) {
            $sidebar_choices[] = array(
                'label' => $sidebar['title'],
                'value' => sanitize_title($sidebar['title']),
                'src' => ''
            );
        }
    }

    //Shortcodes Help
    $shortcodes_options_boxes = array(
        'id' => 'shortcodes_options_boxes',
        'title' => __('Shortcodes', 'framework'),
        'desc' => ts_get_shortcodes_meta_box_cotent(),
        'pages' => array('post', 'page'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array()
    );
    ot_register_meta_box($shortcodes_options_boxes);


    //post options
    $post_options_boxes = array(
        'id' => 'post_options_boxes',
        'title' => __('Post Options', 'framework'),
        'desc' => ts_get_sidebar_radio_buttons_replacement_script(),
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(


            array(
                'id' => 'audio_url',
                'label' => __('Audio URL', 'framework'),
                'desc' => __('Audio URL', 'framework'),
                'std' => '',
                'type' => 'Text',
                'class' => 'audio',
                'choices' => ''
            ),

            array(
                'id' => 'quote_text',
                'label' => __('Quote Text', 'framework'),
                'desc' => __('Quote Text', 'framework'),
                'std' => '',
                'type' => 'Text',
                'class' => 'quote',
                'choices' => ''
            ),
            array(
                'id' => 'author_text',
                'label' => __('Quote Author', 'framework'),
                'desc' => __('Quote Author', 'framework'),
                'std' => '',
                'type' => 'Text',
                'class' => 'quote',
                'choices' => ''
            ),


            array(
                'id' => 'video_url',
                'label' => __('Video URL', 'framework'),
                'desc' => __('YouTube or Vimeo video URL', 'framework'),
                'std' => '',
                'type' => 'Text',
                'class' => 'video',
                'choices' => ''
            ),
            array(
                'id' => 'embedded_video',
                'label' => __('Embadded Video', 'framework'),
                'desc' => __('Please use this option when the video does not come from YouTube or Vimeo', 'framework'),
                'std' => '',
                'type' => 'Textarea_Simple',
                'class' => 'video',
                'choices' => ''
            ),
            array(
                'id' => 'gallery_images',
                'label' => __('Gallery', 'framework'),
                'desc' => __('Slider gallery images', 'framework'),
                'std' => '',
                'type' => 'list-item',
                'section' => 'general',
                'rows' => '',
                'post_type' => 'post',
                'taxonomy' => '',
                'class' => 'gallery',
                'settings' => array(
                    array(
                        'id' => 'image',
                        'label' => __('Image', 'framework'),
                        'desc' => '',
                        'std' => '',
                        'type' => 'upload',
                        'rows' => '',
                        'post_type' => '',
                        'taxonomy' => '',
                        'class' => ''
                    )
                )
            )
        )
    );
    ot_register_meta_box($post_options_boxes);

    $page_options_boxes = array(
        'id' => 'page_options_boxes',
        'title' => __('Page Options', 'framework'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'id' => 'page_builder',
                'label' => __('Page Builder', 'framework'),
                'desc' => '<div id="page-builder" data-post="' . (isset($_GET['post']) ? $_GET['post'] : '') . '"></div>',
                'std' => '',
                'type' => 'textblock',
                'class' => '',
                'choices' => ''
            ),
            array('id' => 'slider_content_bg',
                'label' => __('Slider Content Background 1', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'elements_color',
                'class' => 'template-alternative',
            ),
            array('id' => 'slider_content_bg_2',
                'label' => __('Slider Content Background 2', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'elements_color',
                'class' => 'template-alternative',
            ),


            array('id' => 'slider_content_bg_transparency',
                'label' => __('Slider Content Background Transparency', 'framework'),
                'std' => '',
                'type' => 'Select',

                'class' => 'template-alternative',
                'choices' => array(
                    array(
                        'label' => '10%',
                        'value' => '10',
                        'src' => ' '
                    ),
                    array(
                        'label' => '20%',
                        'value' => '20',
                        'src' => ' '
                    ),
                    array(
                        'label' => '30%',
                        'value' => '30',
                        'src' => ' '
                    ),
                    array(
                        'label' => '40%',
                        'value' => '40',
                        'src' => ' '
                    ),array(
                        'label' => '50%',
                        'value' => '50',
                        'src' => ' '
                    ),array(
                        'label' => '60%',
                        'value' => '60',
                        'src' => ' '
                    ),array(
                        'label' => '70%',
                        'value' => '70',
                        'src' => ' '
                    ),array(
                        'label' => '80%',
                        'value' => '80',
                        'src' => ' '
                    ),array(
                        'label' => '90%',
                        'value' => '90',
                        'src' => ' '
                    ),array(
                        'label' => '100%',
                        'value' => '100',
                        'src' => ' '
                    ),

                )
            ),
            array(
                'id' => 'contact_map',
                'label' => __('Map', 'framework'),
                'desc' => __('Please insert map into editor below', 'framework'),
                'std' => '',
                'type' => 'Textarea',
                'class' => 'template-contact-basic template-contact-form-ext',
                'choices' => ''
            ),
			array(
				'id' => 'contact_form_header',
				'label' => __('Contact Form Header', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'class' => 'template-contact-form-ext',
				'choices' => ''
			),
			array(
				'id' => 'contact_form_name_field_label',
				'label' => __('Name Field Label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'class' => 'template-contact-form-ext',
				'choices' => ''
			),
			array(
                'id' => 'contact_form_name_field_icon',
                'label' => __('Name Field Icon', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => 'template-contact-form-ext',
                'choices' => ts_getFontAwesomeArray(true, null, true)
            ),
			array(
				'id' => 'contact_form_email_field_label',
				'label' => __('Email Field Label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'class' => 'template-contact-form-ext',
				'choices' => ''
			),
			array(
                'id' => 'contact_form_email_field_icon',
                'label' => __('Email Field Icon', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => 'template-contact-form-ext',
                'choices' => ts_getFontAwesomeArray(true, null, true)
            ),
			array(
				'id' => 'contact_form_message_field_label',
				'label' => __('Message Field Label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'class' => 'template-contact-form-ext',
				'choices' => ''
			),
			array(
				'id' => 'contact_form_submit_field_label',
				'label' => __('Submit Field Label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'class' => 'template-contact-form-ext',
				'choices' => ''
			),
			array(
				'id' => 'contact_form_clear_field_label',
				'label' => __('Clear Field Label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'class' => 'template-contact-form-ext',
				'choices' => ''
			),
            array(
                'id' => 'show_categories_filter',
                'label' => __('Show Categories Filter', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'radio',
                'class' => 'switcher-on template-portfolio-1-col template-portfolio-2-col template-portfolio-3-col template-portfolio-4-col template-full-width',
                'choices' => array(
                    array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    )
                )
            ),
//			array(
//				'id' => 'hide_footer_top',
//				'label' => __('Hide footer', 'framework'),
//				'desc' => '',
//				'std' => '',
//				'type' => 'radio',
//				'class' => 'switcher-off template-alternative-page',
//				'choices' => array(
//					array(
//						'value' => 'no',
//						'label' => __('No', 'framework'),
//						'src' => ''
//					),
//					array(
//						'value' => 'yes',
//						'label' => __('Yes', 'framework'),
//						'src' => ''
//					)
//				)
//			),
            array(
                'id' => 'show_contact_form',
                'label' => __('Show contact form', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'radio',
                'class' => 'switcher-on template-contact-basic template-contact-form-ext',
                'choices' => array(
                    array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    )
                )
            ),
			array(
				'id' => 'number_of_items',
				'label' => __('Number of items', 'framework'),
				'desc' => __('Number of blog or portfolio items to show', 'framework'),
				'std' => '',
				'type' => 'text',
				'class' => 'template-alternate template-blog-alternate template-blog-grid  template-blog-list template-blog-timeline template-portfolio-1-col template-portfolio-2-col template-portfolio-3-col template-portfolio-4-col template-portfolio-full-width template-faq',
				'choices' => ''
			),
			array(
				'id' => 'excerpt_length',
				'label' => __('Excerpt length', 'framework'),
				'desc' => __('Custom excerpt length', 'framework'),
				'std' => '',
				'type' => 'text',
				'class' => 'template-alternate template-blog-alternate template-blog-grid  template-blog-list template-blog-timeline',
				'choices' => ''
			),
			array(
				'id' => 'blog_categories',
				'label' => __('Blog categories', 'framework'),
				'desc' => __('Limit list to selected categories only', 'framework'),
				'std' => '',
				'type' => 'checkbox',
				'class' => 'template-alternate template-blog-alternate template-blog-grid  template-blog-list template-blog-timeline',
				'choices' => ts_get_post_categories()
			),
			array(
				'id' => 'portfolio_categories',
				'label' => __('Portfolio categories', 'framework'),
				'desc' => __('Limit list to selected categories only', 'framework'),
				'std' => '',
				'type' => 'checkbox',
				'class' => 'template-portfolio-1-col template-portfolio-2-col template-portfolio-3-col template-portfolio-4-col template-portfolio-full-width',
				'choices' => ts_get_portfolio_categories()
			)
        )
    );
    ot_register_meta_box($page_options_boxes);

    //Portfolio
    $portfolio_options_boxes = array(
        'id' => 'portfolio_options_boxes',
        'title' => __('Portfolio Options', 'framework'),
        'desc' => '',
        'pages' => array('portfolio'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'id' => 'work_author',
                'label' => __('Work By', 'marine'),
                'std' => '',
                'type' => 'Text',
            ),
            array(
                'id' => 'work_author_url',
                'label' => __('Author Url', 'marine'),
                'std' => '',
                'type' => 'Text',
            ),
            array(
                'id' => 'video_url',
                'label' => __('Video URL', 'framework'),
                'desc' => __('YouTube or Vimeo video URL', 'framework'),
                'std' => '',
                'type' => 'Text',
                'class' => 'video',
                'choices' => ''
            ),
            array(
                'id' => 'embedded_video',
                'label' => __('Embadded Video', 'framework'),
                'desc' => __('Please use this option when the video does not come from YouTube or Vimeo', 'framework'),
                'std' => '',
                'type' => 'Textarea_Simple',
                'class' => 'video',
                'choices' => ''
            ),
            array(
                'id' => 'gallery_images',
                'label' => __('Gallery', 'framework'),
                'desc' => __('Slider gallery images', 'framework'),
                'std' => '',
                'type' => 'list-item',
                'section' => 'general',
                'rows' => '',
                'taxonomy' => '',
                'class' => 'gallery',
                'settings' => array(
                    array(
                        'id' => 'image',
                        'label' => __('Image', 'framework'),
                        'desc' => '',
                        'std' => '',
                        'type' => 'upload',
                        'rows' => '',
                        'post_type' => '',
                        'taxonomy' => '',
                        'class' => ''
                    )
                )
            ),
            array(
                'id' => 'portfolio_single_style',
                'label' => __('Portfolio single style', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'basic',
                        'label' => __('Basic', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'extended',
                        'label' => __('Extended', 'framework'),
                        'src' => ''
                    ),

                )
            ),
            array(
                'id' => 'show_related_projects_on_portfolio_single',
                'label' => __('Related projects', 'framework'),
                'desc' => __('Show related projects on a single portfolio post', 'framework'),
                'std' => '',
                'type' => 'Select',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'choices' => array(
                    array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    )
                )
            ),


        )
    );
    ot_register_meta_box($portfolio_options_boxes);
    
	//common options
    $common_options_boxes = array(
        'id' => 'common_options_boxes',
        'title' => __('Common Options', 'framework'),
        'desc' => ts_get_sidebar_radio_buttons_replacement_script(),
        'pages' => array('post', 'page'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'id' => 'show_preheader',
                'label' => __('Show Preheader', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
					array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    )
                )
            ),
			array(
				'id' => 'logo_url',
				'label' => __('Custom logo', 'framework'),
				'desc' => __('Enter full URL of your logo image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
                'id' => 'main_menu_style',
                'label' => __('Main menu style', 'framework'),
                'desc' => __('Overrides global style settings', 'framework'),
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => ts_get_header_styles(true)
            ),
            array(
                'id' => 'post_slider',
                'label' => __('Slider', 'framework'),
                'desc' => __('Select a slider for this post', 'framework'),
                'std' => '',
                'type' => 'select',
                'class' => '',
                'choices' => ts_get_slider_items_for_theme_options()
            ),
            array(
                'id' => 'titlebar',
                'label' => __('Titlebar', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),

                    array(
                        'value' => 'title',
                        'label' => __('Only title', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'breadcrumbs',
                        'label' => __('Title + Breadcrumbs', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no_titlebar',
                        'label' => __('No titlebar', 'framework'),
                        'src' => ''
                    )
                )
            ),
            array(
                'id' => 'titlebar_style',
                'label' => __('Titlebar style', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'style1',
                        'label' => __('Style 1', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'style2',
                        'label' => __('Style 2', 'framework'),
                        'desc' => ''
                    ),
                    array(
                        'value' => 'style3',
                        'label' => __('Style 3', 'framework'),
                        'src' => ''
                    )
                )
            ),
			array(
                'id' => 'page_title_icon',
                'label' => __('Page title icon (choose or upload below)', 'framework'),
                'desc' => __('Works with Titlebar Style 3 only', 'framework'),
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => ts_getFontAwesomeArray(true, null, true)
            ),
			array(
                'id' => 'page_title_icon_upload',
                'label' => __('Page title icon upload', 'framework'),
                'desc' => __('Works with Titlebar Style 3 only', 'framework'),
                'std' => '',
                'type' => 'Upload',
                'class' => '',
                'choices' => ts_getFontAwesomeArray(true, null, true)
            ),
            array(
                'id' => 'page_title_color',
                'label' => __('Page title color', 'framework'),
                'desc' => __('Color of the page title', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'elements_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => '',
                'choices' => ''
            ),
            array(
                'id' => 'titlebar_bg',
                'label' => __('titlebar background color', 'framework'),
                'desc' => __('Background Color', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'class' => '',
                'choices' => ''
            ),
            array(
                'id' => 'titlebar_background',
                'label' => __('titlebar background', 'framework'),
                'desc' => __('Background image URL', 'framework'),
                'std' => '',
                'type' => 'upload',
                'class' => '',
                'choices' => ''
            ),
            array(
                'id' => 'breadcrumb_color',
                'label' => __('Breadcrumbs Color', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'colorpicker',
                'class' => '',
                'choices' => ''
            ),
            array(
                'id' => 'sidebar_position_single',
                'label' => __('Sidebar position', 'framework'),
                'desc' => __('Select a sidebar position', 'framework'),
                'std' => (strpos( $_SERVER['SCRIPT_NAME'], 'post-new.php' ) > 0 && !isset($_GET['post_type']) ? 'right' : ''),
                'type' => 'radio',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'left',
                        'label' => __('Left', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'right',
                        'label' => __('Right', 'framework'),
                        'src' => ''
                    ),

                ),
            ),
            array(
                'id' => 'left_sidebar',
                'label' => __('Left sidebar', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'class' => '',
                'choices' => $sidebar_choices
            ),
            
            array(
                'id' => 'right_sidebar',
                'label' => __('Right sidebar', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'class' => '',
                'choices' => $sidebar_choices
            ),     
           isset($_GET['post']) && is_page($_GET['post']) || isset($_GET['post_type']) && $_GET['post_type'] == 'page' ?
				array(
					'id' => 'show_comment_form',
					'label' => __('Show Comment form', 'framework'),
					'desc' => '',
					'std' => '',
					'type' => 'radio',
					'class' => 'switcher-off',
					'choices' => array(
						array(
							'value' => 'no',
							'label' => __('No', 'framework'),
							'src' => ''
						),
						array(
							'value' => 'yes',
							'label' => __('Yes', 'framework'),
							'src' => ''
						),
					)
				):
				array(
					'id' => 'show_comment_form',
					'label' => __('Show Comment form', 'framework'),
					'desc' => '',
					'std' => '',
					'type' => 'radio',
					'class' => 'switcher-on',
					'choices' => array(
						array(
							'value' => 'yes',
							'label' => __('Yes', 'framework'),
							'src' => ''
						),
						array(
							'value' => 'no',
							'label' => __('No', 'framework'),
							'src' => ''
						)
					)
				)
			,
            array(
                'id' => 'show_shop_footer',
                'label' => __('Show Shop Footer', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'taxonomy' => '',
                'class' => 'switcher-off',
                'choices' => array(
                    array(
                        'value' => '',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    )
                ),

            ),
            array(
                'id' => 'show_recent_tweet_footer',
                'label' => __('Show recent tweets in the footer', 'framework'),
                'desc' => __('You need to set Twitter API keys in the Theme Options to make this option work. You can get the API keys here http://dev.twitter.com',
                    'framework'),
                'std' => '',
                'type' => 'select',
                'taxonomy' => '',
                'class' => '',
                'choices' => array(
					array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    )
                )
            ),
			array(
				'id' => 'footer_style',
				'label' => __('Footer style', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'default',
						'label' => __('Default', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'normal',
						'label' => __('Normal', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'alternative',
						'label' => __('Alternative with contact form', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'footer_cf_font_style',
				'label' => __('Contact Form - Header font style', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'footer_cf_font_size',
				'label' => __('Contact Form - Header font size (px)', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Text',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_cf_color',
				'label' => __('Contact Form - Header color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_cf_header',
				'label' => __('Contact Form - Header', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Text',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_cf_name_label',
				'label' => __('Contact Form - Name label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Text',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_cf_name_icon',
				'label' => __('Contact Form - Name icon', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_getFontAwesomeArray(false, array('default' => __('Default', 'marine')), true)
			),
			array(
				'id' => 'footer_cf_email_label',
				'label' => __('Contact Form - Email label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Text',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_cf_email_icon',
				'label' => __('Contact Form - Email icon', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_getFontAwesomeArray(false, array('default' => __('Default', 'marine')), true)
			),
			array(
				'id' => 'footer_cf_message_label',
				'label' => __('Contact Form - Message label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Text',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_cf_send_label',
				'label' => __('Contact Form - Send label', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Text',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
                'id' => 'footer_cf_submit_style',
                'label' => __('Contact Form - Submit button style', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'rounded',
                        'label' => __('Rounded', 'framework'),
                        'src' => ''
                    )
                )
            )
        )
    );
    ot_register_meta_box($common_options_boxes);
	
	//common options
    $portfolio_common_options_boxes = array(
        'id' => 'common_options_boxes',
        'title' => __('Common Options', 'framework'),
        'desc' => '',
        'pages' => array('portfolio'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
			array(
                'id' => 'show_preheader',
                'label' => __('Show Preheader', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
					array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    )
                )
            ),
			array(
                'id' => 'page_title_color',
                'label' => __('Page title color', 'framework'),
                'desc' => __('Color of the page title', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'section' => 'elements_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => '',
                'choices' => ''
            ),
            array(
                'id' => 'titlebar_bg',
                'label' => __('titlebar background color', 'framework'),
                'desc' => __('Background Color', 'framework'),
                'std' => '',
                'type' => 'colorpicker',
                'class' => '',
                'choices' => ''
            ),
            array(
                'id' => 'titlebar_background',
                'label' => __('titlebar background', 'framework'),
                'desc' => __('Background image URL', 'framework'),
                'std' => '',
                'type' => 'upload',
                'class' => '',
                'choices' => ''
            ),
            array(
				'id' => 'show_comment_form',
				'label' => __('Show Comment form', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'radio',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
            array(
                'id' => 'show_shop_footer',
                'label' => __('Show Shop Footer', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'taxonomy' => '',
                'class' => 'switcher-off',
                'choices' => array(
                    array(
                        'value' => '',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    )
                ),

            ),
            array(
                'id' => 'show_recent_tweet_footer',
                'label' => __('Show recent tweets in the footer', 'framework'),
                'desc' => __('You need to set Twitter API keys in the Theme Options to make this option work. You can get the API keys here http://dev.twitter.com',
                    'framework'),
                'std' => '',
                'type' => 'select',
                'taxonomy' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'default',
                        'label' => __('Default', 'framework'),
                        'src' => ''
                    ),
					array(
                        'value' => 'no',
                        'label' => __('No', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'yes',
                        'label' => __('Yes', 'framework'),
                        'src' => ''
                    )
                )
            )
		)
	);
	ot_register_meta_box($portfolio_common_options_boxes);
	

    //Team
    $team_options_boxes = array(
        'id' => 'team_options_boxes',
        'title' => __('Team Options', 'framework'),
        'desc' => '',
        'pages' => array('team'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'id' => 'team_position',
                'label' => __('Position', 'framework'),
                'desc' => '',
                'type' => 'Text',
                'class' => '',
            ),
            array(
                'id' => 'xs_facebook',
                'label' => __('Facebook URL', 'framework'),
                'desc' => __('Icon appers if not empty', 'framework'),
                'type' => 'Text',
                'class' => '',
            ),
            array(
                'id' => 'xs_twitter',
                'label' => __('Twitter URL', 'framework'),
                'desc' => __('Icon appers if not empty', 'framework'),
                'type' => 'Text',
                'class' => '',
            ),
            array(
                'id' => 'xs_skype',
                'label' => __('Skype username', 'framework'),
                'desc' => __('Icon appers if not empty', 'framework'),
                'type' => 'Text',
                'class' => '',
            ),
            array(
                'id' => 'xs_dribbble',
                'label' => __('Dribbble URL', 'framework'),
                'desc' => __('Icon appers if not empty', 'framework'),
                'type' => 'Text',
                'class' => '',
            ),
            array(
                'id' => 'xs_google',
                'label' => __('Google+ URL', 'framework'),
                'desc' => __('Icon appers if not empty', 'framework'),
                'type' => 'Text',
                'class' => '',
            ),
            array(
                'id' => 'xs_linkedin',
                'label' => __('LinkedIn URL', 'framework'),
                'desc' => __('Icon appers if not empty', 'framework'),
                'type' => 'Text',
                'class' => '',
            ),
            array(
                'id' => 'xs_vimeo',
                'label' => __('Vimeo URL', 'framework'),
                'desc' => __('Icon appers if not empty', 'framework'),
                'type' => 'Text',
                'class' => '',
            ),
            array(
                'id' => 'xs_instagram',
                'label' => __('Instagram URL', 'framework'),
                'desc' => __('Icon appers if not empty', 'framework'),
                'type' => 'Text',
                'class' => '',
            )
        )
    );
    ot_register_meta_box($team_options_boxes);

    //Team
    $banner_builder_options_boxes = array(
        'id' => 'banner_builder_options_boxes',
        'title' => __('Banner Options', 'framework'),
        'desc' => '',
        'pages' => array('banner-builder'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'id' => 'height',
                'label' => __('Banner height', 'framework'),
                'desc' => __('Banner height in pixels', 'framework'),
                'std' => '',
                'type' => 'text',
                'class' => ''
            ),
            array(
                'id' => 'padding_top',
                'label' => __('Padding top', 'framework'),
                'desc' => __('Container top padding', 'framework'),
                'std' => '',
                'type' => 'text',
                'class' => ''
            ),
            array(
                'id' => 'padding_bottom',
                'label' => __('Padding bottom', 'framework'),
                'desc' => __('Container bottom padding', 'framework'),
                'std' => '',
                'type' => 'text',
                'class' => ''
            ),
            array(
                'id' => 'padding_left',
                'label' => __('Padding left', 'framework'),
                'desc' => __('Container left padding', 'framework'),
                'std' => '',
                'type' => 'text',
                'class' => ''
            ),
            array(
                'id' => 'padding_right',
                'label' => __('Padding right', 'framework'),
                'desc' => __('Container right padding', 'framework'),
                'std' => '',
                'type' => 'text',
                'class' => ''
            ),
            array(
                'id' => 'padding_unit',
                'label' => __('Padding unit', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'pixels',
                        'label' => __('px', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'percentage',
                        'label' => __('%', 'framework'),
                        'src' => ''
                    )
                )
            ),
            array(
                'id' => 'background_color',
                'label' => __('Background color', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'colorpicker',
                'class' => ''
            ),
            array(
                'id' => 'background_image',
                'label' => __('Background image', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Upload',
                'class' => ''
            ),
            array(
                'id' => 'background_repeat',
                'label' => __('Background repeat', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'repeat',
                        'label' => __('Repeat horizontally & vertically', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'repeat-x',
                        'label' => __('Repeat horizontally', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'repeat-y',
                        'label' => __('Repeat vertically', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'no-repeat',
                        'label' => __('No repeat', 'framework'),
                        'src' => ''
                    )
                )
            ),
            array(
                'id' => 'background_position',
                'label' => __('Background position', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'left top',
                        'label' => __('left top', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'left center',
                        'label' => __('left center', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'left bottom',
                        'label' => __('left bottom', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'right top',
                        'label' => __('right top', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'right center',
                        'label' => __('right center', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'right bottom',
                        'label' => __('right bottom', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'center top',
                        'label' => __('center top', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'center center',
                        'label' => __('center center', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'center bottom',
                        'label' => __('center bottom', 'framework'),
                        'src' => ''
                    )
                )
            ),
            array(
                'id' => 'background_attachment',
                'label' => __('Background attachment', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'scroll',
                        'label' => __('Scroll', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'fixed',
                        'label' => __('Fixed', 'framework'),
                        'src' => ''
                    )
                )
            ),
            array(
                'id' => 'background_size',
                'label' => __('Background size', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'original',
                        'label' => __('Original', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'fit',
                        'label' => __('Fits the container', 'framework'),
                        'src' => ''
                    )
                )
            ),
            array(
                'id' => 'background_video',
                'label' => __('Background video', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Upload',
                'class' => ''
            ),
            array(
                'id' => 'background_video_format',
                'label' => __('Background video format', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'mp4',
                        'label' => __('MP4', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'webm',
                        'label' => __('WebM', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'ogg',
                        'label' => __('OGG', 'framework'),
                        'src' => ''
                    )
                )
            )
        )
    );
    ot_register_meta_box($banner_builder_options_boxes);

    $testimonial_option_boxes = array(
        'id' => 'testimonial_options_boxes',
        'title' => __('Testimonial Options', 'framework'),
        'desc' => '',
        'pages' => array('testimonial'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'id' => 'position',
                'label' => __('Position', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'class' => ''
            ),
            array(
                'id' => 'company',
                'label' => __('Company', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'class' => ''
            ),
			array(
                'id' => 'quote',
                'label' => __('Quote', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'textarea-simple',
                'class' => ''
            ),

        )
    );
    ot_register_meta_box($testimonial_option_boxes);
	
	//Product (woocommerce)
    $product_options_boxes = array(
        'id' => 'product_options_boxes',
        'title' => __('Product Options', 'framework'),
        'desc' => '',
        'pages' => array('product'),
        'context' => 'normal',
        'priority' => 'default',
        'fields' => array(
            array(
                'id' => 'video_url',
                'label' => __('Video URL', 'framework'),
                'desc' => __('YouTube or Vimeo video URL', 'framework'),
                'std' => '',
                'type' => 'Text',
                'class' => 'video',
                'choices' => ''
            ),
			array(
                'id' => 'embedded_video',
                'label' => __('Embadded Video', 'framework'),
                'desc' => __('Please use this option when the video does not come from YouTube or Vimeo', 'framework'),
                'std' => '',
                'type' => 'Textarea_Simple',
                'class' => 'video',
                'choices' => ''
            )
		)
	);
	ot_register_meta_box($product_options_boxes);
	
	//Menu
    $product_options_boxes = array(
        'id' => 'Menu_options_boxes',
        'title' => __('Menu Options', 'framework'),
        'desc' => '',
        'pages' => array('food_menu'),
        'context' => 'normal',
        'priority' => 'default',
        'fields' => array(
			array(
                'id' => 'price',
                'label' => __('Price', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Text',
                'class' => '',
                'choices' => ''
            ),
            array(
                'id' => 'details',
                'label' => __('Details', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Text',
                'class' => '',
                'choices' => ''
            ),
			
		)
	);
	ot_register_meta_box($product_options_boxes);
}

/**
 * Get slider items for theme options
 * @global type $wpdb
 * @return string
 */
function ts_get_slider_items_for_theme_options()
{
    global $wpdb;

    $slider_items[] = array(
        'value' => '',
        'label' => __('Choose', 'framework'),
        'src' => ''
    );
    
    //LayerSlider
    if (function_exists('ts_get_layer_slider_items_for_theme_options')) {
        $a = ts_get_layer_slider_items_for_theme_options();
        if (is_array($a)) {
            foreach ($a as $val) {
                $slider_items[] = $val;
            }
        }
    }

    //Revolution Slider
    if (is_plugin_active('revslider/revslider.php')) {
        $sliders = $wpdb->get_results($q = "
			SELECT
				*
			FROM
				" . $wpdb->prefix . "revslider_sliders
			ORDER BY
				id
			LIMIT
				100");

        // Iterate over the sliders
        foreach ($sliders as $key => $item) {

            $slider_items[] = array(
                'value' => 'revslider-' . $item->alias,
                'label' => 'Revolution Slider - ' . stripslashes($item->title),
                'src' => ''
            );
        }
    }
	
	//Master Slider
    if (is_plugin_active('masterslider/masterslider.php')) {
        $sliders = get_masterslider_names();

        foreach ($sliders as $key => $item) {

            $slider_items[] = array(
                'value' => 'masterslider-' . $key,
                'label' => 'Master Slider - ' . $item,
                'src' => ''
            );
        }
    }

    //Banner builder
    if (function_exists('ts_get_banners_list')) {
        $banners = ts_get_banners_list();
        if ($banners) {
            // Iterate over the sliders
            foreach ($banners as $key => $item) {

                $slider_items[] = array(
                    'value' => 'banner-builder-' . $item['id'],
                    'label' => __('Banner Builder', 'framework') . ' - ' . $item['title'],
                    'src' => ''
                );
            }
        }
    }
    return $slider_items;
}

/**
 * Get percentage meta box select values
 * @return int
 */
function ts_get_percentage_meta_box_select_values()
{
    $a = array();
    for ($i = 1; $i <= 100; $i++) {
        $a[] = array(
            'value' => $i,
            'label' => $i,
            'src' => ''
        );
    }
    return $a;
}

/**
 * Gets post categories for meta box
 * @return type
 */
function ts_get_post_categories() {
	
	$categories = get_terms("category");
	$categories_output = array();
	if ($categories && !is_wp_error($categories)) {
		foreach ($categories as $category) {
			$categories_output[] = array(
				'value' => $category -> term_id,
				'label' => $category -> name,
				'src' => ''
			);
		}
	}
	return $categories_output;
}

/**
 * Gets portfolio categories for meta box
 * @return type
 */
function ts_get_portfolio_categories() {
	
	$categories = get_terms("portfolio-categories");
	$categories_output = array();
	if ($categories && !is_wp_error($categories)) {
		foreach ($categories as $category) {
			$categories_output[] = array(
				'value' => $category -> term_id,
				'label' => $category -> name,
				'src' => ''
			);
		}
	}
	return $categories_output;
}