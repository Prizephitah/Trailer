$(document).ready(function() {
	$('[rel=tooltip]').tooltip();
	
	if (!Modernizr.inputtypes.time) {
		$('input[type=time]').timepicker({
			showMeridian: false,
			defaultTime: false,
			minuteStep: 10,
			showWidgetOnAddonClick: false
		});
	}
	
	if (!Modernizr.inputtypes.date) {
		$('input[type=date]').datepicker({
			language: 'sv',
			calendarWeeks: true,
			autoclose: true,
			todayHighlight: true,
			todayBtn: "linked"
		});
	}
});