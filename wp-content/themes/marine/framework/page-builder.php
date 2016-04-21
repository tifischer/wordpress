<?php
/**
 * Page builder
 */

/**
 * Force editor to run in tinymce mode, our hidden editor won't work if editor will be loaded in html mode
 * @return string
 */
function ts_force_default_editor() {
    return 'tinymce';
}
add_filter( 'wp_default_editor', 'ts_force_default_editor' );

/**
 * add hidden editor, we get settings from this editor in dynamically created editor
 */
function ts_add_pb_hidden_metabox()
{
	add_meta_box( 'pb_hidden_editor_meta_box', 'Editor', 'ts_add_pb_hidden_editor', 'page', 'normal');
}
add_action( 'add_meta_boxes', 'ts_add_pb_hidden_metabox' );

/**
 * Add hidden editor
 */
function ts_add_pb_hidden_editor()
{
	?>
	<div class="wp-core-ui wp-editor-wrap tmce-active">
		<?php

		//$mce_buttons = array('bold', 'italic', 'strikethrough');
		$mce_buttons = array('bold', 'italic', 'strikethrough', '|', 'bullist', 'numlist', 'blockquote', '|', 'justifyleft', 'justifycenter', 'justifyright', '|', 'link', 'unlink', 'wp_more', '|', 'spellchecker', 'fullscreen', 'code', 'wp_adv' );
		$mce_buttons_2 = array( 'formatselect', 'underline', 'justifyfull', 'forecolor', '|', 'pastetext', 'pasteword', 'removeformat', '|', 'charmap', '|', 'outdent', 'indent', '|', 'undo', 'redo', 'wp_help');


		$args = array(
			'textarea_name' => 'pb_hidden_editor_textarea',
			'media_buttons' => true,
			'quicktags' => true,
			'tinymce' => array(
				'theme_advanced_buttons1' => implode(',',$mce_buttons),
				'theme_advanced_buttons2' => implode(',',$mce_buttons_2)
			)
		);

		wp_editor( '', 'pb_hidden_editor', $args );
		?>
	</div>
	<?php
}

/**
 * Get page builder code
 * @return string
 */
