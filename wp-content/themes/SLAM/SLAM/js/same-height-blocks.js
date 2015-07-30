// JavaScript Document
(function($){
	function getTopHeight() {
			var currentTallest = 0;
			function updateTallest(object){	
				actualHeight = object.height();
				if(currentTallest<actualHeight){
					currentTallest = actualHeight;
				}
				return currentTallest;	
			}
			var totalobjects = $('.equalizeblocks').length;
			var indexx  = 0;
			$('.equalizeblocks').each(function(index) {
						var thisblock = $(this);
						var thisimg = $(this).find('img');	
						indexx++;
						if(thisimg.length==0){
							var resultsize = updateTallest(thisblock);	
						}else{
							thisimg.load(function() {
								var resultsize = updateTallest(thisblock);	
							});	
	
						}
						if(indexx==totalobjects){
							$('.equalizeblocks').each(function(index) {
											$(this).css({height:resultsize});						   
							});
						}
			 });					
	}


	$(window).resize(function() {
	 getTopHeight();
	});
 	getTopHeight();
})(jQuery);