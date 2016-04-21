<?php
	header('Content-Type: text/javascript');
	
	$path = realpath(dirname(__FILE__));
	$position = strrpos($path,'wp-content');
	$wp_path = substr($path, 0, $position);
	require_once($wp_path.'wp-load.php');
	
	$aShortcodes = ts_get_shortcodes_list();
	
	$count = count($aShortcodes);
?>


( function() {
    tinymce.PluginManager.add( 'ShortcodesSelector', function( editor, url ) {
	
		editor.addCommand("shortcodesPopup", function ( a, params )
		{
			tb_show("<?php _e("Shortcodes","framework") ?>", "<?php echo get_template_directory_uri();?>/framework/popup.php?shortcode=" + params.shortcode + "&width=" + 630);
		});
	
        // Add a button that opens a window
        editor.addButton( 'ShortcodesSelector', {

            text: 'Shortcodes',
            icon: false,
			type: 'menubutton',
			menu: [<?php $i = 0; foreach ($aShortcodes as $aShortcode) { $i++; ?>
				{
            		text: '<?php echo $aShortcode["name"];?>',
            		value: '<?php echo sanitize_text_field($aShortcode["shortcode"]);?>',
            		onclick: function() {
						
						tinymce.activeEditor.execCommand("shortcodesPopup", false, {
							shortcode: this.value()
						});
						
					}
				}<?php if ($i < $count) { echo ','; } ?>
			
			<?php } ?>
            	
           ]

        } );

    } );

} )();
