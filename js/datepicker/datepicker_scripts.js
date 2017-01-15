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
	minDate: "0d",
  	maxDate: "+1y",
  	changeMonth: true,
	changeYear: true
    });
});

$(document).ready(function(){
    $('#date2').datepicker({
	dateFormat: "yy-mm-dd",
	minDate: "0d",
  	maxDate: "+1y",
	changeMonth: true,
	changeYear: true
    });
});

$(document).ready(function(){
    $('#dateev').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: "0d",
    maxDate: "+1y",
    changeMonth: true,
  changeYear: true
    });
});

$(document).ready(function(){
    $('#dateev2').datepicker({
  dateFormat: "yy-mm-dd",
  minDate: "0d",
    maxDate: "+1y",
  changeMonth: true,
  changeYear: true
    });
});

