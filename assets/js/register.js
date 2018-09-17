$(document).ready(function() {

console.log('%cCS System! ', 'color: #C4620D; font-size:50px;', '\n by Ek Vireak');
// console.log('%c Oh my heavens! ', 'background: #222; color: #bada55; font-size:100px;', 'more text');

	$('#btn-back').click(function(){
		var step = Number($('input[name=step]').val());

		if(step > 1){
			step--;
			if( step == 1 ){
				$(this).fadeOut();
			}
			$('input[name=step]').val(step);
			$('h4.step-number').text(step);
			$('#form-step-2').slideUp().removeClass('step-active');
			$('#form-step-1').slideDown().addClass('step-active');
			$('input[type=submit]').val('Next');
		}
	});
	$('form#form-register').submit(function() {
		var step = Number($('input[name=step]').val());

		var firstname 	= $('input[name=firstname]').val();
		var lastname 	= $('input[name=lastname]').val();
		var birth_day 	= Number($('select[name=birth-day]').val());
		var birth_month = Number($('select[name=birth-month]').val());
		var birth_year 	= Number($('input[name=birth-year]').val());
		var gender 		= $('select[name=gender]').val();

		var username 			= $('input[name=username]').val();
		var email 				= $('input[name=email]').val();
		var password 			= $('input[name=password]').val();
		var cpassword 	= $('input[name=cpassword]').val();
		var accept_term 		= $('input[name=accept-term]')[0].checked;

		var firstname_error = false;
		var lastname_error = false;
		var birth_day_error = false;
		var birth_month_error = false;
		var birth_year_error = false;
		var gender_error = false;

		var username_error = false;
		var email_error = false;
		var password_error = false;
		var cpassword_error = false;
		var accept_term_error = false;

		var date = new Date();
		// console.log(date);
		// console.log(date.getDay());
		// console.log(date.getDate());
		// console.log(date.getMonth()+1);
		// console.log(date.getYear()+1900);
		var corrent_year = date.getYear()+1900;

		if( step == 1 ){
			if( firstname == "" ){
				$('input[name=firstname]').addClass('focus-error');
				$('#firstname-error').text('Firstname is required!').slideDown();
				firstname_error = true;
			}
			else{
				$('input[name=firstname]').removeClass('focus-error');
				$('#firstname-error').slideUp().text('');
				firstname_error = false;
			}
			if( lastname == "" ){
				$('input[name=lastname]').addClass('focus-error');
				$('#lastname-error').text('Lastname is required!').slideDown();
				lastname_error = true;
			}
			else{
				$('input[name=lastname]').removeClass('focus-error');
				$('#lastname-error').slideUp().text('');
				lastname_error = false;
			}
			if( birth_day == "" || isNaN(birth_day) ){
				$('#birth-day').addClass('focus-error');
				birth_day_error = true;
			}
			else{
				$('#birth-day').removeClass('focus-error');
				birth_day_error = false;
			}
			if( birth_month == "" || isNaN(birth_month) ){
				$('#birth-month').addClass('focus-error');
				birth_month_error = true;
			}
			else{
				$('#birth-month').removeClass('focus-error');
				birth_month_error = false;
			}
			if( birth_year == "" || isNaN(birth_year) || birth_year < 1900 || birth_year > corrent_year){
				$('#birth-year').addClass('focus-error');
				birth_year_error = true;
			}
			else{
				$('#birth-year').removeClass('focus-error');
				birth_year_error = false;
			}
			if( gender == "" ){
				$('#gender').addClass('focus-error');
				gender_error = true;
			}
			else{
				$('#gender').removeClass('focus-error');
				gender_error = false;
			}

			if( !firstname_error && !lastname_error && !birth_day_error && !birth_month_error && !birth_year_error && !gender_error){
				step++;
				$('input[name=step]').val(step);
				$('h4.step-number').text(step);
				$('#form-step-1').slideUp().removeClass('step-active');
				$('#form-step-2').slideDown().addClass('step-active');
				$('input[type=submit]').val('Register');
				$('#btn-back').fadeIn();
			}

		}
		else if( step == 2 ){
			if( username == "" ){
				$('#username-error').text('Username is required!').slideDown();
				username_error = true;
			}
			else{
				$('#username-error').slideUp().text('');
				username_error = false;
			}
			if( email == "" ){
				$('#email-error').text('Email is required!').slideDown();
				email_error = true;
			}
			else{
				$('#email-error').slideUp().text('');
				email_error = false;
			}

			if( password == "" ){
				$('#password-error').text('Password is required!').slideDown();
				password_error = true;
			}
			else{
				$('#password-error').slideUp().text('');
				password_error = false;
			}
			if( cpassword == "" ){
				$('#cpassword-error').text('Confirm Password is required!').slideDown();
				cpassword_error = true;
			}
			else if( cpassword != password ){
				$('#cpassword-error').text('Password not match!').slideDown();
				cpassword_error = true;
			}
			else{
				$('#cpassword-error').slideUp().text('');
				cpassword_error = false;
			}

			if( !accept_term ){
				$('#accept-term-error').text('You must accept to our Term & Condition in order to use our System!').slideDown();
				accept_term_error = true;
			}
			else{
				$('#accept-term-error').slideUp().text('');
				accept_term_error = false;
			}

			if( !username_error && !email_error && !password_error && !cpassword_error && !accept_term_error ){
				step++;
				var formData = {
					'action'		: 'register',
					'firstname' 	: firstname,
					'lastname' 		: lastname,
					'birth-day' 	: birth_day,
					'birth-month' 	: birth_month,
					'birth-year' 	: birth_year,
					'gender' 		: gender,
					'username'		: username,
					'email'			: email,
					'password' 		: password,
					'cpassword' 	: cpassword,
					'accept-term' 	: accept_term
				};

				$.ajax({
					method: 'POST',
					dataType: 'json',
					url: CS_AJAX,
					data: formData,
					success: function(data){
						if(data.success){
							window.location = data.redirect;
							alert('success');
						}
						else{
							alert('Error');
						}
					},
					error: function (jqxhr, textStatus, errorThrown) {
				        console.log(jqxhr);
				        console.log(textStatus);
				        console.log(errorThrown);
				    }
				});
			}
		}
		else{
			alert('Something went wrong! Please try again.');
			// window.location = BASE_URL+'/';
		}

		event.preventDefault();

    });
});