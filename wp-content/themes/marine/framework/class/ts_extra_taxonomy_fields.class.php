<?php 
/**
 * Adding extra taxonomy fields
 * Supported: order, image
 * 
 * Example of use:
 * $settings = array(
 *	'menu-categories' => array('order', 'image')
 * );
 * $tf = new ts_extra_faxonomy_fields($settings);
 * 
 * How to get value:
 * get_option('ts_taxonomy_order'.$taxonomy -> term_id);
 * get_option('ts_taxonomy_image'.$taxonomy -> term_id);
 */
class ts_extra_taxonomy_fields {
	
	/**
	 * Settings
	 * @var array
	 */
	var $settings = array();
	
	/**
	 * Construct
	 * @param array $settings table contaning settings eg. array('category' => array('order', 'image'))
	 */
	public function __construct($settings) {
		
		$this -> settings = $settings;
		
		add_action('create_term', array($this,'save'));
		
		//run only for edit tags screen
		if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) == 0 ) {
			return;
		}
		
		//save term
		add_action('edit_term', array($this,'save'));
		
		foreach ($this -> settings as $key => $fields) {
			add_action($key.'_add_form_fields', array($this,'add_taxonomy_fields'));
			add_action($key.'_edit_form_fields', array($this,'edit_taxonomy_fields'));
		}
	}
		
	// add image field in add form
	function add_taxonomy_fields($tag) {
		
		//order field
		if (isset($this -> settings[$tag]) && in_array('order',$this -> settings[$tag])) { ?>
		
			<div class="form-field">
				<label for="ts_taxonomy_order"><?php _e('Order', 'framework'); ?></label>
				<input type="text" name="ts_taxonomy_order" id="ts_taxonomy_order" value="" />
			</div>
		<?php }
		
		//image field
		if (isset($this -> settings[$tag]) && in_array('image',$this -> settings[$tag])) {
		
			if (get_bloginfo('version') >= 3.5)
				wp_enqueue_media();
			else {
				wp_enqueue_style('thickbox');
				wp_enqueue_script('thickbox');
			}
			?>
			<div class="form-field">
				<label for="ts_taxonomy_image"><?php _e('Image', 'framework'); ?></label>
				<input type="text" name="ts_taxonomy_image" id="ts_taxonomy_image" value="" />
				<br/>
				<button class="ts_upload_image_button button"><?php _e('Upload', 'framework');?></button>
			</div>
				
			<?php echo $this -> get_upload_script();
		}
	}
	
	/**
	 * Edit form
	 * @param type $taxonomy
	 */
	function edit_taxonomy_fields($taxonomy) {
		
		$tag = $taxonomy -> taxonomy;
		
		//order field
		if (isset($this -> settings[$tag]) && in_array('order',$this -> settings[$tag])) { ?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="ts_taxonomy_image"><?php _e('Order', 'framework'); ?></label>
				</th>
				<td>
					<input type="text" name="ts_taxonomy_order" id="ts_taxonomy_order" value="<?php echo esc_attr(get_option('ts_taxonomy_order'.$taxonomy -> term_id)); ?>" />
				</td>
			</tr> 
		<?php }
		
		//image field
		if (isset($this -> settings[$tag]) && in_array('image',$this -> settings[$tag])) {
			
			if (get_bloginfo('version') >= 3.5)
				wp_enqueue_media();
			else {
				wp_enqueue_style('thickbox');
				wp_enqueue_script('thickbox');
			}

			$image = get_option('ts_taxonomy_image'.$taxonomy -> term_id); ?>

			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="ts_taxonomy_image"><?php _e('Image', 'framework'); ?></label>
				</th>
				<td>
					<img class="ts-taxonomy-image" src="<?php echo $image; ?>"/><br/><input type="text" name="ts_taxonomy_image" id="ts_taxonomy_image" value="<?php echo esc_url($image); ?>" /><br />
					<button class="ts_upload_image_button button"><?php _e('Upload', 'framework'); ?></button>
					<button class="ts_remove_image_button button"><?php _e('Remove', 'framework'); ?></button>
				</td>
			</tr> 
			<?php
			echo $this -> get_upload_script();
		}
	}
	
	/**
	 * Upload JS script
	 * @return string
	 */
	function get_upload_script() {
		
		ob_start(); ?>
		
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				var wp_ver = "<?php bloginfo("version"); ?>", upload_button;
				$(".ts_upload_image_button").click(function(event) {
					upload_button = $(this);
					var file_frame;
					if (wp_ver >= "3.5") {
						
						event.preventDefault();
						
						// If the media frame already exists, reopen it.
						if ( file_frame ) {
						  file_frame.open();
						  return;
						}
						
						file_frame = wp.media.frames.file_frame = wp.media({
							multiple: false  // Set to true to allow multiple files to be selected
						});
						file_frame.on( "select", function() {
							// Grab the selected attachment.
							var attachment = file_frame.state().get("selection").first();
							file_frame.close();
							$("#ts_taxonomy_image").val(attachment.attributes.url);
						});
						
						file_frame.open();
					}
					else {
						tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
						return false;
					}
				});

				$(".ts_remove_image_button").click(function() {
					event.preventDefault();			
					$("#ts_taxonomy_image").val("");
					$(".ts-taxonomy-image").remove();
					return false;
				});
			});
		</script> <?php
		
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}
	
	/**
	 * Save taxanomy
	 * @param type $term_id
	 */
	public function save($term_id) {
		
		if(isset($_POST['ts_taxonomy_order'])) {
			update_option('ts_taxonomy_order'.$term_id, $_POST['ts_taxonomy_order']);
		}
		
		if(isset($_POST['ts_taxonomy_image'])) {
			update_option('ts_taxonomy_image'.$term_id, $_POST['ts_taxonomy_image']);
		}
	}
}
