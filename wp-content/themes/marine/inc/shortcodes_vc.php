<?php
/**
 * Shortcodes Visual Composer integration
 *
 * @package framework
 * @since framework 1.0
 */

add_action( 'init', 'ts_integrateWithVC' );

function ts_integrateWithVC() {
	
	if (!function_exists('vc_map')) {
		return;
	}

	/**
	 * Accordion
	 */
	vc_map(
		array(
			"name" => __("Accordion (theme)", "framework"),
			"base" => "accordion",
			"as_parent" => array('only' => 'accordion_toggle'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings(),
				array(
					"type" => "checkbox",
					"heading" => __("Default Open", "framework"),
					"param_name" => "open",
					"value" => array("Set default position to open" => "yes"),
					"description" => __("Check if you want to set the default open state for this accordion.", "framework")
				)
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_accordion extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Accordion Toggle", "framework"),
			"base" => "accordion_toggle",
			"content_element" => true,
			"as_child" => array('only' => 'accordion'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Accordion Title", "framework"),
					"param_name" => "title",
					"description" => __("Enter title for this toggle.", "framework")
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => __( 'Toggle Content', 'framework' ),
					'param_name' => 'content',
					'value' => ''
				),
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_accordion_toggle extends WPBakeryShortCode {
		}
	}
	
	/**
	 * alert
	 */
	vc_map( 
		array(
			'name' => __('Alert', 'framework'),
			'base' => 'alert',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'framework' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
                        __('Info', 'framework') => 'info',
                        __('Error', 'framework') => 'error',
                        __('Notice', 'framework') => 'notice',
                        __('Success', 'framework') => 'success'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Close button', 'framework' ),
					'param_name' => 'close_btn',
					'admin_label' => true,
					'value' => array(
                        __('yes', 'framework') => 'yes',
                        __('no', 'framework') => 'no'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Message', 'framework' ),
					'param_name' => 'message',
					'admin_label' => true,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * blockquote
	 */
	vc_map( 
		array(
			'name' => __('Blockquote', 'framework'),
			'base' => 'blockquote',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Author', 'framework' ),
					'param_name' => 'author',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * blog_timeline
	 */
	vc_map( 
		array(
			'name' => __('Blog Timeline', 'framework'),
			'base' => 'blog_timeline',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Posts per page', 'framework' ),
					'param_name' => 'posts_per_page',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Load More Label', 'framework' ),
					'param_name' => 'load_more',
					'admin_label' => true,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * banner
	 */
	vc_map( 
		array(
			'name' => __('Banner', 'framework'),
			'base' => 'banner',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'framework' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
						'1' => '1',
                        '2' => '2'
                    ),
					'description' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'framework' ),
					'param_name' => 'image',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Subtitle', 'framework' ),
					'param_name' => 'subtitle',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text (no button if empty)', 'framework' ),
					'param_name' => 'button_text',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * button
	 */	
	vc_map( 
		array(
			'name' => __('Button', 'framework'),
			'base' => 'button',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Variant', 'framework' ),
					'param_name' => 'variant',
					'admin_label' => true,
					'value' => array(
						'1' => '1',
						'2' => '2'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'framework' ),
					'param_name' => 'background',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'framework' ),
					'param_name' => 'size',
					'admin_label' => true,
					'value' => array(
						__('Small', 'framework') => 'small',
						__('Large', 'framework') => 'large'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text', 'framework' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * button
	 */	
	vc_map( 
		array(
			'name' => __('Button', 'framework'),
			'base' => 'button',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Variant', 'framework' ),
					'param_name' => 'variant',
					'admin_label' => true,
					'value' => array(
						'1' => '1',
						'2' => '2'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'framework' ),
					'param_name' => 'background',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'framework' ),
					'param_name' => 'size',
					'admin_label' => true,
					'value' => array(
						__('Small', 'framework') => 'small',
						__('Large', 'framework') => 'large'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text', 'framework' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * button_view
	 */	
	vc_map( 
		array(
			'name' => __('Button View', 'framework'),
			'base' => 'button_view',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Size', 'framework' ),
					'param_name' => 'size',
					'admin_label' => true,
					'value' => array(
						__('Black', 'framework') => 'black',
						__('White', 'framework') => 'white'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Text', 'framework' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * call_to_action
	 */
	vc_map( 
		array(
			'name' => __('Call To Action', 'framework'),
			'base' => 'call_to_action',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Transparent background', 'framework' ),
					'param_name' => 'transparent_background',
					'admin_label' => true,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes'
                    ),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'framework' ),
					'param_name' => 'background_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'framework' ),
					'param_name' => 'text_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Button background', 'framework' ),
					'param_name' => 'button_bg',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Button color', 'framework' ),
					'param_name' => 'button_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'admin_label' => true,
					'value' => ts_getFontAwesomeArray(),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Border color', 'framework' ),
					'param_name' => 'border_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button label', 'framework' ),
					'param_name' => 'button_text',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Padding top', 'framework' ),
					'param_name' => 'padding_top',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Padding bottom', 'framework' ),
					'param_name' => 'padding_bottom',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Margin bottom', 'framework' ),
					'param_name' => 'margin_bottom',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'First element on page', 'framework' ),
					'param_name' => 'first_page',
					'admin_label' => false,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes',
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Last element on page', 'framework' ),
					'param_name' => 'last_page',
					'admin_label' => false,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes',
                    ),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * col_offset
	 */
	vc_map( 
		array(
			'name' => __('Column With Offset', 'framework'),
			'base' => 'col_offset',
			'class' => '',
			'category' => __('Structure', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Columns', 'framework' ),
					'param_name' => 'cols',
					'admin_label' => true,
					'value' => array(
						'Col 1' => '1',
						'Col 2' => '2',
						'Col 3' => '3',
						'Col 4' => '4',
						'Col 5' => '5',
						'Col 6' => '6',
						'Col 7' => '7',
						'Col 8' => '8',
						'Col 9' => '9',
						'Col 10' => '10',
						'Col 11' => '11',
						'Col 12' => '12'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Columns offset', 'framework' ),
					'param_name' => 'offset',
					'admin_label' => true,
					'value' => array(
						'Col Offset 1' => '1',
						'Col Offset 2' => '2',
						'Col Offset 3' => '3',
						'Col Offset 4' => '4',
						'Col Offset 5' => '5',
						'Col Offset 6' => '6',
						'Col Offset 7' => '7',
						'Col Offset 8' => '8',
						'Col Offset 9' => '9',
						'Col Offset 10' => '10',
						'Col Offset 11' => '11',
						'Col Offset 12' => '12'
                    ),
					'description' => ''
				),
			)
		)
	);
	
	/**
	 * contact_form
	 */
	vc_map( 
		array(
			'name' => __('Contact Form', 'framework'),
			'base' => 'contact_form',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Name Field Label', 'framework' ),
					'param_name' => 'name_label',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon for Name Field', 'framework' ),
					'param_name' => 'name_icon',
					'admin_label' => false,
					'value' => ts_getFontAwesomeArray(),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Email Field Label', 'framework' ),
					'param_name' => 'email_label',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon for Email Field', 'framework' ),
					'param_name' => 'email_icon',
					'admin_label' => false,
					'value' => ts_getFontAwesomeArray(),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Message Field Label', 'framework' ),
					'param_name' => 'message_label',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Send Button Label', 'framework' ),
					'param_name' => 'send_label',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Clear Button Label', 'framework' ),
					'param_name' => 'clear_label',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Skin', 'framework' ),
					'param_name' => 'skin',
					'admin_label' => true,
					'value' => array(
						'1' => '1',
						'2' => '2'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Button alignment', 'framework' ),
					'param_name' => 'button_align',
					'admin_label' => true,
					'value' => array(
						__('Left', 'framework') => 'left',
						__('Right', 'framework') => 'right',
						__('Center', 'framework') => 'center'
                    ),
					'description' => ''
				),
			)
		)
	);
	
	/**
	 * content_box
	 */
	vc_map( 
		array(
			'name' => __('Content Box', 'framework'),
			'base' => 'content_box',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'framework' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array(
						__('Style 1', 'framework') => 'style1',
						__('Style 2', 'framework') => 'style2',
						__('Style 3', 'framework') => 'style3'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'admin_label' => false,
					'value' => ts_getFontAwesomeArray(),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon color', 'framework' ),
					'param_name' => 'icon_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon background color', 'framework' ),
					'param_name' => 'icon_bg',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Title color', 'framework' ),
					'param_name' => 'title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'framework' ),
					'param_name' => 'text_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
			)
		)
	);
	
	/**
	 * counter
	 */
	vc_map( 
		array(
			'name' => __('Counter', 'framework'),
			'base' => 'counter',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Quantity', 'framework' ),
					'param_name' => 'quantity',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Foreground color', 'framework' ),
					'param_name' => 'fgcolor',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'framework' ),
					'param_name' => 'bgcolor',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'framework' ),
					'param_name' => 'textcolor',
					'admin_label' => false,
					'description' => ''
				),
			)
		)
	);
	
	/**
	 * test
	 */
	vc_map( 
		array(
			'name' => __('Divider', 'framework'),
			'base' => 'divider',
			'class' => '',
			'category' => __('Structure', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * dropcaps
	 */
	vc_map( 
		array(
			'name' => __('Dropcaps', 'framework'),
			'base' => 'dropcaps',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'framework' ),
					'param_name' => 'background',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * heading
	 */
	vc_map( 
		array(
			'name' => __('Heading', 'framework'),
			'base' => 'heading',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Type', 'framework' ),
					'param_name' => 'type',
					'admin_label' => true,
					'value' => array(
						'H1' => '1',
						'H2' => '2',
						'H3' => '3',
						'H4' => '4',
						'H5' => '5'
                    ),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Align', 'framework' ),
					'param_name' => 'align',
					'admin_label' => true,
					'value' => array(
						__('Left (default)') => 'left',
						__('Center') => 'center',
						__('Right') => 'right'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * featured_projects
	 */
	vc_map( 
		array(
			'name' => __('Featured projects', 'framework'),
			'base' => 'featured_projects',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Full Width', 'framework' ),
					'param_name' => 'full',
					'admin_label' => true,
					'value' => array(
						__('Yes', 'framework') => 'yes',
						__('No', 'framework') => 'no'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Category ID', 'framework' ),
					'param_name' => 'category',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * featured_projects_2
	 */
	vc_map( 
		array(
			'name' => __('Featured projects 2', 'framework'),
			'base' => 'featured_projects_2',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category filter', 'framework' ),
					'param_name' => 'category_filter',
					'admin_label' => true,
					'value' => array(
						__('Yes', 'framework') => 'yes',
						__('No', 'framework') => 'no'
                    ),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter color', 'framework' ),
					'param_name' => 'category_filter_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter background color', 'framework' ),
					'param_name' => 'category_filter_background',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter border color', 'framework' ),
					'param_name' => 'category_filter_border',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Category ID', 'framework' ),
					'param_name' => 'category',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Title color', 'framework' ),
					'param_name' => 'title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Subtitle', 'framework' ),
					'param_name' => 'subtitle',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Subtitle color', 'framework' ),
					'param_name' => 'subtitle_color',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * featured_projects_3
	 */
	vc_map( 
		array(
			'name' => __('Featured projects 3', 'framework'),
			'base' => 'featured_projects_3',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category filter', 'framework' ),
					'param_name' => 'category_filter',
					'admin_label' => true,
					'value' => array(
						__('Yes', 'framework') => 'yes',
						__('No', 'framework') => 'no'
                    ),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter color', 'framework' ),
					'param_name' => 'category_filter_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter background color', 'framework' ),
					'param_name' => 'category_filter_background',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter border color', 'framework' ),
					'param_name' => 'category_filter_border',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Category ID', 'framework' ),
					'param_name' => 'category',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Title color', 'framework' ),
					'param_name' => 'title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Subtitle', 'framework' ),
					'param_name' => 'subtitle',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Subtitle color', 'framework' ),
					'param_name' => 'subtitle_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Items per row', 'framework' ),
					'param_name' => 'items_per_row',
					'admin_label' => false,
					'value' => array(
                        '3' => '3',
                        '4' => '4',
                        '5' => '5'
                    ),
					'description' => ''
				),
			)
		)
	);
	
	/**
	 * featured_projects_4
	 */
	vc_map( 
		array(
			'name' => __('Featured projects 4', 'framework'),
			'base' => 'featured_projects_4',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category filter', 'framework' ),
					'param_name' => 'category_filter',
					'admin_label' => true,
					'value' => array(
						__('Yes', 'framework') => 'yes',
						__('No', 'framework') => 'no'
                    ),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter color', 'framework' ),
					'param_name' => 'category_filter_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter background color', 'framework' ),
					'param_name' => 'category_filter_background',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Category filter border color', 'framework' ),
					'param_name' => 'category_filter_border',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Category ID', 'framework' ),
					'param_name' => 'category',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Hover color', 'framework' ),
					'param_name' => 'hover_color',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * food_menu
	 */
	vc_map( 
		array(
			'name' => __('Food menu slider', 'framework'),
			'base' => 'food_menu',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => __('Title will be added to category name. Example of use: "Our %s" where %s will be replace with category name', 'framework')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Title color', 'framework' ),
					'param_name' => 'title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Title font', 'framework' ),
					'param_name' => 'title_font',
					'admin_label' => false,
					'value' => array_flip(ts_get_font_choices(true)),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * food_menu
	 */
	vc_map( 
		array(
			'name' => __('Food menu slider 2', 'framework'),
			'base' => 'food_menu_2',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => __('Title will be added to the category name. Example of use: "Our %s" where %s will be replace with category name', 'framework')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Title color', 'framework' ),
					'param_name' => 'title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Title font', 'framework' ),
					'param_name' => 'title_font',
					'admin_label' => false,
					'value' => array_flip(ts_get_font_choices(true)),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Subtitle color', 'framework' ),
					'param_name' => 'subtitle_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * form
	 */
	vc_map(
		array(
			"name" => __("Form", "framework"),
			"base" => "form",
			"as_parent" => array('only' => 'field'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Skin', 'framework' ),
					'param_name' => 'skin',
					'admin_label' => false,
					'value' => array(
                        '1' => '1',
                        '2' => '2'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Success message', 'framework' ),
					'param_name' => 'success_message',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Send button text', 'framework' ),
					'param_name' => 'send_button',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Clear button text', 'framework' ),
					'param_name' => 'clear_button',
					'admin_label' => false,
					'description' => ''
				),
				
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_form extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Field", "framework"),
			"base" => "field",
			"content_element" => true,
			"as_child" => array('only' => 'form'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Name", "framework"),
					"param_name" => "name",
					'admin_label' => true,
					"description" => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Type', 'framework' ),
					'param_name' => 'type',
					'admin_label' => false,
					'value' => array_flip(array(
						'text' => __('Text','framework'),
						'textarea' => __('Textarea','framework'),
						'email' => __('Email','framework'),
					)),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Required', 'framework' ),
					'param_name' => 'required',
					'admin_label' => false,
					'value' => array_flip(array(
							'no' => __('No','framework'),
							'yes' => __('Yes','framework')
						)),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'admin_label' => false,
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'value' => ts_getFontAwesomeArray(),
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_field extends WPBakeryShortCode {
		}
	}
	
	/**
	 * highlight
	 */
	vc_map( 
		array(
			'name' => __('Highlight', 'framework'),
			'base' => 'highlight',
			'class' => '',
			//"as_parent" => array('except' => 'highlight,vc_row,vc_row_inner'),
			//"content_element" => true,
			'category' => __('Structure', 'framework'),
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Border color', 'framework' ),
					'param_name' => 'border_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Background image', 'framework' ),
					'param_name' => 'background_image',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Background attachment', 'framework' ),
					'param_name' => 'background_attachment',
					'admin_label' => false,
					'value' => array(
						__('Scroll', 'framework') => 'scroll',
						__('Fixed', 'framework') => 'fixed'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Background position', 'framework' ),
					'param_name' => 'background_position',
					'admin_label' => false,
					'value' => array(
						__('left top', 'framework') => 'left top', 
                        __('left center', 'framework') => 'left center',
                        __('left bottom', 'framework') => 'left bottom',
                        __('right top', 'framework') => 'right top',
                        __('right center', 'framework') => 'right center',
                        __('right bottom', 'framework') =>  'right bottom',
                        __('center top', 'framework') => 'center top', 
                        __('center center', 'framework') => 'center center', 
                        __('center bottom', 'framework') => 'center bottom'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Background stretch', 'framework' ),
					'param_name' => 'background_stretch',
					'admin_label' => false,
					'value' => array(
						__('Yes', 'framework') => 'yes',
						__('No', 'framework') => 'no'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Background video URL', 'framework' ),
					'param_name' => 'background_video',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Background video format', 'framework' ),
					'param_name' => 'background_video_format',
					'admin_label' => false,
					'value' => array(
						__('MP4', 'framework') => 'mp4',
						__('WebM', 'framework') => 'webm',
						__('Ogg', 'framework') => 'ogg'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Background pattern', 'framework' ),
					'param_name' => 'background_pattern',
					'admin_label' => false,
					'value' => array(
						__('No pattern', 'framework') => 'no',
						__('Grid', 'framework') => 'grid'
                    ),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Background pattern color', 'framework' ),
					'param_name' => 'background_pattern_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Background pattern color transparency (%)', 'framework' ),
					'param_name' => 'background_pattern_color_transparency',
					'admin_label' => false,
					'value' => ts_get_percentage_select_values(true),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Minimum height (px)', 'framework' ),
					'param_name' => 'min_height',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'First element on page', 'framework' ),
					'param_name' => 'first_page',
					'admin_label' => false,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes',
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Last element on page', 'framework' ),
					'param_name' => 'last_page',
					'admin_label' => false,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes',
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Padding top', 'framework' ),
					'param_name' => 'padding_top',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Padding bottom', 'framework' ),
					'param_name' => 'padding_bottom',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Margin bottom', 'framework' ),
					'param_name' => 'margin_bottom',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Fullwidth', 'framework' ),
					'param_name' => 'fullwidth',
					'admin_label' => false,
					'value' => array(
						__('Yes', 'framework') => 'yes',
						__('No', 'framework') => 'no'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
			),
			//"js_view" => 'VcColumnView'
		)
	);
	
	/**
	 * Icon
	 */
	vc_map( 
		array(
			'name' => __('Icon', 'framework'),
			'base' => 'icon',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'heading' => __( 'Icon (choose or upload below)', 'framework' ),
					'param_name' => 'icon',
					'value' => ts_getFontAwesomeArray()
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Upload icon', 'framework' ),
					'param_name' => 'icon_upload',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon color', 'framework' ),
					'param_name' => 'icon_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'text',
					'heading' => __( 'Title font size (px)', 'framework' ),
					'param_name' => 'title_size',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Title font weight', 'framework' ),
					'param_name' => 'size',
					'admin_label' => false,
					'value' => array_flip(array(
						'default' => __('Default', 'framework'),
                        'normal' => __('Normal', 'framework'),
                        'bold' => __('Bold', 'framework'),
                        'bolder' => __('Bolder', 'framework'),
                        '300' => __('Light', 'framework')
                    )),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Title color', 'framework' ),
					'param_name' => 'title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'text',
					'heading' => __( 'Content font size (px)', 'framework' ),
					'param_name' => 'content_size',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Content color', 'framework' ),
					'param_name' => 'content_color',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * icon_list
	 */
	vc_map(
		array(
			"name" => __("Icon List", "framework"),
			"base" => "icon_list",
			"as_parent" => array('only' => 'icon_list_item'),
			"content_element" => true,
			'params' => array(
				ts_get_vc_animation_effects_settings()
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_icon_list extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Icon List Item", "framework"),
			"base" => "icon_list_item",
			"content_element" => true,
			"as_child" => array('only' => 'accordion'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Icon Type", "js_composer"),
					"param_name" => "icon_type",
					"value" => array(__("Font Icon", 'framework') => "icon", __("Image", 'framework') => "image"),
					"description" => __("Select the icon type you want to use", "framework")
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'heading' => __( 'Icon (choose or upload below)', 'framework' ),
					'param_name' => 'icon',
					'value' => ts_getFontAwesomeArray(),
					'dependency' => Array('element' => 'icon_type', 'value' => array('icon')),
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Upload icon', 'framework' ),
					'param_name' => 'icon_upload',
					'admin_label' => false,
					'description' => '',
					'dependency' => Array('element' => 'icon_type', 'value' => array('image')),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Icon color', 'framework' ),
					'param_name' => 'icon_color',
					'admin_label' => false,
					'description' => '',
					'dependency' => Array('element' => 'icon_type', 'value' => array('icon')),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Title color', 'framework' ),
					'param_name' => 'title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Content color', 'framework' ),
					'param_name' => 'content_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Border color', 'framework' ),
					'param_name' => 'border_color',
					'admin_label' => false,
					'description' => ''
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_icon_list_item extends WPBakeryShortCode {
		}
	}
	
	/**
	 * image
	 */
	vc_map( 
		array(
			'name' => __('Image', 'framework'),
			'base' => 'image',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Image width', 'framework' ),
					'param_name' => 'size',
					'admin_label' => true,
					'value' => array_flip(array(
						'dont_scale' => __('dont scale', 'framework'),
                        'full' => __('full', 'framework'),
                        'half' => __('half', 'framework'),
                        'one_third' => __('1/3', 'framework'),
                        'one_fourth' => __('1/4', 'framework'))
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * info_box
	 */
	vc_map( 
		array(
			'name' => __('Info Box', 'framework'),
			'base' => 'info_box',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Box title', 'framework' ),
					'param_name' => 'box_title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Box subtitle', 'framework' ),
					'param_name' => 'box_subtitle',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Box background color', 'framework' ),
					'param_name' => 'box_bg',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'framework' ),
					'param_name' => 'text_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button text', 'framework' ),
					'param_name' => 'button_text',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Button background', 'framework' ),
					'param_name' => 'button_bg',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Button color', 'framework' ),
					'param_name' => 'button_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * test
	 */
	vc_map( 
		array(
			'name' => __('Latest works', 'framework'),
			'base' => 'latest_works',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Category ID', 'framework' ),
					'param_name' => 'category',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * list - TODO
	 */
	
	vc_map( 
		array(
			'name' => __('List', 'framework'),
			'base' => 'list',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Text', 'framework' ),
					'param_name' => 'text',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * logos
	 */
	vc_map(
		array(
			"name" => __("Logos", "framework"),
			"base" => "logos",
			"as_parent" => array('only' => 'logos_item'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings()
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_logos extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Logos Item", "framework"),
			"base" => "logos_item",
			"content_element" => true,
			"as_child" => array('only' => 'logos'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "framework"),
					"param_name" => "title",
					'admin_label' => true,
					"description" => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'framework' ),
					'param_name' => 'image',
					'admin_label' => false,
					'description' => ''
				),
				array(
					"type" => "textfield",
					"heading" => __("URL", "framework"),
					"param_name" => "url",
					"description" => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_logos_item extends WPBakeryShortCode {
		}
	}
	
	/**
	 * map_container
	 */
	vc_map( 
		array(
			'name' => __('Map container', 'framework'),
			'base' => 'map_container',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Address', 'framework' ),
					'param_name' => 'address',
					'admin_label' => true,
					'description' => __('Leave empty if you want to use Google Maps plugin', 'framework'),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Zoom', 'framework' ),
					'param_name' => 'zoom',
					'admin_label' => true,
					'description' => __('Zoom level, default: 14', 'framework')
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Custom marker', 'framework' ),
					'param_name' => 'custom_marker',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Fullwidth', 'framework' ),
					'param_name' => 'fullwidth',
					'admin_label' => true,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes'
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Grayscale', 'framework' ),
					'param_name' => 'grayscale',
					'admin_label' => true,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes'
                    ),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Height', 'framework' ),
					'param_name' => 'height',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Marker offset', 'framework' ),
					'param_name' => 'marker_offset',
					'admin_label' => false,
					'description' => __('Moves marker to the top (px)', 'framework')
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'First element on page', 'framework' ),
					'param_name' => 'first_page',
					'admin_label' => false,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes',
                    ),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Last element on page', 'framework' ),
					'param_name' => 'last_page',
					'admin_label' => false,
					'value' => array(
						__('No', 'framework') => 'no',
						__('Yes', 'framework') => 'yes',
                    ),
					'description' => ''
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Map", "framework"),
					"param_name" => "content",
					"description" => ''
				)
			)
		)
	);
	
	/**
	 * multi_posts
	 */
	vc_map( 
		array(
			'name' => __('Multi posts', 'framework'),
			'base' => 'multi_posts',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'limit',
					'admin_label' => true,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * person
	 */
	vc_map( 
		array(
			'name' => __('Person', 'framework'),
			'base' => 'person',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Person ID', 'framework' ),
					'param_name' => 'id',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'framework' ),
					'param_name' => 'style',
					'admin_label' => true,
					'value' => array_flip(array(
                        'style1' => __('Style 1', 'framework'),
                        'style2' => __('Style 2', 'framework'),
                    )),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Title color', 'framework' ),
					'param_name' => 'title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Subtitle color', 'framework' ),
					'param_name' => 'sub_title_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'framework' ),
					'param_name' => 'text_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Divider color', 'framework' ),
					'param_name' => 'divider_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Social icons color', 'framework' ),
					'param_name' => 'icon_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'texfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'link',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * person_slide
	 */
	vc_map(
		array(
			"name" => __("Person slider", "framework"),
			"base" => "person_slider",
			"as_parent" => array('only' => 'person_slide'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings(),
				array(
					"type" => "textfield",
					"heading" => __("Title", "framework"),
					"param_name" => "title",
					"description" => ""
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Title first word color", "framework"),
					"param_name" => "title_first_word_color",
					"description" => ''
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Title color", "framework"),
					"param_name" => "title_color",
					"description" => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Title font', 'framework' ),
					'param_name' => 'title_font',
					'admin_label' => false,
					'value' => array_flip(ts_get_font_choices(true)),
					'description' => ''
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Background color", "framework"),
					"param_name" => "background_color",
					"description" => ''
				)
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	vc_map( 
		array(
			"name" => __("Person slide", "framework"),
			"base" => "person_slide",
			"content_element" => true,
			"as_child" => array('only' => 'person_slider'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("ID", "framework"),
					"param_name" => "id",
					"description" => __("Enter team member ID for this slide", "framework")
				),
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'framework' ),
					'param_name' => 'image',
					'admin_label' => false,
					'description' => ''
				),
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_person_slider extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_person_slide extends WPBakeryShortCode {
		}
	}
	
	/**
	 * pricing_table
	 */
	vc_map(
		array(
			"name" => __("Pricing Table", "framework"),
			"base" => "pricing_table",
			"as_parent" => array('only' => 'pricing_table_column'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'framework' ),
					'param_name' => 'style',
					'admin_label' => false,
					'value' => array_flip(array(
                        'style1' => __('Style 1','framework'),
                        'style2' => __('Style 2','framework')
                    )),
					'description' => ''
				)
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_pricing_table extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Pricing Table Column", "framework"),
			"base" => "pricing_table_column",
			"content_element" => true,
			"as_child" => array('only' => 'pricing_table'),
			"as_parent" => array('only' => 'pricing_table_item'),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Featured (only one column should be featured)', 'framework' ),
					'param_name' => 'featured',
					'admin_label' => false,
					'value' => array_flip(array(
						'no' => __('No', 'framework'),
						'yes' => __('Yes', 'framework')
					)),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'framework' ),
					'param_name' => 'title',
					'admin_label' => true,
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Price', 'framework' ),
					'param_name' => 'price',
					'admin_label' => false,
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Currency', 'framework' ),
					'param_name' => 'currency',
					'admin_label' => false,
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Period', 'framework' ),
					'param_name' => 'period',
					'admin_label' => false,
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Button Text', 'framework' ),
					'param_name' => 'buttontext',
					'admin_label' => false,
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'value' => ''
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		//class WPBakeryShortCode_accordion_toggle extends WPBakeryShortCode {
		class WPBakeryShortCode_pricing_table_column extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Pricing Table Item", "framework"),
			"base" => "pricing_table_item",
			"content_element" => true,
			"as_child" => array('only' => 'pricing_table_column'),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Value', 'framework' ),
					'param_name' => 'value',
					'admin_label' => false,
					'value' => array_flip(array(
						'text' => __('Text', 'framework'),
						'checked' => __('Checked', 'framework'),
						'notchecked' => __('Not checked', 'framework')
					)),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Text', 'framework' ),
					'param_name' => 'text',
					'admin_label' => true,
					'value' => ''
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_pricing_table_item extends WPBakeryShortCode {
		}
	}
	
	/**
	 * project_gallery
	 */
	vc_map(
		array(
			"name" => __("Project gallery", "framework"),
			"base" => "project_gallery",
			"as_parent" => array('only' => 'image_item'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings()
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_project_gallery extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Image Item", "framework"),
			"base" => "image_item",
			"content_element" => true,
			"as_child" => array('only' => 'project_gallery'),
			"params" => array(
				array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
				array(
					"type" => "textfield",
					"heading" => __("Tooltip", "framework"),
					"param_name" => "tooltip",
					'admin_label' => true,
					"description" => ''
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_image_item extends WPBakeryShortCode {
		}
	}
	
	/**
	 * recent_news_big
	 */
	vc_map( 
		array(
			'name' => __('Recent News Big', 'framework'),
			'base' => 'recent_news_big',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * recent_posts
	 */
	vc_map( 
		array(
			'name' => __('Recent Posts', 'framework'),
			'base' => 'recent_posts',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Excerpt length', 'framework' ),
					'param_name' => 'length',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'count',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * skillbar
	 */
	vc_map(
		array(
			"name" => __("Skillbar", "framework"),
			"base" => "skillbar",
			"as_parent" => array('only' => 'skillbar_item'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'framework' ),
					'param_name' => 'style',
					'admin_label' => false,
					'value' => array_flip(array(
                        'style1'=> __('Style 1', 'framework'),
                        'style2'=> __('Style 2', 'framework')
                    )),
					'description' => ''
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Text color", "framework"),
					"param_name" => "text_color",
					"description" => ''
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Border color", "framework"),
					"param_name" => "border_color",
					"description" => ''
				),
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_skillbar extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Skillbar Item", "framework"),
			"base" => "skillbar_item",
			"content_element" => true,
			"as_child" => array('only' => 'skillbar'),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Percentage', 'framework' ),
					'param_name' => 'percentage',
					'admin_label' => true,
					'value' => array_flip(ts_get_percentage_select_values()),
					'description' => ''
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "framework"),
					"param_name" => "title",
					'admin_label' => true,
					"description" => ''
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_skillbar_item extends WPBakeryShortCode {
		}
	}
	
	/**
	 * social_icons
	 */
	vc_map(
		array(
			"name" => __("Social Icons", "framework"),
			"base" => "social_icons",
			"as_parent" => array('only' => 'social_icon'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings()
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_social_icons extends WPBakeryShortCodesContainer {
		}
	}
	
	vc_map( 
		array(
			"name" => __("Social Icon", "framework"),
			"base" => "social_icon",
			"content_element" => true,
			"as_child" => array('only' => 'social_icons'),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					"admin_label" => true,
					'value' => array_flip(array(
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
					)),
					'description' => ''
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "framework"),
					"param_name" => "title",
					"admin_label" => true,
					"description" => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Target', 'framework' ),
					'param_name' => 'target',
					'admin_label' => false,
					'value' => array(
						'_blank' => '_blank',
                        '_parent' => '_parent',
                        '_self' => '_self',
                        '_top' => '_top'
                    ),
					'description' => ''
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_social_icon extends WPBakeryShortCode {
		}
	}
	
	/**
	 * space
	 */
	vc_map( 
		array(
			'name' => __('Space', 'framework'),
			'base' => 'space',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Height (px)', 'framework' ),
					'param_name' => 'height',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * special_text
	 */
	vc_map( 
		array(
			'name' => __('Special Text', 'framework'),
			'base' => 'special_text',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Tag name', 'framework' ),
					'param_name' => 'tagname',
					'admin_label' => true,
					'value' => array_flip(array(
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                    )),
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Font color', 'framework' ),
					'param_name' => 'color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Font size', 'framework' ),
					'param_name' => 'font_size',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Font weight', 'framework' ),
					'param_name' => 'font_weight',
					'admin_label' => false,
					'value' => array_flip(array(
                        'default' => __('Default', 'framework'),
                        'normal' => __('Normal', 'framework'),
                        'bold' => __('Bold', 'framework'),
                        'bolder' => __('Bolder', 'framework'),
                        '300' => __('Light', 'framework')
                    )),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Font style', 'framework' ),
					'param_name' => 'font_style',
					'admin_label' => false,
					'value' => array_flip(array(
                        'left' => __('Normal', 'framework'),
                        'italic' => __('Italic', 'framework')
                    )),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Font', 'framework' ),
					'param_name' => 'font',
					'admin_label' => false,
					'value' => array_flip(ts_get_font_choices(true)),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Margin top (px)', 'framework' ),
					'param_name' => 'margin_top',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Margin bottom (px)', 'framework' ),
					'param_name' => 'margin_bottom',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Align', 'framework' ),
					'param_name' => 'align',
					'admin_label' => false,
					'value' => array_flip(array(
                        'left' => __('Left', 'framework'),
                        'center' => __('Center', 'framework'),
                        'right' => __('Right', 'framework')
                    )),
					'description' => ''
				),
				array(
					'type' => 'textarea',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				),
			)
		)
	);
	
	/**
	 * tabs
	 */
	vc_map(
		array(
			"name" => __("Tabs (theme)", "framework"),
			"base" => "tabs",
			"as_parent" => array('only' => 'tab'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"params" => array(
				ts_get_vc_animation_effects_settings(),
				array(
					"type" => "dropdown",
					"heading" => __("Tabs Orientation", "framework"),
					"param_name" => "orientation",
					"value" => array_flip(array(
                        'horizontal' => __('horizontal', 'framework'),
                        'vertical' => __('vertical', 'framework')
                    )),
					"description" => __("Select the default orientation for this tabs group", "framework")
				)
			),
			"js_view" => 'VcColumnView'
		)
	);
	
	vc_map( 
		array(
			"name" => __("Tab", "framework"),
			"base" => "tab",
			"content_element" => true,
			"as_child" => array('only' => 'tabs'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Tab Title", "framework"),
					"param_name" => "title",
					"description" => __("Enter title for this toggle.", "framework")
				),
				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'heading' => __( 'Icon', 'framework' ),
					'param_name' => 'icon',
					'value' => ts_getFontAwesomeArray(),
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => __( 'Tab Content', 'framework' ),
					'param_name' => 'content',
					'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'framework' )
				),
			)
		) 
	);
	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_tabs extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_tab extends WPBakeryShortCode {
		}
	}
	
	/**
	 * testimonial
	 */
	vc_map( 
		array(
			'name' => __('Testimonial', 'framework'),
			'base' => 'testimonial',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Testimonial ID', 'framework' ),
					'param_name' => 'id',
					'admin_label' => true,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * testimonial
	 */
	vc_map( 
		array(
			'name' => __('Testimonials', 'framework'),
			'base' => 'testimonials',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Category ID', 'framework' ),
					'param_name' => 'category',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Navigation style', 'framework' ),
					'param_name' => 'nav_style',
					'admin_label' => false,
					'value' => array_flip(array(
                        'default' => __('Default', 'framework'),
						'modern' => __('Modern', 'framework')
                    )),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Limit', 'framework' ),
					'param_name' => 'limit',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'framework' ),
					'param_name' => 'text_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Info color', 'framework' ),
					'param_name' => 'info_color',
					'admin_label' => false,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Navigation style', 'framework' ),
					'param_name' => 'nav_style',
					'admin_label' => false,
					'value' => array_flip(array(
                        'light' => __('Light', 'framework'),
						'dark' => __('Dark', 'framework')
                    )),
					'description' => ''
				),
			)
		)
	);
	
	/**
	 * text
	 */
	vc_map( 
		array(
			'name' => __('Text', 'framework'),
			'base' => 'text',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textarea_html',
					'heading' => __( 'Content', 'framework' ),
					'param_name' => 'content',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * tooltip
	 */
	vc_map( 
		array(
			'name' => __('Tooltip', 'framework'),
			'base' => 'tooltip',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Label', 'framework' ),
					'param_name' => 'content',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Tooltip', 'framework' ),
					'param_name' => 'tooltip',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Position', 'framework' ),
					'param_name' => 'position',
					'admin_label' => false,
					'value' => array_flip(array(
                        'top' => __('Top', 'framework'),
                        'bottom' => __('Bottom', 'framework'),
                        'left' => __('Left', 'framework'),
                        'right' => __('Right', 'framework'),
                    )),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Link', 'framework' ),
					'param_name' => 'link',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * test
	 */
	vc_map( 
		array(
			'name' => __('Video Player', 'framework'),
			'base' => 'video_player',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'URL', 'framework' ),
					'param_name' => 'url',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Autoplay', 'framework' ),
					'param_name' => 'autoplay',
					'admin_label' => false,
					'value' => array_flip(array(
                        'no' => __('No', 'framework'),
						'yes' => __('Yes', 'framework')
                    )),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Align', 'framework' ),
					'param_name' => 'align',
					'admin_label' => false,
					'value' => array_flip(array(
                        'left' => __('Left', 'framework'),
                        'center' => __('Center', 'framework'),
                        'right' => __('Right', 'framework')
                    )),
					'description' => ''
				)
			)
		)
	);
	
	/**
	 * test
	 */
	/*
	vc_map( 
		array(
			'name' => __('Blockquote', 'framework'),
			'base' => 'blockquote',
			'class' => '',
			'category' => __('Content', 'framework'),
			'admin_enqueue_js' => '',
			'admin_enqueue_css' => '',
			'params' => array(
				ts_get_vc_animation_effects_settings(),
				array(
					'type' => 'textfield',
					'heading' => __( 'Text', 'framework' ),
					'param_name' => 'text',
					'admin_label' => false,
					'description' => ''
				)
			)
		)
	);*/
}