(function() {

	app = {

		init: function() {
			//this.listeners();
		},

		listeners: function() {
			$("#btnDecrypt").on('click', this.decrypt.bind(this));
		},

		decrypt: function() {
			let offset = $("#offset").val();
			let id = $("#id").val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: '/decrypt/' + id + '/' + offset,
				type: 'post'
			})
			.done(function(response) {
				$("#decrypted_message").html(response);
			})
		}
	}

	app.init();

})();