$(document).ready(function() {
	$('[rel=tooltip]').tooltip();
	
	$('input[type=time]').timepicker({
		showMeridian: false,
		defaultTime: false,
		minuteStep: 10,
		showWidgetOnAddonClick: false
	});
	
	$('input[type=date]').datepicker({
		language: 'sv',
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		todayBtn: "linked"
	});
});