function Booking() {
	if ($('#wholeday').is(':checked')) {
		$('input[type=time]').attr('disabled', true);
	}
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
	
	$('.book-vehicle').click(function(event) {
		event.preventDefault();
		if ($(this).data('href')) {
			window.location = $(this).data('href');
		}
	});
};

var Trailer = Trailer || {};
$(document).ready(function() {
	Trailer.Booking = new Booking();
});
