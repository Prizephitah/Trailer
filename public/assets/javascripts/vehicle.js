function Vehicle() {
	$('.admin-vehicle').click(function(event) {
		event.preventDefault();
		if ($(this).data('href')) {
			window.location = $(this).data('href');
		}
	});
	$('.delete-vehicle').click(function(event) {
		event.preventDefault();
		$('body').append(
			$('<form>', { action: $(this).data('href'), method: 'post', id: 'vehicle-delete-form'}).append(
				$('<input>', { type: 'hidden', name: '_method', value: 'DELETE' }),
				$('<input>', { type: 'hidden', name: '_token', value: $('#csrf-token').val() })
			)
		);
		$('#vehicle-delete-form').submit();
	});
};

var Trailer = Trailer || {};
$(document).ready(function() {
	Trailer.Vehicle = new Vehicle();
});