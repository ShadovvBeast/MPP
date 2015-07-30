function initializeLabelpro ($) {
	transformlinks();
	
	facebookLikeFix();
	NewYoutubeResize();
	mixcloudExpandableButton();
	loadTwitter();
	playAnyMp3Here();
	if($('#searchsubmit').hasClass('btn')){}else{
		$('#searchsubmit').addClass('btn');
	}
	timeoutHandle = window.setTimeout(function (){
			jQuery.qwFixBlocks(1);
	}, 800);

	$(".qw-keepsize").each(function(){
		$(this).css({width:$(this).width()+"px !important"});
	});
	getTopHeight();
	//quicksand_filter($);
	if($('#ca-container')){
		$('#ca-container').contentcarousel();
	}

	jQuery(window).resize(function() {
	 	timeoutHandlecontentcarousel = window.setTimeout(function (){
				$('#ca-container').contentcarousel();
	    }, 800); // using timeout because it wants to execute this too early!!
	});

	musicPlaylist();
	$( 'a[href*=".jpg"], a[href*="jpeg"], a[href*=".png"], a[href*=".gif"]' ).swipebox();


}


function initializeAfterAjax($){
	jQuery(".filterable-grid").css({opacity:0});
	initializeLabelpro ($);

	$.CSLSactivation();

	if(FireSliderArray != undefined){
		for(var n = 0; n < FireSliderArray.length; n++){
			var fTemp = FireSliderArray[n];
			fTemp();
		}
	}else {
		jQuery("[data-scriptelement]").each(function(i,c){
			var that = $(this);
			var revId = that.attr("data-sliderid");

			if(jQuery("#revScriptFooter"+revId).length <= 0){
				// no such script in footer. delete the original one and put a new one
				var code = that.html();
				//that.remove();
				that.html("");

				//	jQuery("body").append("<script id=\"revScriptFooter"+revId+"\">"+ code +"  </script>");
			}
		});

	}

	// Fix google maps api
	if(jQuery("#qteventscript").length > 0){
		jQuery("body").append("<script id=\"eventscript\">"+ jQuery("#qteventscript").html() +"  </script>");
	}

}

jQuery(document).ready(function ($) {
	initializeLabelpro($);
	jQuery.beingExecuted =0;
	jQuery.QTSPtodoAfterResize();
});
