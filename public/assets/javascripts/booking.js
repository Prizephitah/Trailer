function Booking() {
	$('#wholeday').change(function(event) {
		if ($(this).is(':checked')) {
			$('input[type=time]').attr('disabled', true);
		} else {
			$('input[type=time]').removeAttr('disabled');
		}
	})
};

var Trailer = Trailer || {};
$(document).ready(function() {
	Trailer.Booking = new Booking();
});
