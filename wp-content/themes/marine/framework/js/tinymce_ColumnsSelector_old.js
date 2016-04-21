/**
 * Columns selector - WP 3.8 and less
 *
 */
(function() {
	
	tinymce.create('tinymce.plugins.ColumnsSelector', {
		/**
		 * Plugin initalization, will be executed after the plugin has been created.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			
		},

		/**
		 * Creates control instances based in the incomming name
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			
			if(n=='ColumnsSelector'){
                var mlb = cm.createListBox('ColumnsSelectorList', {
                     title : 'Columns',
                     onselect : function(v) { //Option value as parameter
                     	
						switch (v)
						{
							case '2_columns':
								content = '[one_half]' + tinyMCE.activeEditor.selection.getContent() + '[/one_half]';
								content += '[one_half_last][/one_half]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
								
							case '3_columns':
								content = '[one_third]' + tinyMCE.activeEditor.selection.getContent() + '[/one_third]';
								content += '[one_third][/one_third]';
								content += '[one_third_last][/one_third]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
							
							case '4_columns':
								content = '[one_fourth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_fourth]';
								content += '[one_fourth][/one_fourth]';
								content += '[one_fourth][/one_fourth]';
								content += '[one_fourth_last][/one_fourth]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
							
							case '6_columns':
								content = '[one_sixth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_sixth]';
								content += '[one_sixth][/one_sixth]';
								content += '[one_sixth][/one_sixth]';
								content += '[one_sixth][/one_sixth]';
								content += '[one_sixth][/one_sixth]';
								content += '[one_sixth_last][/one_sixth]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
							
							default:
								if(tinyMCE.activeEditor.selection.getContent() != '')
								{
									tinyMCE.activeEditor.selection.setContent('[' + v + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + v + ']');
								}
								else
								{
									tinyMCE.activeEditor.selection.setContent('[' + v + '][/' + v + ']');
								}
						}
						
						
                     }
                });

                // Add some values to the list box
				mlb.add('Row', 'row');
				
				mlb.add('1/2', 'one_half');
				
				mlb.add('1/3', 'one_third');
				mlb.add('2/3', 'two_third');
				
				mlb.add('1/4', 'one_fourth');
				mlb.add('3/4', 'three_fourth');
				
				mlb.add('1/6', 'one_sixth');
				mlb.add('5/6', 'five_sixth');
				
				mlb.add('1 column', 'one');
				mlb.add('2 columns', '2_columns');
				mlb.add('3 columns', '3_columns');
				mlb.add('4 columns', '4_columns');
				mlb.add('5 columns', '5_columns');
				mlb.add('6 columns', '6_columns');
				
				return mlb;
             }
             
             return null;
		},

		/**
		 * Returns information about the plugin
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Columns'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('ColumnsSelector', tinymce.plugins.ColumnsSelector);
})();












