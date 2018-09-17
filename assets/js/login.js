$(document).ready(function() {

	$('form#form-login').submit(function() {

		var username 			= $('input[name=username]').val();
		var password 			= $('input[name=password]').val();

		var username_error = false;
		var password_error = false;

		if( username == "" ){
			$('#username').addClass('focus-error');
			username_error = true;
		}
		else{
			$('#username').removeClass('focus-error');
			username_error = false;
		}
		if( password == "" ){
			$('#password').addClass('focus-error');
			password_error = true;
		}
		else{
			$('#password').removeClass('focus-error');
			password_error = false;
		}

		if( !username_error && !password_error ){

			var formData = {
				'action'		: 'login',
				'username'		: username,
				'password' 		: password
			};

			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: CS_AJAX,
				data: formData,
				success: function(data){
					console.log(data);
					if(data.success){
						window.location = data.redirect;
						// alert('success');
					}
					else{
						$('#login-error').text(data.error.login).slideDown();
						
						// alert('Error');
					}
				},
				error: function (jqxhr, textStatus, errorThrown) {
			        console.log(jqxhr);
			        console.log(textStatus);
			        console.log(errorThrown);
			    }
			});
		}

		event.preventDefault();

    });
});