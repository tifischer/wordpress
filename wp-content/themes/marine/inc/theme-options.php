<?php

/**
 * Theme options
 *
 * @package framework
 * @since framework 1.0
 */
/**
 * Initialize the options before anything else.
 */
add_action('admin_init', 'ts_custom_theme_options', 1);

/**
 * Initalize theme options scripts
 */
add_action('admin_enqueue_scripts', 'ts_framework_theme_options_scripts');

function ts_framework_theme_options_scripts() {

	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_style('jquery-ui-my-theme', get_template_directory_uri() . "/framework/css/jquery-ui/jquery.ui.my-theme.css", false);

	wp_register_script('theme_options', get_template_directory_uri() . '/framework/js/theme-options.js', array('jquery'));
	wp_enqueue_script('theme_options');

	wp_register_script('screwdefaultbuttons', get_template_directory_uri() . '/framework/js/jquery.screwdefaultbuttonsV2.min.js', array('jquery'));
	wp_enqueue_script('screwdefaultbuttons');
}

/**
 * Build the custom settings & update OptionTree.
 */
function ts_custom_theme_options() {
	/**
	 * Get a copy of the saved settings array.
	 */
	$saved_settings = get_option('option_tree_settings', array());

	$user_sidebars = ot_get_option('user_sidebars');
	$sidebar_choices = array();
	$sidebar_choices[] = array(
		'label' => __('Main', 'framework'),
		'value' => 'main',
		'src' => ''
	);
	if (is_array($user_sidebars)) {
		foreach ($user_sidebars as $sidebar) {
			$sidebar_choices[] = array(
				'label' => $sidebar['title'],
				'value' => sanitize_title($sidebar['title']),
				'src' => ''
			);
		}
	}

	/**
	 * Custom settings array that will eventually be
	 * passes to the OptionTree Settings API Class.
	 */
	$custom_settings = array(
		'sections' => array(
			array(
				'id' => 'general_settings',
				'title' => __('General Settings', 'framework')
			),
			array(
				'id' => 'fonts',
				'title' => __('Fonts', 'framework')
			),
			array(
				'id' => 'elements_color',
				'title' => __('Elements Color', 'framework')
			),
			array(
				'id' => 'pages',
				'title' => __('Pages', 'framework')
			),
			array(
				'id' => 'sidebars',
				'title' => __('Sidebars', 'framework')
			),
			array(
				'id' => 'integration',
				'title' => __('Integration', 'framework')
			),
			array(
				'id' => 'social',
				'title' => __('Contacts & Social', 'framework')
			),
			array(
				'id' => 'contact_form',
				'title' => __('Contact Form', 'framework')
			),
			array(
				'id' => 'translations',
				'title' => __('Translations', 'framework')
			)
		),
		//general_settings
		'settings' => array(
			array(
				'id' => 'import_demo',
				'label' => __('Import demo content', 'framework'),
				'desc' => '<a id="ts-import-sample-data" href="'. admin_url('themes.php').'?page=ot-theme-options&import_sample_data=1" class="button-primary" data-warning="'.esc_attr(__(' WARNING: clicking this button will install new posts and replace your current data including theme options, sliders and widgets.', 'framework')).'">'.__('Import sample data', 'framework').'</a>',
				'std' => '',
				'type' => 'textblock-titled',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			
            array(
				'id' => 'body_class',
				'label' => __('Body class', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'w1170',
						'label' => __('Wide 1170px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'w960',
						'label' => __('Wide 960px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'b1170',
						'label' => __('Boxed 1170px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'b960',
						'label' => __('Boxed 960px', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'preloader',
				'label' => __('Preloader', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'disabled',
						'label' => __('Disabled', 'framework'),
						'src' => ''
					),
					array(
						'value' => '1',
						'label' => '1',
						'src' => ''
					),
					array(
						'value' => '2',
						'label' => '2',
						'src' => ''
					),
					array(
						'value' => '3',
						'label' => '3',
						'src' => ''
					),
					array(
						'value' => '4',
						'label' => '4',
						'src' => ''
					),
					array(
						'value' => '5',
						'label' => '5',
						'src' => ''
					),
					array(
						'value' => '6',
						'label' => '6',
						'src' => ''
					),
					array(
						'value' => '7',
						'label' => '7',
						'src' => ''
					),
					array(
						'value' => '8',
						'label' => '8',
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
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'logo_top_margin',
				'label' => __('Logo top margin', 'framework'),
				'desc' => __('Enter number to set the top space of the logo', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'logo_left_margin',
				'label' => __('Logo left margin', 'framework'),
				'desc' => __('Enter number to set the left space of the logo', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'logo_bottom_margin',
				'label' => __('Logo bottom margin', 'framework'),
				'desc' => __('Enter number to set the bottom space of the logo', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'favicon',
				'label' => __('Favicon', 'framework'),
				'desc' => __('Enter Full URL of your favicon image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_color',
				'label' => __('Background color', 'framework'),
				'desc' => __('Enabled only when boxed layout is selected', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_pattern',
				'label' => __('Background pattern', 'framework'),
				'desc' => __('Enabled only when boxed layout is selected', 'framework'),
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_background_patterns()
			),
			array(
				'id' => 'background_image',
				'label' => __('Background image', 'framework'),
				'desc' => __('Choose "Image" option on "Background pattern" list and boxed layout to enable background', 'framework'),
				'std' => '',
				'type' => 'Upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_repeat',
				'label' => __('Background repeat', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'left',
						'label' => __('Left', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'center',
						'label' => __('Center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'right',
						'label' => __('Right', 'framework'),
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
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'original',
						'label' => __('Original', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'browser',
						'label' => __('Fits to browser size', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'default_titlebar_style',
				'label' => __('Default titlebar style', 'framework'),
				'desc' => '',
				'std' => '',
				'section' => 'general_settings',
				'type' => 'Select',
				'class' => '',
				'choices' => array(
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
				'id' => 'default_title_background',
				'label' => __('Default title background', 'framework'),
				'desc' => __('Background image URL', 'framework'),
				'std' => '',
				'type' => 'Upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'default_shop_titlebar_style',
				'label' => __('Default shop titlebar style', 'framework'),
				'desc' => __('Titlebar style for WooCommerce pages', 'framework'),
				'std' => '',
				'section' => 'general_settings',
				'type' => 'Select',
				'class' => '',
				'choices' => array(
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
				'id' => 'default_shop_title_background',
				'label' => __('Default shop title background', 'framework'),
				'desc' => __('Background image URL for WooCommerce shop pages', 'framework'),
				'std' => '',
				'type' => 'Upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'default_title_background_position',
				'label' => __('Title background position', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'position-left-top',
						'label' => __('left top', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'position-left-center',
						'label' => __('left center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'position-left-bottom',
						'label' => __('left bottom', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'position-right-top',
						'label' => __('right top', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'position-right-center',
						'label' => __('right center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'position-right-bottom',
						'label' => __('right bottom', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'position-center-top',
						'label' => __('center top', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'position-center-center',
						'label' => __('center center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'position-center-bottom',
						'label' => __('center bottom', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'default_title_background_size',
				'label' => __('Title background size', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'size-original',
						'label' => __('Original', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'size-cover',
						'label' => __('Scale to the container size', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'header_text',
				'label' => __('Header text', 'framework'),
				'desc' => __('Text displays in the heade, html allowed.', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
            array(
                'id' => 'show_shop_footer',
                'label' => __('Show Shop Footer', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'section' => 'general_settings',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => '',
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
                    ),

                )
            ),
			array(
                'id' => 'show_recent_tweet_footer',
                'label' => __('Show recent tweets in the footer', 'framework'),
                'desc' => __('You need to set Twitter API keys in the Theme Options to make this option work. You can get the API keys here http://dev.twitter.com',
                    'framework'),
                'std' => '',
				'section' => 'general_settings',
                'type' => 'radio',
                'taxonomy' => '',
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
                    )
                )
            ),
			array(
                'id' => 'dont_cache_tweets',
                'label' => __('Don\'t cache tweets', 'framework'),
                'desc' => __('When enabled tweets are not cached. Disable this feature on production server!','framework'),
                'std' => '',
				'section' => 'general_settings',
                'type' => 'radio',
                'taxonomy' => '',
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
                    )
                )
            ),
			array(
				'id' => 'footer_text',
				'label' => __('Footer text', 'framework'),
				'desc' => __('You can add copyright text here.', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_style',
				'label' => __('Footer style', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
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
				'id' => 'sticky_footer',
				'label' => __('Sticky footer', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
					)
				)
			),
			
			array(
				'id' => 'main_menu_style',
				'label' => __('Main menu style', 'framework'),
				'desc' => __('Default menu style', 'framework'),
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_header_styles()
			),
			array(
				'id' => 'shop_menu_style',
				'label' => __('Shop menu style', 'framework'),
				'desc' => __('Default menu style for all shop pages', 'framework'),
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_header_styles()
			),
			array(
				'id' => 'show_preheader',
				'label' => __('Show preheader', 'framework'),
				'desc' => __('Show or hide preheader', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
					)
				)
			),
			array(
				'id' => 'preheader',
				'label' => __('Preheader items', 'framework'),
				'type' => 'list-item',
				'desc' => __('List of user defined preheader items. Please use "save changes" button after you add or edit items.', 'framework'),
				'settings' => array(
					array(
						'id' => 'float',
						'label' => __('Item float', 'framework'),
						'desc' => '',
						'std' => '',
						'type' => 'Select',
						'choices' => array(
							array(
								'value' => 'left',
								'label' => __('Left', 'framework'),
								'src' => ''
							),
							array(
								'value' => 'right',
								'label' => __('Right', 'framework'),
								'src' => ''
							)
						)
					),
//					array(
//						'label' => __('Icon', 'framework'),
//						'id' => 'icon',
//						'type' => 'select',
//						'desc' => '',
//						'std' => '',
//						'type' => 'Select',
//						'choices' => ts_getFontAwesomeArray(true,null,true)
//					),
					array(
						'label' => __('Type', 'framework'),
						'id' => 'type',
						'type' => 'select',
						'desc' => '',
						'std' => '',
						'type' => 'Select',
						'choices' => ts_get_preheader_types()
					),
					array(
						'id' => 'text',
						'label' => __('Text (content for the text type)', 'framework'),
						'desc' => '',
						'std' => '',
						'type' => 'text',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => ''
					)

				),
				'std' => '',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'section' => 'general_settings'
			),
			array(
				'id' => 'show_breadcrumbs',
				'label' => __('Show breadcrumbs', 'framework'),
				'desc' => __('Show or hide breadcrumbs', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
				'id' => 'show_search_nav',
				'label' => __('Show search icon in navigation', 'framework'),
				'desc' => __('Show or hide search form right to the main navigation', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
				'id' => 'retina_support',
				'label' => __('Retina support', 'framework'),
				'desc' => __('If enabled all images should be uploaded 2x larger. Requires more server resources if enabled.', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-off',
				'choices' => array(
					array(
						'value' => 'disabled',
						'label' => __('Disabled', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled',
						'label' => __('Enabled', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'control_panel',
				'label' => __('Show control panel', 'framework'),
				'desc' => __('Shows the Control Panel on your homepage if enabled.', 'framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'disabled',
						'label' => __('Disabled', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled_admin',
						'label' => __('Enabled for administrator', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled_all',
						'label' => __('Enabled for all', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'switch_menu_to_mobile',
				'label' => __('Switch menu to mobile on width (px)', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
            array(
				'id' => 'megamenu_background',
				'label' => __('Mega Menu background', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			//fonts
			array(
				'id' => 'character_sets',
				'label' => __('Additional character sets', 'framework'),
				'desc' => __('Choose the character sets you want to download from Google Fonts','framework'),
				'std' => '',
				'type' => 'checkbox',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'cyrillic',
						'label' => __('Cyrillic', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'cyrillic-ext',
						'label' => __('Cyrillic Extended', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'greek-ext',
						'label' => __('Greek Extended', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'latin-ext',
						'label' => __('Latin Extended', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'vietnamese',
						'label' => __('Vietnamese', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'title_font',
				'label' => __('Title font', 'framework'),
				'desc' => __('Font style for page title','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'title_font_size',
				'label' => __('Title font size', 'framework'),
				'desc' => __('The size of the page title in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'content_font',
				'label' => __('Content font', 'framework'),
				'desc' => __('Font style for content','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'content_font_size',
				'label' => __('Content font size', 'framework'),
				'desc' => __('The size of the page content in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'menu_font',
				'label' => __('Menu font', 'framework'),
				'desc' => __('Font style for menu items', 'framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'menu_font_size',
				'label' => __('Menu font size', 'framework'),
				'desc' => __('The size of the menu elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'headers_font',
				'label' => __('Header font', 'framework'),
				'desc' => __('Font style for all headers (H1, H2 etc.)','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'h1_size',
				'label' => __('H1 font size', 'framework'),
				'desc' => __('The size of H1 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h2_size',
				'label' => __('H2 font size', 'framework'),
				'desc' => __('The size of H2 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h3_size',
				'label' => __('H3 font size', 'framework'),
				'desc' => __('The size of H3 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h4_size',
				'label' => __('H4 font size', 'framework'),
				'desc' => __('The size of H4 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h5_size',
				'label' => __('H5 font size', 'framework'),
				'desc' => __('The size of H5 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h6_size',
				'label' => __('H6 font size', 'framework'),
				'desc' => __('The size of H6 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			//elements_color
			array(
				'id' => 'main_color',
				'label' => __('Main color', 'framework'),
				'desc' => __('Main theme color','framework'),
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
				'id' => 'main_body_background_color',
				'label' => __('Main body background color', 'framework'),
				'desc' => '',
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
				'id' => 'main_body_text_color',
				'label' => __('Main body text color', 'framework'),
				'desc' => __('Main body text color, used for post content.','framework'),
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
				'id' => 'headers_text_color',
				'label' => __('Headers text color', 'framework'),
				'desc' => __('Color of all headers','framework'),
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
				'id' => 'header_background_color',
				'label' => __('Header background color', 'framework'),
				'desc' => '',
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
				'id' => 'page_title_background_color',
				'label' => __('Page title background color', 'framework'),
				'desc' => __('Background color of the page title', 'framework'),
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
				'id' => 'menu_background_color',
				'label' => __('Menu background color', 'framework'),
				'desc' => __('Background color of the menu (works with selected header styles only)', 'framework'),
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
				'id' => 'sub_menu_background_color',
				'label' => __('Sub menu background color', 'framework'),
				'desc' => __('Background color of the sub menu item', 'framework'),
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
				'id' => 'preheader_background_color',
				'label' => __('Preheader background color', 'framework'),
				'desc' => '',
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
				'id' => 'preheader_text_color',
				'label' => __('Preheader text color', 'framework'),
				'desc' => '',
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
				'id' => 'footer_background_color',
				'label' => __('Footer background color', 'framework'),
				'desc' => '',
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
				'id' => 'footer_headers_color',
				'label' => __('Footer headers color', 'framework'),
				'desc' => '',
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
				'id' => 'footer_main_text_color',
				'label' => __('Footer main text color', 'framework'),
				'desc' => '',
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
				'id' => 'copyrights_bar_background',
				'label' => __('Copyrights bar background color', 'framework'),
				'desc' => '',
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
				'id' => 'copyrights_bar_text_color',
				'label' => __('Copyrights bar text color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			//pages
			array(
				'id' => 'show_related_posts_on_blog_single',
				'label' => __('Related posts', 'framework'),
				'desc' => __('Show related posts on a single blog post', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'pages',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
                'id' => 'blog_style',
                'label' => __('Blog style', 'framework'),
                'desc' => '',
                'std' => '',
                'type' => 'Select',
                'section' => 'pages',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'list',
                        'label' => __('List', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'alternate',
                        'label' => __('Alternate', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'grid',
                        'label' => __('Grid', 'framework'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'timeline',
                        'label' => __('Timeline', 'framework'),
                        'src' => ''
                    ),
                )
            ),


			array(
				'id'          => 'portfolio_page',
				'label'       => __('Portfolio page', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'page-select',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id' => 'portfolio_single_style',
				'label' => __('Portfolio single style', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'pages',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'basic',
						'label' => __('Basic', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'extended',
						'label' => __('Extended', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'show_related_projects_on_portfolio_single',
				'label' => __('Related projects', 'framework'),
				'desc' => __('Show related projects on a single portfolio post', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'pages',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
				'id'          => 'portfolio_page_related_projects_header',
				'label'       => __('Portfolio page - related projects header', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => '404_content',
				'label'       => __('404 content', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'textarea',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			//integration
			array(
				'id' => 'google_analytics_id',
				'label' => __('Google Analytics ID', 'framework'),
				'desc' => __('Your Google Analytics ID eg. UA-1xxxxx8-1', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'scripts_header',
				'label' => __('Header scripts', 'framework'),
				'desc' => __('Scripts will be added to the header. Don\'t forget to add &lsaquo;script&rsaquo;;...&lsaquo;/script&rsaquo; tags.', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'scripts_footer',
				'label' => __('Footer scripts', 'framework'),
				'desc' => __('Scripts will be added to the footer. You can use this for Google Analytics etc. Don\'t forget to add &lsaquo;script&rsaquo;...&lsaquo;/script&rsaquo; tags.', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'custom_css',
				'label' => __('Custom CSS', 'framework'),
				'desc' => __('Please add css classes only', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'active_social_items',
				'label' => __('Actived items', 'framework'),
				'desc' => __('Items available on your website', 'framework'),
				'std' => '',
				'type' => 'checkbox',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'twitter',
						'label' => __('Twitter', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'facebook',
						'label' => __('Facebook', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'skype',
						'label' => __('Skype', 'framework'),
						'src' => ''
					),

                    array(
                        'value' => 'google',
                        'label' => __('Google+', 'framework'),
                        'src' => ''
                    ),

					array(
						'value' => 'vimeo',
						'label' => __('vimeo', 'framework'),
						'src' => ''
					),
                    array(
                        'value' => 'linkedin',
                        'label' => __('LinkedIn', 'framework'),
                        'src' => ''
                    ),
					array(
						'value' => 'instagram',
						'label' => __('instagram', 'framework'),
						'src' => ''
					),

				),
			),
			array(
				'id' => 'facebook_url',
				'label' => __('Facebook URL', 'framework'),
				'desc' => __('URL to your Facebook account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_url',
				'label' => __('Twitter URL', 'framework'),
				'desc' => __('URL to your Twitter account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'skype_username',
				'label' => __('Skype username', 'framework'),
				'desc' => __('Your Skype username', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
            array(
                'id' => 'google_plus_url',
                'label' => __('Google+ URL', 'framework'),
                'desc' => __('URL to your Google+ account', 'framework'),
                'std' => '',
                'type' => 'text',
                'section' => 'social',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => ''
            ),
			array(
				'id' => 'vimeo_url',
				'label' => __('Vimeo URL', 'framework'),
				'desc' => __('URL to your Vimeo account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'linkedin_url',
				'label' => __('Linkedin URL', 'framework'),
				'desc' => __('URL to your Linkedin account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'instagram_url',
				'label' => __('Instagram URL', 'framework'),
				'desc' => __('URL to your Instagram account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),

			array(
				'id' => 'twitter_account_recent_tweets',
				'label' => __('Twitter URL', 'framework'),
				'desc' => __('Your Twitter URL to use where tweets are diplayed', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_consumer_key',
				'label' => __('Twitter consumer key', 'framework'),
				'desc' => __("Consumer key from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_consumer_secret',
				'label' => __('Twitter consumer secret', 'framework'),
				'desc' => __("Consumer secret from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_user_token',
				'label' => __('Twitter user token', 'framework'),
				'desc' => __("'User token from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_token_secret',
				'label' => __('Twitter access token secret', 'framework'),
				'desc' => __("'Access token secret from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'contact_form_email',
				'label' => __('Email', 'framework'),
				'desc' => __('Email to receive messages from contact forms', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'contact_form',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'label' => 'Sidebars',
				'id' => 'user_sidebars',
				'type' => 'list-item',
				'desc' => __('List of user defined sidebars. Please use "save changes" button after adding or editing sidebars.', 'framework'),
				'settings' => array(
					array(
						'label' => __('Description', 'framework'),
						'id' => 'user_sidebar_description',
						'type' => 'text',
						'desc' => '',
						'std' => '',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => ''
					)
				),
				'std' => '',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'section' => 'sidebars'
			),
			array(
				'id' => 'enable_translations',
				'label' => __('Enable translations', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Radio',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
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
					)
				)
			)
		)
	);

	//get phrases using Poedit, export them to html and copy only phrases (remove all tabs etc. first)
	$traslate_phrases =
'Contact Form
Our Work
All
Comments
Comment navigation
&larr; Older Comments
Newer Comments &rarr;
Comments are closed.
Leave A Reply Form
Name*
E-mail*
Message
Loading posts
Load More
Sort Portfolio
Loading...
By
404
Oops, This page couldn\'t be found!
Go back home
Search Our Website
Can\'t find what you need? Take a moment and do a search below!
Send Message
Clear
is required
Email is invalid
Message Sent
An Error occured.
Please fill all required fields.
Please check your email.
Email sent. Thank you for contacting us
Server error. Pease try again later.
Now:
Slider
Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.
Pages:
No Tweets to show
Page %s
Your browser does not support the audio element.
No comments
1 comment
% comments
Work by
Search here..
Menu
Posts Tagged \"%s\"
Posts by %s
404 Page Not Found
Shop
Home
Archive by Category \"%s\"
Search Results for \"%s\" Query
Login
ITEMS(S)
Cart is empty
View Cart
Checkout
Language
RECENTLY VIEWED
Clear All
Save for later
Your comment is awaiting moderation.
&laquo; Previous
Next &raquo;
About %s
Displays the most recent portfolio items.
Recent Works
Title:
Number of posts to show:
Shows choosen WordPress pages
Side Navi
Sort by:
Page title
Page order
Page ID
Include:
Page IDs, separated by commas.
Displays the most latest posts.
Latest Posts
Social Media Icons
Facebook:
Twitter:
Skype:
Google+:
Vimeo:
Linkdin:
Instagram:
Your site&#8217;s most recent comments.
Alternative Recent Comments
Recent Comments
on
Title with button widget
Line 1:
Line 2:
Button text:
URL:
Popular
Recent
BY
Contact Info
Address:
Phone:
Fax:
E-mail:
Email:
Show social links
Twitter + RSS
Followers
Subscribe
to RSS Feed
Read more
Send message
Related Projects
Learn more
There are no reviews yet.
Add a review
Be the first to review
Leave a Reply to %s
Name
Email
Submit
Your Rating
Rate&hellip;
Perfect
Good
Average
Not that bad
Very Poor
Your Review
Only logged in customers who have purchased this product may leave a review.
Details
Sale!
SKU:
N/A
Zoom
Video
You may also like&hellip;
Rated %d out of 5
out of 5
Your comment is awaiting approval
verified owner
Related Products
Clear selection
This product is currently out of stock and unavailable.
UNFORTUNATELY, YOUR SHOPPING BAG IS EMPTY
Back to store
Item
Description
Product Code
Unit Price
Quantity
Subtotal
Available on backorder
Remove this item
Coupon
Coupon code
Apply Coupon
Update Cart
Continue Shopping
Cart Subtotal
Order Total
(taxes estimated for %s)
Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.
Shipping #%d
Shipping and Handling
Please use the shipping calculator to see available shipping methods.
Please continue to the checkout and enter your full address to see if there are any available shipping methods.
Please fill in your details to see available shipping methods.
There doesn&lsquo;t seem to be any available shipping methods. Please double check your address, or contact us if you need any help.
Shipping
Estimate Shipping
Select a country&hellip;
State / county
Select a state&hellip;
City
Postcode / Zip
Update Totals
Showing all %d results
Sort by
Default sorting
Sort by popularity
Sort by average rating
Sort by newness
Sort by price: low to high
Sort by price: high to low
Previous
View Page %d of %d
Next
Products tagged &ldquo;
Search results for &ldquo;
Back to %s
Error 404
Posts tagged &ldquo;
Author:
Page';

	$to_translate = explode("\n",$traslate_phrases);

	if (is_array($to_translate)) {
		foreach ($to_translate as $item) {
			$item = trim($item);
			$custom_settings['settings'][] = array(
				'id' => 'translator_'.  sanitize_title($item),
				'label' => $item,
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'default' => $item
			);
		}
	}

	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters('option_tree_settings_args', $custom_settings);

	/* settings are not the same update the DB */
	if ($saved_settings !== $custom_settings) {
		update_option('option_tree_settings', $custom_settings);
	}
}

/**
 * Get font choices for theme options
 * @param bool $return_string if true returned array is strict, example array item: font_name => font_label
 * @return array
 */
function ts_get_font_choices($return_strict = false) {
	$aFonts = array(
		array(
			'value' => 'default',
			'label' => __('Default', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'Verdana',
			'label' => 'Verdana',
			'src' => ''
		),
		array(
			'value' => 'Geneva',
			'label' => 'Geneva',
			'src' => ''
		),
		array(
			'value' => 'Arial',
			'label' => 'Arial',
			'src' => ''
		),
		array(
			'value' => 'Arial Black',
			'label' => 'Arial Black',
			'src' => ''
		),
		array(
			'value' => 'Trebuchet MS',
			'label' => 'Trebuchet MS',
			'src' => ''
		),
		array(
			'value' => 'Helvetica',
			'label' => 'Helvetica',
			'src' => ''
		),
		array(
			'value' => 'sans-serif',
			'label' => 'sans-serif',
			'src' => ''
		),
		array(
			'value' => 'Georgia',
			'label' => 'Georgia',
			'src' => ''
		),
		array(
			'value' => 'Times New Roman',
			'label' => 'Times New Roman',
			'src' => ''
		),
		array(
			'value' => 'Times',
			'label' => 'Times',
			'src' => ''
		),
		array(
			'value' => 'serif',
			'label' => 'serif',
			'src' => ''
		),
		array(
			'value' => 'Nella Sue',
			'label' => 'Nella Sue',
			'src' => ''
		)
	);

	if (file_exists(get_template_directory() . '/framework/fonts/google-fonts.json')) {

		//ts_load_filesystem();
		//WP_Filesystem();
		//global $wp_filesystem;

		//$google_fonts = $wp_filesystem->get_contents(get_template_directory() . '/framework/fonts/google-fonts.json');
		$google_fonts = file_get_contents(get_template_directory() . '/framework/fonts/google-fonts.json', true);
		$aGoogleFonts = json_decode($google_fonts, true);

		if (!isset($aGoogleFonts['items']) || !is_array($aGoogleFonts['items'])) {
			continue;
		}

		$aFonts[] = array(
			'value' => 'google_web_fonts',
			'label' => '---Google Web Fonts---',
			'src' => ''
		);

		foreach ($aGoogleFonts['items'] as $aGoogleFont) {
			$aFonts[] = array(
				'value' => 'google_web_font_' . $aGoogleFont['family'],
				'label' => $aGoogleFont['family'],
				'src' => ''
			);
		}
	}

	if ($return_strict) {
		$aFonts2 = array();
		foreach ($aFonts as $font) {
			$aFonts2[$font['value']] = $font['label'];
		}
		return $aFonts2;
	}
	return $aFonts;
}

/**
 * Get background patterns
 * @param bool $control_panel if true return array for control panel (front end)
 * @return type
 */
function ts_get_background_patterns($control_panel = false)
{
	$patterns = array();


	if ($control_panel === false)
	{
		$patterns[] = array(
			'value' => 'none',
			'label' => __('None', 'framework'),
			'src' => ''
		);

		$patterns[] = array(
			'value' => 'image',
			'label' => __('Image (choose below)', 'framework'),
			'src' => ''
		);
	}

	$patterns[] = array(
		'value' => 'cartographer.png',
		'label' => __('Cartographer', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'concrete_wall.png',
		'label' => __('Concrete Wall', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'dark_wall.png',
		'label' => __('Dark Wall', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'dark_wood.png',
		'label' => __('Dark Wood', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'irongrip.png',
		'label' => __('Irongrip', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'purty_wood.png',
		'label' => __('Purty Wood', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'px_by_Gre3g.png',
		'label' => __('PX', 'framework'),
		'src' => ''
	);
	return $patterns;
}

/**
 * Get menu background transparency values
 * @return int
 */
function ts_get_menu_background_transparency_values()
{
	$values = array();
	for ($i = 0; $i <= 100; $i ++)
	{
		$v = $i;
		$v = 100 - $i;
		if ($v == 100)
		{
			$v = 1;
		}
		else
		{
			if ($v < 10)
			{
				$v = '0'.$v;
			}
			$v = '0.'.$v;
		}
		$values[] = array(
			'value' => $v,
			'label' => $i.'%',
			'src' => ''
		);
	}
	return $values;
}

/**
 * Get preheader types
 * @return array
 */
function ts_get_preheader_types() {
	
	$preheader_items = array(
		array(
			'value' => 'text',
			'label' => __('Text', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'date',
			'label' => __('Date', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'language',
			'label' => __('Language (WPML)', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'cart',
			'label' => __('Cart (WooCommerce)', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'login',
			'label' => __('Login', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'social_icons',
			'label' => __('Social icons', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'search_icon',
			'label' => __('Search icon', 'framework'),
			'src' => ''
		)
	);
	
	$menus = ts_get_user_defined_menus();
	
	if (is_array($menus) && count($menus) > 0) {
		foreach ($menus as $key => $menu) {
			$preheader_items[] = array(
				'value' => 'menu_'.$key,
				'label' => __('Menu', 'framework').' - '.$menu,
				'src' => ''
			);
		}
	}
	return $preheader_items;
}