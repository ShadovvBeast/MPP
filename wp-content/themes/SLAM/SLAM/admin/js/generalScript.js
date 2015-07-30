(function($){
	$.testFont = function(val,id){
		
		var name = val.split(" ").join("+");
		$("head").remove("#googletestStyle"+id);
		$("head").append(
		                 "<link href=\"http://fonts.googleapis.com/css?family="+name+"\" rel=\"stylesheet\" type=\"text/css\">\
					        <style type=\"text/css\">\
					            #font-testarea"+id+" h1,#font-testarea"+id+" h2,#font-testarea"+id+" h3,#font-testarea"+id+" h4, #font-testarea"+id+" p {\
					                font-family: \""+val+"\", sans-serif;line-height:1.3em;\
					            }\
					        </style>"
		                 );
		$("#font-testarea"+id).show();
	}
	$(document).ready(function(){
		$(".googlefont-switch").each(function(i,c){
			var that = $(this),
			val = that.val(),
				id = that.attr("id"),
				testarea = $("#font-testarea"+id);
			if(val!=undefined){
				$.testFont(val,id);
			}
		});
		/*					   
		var testarea = $("#font-testarea");              
		if(testarea.attr("data-visible")!="true"){
			testarea.hide();
			$("head").remove("#googletestStyle");
		}else{
			var name = $(".googlefont-switch").val();
			var id = name.split(" ").join("+");
			$("head").remove("#googletestStyle");
			$("head").append(
		                 "<link id=\"googletestStyle\" href=\"http://fonts.googleapis.com/css?family="+id+"\" rel=\"stylesheet\" type=\"text/css\">\
					        <style type=\"text/css\">\
					            #font-testarea h1,#font-testarea h2,#font-testarea h3,#font-testarea h4, #font-testarea p {\
					                font-family: \""+name+"\", sans-serif;line-height:1.3em;\
					            }\
					        </style>"
		                 );
		}
		*/
		
		$(".googlefont-switch").change(function(e){
			$.testFont($(this).val(),$(this).attr("id"));	
			
		});
	});

	$(document).ready(function(){
		$(".image_selector").each(function(i,c){
			var that = $(this);
			

			that.find("input").on('change', function() { 

				$("#group"+$(this).attr("name")+" input" ).each(function(i,c){
					var thos = $(this);
					if (!this.checked) {
						thos.parent().find("img").removeClass("selected");
					}
				});

			    

			    if (this.checked) {
			    	$(this).parent().find("img").addClass("selected");
			    }
			});
		});
		$(".reset_value").on('change', function() { 
				$("#group"+$(this).attr("name")+" input" ).each(function(i,c){
					var thos = $(this);
					
						thos.parent().find("img").removeClass("selected");
					
				});
			});
	});

	// = THE DESCRIPTION SWITCH
	// =====================================================
	$(document).ready(function(){
		$("a.infoSign").click(function(e){

			e.preventDefault();
			var that = $(this);
			var relto = that.attr("data-relto");
			$("#descfor"+relto).toggleClass("open");
		}); 
	});


})(jQuery);
