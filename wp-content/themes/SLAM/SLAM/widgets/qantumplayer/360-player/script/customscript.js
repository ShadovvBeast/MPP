// JavaScript Document



	/*

	

	

	

	

	

	

	

	

	

	

					not used, this code has been embedded into main_theme_script.js

	

	

	

	

	

	

	

	

	

	

	

	

	

	*/

	

	

	

	soundManager.onready(threeSixtyPlayer.init);

	var actualplaying = '';

	



	function setquantumvars(vars){

		

		$('#mainplayer div.playerinfodata div.player-tracktitle').empty();

		$('#mainplayer div.playerinfodata div.player-trackauthor').empty();

		$('#mainplayer div.playerinfodata div.player-buylink').empty();

		

		if(vars['tracktitle']!='' && vars['tracktitle']!=undefined){

			$('#mainplayer div.playerinfodata div.player-tracktitle').add().html('Title: '+vars['tracktitle']);

		}

		if(vars['trackauthor']!='' && vars['trackauthor']!=undefined){

			$('#mainplayer div.playerinfodata div.player-trackauthor').add().html('By: '+vars['trackauthor']);

		}

		if(vars['buylink']!='' && vars['buylink']!=undefined){

			$('#mainplayer div.playerinfodata div.player-buylink').add().html('Buy here: '+vars['buylink']);

		}

	}

	

	var linkSelector = $("a[href$='.mp3']");

	

	linkSelector.not('.playable-mp3-link').addClass('playable-mp3-link');

	

	linkSelector.click(function(event) {

		event.preventDefault();

		linkSelector.not(this).removeClass('beingplayed');

		var url = $(this).attr("href");

		$.cookie('smCurrentUrl', url, { expires: 100, path: '/' });

		if(actualplaying != url){

			$('span.sm2-360btn').click();

			$("a#playerlink").prop("href",url);	

			soundManager.unload('igorsound');

			soundManager.destroySound('igorsound');

			threeSixtyPlayer.init();

			actualplaying = url;

			$(this).addClass("beingplayed");	

			$.cookie('smCurrentUrl', url, { expires: 100, path: '/' });

			$.cookie('smState', 'playing', { expires: 100, path: '/' });

			$('span.sm2-360btn').click();

		}else{

			$(this).toggleClass('beingplayed');

			soundManager.togglePause('igorsound');

		}

	});	

	

	var playerlinkSelector = $("a#playerlink");

	if(playerlinkSelector.attr('href')==''){

		playerlinkSelector.attr('href',tracks[0]);

	}

	

	

	(function($){

	$(window).load(function(){

		$("#content_1").mCustomScrollbar({

			scrollButtons:{

				enable:true

				}

			});

		});

	})(jQuery);

	

		



	$('a.qw-musicplayer-label').click(function(){

		var wrapselector = $('#wrap-playlist');					   

		var Wplaylistheight = wrapselector.height();

		if(Wplaylistheight>0){

			wrapselector.animate({height:0,'margin-bottom':'0px','margin-top':'0px'},350);

		}else{

			wrapselector.animate({height:260,'margin-bottom':'15px','margin-top':'10px'},350);

		}

	});

	

	

	

	

	

	

