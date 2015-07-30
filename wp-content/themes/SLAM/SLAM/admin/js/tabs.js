(function($) {
	$(document).ready(function(){
		$('ul.tabs').each(function() {
			$(this).find('li').each(function(i) {
				$(this).click(function(e){
					e.preventDefault();
					$(this).addClass('current').siblings().removeClass('current')
						.parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')').fadeIn(450);
						$.cookie("curtabz", $(this).prevAll().size()+1);
					
				});
				if($.cookie("curtabz")==undefined || $.cookie("curtabz")==null){
					$(this).click();
					$.cookie("curtabz",1);
				}
			});
		});

	});
})(jQuery)