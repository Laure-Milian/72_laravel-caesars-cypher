(function() {

	app = {

		init: function() {
			this.listeners();
		},

		listeners: function() {
			$("#form").on("submit", this.decrypt.bind(this));
		},

		decrypt: function(event) {
			event.preventDefault();
			let offset = $("#offset").val();
			let id = $("#id").html();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: '/show/' + id,
				type: 'post',
				data: {'offset': offset}
			})
			.done(function(response) {
				$('#decrypted_message').html(response);
			})
		}
	}

	app.init();

})();