function ts_get_page_builder() {

	$aShortcodes = ts_get_shortcodes_list();
	$options = '<option value="">' . __('Choose item', 'framework') . '</option>';
	if (is_array($aShortcodes)) {
		foreach ($aShortcodes as $aShortcode) {
			$aShortcodesNames[sanitize_text_field($aShortcode["shortcode"])] = $aShortcode["name"];
			$options .= '<option value="' . sanitize_text_field($aShortcode["shortcode"]) . '">' . $aShortcode["name"] . '</option>';
		}
	}

	$page_builder_config = ts_get_page_builder_config();

	$post = null;
	if (isset($_POST['post']))
	{
		$post = $_POST['post'];
	}

	if (!isset($_POST['template']))
	{
		$template = 'default';
	}
	else
	{
		$template = $_POST['template'];
	}

	if (!isset($page_builder_config[$template]))
	{
		$template = 'default';
	}

	$content = '';


	foreach ($page_builder_config[$template] as $builder_key => $builder_label)
	{
		$page_builder_data = ts_get_page_builder_data($post, $builder_key);
		
		$content .= '
			<div class="page_builder_container">
				<div class="format-setting-label">
					<label for="header_background" class="label">'.$builder_label.'</label>
				</div>
				<div class="format-setting type-select">
					<div class="format-setting-inner">
						<div class="select-wrapper" style="float: left">
							<span>' . __('Choose item', 'framework') . '</span>
							<select name="pb_select_items_'.$builder_key.'" id="pb_select_items_'.$builder_key.'" class="pb_select_items option-tree-ui-select ">
								' . $options . '
							</select>
						</div>
						<div id="pb_add_item_'.$builder_key.'" class="pb_add_item button button-primary button-large">'.__('Add Item','framework').'</div>
					</div>
				</div>
				<!-- Pattern used for each added item (hidden element -->
				<div id="pb_item_pattern_'.$builder_key.'" class="pb_item_pattern">
					<div class="pb_item_wrapper" style="width: 50%">
						<div class="pb_item" data-item="{$item}" data-item-id="{$id}" data-size="1/2">
							<div class="pb_item_action pb_item_edit" title="' . __('Edit', 'framework') . '"></div>
							<div class="pb_item_action pb_item_size">1/2</div>
							<div class="pb_item_action pb_item_plus"></div>
							<div class="pb_item_action pb_item_minus"></div>
							<div class="pb_item_action pb_item_clone"></div>
							<div class="pb_item_action pb_item_remove" data-msg="' . esc_attr(__('Are you sure?', 'framework')) . '" title="' . __('Delete', 'framework') . '"></div>
							<div class="pb_item_title">{$title}</div>
							<input type="hidden" class="pb_item_data" id="pb_item_data_'.$builder_key.'_{$id}" name="pb_item_data_'.$builder_key.'_{$id}" value=\'\' />
							<input type="hidden" class="pb_item_size_value" id="pb_item_size_'.$builder_key.'_{$id}" name="pb_item_size_'.$builder_key.'_{$id}" value=\'1/2\' />
							<input type="hidden" class="pb_item_type" id="pb_item_type_'.$builder_key.'_{$id}" name="pb_item_type_'.$builder_key.'_{$id}" value=\'{$type}\' />
						</div>
					</div>
				</div> <!-- #pb_item_pattern -->

				<!-- Page builder items -->
				<div class="pb_wrapper">
					<div class="pb_inner" id="pb_inner_'.$builder_key.'" data-builder="'.$builder_key.'">';

		if (is_array($page_builder_data)) {
			$i = 0;
			foreach ($page_builder_data as $item) {
				if (empty($item['shortcode'])) {
					continue;
				}
				$i++;
				if (version_compare(PHP_VERSION, '5.3.0', '>=') === true)
				{
					$data = json_encode($item['data'],JSON_HEX_APOS);
				}
				else
				{
					$data = str_replace(array('\"', '\''), array('\\u0022', '\\u0027'), json_encode($item['data']));
				}
				$content .= '
						<div class="pb_item_wrapper" style="width: ' . ts_get_pb_size($item['size']) . '%">
							<div class="pb_item" data-item="' . $item['type'] . '" data-item-id="' . $i . '" data-size="' . $item['size'] . '">
								<div class="pb_item_action pb_item_edit" title="' . __('Edit', 'framework') . '"></div>
								<div class="pb_item_action pb_item_size">' . $item['size'] . '</div>
								<div class="pb_item_action pb_item_plus"></div>
								<div class="pb_item_action pb_item_minus"></div>
								<div class="pb_item_action pb_item_clone"></div>
								<div class="pb_item_action pb_item_remove" data-msg="' . esc_attr(__('Are you sure?', 'framework')) . '" title="' . __('Delete', 'framework') . '"></div>
								<div class="pb_item_title">' . $aShortcodesNames[$item['type']] . '</div>
								<input type="hidden" class="pb_item_data" id="pb_item_data_'.$builder_key.'_' . $i . '" name="pb_item_data_'.$builder_key.'_' . $i . '" value=\'' . $data . '\' />
								<input type="hidden" class="pb_item_size_value" id="pb_item_size_'.$builder_key.'_' . $i . '" name="pb_item_size_'.$builder_key.'_' . $i . '" value=\'' . $item['size'] . '\' />
								<input type="hidden" class="pb_item_type" id="pb_item_type_'.$builder_key.'_' . $i . '" name="pb_item_type_'.$builder_key.'_' . $i . '" value=\'' . $item['type'] . '\' />
							</div>
						</div>';
			}
		}
		$content .= '
						<div class="pb_clear" id="pb_clear'.$builder_key.'"></div>
					</div> <!-- .pb_inner -->
				</div> <!-- .pb_wrapper -->
			</div> <!-- .page_builder_container -->';
	}

	$content .= '
		<script>
			jQuery(document).ready(function ($) {

				$(".pb_inner").sortable({
					cursor: "pointer",
					items: "div.pb_item_wrapper",
					placeholder: "placeholder",
					containment: "#page-builder",
					connectWith: ".pb_inner",
					forcePlaceholderSize: true,
					start: function(e, ui ) {
						ui.placeholder.width(ui.helper.outerWidth() - 5);
					},
					update: function( event, ui ) {
						$this = this;

						//get page builder container id
						$pb_inner = $($this).closest(".pb_inner").attr("id");
						$pb_inner_id = $pb_inner.replace("pb_inner_content_","");

						//get current element old container id
						$item = $($this).find(".pb_item_data").attr("id");

						$item_values = $item.split("_");
						$old_item_id = $item_values[5];
						$old_item_pb_inner_id = $item_values[4];

						//change item attributes if item was moved to the new container
						if ($pb_inner_id != $old_item_pb_inner_id) {

							//find next id for a new element
							$next_item_id = 1;
							$($this).closest(".page_builder_container").find(".pb_inner .pb_item").each(function(index) {
								$item_id = $(this).attr("data-item-id");
								$item_id = parseInt($item_id);
								if ($item_id >= $next_item_id)
								{
									$next_item_id = $item_id + 1;
								}
							});


							//replace attributes with a new one with id of the new container $pb_inner_id
							$old_item = $old_item_pb_inner_id + "_" + $old_item_id;

							$("#pb_item_data_content_" + $old_item).closest(".pb_item").attr("data-item-id",$next_item_id);
							$("#pb_item_data_content_" + $old_item).attr("name","pb_item_data_content_" + $pb_inner_id + "_" + $next_item_id);
							$("#pb_item_data_content_" + $old_item).attr("id","pb_item_data_content_" + $pb_inner_id + "_" + $next_item_id);
							$("#pb_item_size_content_" + $old_item).attr("name","pb_item_size_content_" + $pb_inner_id + "_" + $next_item_id);
							$("#pb_item_size_content_" + $old_item).attr("id","pb_item_size_content_" + $pb_inner_id + "_" + $next_item_id);
							$("#pb_item_type_content_" + $old_item).attr("name","pb_item_type_content_" + $pb_inner_id + "_" + $next_item_id);
							$("#pb_item_type_content_" + $old_item).attr("id","pb_item_type_content_" + $pb_inner_id + "_" + $next_item_id);

						}
					}
				}).disableSelection();
			});
		</script>

	';

	$content .= '<input type="hidden" id="popup_url" name="popup_url" value="' . get_template_directory_uri() . '/framework/" />';
	echo $content;
	die();
}

add_action( 'wp_ajax_nopriv_get_page_builder', 'ts_get_page_builder' );
add_action( 'wp_ajax_get_page_builder', 'ts_get_page_builder' );

/**
 * Save page builder
 * @return string
 */
add_action('save_post', 'ts_save_post_page_builder');

function ts_save_post_page_builder($post_id) {

	global $post;

	if (!isset($_POST)) {
		return true;
	}

	if (!isset($_POST['post_type']) || 'page' != $_POST['post_type'] ) {
		return;
    }
    if ( !current_user_can( 'edit_post', $post_id ) ) {
		return;
    }

	$page_builder_config = ts_get_page_builder_config();

	//prepare all page builder items
	$items = array();

	$template = $_POST['page_template'];
	if (!isset($page_builder_config[$_POST['page_template']]))
	{
		$template = 'default';
	}

	if (isset($page_builder_config) && is_array($page_builder_config[$template]))
	{
		foreach ($page_builder_config[$template] as $builder_key => $builder_val)
		{
			$items = array();

			foreach ($_POST as $key => $val) {
				if (strstr($key, 'pb_item_data_'.$builder_key.'_')) {
					$i = str_replace('pb_item_data_'.$builder_key.'_', '', $key);

					if (!preg_match ("/^[0-9]+$/", $i)) {
						continue;
					}

					$i = intval($i);

					$data = stripslashes($_POST['pb_item_data_'.$builder_key.'_' . $i]);
					$data = json_decode($data);

					$items[] = array(
						'shortcode' => $data->shortcode,
						'data' => $data,
						'size' => $_POST['pb_item_size_'.$builder_key.'_' . $i],
						'type' => $_POST['pb_item_type_'.$builder_key.'_' . $i]
					);
				}
			}

			$page = array();
			//create shortcodes string ready to use on website
			if (count($items) > 0) {
				$c = count($items);
				$size = 0;
                $page[]='[row]';
				for ($i = 0; $i < $c; $i++) {
					$size += ts_get_pb_size($items[$i]['size']);

					//check if column is not last
					//column is last when:
					//-next item doesn't exisits
					//-size + next item size > 100 (%)
					$last = '';
					if (!isset($items[$i + 1]) || $size + ts_get_pb_size($items[$i + 1]['size']) > 100) {
						//$last = '_last';
						//$size = 0;
					}

					switch ($items[$i]['size']) {
						case '1/4': $page[] = '[one_fourth]' . $items[$i]['shortcode'] . '[/one_fourth]';
							break;
						case '1/3': $page[] = '[one_third]' . $items[$i]['shortcode'] . '[/one_third]';
							break;
						case '1/2': $page[] = '[one_half]' . $items[$i]['shortcode'] . '[/one_half]';
							break;
						case '2/3': $page[] = '[two_third]' . $items[$i]['shortcode'] . '[/two_third]';
							break;
						case '3/4': $page[] = '[three_fourth]' . $items[$i]['shortcode'] . '[/three_fourth]';
							break;
						case '1/1': $page[] = '[one]'.$items[$i]['shortcode'].'[/one]';
							break;
					}

				}
                $page[]='[/row]';

			}
			//saving page builder data, used only for admin 
			ts_save_page_builder_items($post->ID, $builder_key, $items);
			
			//saving a serialized copy od page builder data for admin
			update_post_meta($post->ID, ts_get_page_builder_meta_key($builder_key,'page_builder_items'), $items);
			
			//saving post builder data for frontend
			update_post_meta($post->ID, ts_get_page_builder_meta_key($builder_key,'page_builder_content'), implode('', $page));
		}
	}
}

/**
 * Save pb items
 * @global type $wpdb
 * @param type $post_id
 * @param type $builder_key
 * @param type $items
 */
function ts_save_page_builder_items($post_id, $builder_key, $items) {

	global $wpdb;
	
	//delete all old records
	//$wpdb->query('START TRANSACTION');
	$wpdb -> query($wpdb -> prepare('DELETE FROM '.$wpdb -> prefix.'fs_page_builder WHERE post_id=%d AND pb_key=%s',$post_id,$builder_key));
	$wpdb -> query($wpdb -> prepare('DELETE FROM '.$wpdb -> prefix.'fs_page_builder_items WHERE post_id=%d AND pb_key=%s',$post_id, $builder_key));
	
	//save items
	if (is_array($items) && count($items) > 0) {
		
		//save shortcode main info
		foreach ($items as $key => $item) {
			$wpdb -> query($q = $wpdb -> prepare('
				INSERT INTO 
					'.$wpdb -> prefix.'fs_page_builder
					(pb_key,post_id,size,type,shortcode)
				VALUES(
					%s,
					%d,
					%s,
					%s,
					%s
				)',
				$builder_key,
				$post_id,
				$item['size'],
				$item['type'],
				$item['shortcode']
			));
			
			$data = $item['data'] -> data;
			$insert_id = $wpdb->insert_id;
			
			//save attributes
			if ($insert_id && is_array($data) && count($data) > 0) {
				
				foreach ($data as $level => $data_level) {
					if (is_array($data_level) && count($data_level) > 0) {
						foreach ($data_level as $pbparent => $attributes) {
							if (is_array($attributes) && count($attributes) > 0) {
								foreach ($attributes as $position => $attribute) {
									
									if (is_object($attribute)) {
										foreach ($attribute as $label => $val) {
											$wpdb -> query($q = $wpdb -> prepare('
												INSERT INTO
													'.$wpdb -> prefix.'fs_page_builder_items
													(pb_id,post_id,pb_key,level,pbparent,position,attribute,value)
												VALUES(
													%d,
													%d,
													%s,
													%d,
													%d,
													%d,
													%s,
													%s
												)
												',
												$insert_id,
												$post_id,
												$builder_key,
												$level,
												$pbparent,
												$position,
												$label,
												$val
											));
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	//$wpdb->query('COMMIT');
}

/**
 * Get page builder data
 * @param type $post
 * @param type $builder_key
 */
function ts_get_page_builder_data($post_id, $builder_key) {
	
	global $wpdb;
	
	$rows = $wpdb -> get_results($wpdb -> prepare('
		SELECT 
			* 
		FROM 
			'.$wpdb -> prefix.'fs_page_builder 
		WHERE 
			post_id=%d AND pb_key=%s ORDER BY pb_id',
		$post_id,
		$builder_key
	));
	
	if (!is_wp_error($rows) &&  is_array($rows)) {
		
		$items = array();
		foreach ($rows as $row) {
			
			$tmp['shortcode'] = $row -> shortcode;
			$tmp['size'] = $row -> size;
			$tmp['type'] = $row -> type;
			$tmp['data'] = new stdClass;
			$tmp['data'] -> shortcode = $tmp['shortcode'];

			$attributes = $wpdb -> get_results($wpdb -> prepare('
				SELECT 
					* 
				FROM 
					'.$wpdb -> prefix.'fs_page_builder_items
				WHERE 
					pb_id=%d 
				ORDER BY 
					position',
			   $row -> pb_id
		   ));
			 
			if (!is_wp_error($attributes) && is_array($attributes)) {
				$tmp['data'] -> data = array();
				$tmp['data'] -> data[0] = null;
				
				$i = 0;
				foreach ($attributes as $attr) {
					
					if (!isset($tmp['data'] -> data[$attr -> level])) {
						$tmp['data'] -> data[$attr -> level] = array();
					}
					
					if (!isset($tmp['data'] -> data[$attr -> level][$attr -> pbparent])) {
						$tmp['data'] -> data[$attr -> level][$attr -> pbparent] = array();
					}
					
					if (!isset($tmp['data'] -> data[$attr -> level][$attr -> pbparent][$attr -> position])) {
						$tmp['data'] -> data[$attr -> level][$attr -> pbparent][$attr -> position] = new stdClass;
					}
					
					$attr_name = $attr -> attribute;
					$tmp['data'] -> data[$attr -> level][$attr -> pbparent][$attr -> position] -> $attr_name = $attr -> value;
					
					$i++;
				}
			}
						
			$items[] = $tmp;
		}
		return $items;
	}
	return false;
}

/**
 * Get page builder meta key
 * @param type $builder
 * @param string $meta_key
 * @return string
 */
function ts_get_page_builder_meta_key($builder,$meta_key) {

	if ($builder != 'content')
	{
		$meta_key .= '_'.$builder;
	}
	return $meta_key;
}

/**
 * Get page builder config, sets default config if config is not defined
 * @global array $page_builder_config
 * @return array
 */
function ts_get_page_builder_config()
{
	global $page_builder_config;

	if (!isset($page_builder_config) || !is_array($page_builder_config) || !isset($page_builder_config['default']['content']))
	{
		$page_builder_config['default']['content'] = __('Page builder','framework');
	}
	return $page_builder_config;
}

/**
 * Get size for page builder saving
 * @param string $size
 * @return int
 */
function ts_get_pb_size($size) {
	switch ($size) {
		case '1/4': return 25;
			break;
		case '1/3': return 33;
			break;
		case '1/2': return 50;
			break;
		case '2/3': return 67;
			break;
		case '3/4': return 75;
			break;
		case '1/1': return 100;
			break;
	}
	return 0;
}
