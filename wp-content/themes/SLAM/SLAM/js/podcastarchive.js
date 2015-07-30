 function newfunction (url) {
	   	var mixcloudExpression = /http\:\/\/www\.mixcloud\.com\/[\w-]{0,150}\/[\w-]{0,150}\/[\w-]{0,1}/ig;  
		if(url.match(mixcloudExpression)){
			var finalurl = ((encodeURIComponent(url)));
			var embedcode ='<iframe data-state="0" class="mixcloudplayer" width="100%" height="166" src="//www.mixcloud.com/widget/iframe/?feed='+finalurl+'&embed_uuid=addfd1ba-1531-4f6e-9977-6ca2bd308dcc&stylecolor=&embed_type=widget_standard" frameborder="0"></iframe><p><a class="btn btn-small pull-right qw-expandplayerinfo">Expand player info <i class="icon-plus-sign"></i></a></p><div class="canc"></div>';	
			$('#PlaylistEmbeddedPlayer').remove();
			$('.qw-playercontainer-inpage').animate({
					  height:'auto',  
				 },
				 500,
				 function(){
					  $(this).append('<div id="PlaylistEmbeddedPlayer">'+embedcode+'</div>');
					  mixcloudExpandableButton();
				});
		}	

		var soundcloudExpression = /(\http:\/\/soundcloud.com\/+([a-zA-Z0-9\/\-]*))/g;  
		var soundcloudExpression2 = /(\https:\/\/soundcloud.com\/+([a-zA-Z0-9\/\-]*))/g;
		if(url.match(soundcloudExpression) || url.match(soundcloudExpression2)){
			var finalurl = ((encodeURIComponent(url)));
			var finalurl = url.replace(':','%3A');	
			$('#PlaylistEmbeddedPlayer').remove();
			$('.qw-playercontainer-inpage').animate(								
				{ height:'176px'},
				500,
				function(){
					  $.getJSON('http://soundcloud.com/oembed?maxheight=160&format=js&url=' + finalurl + '&iframe=true&callback=?', function(response){
						$('.qw-playercontainer-inpage').append('<div id="PlaylistEmbeddedPlayer">'+response.html+'</div>');
				});
					 
			});
		}
		
		var mp3Expression = /\.(mp3)$/i
		if(url.match(mp3Expression)){
			$("a[href$='.mp3']").removeClass('beingplayed');
			$('a#playerlink').attr('href',url);
			actualplaying = url;
			soundManager.unload('igorsound');
			soundManager.destroySound('igorsound');
			threeSixtyPlayer.init();
			$.cookie('smCurrentUrl', url, { expires: 1, path: '/' });	
			$('span.sm2-360btn').click();
			
		}
}