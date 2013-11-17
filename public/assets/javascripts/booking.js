function Booking() {
	$('#wholeday').change(function(event) {
		if ($(this).is(':checked')) {
			$('input[type=time]').attr('disabled', true);
		} else {
			$('input[type=time]').removeAttr('disabled');
		}
	});
	
	if (!Modernizr.inputtypes.date) {
		$('.start-date').datepicker('setStartDate', new Date()).on('changeDate', function(event) {
			$('.end-date').datepicker('setStartDate', event.date);
		});
	}
};

var Trailer = Trailer || {};
$(document).ready(function() {
	Trailer.Booking = new Booking();
});
