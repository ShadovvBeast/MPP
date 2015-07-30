// JavaScript Document
(function() {
    // Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.dws_icons', {
        createControl: function(n, cm) {
            switch (n) {                
                case 'dws_icons':
                var c = cm.createButton('dws_icons', {
                    title : 'Icons',
                    onclick : function() {
                        tb_show('Select icons', qt_shortcodes_plugin_url+'assets/js/plugins/icons.html?TB_iframe=1');
                    }
                });

        
                // Return the new splitbutton instance
                return c;
                
            }
            return null;
        }
    });
    tinymce.PluginManager.add('dws_icons', tinymce.plugins.dws_icons);
})();

