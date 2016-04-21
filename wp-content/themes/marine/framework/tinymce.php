<?php
/**
 * Tinymce editor extensions
 *
 * @package framework
 * @since framework 1.0
 */


if (current_user_can('edit_posts') || current_user_can('edit_pages') )
{
	if ( get_user_option('rich_editing') == 'true')
	{
		
		global $wp_version;

		if ( $wp_version >= 3.9 ) {
			add_filter('mce_external_plugins', 'ts_registerTmcePluginColumns');
			add_filter('mce_buttons', 'ts_registerButtonColumns');
		
			add_filter('mce_external_plugins', 'ts_registerTmcePluginShortcodes');
			add_filter('mce_buttons', 'ts_registerButtonShortcodes');
		} else {
			add_filter('mce_external_plugins', 'ts_registerTmcePluginColumns_old');
			add_filter('mce_buttons', 'ts_registerButtonColumns');
		
			add_filter('mce_external_plugins', 'ts_registerTmcePluginShortcodes_old');
			add_filter('mce_buttons', 'ts_registerButtonShortcodes');
		}
	}
}

/**
 * Shortcode Columns - register button
 * @since framework 1.0
 */
function ts_registerButtonColumns($buttons)
{
	array_push($buttons, "separator", 'ColumnsSelector');
	return $buttons;
}

/**
 * Shortcode Columns - regsiter plugin
 * @since framework 1.0
 */
function ts_registerTmcePluginColumns($plugin_array)
{
	$plugin_array['ColumnsSelector'] = get_template_directory_uri() . '/framework/js/tinymce_ColumnsSelector.js';
	return $plugin_array;
}

/**
 * Shortcode Columns - regsiter plugin for WP < 3.9
 * @since framework 1.0
 */
function ts_registerTmcePluginColumns_old($plugin_array)
{
	$plugin_array['ColumnsSelector'] = get_template_directory_uri() . '/framework/js/tinymce_ColumnsSelector_old.js';
	return $plugin_array;
}

/**
 * Shortcodes - register button
 * @since framework 1.0
 */
function ts_registerButtonShortcodes($buttons)
{
	array_push($buttons, "separator", 'ShortcodesSelector');
	return $buttons;
}

/**
 * Shortcodes - regsiter plugin
 * @since framework 1.0
 */
function ts_registerTmcePluginShortcodes($plugin_array)
{
	$plugin_array['ShortcodesSelector'] = get_template_directory_uri() . '/framework/js/tinymce_ShortcodesSelector.js.php';
	return $plugin_array;
}

/**
 * Shortcodes - regsiter plugin for WP < 3.9
 * @since framework 1.0
 */
function ts_registerTmcePluginShortcodes_old($plugin_array)
{
	$plugin_array['ShortcodesSelector'] = get_template_directory_uri() . '/framework/js/tinymce_ShortcodesSelector_old.js.php';
	return $plugin_array;
}