$(document).ready(function() {

						   

		



			

        soundManager.onready(function() {

									  

					

				

					

					$("#qw-volumeFader").click(function(e){

														

						var parentOffset = $(this).offset();

						//var parentOffset = $(this).parent().offset();

						

						var relX = Math.floor(e.pageX - parentOffset.left);	  

						

						

						var vol = Math.ceil( (relX-14)/14)+1;

						

					

						

						console.log(vol);

						if(vol >=1 && vol <=10){

							$("#qw-volumeFader-bg").css("left",-(140-(14*vol)));

							if(threeSixtyPlayer != undefined){

								soundManager.setVolume('igorsound',vol*10);

								$.cookie('smVolume', vol*10, { expires: 1, path: '/' });		

							}

						}

					}).mouseover(function(){

						$(this).css("cursor","pointer");

					});	  

									  

					



					

					var trackIndex = 0;

					

					

					for(count = 0; count < tracks.length; count++) {

						if(tracks[count]==$("a#playerlink").prop("href")){

								$('#trackid-'+count).addClass('beingplayed');

								trackIndex = parseInt(count);

						}

						

					}

					

					

					$('.qw-playertrack-link').click(function(){

						var trackIndex = parseInt ($(this).attr('data-id'));

					});



					$("a#nextTrack").click(function(event) 

					{

						

								for(count = 0; count < tracks.length; count++) {

									if(tracks[count]==$("a#playerlink").prop("href")){

											$('#trackid-'+count).addClass('beingplayed');

											trackIndex = parseInt(count);

									}

								}

								$("a[href$='.mp3']").removeClass('beingplayed');

								$('span.sm2-360btn').click();

								trackIndex = trackIndex+1;

								if(trackIndex>=tracks.length){

									trackIndex=0;

								}

								if(trackIndex<0){

									trackIndex = tracks.length-1;

								}

								var nextTrackUrl = tracks[trackIndex];

								$("a#playerlink").prop("href",nextTrackUrl);		

								actualplaying = nextTrackUrl;

								soundManager.unload('igorsound');

								soundManager.destroySound('igorsound');

								threeSixtyPlayer.init();

								$('#trackid-'+trackIndex).addClass('beingplayed');

								$.cookie('smCurrentUrl', nextTrackUrl, { expires: 1, path: '/' });	

								$('span.sm2-360btn').click();

					});

					

					

					$("a#prevTrack").click(function(event) 

					{

								for(count = 0; count < tracks.length; count++) {

									if(tracks[count]==$("a#playerlink").prop("href")){

											$('#trackid-'+count).addClass('beingplayed');

											trackIndex = parseInt(count);

									}

								}

								$("a[href$='.mp3']").removeClass('beingplayed');

								$('span.sm2-360btn').click();

								trackIndex = trackIndex-1;

								if(trackIndex>=tracks.length){

									trackIndex=0;

								}

								if(trackIndex<0){

									trackIndex = tracks.length-1;

								}

								var nextTrackUrl = tracks[trackIndex];

								$('#trackid-'+trackIndex).addClass('beingplayed');

								$("a#playerlink").prop("href",nextTrackUrl);	

								actualplaying = nextTrackUrl;

								soundManager.unload('igorsound');

								soundManager.destroySound('igorsound');

								threeSixtyPlayer.init();

								$.cookie('smCurrentUrl', nextTrackUrl, { expires: 1, path: '/' });

								$('span.sm2-360btn').click();

					});

				

				

				

			//======================== AUTO RESUME PLAYING TRACK =========================	

			

			/**/

			if($.cookie('smVolume')==null){

			$.cookie('smVolume', 100, { expires: 1, path: '/' });	

			soundManager.setVolume('igorsound',$.cookie('smVolume'));

			

		}

			var actvol = $.cookie('smVolume');

			$("#qw-volumeFader-bg").css("left",-(140-(1.4*actvol)));

		

		

			if($.cookie('smState')!=null){

					if($.cookie('smState')=='playing'){

						//alert('i was playing');

						if($.cookie('smCurrentUrl')!=null){

							//alert($.cookie('smCurrentUrl'));	

										

										var nextTrackUrl = $.cookie('smCurrentUrl');

										$('span.sm2-360btn').click();

										var nextTrackUrl = $.cookie('smCurrentUrl');

										$("a#playerlink").prop("href",nextTrackUrl);		

										actualplaying = nextTrackUrl;

										soundManager.unload('igorsound');

										soundManager.destroySound('igorsound');

										threeSixtyPlayer.init();

										

										for(count = 0; count < tracks.length; count++) {

											//alert($("a#playerlink").prop("href")+'-'+tracks[count]);

											

											if(tracks[count]==$("a#playerlink").prop("href")){

													$('#trackid-'+count).addClass('beingplayed');

													

													trackIndex = parseInt(count);

											}

											

										}



										$('span.sm2-360btn').click();



						}

														   

					}

				}

			

							

					

			

		

    	});

		//================================================================================================================================			







		 

		threeSixtyPlayer.events.play = function(){ 

				soundManager.setVolume('igorsound',$.cookie('smVolume'));

				$.cookie('smState', 'playing', { expires: 1, path: '/' });

		}





		threeSixtyPlayer.events.pause = function(){ 

				

				$.cookie('smState', 'pause', { expires: 1, path: '/' });	

		}

		threeSixtyPlayer.events.stop = function(){ 

				var whatToPlay = tracks[trackIndex];

				$.cookie('smState', 'stop', { expires: 1, path: '/' });	

		}

		

		



		$.cookie('alreadyPlayed', 'no', { expires: 1, path: '/' });

		

		

	$('a#testplay').click(function(){

	  		soundManager.setPosition('igorsound',116000);

	   });









});





