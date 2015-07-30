// only for wordpress__________________________
(function ($) {
//_____________________________________________



/* = Beatport Importer AJAX with XMLRPC
=============================================================*/

/* = main constants
=============================================================*/
$.qtdebug = false;
$.theStep = 0;
$.ececutionInterval = 3000; //ms of interval between execution
$.continuePerfAct = true;
$.statevar = {};
$.BPcheck = $.cookie('BeatMeCookyep');


$.expression = /http:\/\/pro\.beatport\.com\//;

$.msgAfterFirstSend = '<h3>Releases found to import</h3>';

$('a#togglePerfAct').hide();
$('a#resetAction').hide();

$('a#togglePerfAct').click(function(e){
	e.preventDefault();
	var thatb = $(this);
	if($.continuePerfAct == true){
		thatb.addClass('button-primary');
		thatb.html('PAUSED');
		$.continuePerfAct = false;
		$('#finalresult').addClass("updated").html('<p>Process paused</p>');
	}else if($.continuePerfAct == false){
		thatb.removeClass('button-primary');
		thatb.html('Pause Process');
		$.continuePerfAct = true;
		$('#finalresult').addClass("updated").html('<p>Process restarted</p>');
	}

	return false;
});

$('a#resetAction').click(function(e){
	e.preventDefault();
	var thatb = $(this);
	if (confirm("Are you sure?")){
		$("div#response").html('');
		$('#qtbeatimporter').show();
		$('#firstLoader').remove();

	}
	return false;
});



/* = Pause function
=============================================================*/
function pausecomp(ms) {
	ms += new Date().getTime();
	while (new Date() < ms){}
} 

/* = Debug Function
=============================================================*/
function dbg(cont){
	if($.qtdebug==true){
		console.log(cont);
	}
}

/* = Validate Link
=============================================================*/
function validateLink(url){
   if($.expression .test(url)) 
	{
		return true;
	}else{
		return false;
	}
}


/* # Main functions
###################################################################################*/
function performCall(id){
	dbg('performing call for: '+id);
}


/* = Generate the list of items to import
=============================================================*/
function generate_list_toimport(data){
	dbg("ecco i data: \n "+data);
	var parsedData = $.parseJSON(data);
	var idsToImport=new Array(); 

	if(parsedData['results']!==undefined && parsedData['results']!==null){
		
		for (i in parsedData['results']) { 
			idsToImport[i] = parsedData['results'][i]['id'];
		}

		var output = $.msgAfterFirstSend;
		var output = '<br /><a class="button button-primary" id="importAll">Import all</a><br />';
		for (id in idsToImport) {
			output = output +'<tr id="tabEl'+idsToImport[id]+'"><td><img src="'+parsedData['results'][id]['images']['small']['url']+'" /></td>\
			<td>\
			<h3>'+parsedData['results'][id]['catalogNumber']+' - '+parsedData['results'][id]['name']+'</h3>\
			<span class="tableElement" id="responseBox'+idsToImport[id]+'"></span>\
			</td>\
			<td><a href="#'+idsToImport[id]+'" class="button button-primary performImport" data-id="'+idsToImport[id]+'" id="importer'+idsToImport[id]+'">Import this</a></td></tr>';
			$.statevar[idsToImport[id]]=0; // this is the var of each button to know if is performed
		}
	}



	$("div#response").append('<table>'+output+'</table>');


	$("a.performImport").click(function(e){
		e.preventDefault();
		var thisbutton = $(this);
		var theidtoimport = $(this).data("id");
		var responsebox = $("#responseBox"+theidtoimport);
		responsebox.html('<div class="wait" id="firstLoader">&nbsp;</div>');
		if($.continuePerfAct == true){// if you click the stop button it goes to false
			if($.statevar[theidtoimport]==0){
				$.ajax({
					  url: window.QTBPIserviceUrl+'&action=ImportRelease&releaseid='+theidtoimport+'&BPcheck='+$.BPcheck,
					  type: "GET",
					  success:function(result){
					  	//console.log(result);
					  	responsebox.html(result);//('<span class="success">Success: '+result+'</strong>');
				  		thisbutton.addClass('button-disabled');
					  },
					  error: function(request,state,errors){
					    responsebox.html("<strong>Call failed:</strong>"+state+" "+errors);
					    //console.log(errors);
					  }
				});
				$.statevar[theidtoimport]= 1;
			}
		}else{
			$('#finalresult').addClass("error").html('<p>I said: Process is paused. Remove the pause to continue.</p>');
		}
		return false;
	});

	// = Button that launch the entire routine to import all ==============

	function ClicFunc(idt,idsToImport) {
		dbg('eseguo');
		if($.continuePerfAct == true){// if you click the stop button it goes to false
			$("#importer"+idsToImport[idt]).click();
			if(idt == (idsToImport.length-1)){
				$('#finalresult').addClass("updated").html('<p>Congratulations! The process finished successfully!</p>');
				clearInterval($.ClicFunction);
			}
			$.actualId ++;
		}else{
			clearInterval($.ClicFunction);
			$('#finalresult').addClass("error").html('<p>Process is paused. Remove the pause to continue.</p>');
		}
		return true;
	}

	$("a#importAll").click(function(e){
		$.actualId = 0;
		$.idsToImport = idsToImport;
		e.preventDefault();
		if($.continuePerfAct == true){// if you click the stop button it goes to false
			$.ClicFunction = setInterval(function(){ClicFunc($.actualId,$.idsToImport)}, $.ececutionInterval);
			var thisbutton = $(this);
			thisbutton.addClass('button-disabled');
		}else{
			clearInterval(ClicFunction);
			$('#finalresult').addClass("error").html('<p>Process is paused. Remove the pause to continue.</p>');
		}
		return false;
	});
}

/* = Form prmary function
=============================================================*/
function activateStartForm(){

	// reinitialaze the functions and buttons
	$('a#stopPerfAct').removeClass('button-disabled');
	$.continuePerfAct = true;

	var sendButton = $('#BPIsubmit');
	sendButton.click(function(e){
		e.preventDefault();
		var url = $('#BPIurl').val();
		var onlyartist = $('#onlyartistpage').prop('checked');
		sendButton.after('<div class="wait" id="firstLoader">&nbsp;</div>');
		if(validateLink(url)){
			dbg (url);
			url = url.split('http://pro.beatport.com').join('');
			if(onlyartist===true && url.indexOf("/artist/") >= 0){
				
				var serviceUrl = window.QTBPIserviceUrl+'&action=createArtistPage&Url='+url+'&BPcheck='+$.BPcheck;
				$.ajax({
				  url: serviceUrl,
				  type: "GET",
				  success:function(result){
				  	dbg(serviceUrl);
				  	$('#qtbeatimporter').hide();
				  	$('#firstLoader').remove();
				  	$("div#response").html(result);
				  },
				  error: function(request,state,errors){
				     $("div#response").html("<strong>Call failed:</strong>"+state+" "+errors);
				     $('#firstLoader').remove();
				  }
				});//ajax
			}else{
				var serviceUrl = window.QTBPIserviceUrl+'&action=getReleasesId&Url='+url+'&BPcheck='+$.BPcheck;
				$.ajax({
				  url: serviceUrl,
				  type: "GET",
				  success:function(result){
				  	dbg(serviceUrl);
				  	$('#qtbeatimporter').hide();
				  	$('#firstLoader').remove();
				  	$('a#togglePerfAct').show();
					$('a#resetAction').show();
				  	generate_list_toimport(result);
				  },
				  error: function(request,state,errors){
				     $("div#response").html("<strong>Call failed:</strong>"+state+" "+errors);
				     $('#firstLoader').remove();
				  }
				});//ajax
			}
		}else{			
			dbg('Non valido');
		}
	})
	return true;
}



/* = Initialization
=============================================================*/
function qtBeatImporterInitialize(){
	// 1. Associate the submit with the ajax call
	$('#finalresult').removeClass("updated").html('');
	if(activateStartForm()==false){
		return false;
	};
	return true;
}

/* = Main procedure launch
=============================================================*/
$(document).ready(function($){
	var initResult = qtBeatImporterInitialize();
	if(initResult!=true){
		dbg('\n Error initializing');
	}else{
		dbg('\n Correctly initialized');	
	}
});



// only for wordpress__________________________
}(jQuery));
//_____________________________________________