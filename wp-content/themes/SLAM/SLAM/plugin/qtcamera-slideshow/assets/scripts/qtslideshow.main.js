// javascript
//Updated responsiveness on 1 april 2014 // qantumthemes.com
jQuery(function($){
	$.QTsliderheight = Array();
	function getSlideshowProportion(widths,heights){
		var prop = 900/widths*heights;
		return prop;
	}
	$.cameraSliderResize = function(){
		$( ".cameraslideshow-box" ).each(function( index ) {
			var that = $(this);
		 	var qid = that.attr('id');
		 	var proportion = that.parent().width()/900;
		 	var mynewheight =  $.QTsliderheight[qid] * proportion;
			that.attr("data-maxheight",mynewheight)
					.css({"height":mynewheight}).height(mynewheight);
		});
	}
	$.cameraSliderActivation = function(){
		$( ".cameraslideshow-box" ).each(function( index ) {
			var that = $(this);
		 	var qid = that.attr('id');
		 	var oldattr = that.attr("data-maxheight");
		 	that.attr("data-maxheight",oldattr.split("px").join(""));
		 	$.QTsliderheight[qid] = that.attr("data-maxheight");
		 	var proportion = that.parent().width()/900;
		 	var mynewheight =  $.QTsliderheight[qid] * proportion;
		 	var imgpath = that.attr('data-filespath');
			$(this).camera({
				pagination: false,
				thumbnails: false,
				imagePath:imgpath
				,height: mynewheight.toString() //added responsiveness
			});
		});
	} 
	$.CSLSactivation = function () {
		 $.cameraSliderActivation();
	}
	$.CSLSres = function () {
		 $.cameraSliderResize();
	}
	
	var timeoutHandle = window.setTimeout(function (){
			$.CSLSactivation();
    }, 1000); 
    $(window).resize(function() {
		window.clearTimeout(timeoutHandle);
	 	timeoutHandle = window.setTimeout(function (){
 			$.cameraSliderResize();
        }, 1000); 
	});
});