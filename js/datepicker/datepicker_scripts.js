$(document).ready(function(){
    $('#birthday').datepicker({
  	dateFormat: "yy-mm-dd",
  	minDate: "-100y",
  	maxDate: "0d",
  	changeMonth: true,
	changeYear: true
    });
});


$(document).ready(function(){
    $('#date').datepicker({
  	dateFormat: "yy-mm-dd",
  	changeMonth: true,
	changeYear: true
    });
});

$(document).ready(function(){
    $('#date2').datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true
    });
});

