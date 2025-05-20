(function() {
    tinymce.PluginManager.add( 'infoboxleft', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('infoboxleft', {
            title: 'Insert Left Info Box',
            cmd: 'infoboxleft',
            image: url + '/infobox-left.png',
        });

        editor.addCommand('infoboxleft', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });
            if ( selected_text.length === 0 ) {
                alert( 'Please select text to appear inside the box.' );
                return;
            }
            var open_column = '<div class="info-box alignleft">';
            var close_column = '</div>';
            var return_text = '';
            return_text = open_column + selected_text + close_column;
            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });

    });
})();
(function() {
    tinymce.PluginManager.add( 'infoboxright', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('infoboxright', {
            title: 'Insert Right Info Box',
            cmd: 'infoboxright',
            image: url + '/infobox-right.png',
        });

        editor.addCommand('infoboxright', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });
            if ( selected_text.length === 0 ) {
                alert( 'Please select text to appear inside the box.' );
                return;
            }
            var open_column = '<div class="info-box alignright">';
            var close_column = '</div>';
            var return_text = '';
            return_text = open_column + selected_text + close_column;
            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });

    });
})();
(function() {
    tinymce.PluginManager.add( 'infoboxcenter', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('infoboxcenter', {
            title: 'Insert Full Width Info Box',
            cmd: 'infoboxcenter',
            image: url + '/infobox-center.png',
        });

        editor.addCommand('infoboxcenter', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });
            if ( selected_text.length === 0 ) {
                alert( 'Please select text to appear inside the box.' );
                return;
            }
            var open_column = '<div class="info-box aligncenter">';
            var close_column = '</div>';
            var return_text = '';
            return_text = open_column + selected_text + close_column;
            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });

    });
})();