// JavaScript Document
(function() {
    // Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.qtslideshows', {
        createControl: function(n, cm) {
            switch (n) {                
                case 'qtslideshows':
                var c = cm.createSplitButton('qtslideshows', {
                    title : 'QT Slideshow',
                    onclick : function() {
                    }
                    //'class':'mceListBoxMenu'
                });
                c.onRenderMenu.add(function(c, m) {
                    m.onShowMenu.add(function(c,m){
                        jQuery('#menu_'+c.id).height('auto').width('auto');
                        jQuery('#menu_'+c.id+'_co').height('auto').addClass('mceListBoxMenu'); 
                        var $menu = jQuery('#menu_'+c.id+'_co').find('tbody:first');
                        if($menu.data('added')) return;
                        $menu.append('');
                        $menu.append('<div style="padding:0 10px 10px">\
                        <label>Slideshow ID<br />\
                        <input type="text" name="qtslideshowsurl" onclick="this.select()"  /></label>\
                        </div>');
                        jQuery('<input type="button" class="button" value="Insert" />').appendTo($menu)
                                .click(function(){
                                	var uID =  Math.floor((Math.random()*100)+1);
                                	var gurl = $menu.find('input[name=qtslideshowsurl]').val();
									var shortcode = '[qtslideshows id="'+gurl+'"]';
                                    tinymce.activeEditor.execCommand('mceInsertContent',false,shortcode);
                                    c.hideMenu();
									
                                }).wrap('<div style="padding: 0 10px 10px"></div>')
                 
                        $menu.data('added',true); 
                    });
					m.add({title : 'QT Slideshow', 'class' : 'qtslideshows'}).setDisabled(1);
                 });
                // Return the new splitbutton instance
                return c;
                
            }
            return null;
        }
    });
    tinymce.PluginManager.add('qtslideshows', tinymce.plugins.qtslideshows);
})();