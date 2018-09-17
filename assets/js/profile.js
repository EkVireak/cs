$(document).ready(function(){

	$('.thumnail').click(function(){
		var bg_body = $('body').attr('data-bg');
		var bg = $(this).attr('data-bg');
		if( bg != bg_body ){
			$('#loading').fadeIn();
			var bg_index = $(this).attr('data-index');
			console.log(bg);
			var formData = {
				'action' 		: 'user_setting',
				'username'		: USERNAME,
				'background'	: bg
			}
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: PROCESS_AJAX,
				data: formData,
				success: function(data){
					if(data.success){
						$('body').attr('style', 'background-image:url("'+BASE_URL+'/assets/img/'+bg+'")');
						$('body').attr('data-bg', bg);
						$('.thumnail .tick').hide();
						$('.thumnail #thumnail-tick-'+bg_index).show();
						$('#loading').fadeOut();
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
	});


	$.get(
		BASE_URL+'/users/bongvireak/setting.json',
		function(data, status, jqXHR) {
			console.log(data.background);
			console.log(data);
			console.log(status);
			console.log(jqXHR);
		}
	); 



});