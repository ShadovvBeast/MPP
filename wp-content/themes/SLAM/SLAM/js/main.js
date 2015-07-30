window: var console = window.console || { log: function() {} };

if(typeof($) == "undefined"){
	var $ = jQuery.noConflict();
}


jQuery.fn.qtGetUrlParameter = function(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}     


function initializeLabelpro ($) {
	
	if(typeof($) == "undefined"){
		var $ = jQuery.noConflict();
	}
	
	transformlinks();
	facebookLikeFix();
	NewYoutubeResize();
	mixcloudExpandableButton();
	loadTwitter();
	playAnyMp3Here();
	if(!jQuery('#searchsubmit').hasClass('btn')){
		jQuery('#searchsubmit').addClass('btn');
	} else {
		//console.log("Msg:::::::::::::::::::::::"+$('#searchsubmit'));
	}
	timeoutHandle = window.setTimeout(function (){
			jQuery.qwFixBlocks(1);
	}, 800);

	jQuery(".qw-keepsize").each(function(){
		jQuery(this).css({width:jQuery(this).width()+"px !important"});
	});
	getTopHeight();
	//quicksand_filter($);
	if(jQuery('#ca-container')){
		jQuery('#ca-container').contentcarousel();
		setTimeout(function(){
            jQuery('a.ca-close').click();
      },500);
	}

	jQuery(window).resize(function() {
	 	timeoutHandlecontentcarousel = window.setTimeout(function (){
				jQuery('#ca-container').contentcarousel();
	    }, 800); // using timeout because it wants to execute this too early!!
	});
	musicPlaylist();
	jQuery( 'a[href*=".jpg"], a[href*="jpeg"], a[href*=".png"], a[href*=".gif"]' ).swipebox();
	jQuery.fn.qtPlaceholderFix();
}


function initializeAfterAjax($){

	if(typeof($) == "undefined"){
	var $ = jQuery.noConflict();
}



	jQuery("body").delay(800).promise().done(function(){
		jQuery.fn.qtPlaceholderFix();
		jQuery(".filterable-grid").css({opacity:0});
		initializeLabelpro ($);
		$.CSLSactivation();
		if(jQuery.qwRevCss.html() != undefined){
			jQuery("body").append('<style>'+jQuery.qwRevCss.html().split(";").join(" !important;")+"</style>");
		}
		// Fix google maps api
		if(jQuery("#qteventscript").length > 0){
			jQuery("body").append("<script id=\"eventscript\">"+ jQuery("#qteventscript").html() +"  </script>");
		}
		transformlinks();
		jQuery("#ajaxContainer").find("script").each(function(i,c) {
	      jQuery.globalEval(jQuery(this).text());
	    });
	    if(typeof(FireSliderArray) === "Array"){
			for(var n = 0; n < FireSliderArray.length; n++){
				var fTemp = FireSliderArray[n];
				fTemp();
			}
		}
		if(typeof(jQuery.fn.qtAjaxRevslider) === "function"){
		 	jQuery.fn.qtAjaxRevslider();
		}

		
		if(typeof('FB') !== "undefined"){
			FB.XFBML.parse();
		}
		if(typeof('twttr') !== "undefined"){
			twttr.widgets.load();	
		}

		if(typeof('stButtons') !== "undefined"){ // enable only in case of ShareThis Plugin installed
			//stButtons.locateElements();	
		}
		if(typeof('gapi') !== "undefined"){
			gapi.plusone.go(); 
		}
		
		
		if(typeof(window.vc_js) === "function"){
			window.vc_js();
		}


		if(jQuery('#slider').length > 0){
			jQuery('#slider').nivoSlider({
			pauseTime:3000,
			effect:'boxRandom',
			animSpeed:700,
			directionNav:true,
			controlNav: false
			});
		}

		if($(".nav-collapse").hasClass("in")){
			$("a.btn.btn-navbar").click();
		}
		
	});
}

jQuery(document).ready(function ($) {
	initializeLabelpro($);
	jQuery.beingExecuted =0;
	jQuery.QTSPtodoAfterResize();
});
