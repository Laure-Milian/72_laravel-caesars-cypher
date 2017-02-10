(function() {

	app = {

		init: function() {
			this.listeners();
		},

		listeners: function() {
			$("#btnDecrypt").on('click', this.decrypt.bind(this));
		},

		decrypt: function() {
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
				data: 'offset' : + offset;
			})
			.done(function(response) {
				$('#decrypted_message').html(response);
			})
		}
	}

	app.init();

})();