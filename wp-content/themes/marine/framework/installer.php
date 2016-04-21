<?php
/**
 * Installer functions, upgrading framework to the newest version
 *
 * @package framework
 * @since framework 2.0
 */

define('TS_VERSION','2.1');				//framework version
define('TS_PB_VERSION','2.0');			//page builder version

$ts_installer = new ts_installer();

add_action('admin_init',array($ts_installer,'init'));

class ts_installer {
	
	public function __construct() {
		
	}
	
	public function init() {
		
		if (get_option('ts_version') < TS_VERSION) {
			$this -> updateDb();
		}

		if (get_option('ts_pb_version') < TS_PB_VERSION) {
			$this -> updatePageBuilder();
		}
	}
	
	/**
	 * Update database tables
	 */
	protected function updateDb() {
		
		global $wpdb;
		
		$fs_sliders_table = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb -> prefix."fs_sliders'");
		if (!strstr($fs_sliders_table,'fs_sliders'))
		{
			$wpdb-> query("
			   CREATE TABLE `".$wpdb -> prefix."fs_sliders` (
				`slider_id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(64) NOT NULL,
				`created_date` int(11) NOT NULL,
				`animation` varchar(32) NOT NULL,
				`direction` varchar(32) NOT NULL,
				`slideshow_speed` int(10) unsigned NOT NULL,
				`animation_speed` int(10) unsigned NOT NULL,
				`background` varchar(512) NOT NULL,
				`reverse` tinyint(1) unsigned NOT NULL DEFAULT '0',
				`randomize` tinyint(1) unsigned NOT NULL DEFAULT '0',
				`control_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
				`direction_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
				PRIMARY KEY (`slider_id`)
			  ) ENGINE=MyISAM;");
		}
		$fs_slides_table = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb -> prefix."fs_slides'");
		if (!strstr($fs_slides_table,'fs_slides'))
		{
			$wpdb-> query("
			   CREATE TABLE `".$wpdb -> prefix."fs_slides` (
				`slide_id` int(11) NOT NULL AUTO_INCREMENT,
				`slider_id` int(11) NOT NULL,
				`image` varchar(255) NOT NULL,
				`show_order` int(10) unsigned NOT NULL,
				`update_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
				PRIMARY KEY (`slide_id`),
				KEY `slider_id` (`slider_id`)
			  ) ENGINE=MyISAM;");
		}
		
		$fs_page_builder_table = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb -> prefix."fs_page_builder'");
		if (!strstr($fs_page_builder_table,'fs_page_builder'))
		{
			$wpdb-> query("
				CREATE TABLE `".$wpdb -> prefix."fs_page_builder` (
					`pb_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
					`pb_key` varchar(16) NOT NULL DEFAULT '',
					`post_id` bigint(20) unsigned NOT NULL,
					`size` varchar(8) NOT NULL,
					`type` varchar(32) NOT NULL,
					`shortcode` text NOT NULL,
					PRIMARY KEY (`pb_id`),
					KEY `pb_label` (`pb_key`)
				  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
			");
		}
		
		$fs_page_builder_items_table = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb -> prefix."fs_page_builder_items'");
		if (!strstr($fs_page_builder_items_table,'fs_page_builder_items'))
		{
			$wpdb-> query("
				CREATE TABLE `".$wpdb -> prefix."fs_page_builder_items` (
					`pb_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
					`pb_id` int(11) NOT NULL,
					`post_id` int(10) unsigned NOT NULL,
					`pb_key` varchar(16) NOT NULL DEFAULT '',
					`level` int(10) unsigned NOT NULL DEFAULT '0',
					`pbparent` int(10) unsigned NOT NULL DEFAULT '0',
					`position` int(11) NOT NULL DEFAULT '0',
					`attribute` varchar(32) NOT NULL,
					`value` text NOT NULL,
					PRIMARY KEY (`pb_attr_id`),
					KEY `post_id` (`post_id`),
					KEY `pb_id` (`pb_id`)
				  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
			");
		}
		
		$aFields = $wpdb->get_results("SHOW COLUMNS FROM ".$wpdb -> prefix."fs_page_builder_items");
		if (is_array($aFields))
		{
		   $bExists_pb_key = false;
		   foreach ($aFields as $aField)
		   {
			  if ($aField -> Field == 'pb_key')
			  {
				 $bExists_pb_key = true;
			  }
		   }
		   if ($bExists_pb_key === false)
		   {
			  $wpdb-> query(" ALTER TABLE  `".$wpdb -> prefix."fs_page_builder_items` ADD  `pb_key` varchar(16) NOT NULL DEFAULT '' AFTER post_id");
			  $rows = $wpdb -> get_results('SELECT * FROM '.$wpdb -> prefix.'fs_page_builder');
			  if (is_array($rows) && !is_wp_error($rows)) {
				  foreach ($rows as $row) {
					  $wpdb-> query($q = $wpdb -> prepare('UPDATE `'.$wpdb -> prefix.'fs_page_builder_items` SET pb_key=%s  WHERE pb_id=%d', $row -> pb_key, $row -> pb_id));
				  }
			  }  
		   }
		}
		update_option('ts_version', TS_VERSION);
	}
	
	/**
	 * Update page builder data from serialized string to separated tables
	 * @global type $wpdb
	 * @return boolean
	 */
	protected function updatePageBuilder() {
		
		global $wpdb;
		
		$posts = $this -> getPageBuilderNotUpdated();
		
		if (is_array($posts) && count($posts) > 0) {
			
			foreach ($posts as $post) {
				
				$rows = $wpdb -> get_results('
					SELECT 
						* 
					FROM 
						'.$wpdb -> postmeta.' 
					WHERE 
						meta_key LIKE "page_builder_items%" AND 
						meta_key != "page_builder_items_updated" AND
						meta_value != "a:0:{}" AND
						post_id='.intval($post -> ID).'
				');
				
				if (!is_wp_error($rows)) {
					
					if (count($rows) > 0) {
						
						foreach ($rows as $row) {

							if ($row -> meta_key == 'page_builder_items') {
								$builder_key = 'content';
							} else {
								$builder_key = str_replace('page_builder_items_','',$row -> meta_key);
							}
							$items = get_post_meta($row -> post_id,$row -> meta_key,true);							
							ts_save_page_builder_items($row -> post_id, $builder_key, $items);
							
						} //foreach $rows
					}
					update_post_meta($post -> ID,'page_builder_items_updated',1);
				}
			} //foreach $posts
		}
		
		//change page builder version info if all pages are updated (updated status for each post is changed)
		$updated = $this -> checkIfAllPageBuilderRecordsUpdated();
		if ($updated === true) {			
			update_option('ts_pb_version', TS_PB_VERSION);
			$wpdb -> query('DELETE FROM '.$wpdb -> postmeta.' WHERE meta_key="page_builder_items_updated"');
			
		//show update notice if it's not completed
		} else if ($updated === false) {		
			add_action( 'admin_notices', array($this,'printPageBuilderUpdateNotice') );
		}
	}
	
	/** 
	 * Get not updated post ids
	 * @return boolean
	 */
	protected function getPageBuilderNotUpdated() {
		
		global $wpdb;
		
		$posts = $wpdb -> get_results('
			SELECT 
				DISTINCT P.ID
			FROM 
				'.$wpdb -> posts.' P
			LEFT JOIN
				'.$wpdb -> postmeta.' M
			ON
				P.ID=M.post_id AND
				M.meta_key="page_builder_items_updated" AND
				M.meta_value=1
			WHERE
				P.post_type="page" AND
				M.meta_id IS NULL
			ORDER BY 
				P.ID
		');
		
		if (!is_wp_error($posts) && count($posts) > 0) {
			
			return $posts;
		}
		return false;
	}
	
	/**
	 * Get not updated page builder records 
	 * @return boolean
	 */
	protected function checkIfAllPageBuilderRecordsUpdated() {
		
		global $wpdb;
		
		$posts = $wpdb -> get_var($q = '
			SELECT 
				COUNT(DISTINCT P.ID)
			FROM 
				'.$wpdb -> posts.' P
			LEFT JOIN
				'.$wpdb -> postmeta.' M
			ON
				P.ID=M.post_id AND
				M.meta_key="page_builder_items_updated" AND
				M.meta_value=1
			WHERE
				P.post_type="page" AND
				M.meta_id IS NULL
		');
		
		if (!is_wp_error($posts) && $posts == 0) {
			return true;
		}
		return false;
	}
	
	function printPageBuilderUpdateNotice() {
		?>
		<div class="updated">
			<p><strong><?php _e( 'Updating page builder data.','framework'); ?></strong> <?php _e('Please reload if you see this notice. It will disapear when the update is completed.', 'framework' ); ?></p>
		</div>
		<?php
	}
}

