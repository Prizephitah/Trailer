function Group() {
	$('.admin-group').click(function(event) {
		event.preventDefault();
		if ($(this).data('href')) {
			window.location = $(this).data('href');
		}
	});
	$('.delete-group').click(function(event) {
		event.preventDefault();
		$('form').after(
			$('<form>', { action: $(this).data('href'), method: 'post', id: 'group-delete-form'}).append(
				$('<input>', { type: 'hidden', name: '_method', value: 'DELETE' })
			)
		);
		$('#group-delete-form').submit();
	});
};

var Trailer = Trailer || {};
$(document).ready(function() {
	Trailer.Group = new Group();
});
