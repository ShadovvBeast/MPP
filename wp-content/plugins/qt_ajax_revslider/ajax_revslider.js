
/*
*
*   Dynamically load revolution slider if present
*
*
*
*/

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


var QTnnc = jQuery("#enableRsAjax").attr("data-nnc"),
    QTadmu = jQuery("#enableRsAjax").attr("data-admu");

jQuery.fn.QTajaxRevsliderFun = function(obj) {
    if(jQuery.isQantumDebug == "true"){
        console.log("QantumThemes Debug Message -> Slider obj ID: "+obj.id);
    }

    var content = "";
    data = {};
    data.action = 'revslider_ajax_call_front';
    data.client_action = 'get_slider_html';
    data.token = QTnnc;
    data.type = obj.type;
    data.id = obj.id;
    data.aspectratio = obj.aspectratio;
    // SYNC AJAX REQUEST
    jQuery.ajax({
        type:"post",
        url: QTadmu,
        dataType: 'json',
        data:data,
        async:false,
        success: function(ret, textStatus, XMLHttpRequest) {
            if(ret.success == true)
                content = ret.data;                             
        },
        error: function(e) {
        }
    });
    return content;                         
};

QTajaxRevslider = jQuery.fn.QTajaxRevsliderFun;

/*   Ajax Revolution Slider
    VERY IMPORTANT: the version of revolution slider is a custom one! Do not update with official one because it will not work
=================================================================*/

jQuery.fn.qtAjaxRevslider = function(){
    jQuery.isQantumDebug = jQuery.fn.qtGetUrlParameter('debug');
    jQuery("[data-qwrevslider]").each(function(i,c){
        var that = jQuery(this),
            sliderId = that.attr("data-qwrevslider");

        if(jQuery.isQantumDebug == "true"){
            console.log("QantumThemes Debug Message -> PHASE 1 Slider obj ID: "+sliderId);
        }
        that.html(QTajaxRevslider({id:sliderId})); 
    });
}




jQuery.fn.qtAjaxRevslider(); // This must go in the Advanced Ajax page Load!!!