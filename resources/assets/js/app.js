(function() {

	app = {

		init: function() {
			this.listeners();
		},

		listeners: function() {
			$("#btnDecrypt").on('click', this.decrypt.bind(this));
		},

		decrypt: function() {
			var offset = $("#offset").val();
			var id = $("#id").val();
			console.log(id);
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: '/decrypt/' + id,
				type: 'post'
			})
			.done(function(response) {
				$("#decrypted_message").html(response);
			})

			// $.ajax({
			// 	url: '/products/subtract/' + id,
			// 	type: 'post'
			// })
			// .done(function(response) {
			// 	$("#stock").html(response);
			// });
		}
	}

	app.init();

})();