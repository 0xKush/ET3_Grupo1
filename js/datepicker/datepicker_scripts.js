  $(document).ready(function(){
    $('#birthday').datepicker({
  	format: "yyyy-mm-dd",
  	startDate: "-100y",
  	endDate: "0d",
  	changeMonth: true,
    changeYear: true
    });
});
