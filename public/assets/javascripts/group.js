function Group() {
	$('.list-groups').click(function(event) {
		event.preventDefault();
		if ($(this).data('href')) {
			window.location = $(this).data('href');
		}
	});
	$('.admin-group').click(function(event) {
		event.preventDefault();
		if ($(this).data('href')) {
			window.location = $(this).data('href');
		}
	});
	$('.create-group').click(function(event) {
		event.preventDefault();
		if ($(this).data('href')) {
			window.location = $(this).data('href');
		}
	});
	$('.add-vehicle-group').click(function(event) {
		event.preventDefault();
		if ($(this).data('href')) {
			window.location = $(this).data('href');
		}
	});
	$('.delete-group').click(function(event) {
		event.preventDefault();
		$('body').append(
			$('<form>', { action: $(this).data('href'), method: 'post', id: 'group-delete-form'}).append(
				$('<input>', { type: 'hidden', name: '_method', value: 'DELETE' }),
				$('<input>', { type: 'hidden', name: '_token', value: $('#csrf-token').val() })
			)
		);
		$('#group-delete-form').submit();
	});
	$('.join-group').click(function(event) {
		$('body').append(
			$('<form>', { action: $(this).data('href'), method: 'post', id: 'group-join-form'}).append(
				$('<input>', { type: 'hidden', name: '_token', value: $('#csrf-token').text() })
			)
		);
		$('#group-join-form').submit();
	});
	$('.leave-group').click(function(event) {
		$('body').append(
			$('<form>', { action: $(this).data('href'), method: 'post', id: 'group-leave-form'}).append(
				$('<input>', { type: 'hidden', name: '_token', value: $('#csrf-token').text() })
			)
		);
		$('#group-leave-form').submit();
	});
};

var Trailer = Trailer || {};
$(document).ready(function() {
	Trailer.Group = new Group();
});
