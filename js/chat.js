$( document ).ready(function() {
    console.log( "ready!" );
    jQuery.ajaxSetup({"cache":false});
    setInterval("loadOldMessages()", 400);
});

var loadOldMessages = function(){
    $('#panel-body').load(document.URL +  ' #panel-body');
}
