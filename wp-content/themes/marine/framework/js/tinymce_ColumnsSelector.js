/**
 * Columns selector - WP 3.9 and higher
 *
 */
( function() {
    tinymce.PluginManager.add( 'ColumnsSelector', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'ColumnsSelector', {

            text: 'Columns',
            icon: false,
			type: 'menubutton',
			menu: [
            	{
            		text: 'Row',
            		value: 'row',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/2',
            		value: 'one_half',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/3',
            		value: 'one_third',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '2/3',
            		value: 'two_third',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/4',
            		value: 'one_fourth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '3/4',
            		value: 'three_fourth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/6',
            		value: 'one_sixth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '5/6',
            		value: 'five_sixth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1 column',
            		value: '1_column',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one]' + tinyMCE.activeEditor.selection.getContent() + '[/one]');
            		}
           		},
				{
            		text: '2 columns',
            		value: '2_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_half]' + tinyMCE.activeEditor.selection.getContent() + '[/one_half][one_half][/one_half]');
            		}
           		},
				{
            		text: '3 columns',
            		value: '3_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_third]' + tinyMCE.activeEditor.selection.getContent() + '[/one_third][one_third][/one_third][one_third][/one_third]');
            		}
           		},
				{
            		text: '4 columns',
            		value: '4_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_fourth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_fourth][one_fourth][/one_fourth][one_fourth][/one_fourth][one_fourth][/one_fourth]');
            		}
           		},
				{
            		text: '6 columns',
            		value: '6_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_sixth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth]');
            		}
           		}
           ]

        } );

    } );

} )();