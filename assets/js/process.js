$(document).ready(function() {
	// var i = 0;
	// function getId(id){
	// 	var comment_id = id;
	// 	var formData = {
	// 		'action'		: 'handle_like',
	// 		'comment_id'	: comment_id
	// 	};
	// 	$.ajax({
	// 		method	: 'POST',
	// 		dataType: 'json',
	// 		url		: SERVICES_AJAX,
	// 		data: formData,
	// 		success: function(data){
	// 			console.log(data);
	// 			if(data.success){
	// 				$('#LIKE_COUNT_'+comment_id+'').text(data.like_count);
	// 			}
	// 			else{
	// 				alert('error');
	// 			}
	// 		},
	// 		error: function (jqxhr, textStatus, errorThrown) {
	// 	        console.log(jqxhr);
	// 	        console.log(textStatus);
	// 	        console.log(errorThrown);
	// 	    }
	// 	});
	// }
	// function handle_like(){
	// 	// i++;
	// 	// console.log(i);
	// 	getId(3);
		
	// }
	// setInterval(handle_like, 1000);
    
	$('form#form-comment').submit(function(event){
		var user_id = Number($('input[name=user-id]').val());
		var comment_text = $('input[name=comment-text]').val();

		if( comment_text == "" )
			$('textarea[name=comment]').addClass('focus-error');
		else{
			$('textarea[name=comment]').removeClass('focus-error');

			var formData = {
				'action'	: 'comment',
				'user_id'	: user_id,
				'comment_text'	: comment_text
			};
			console.log(formData);
			$.ajax({
				method	: 'POST',
				dataType: 'json',
				url		: PROCESS_AJAX,
				data: formData,
				success: function(data){
					console.log(data);
					if(data.success){
						window.location = data.redirect;
					}
					else{
						alert('error');
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
	$('form.form-reply').submit(function(event){
		var comment_id = $(this).attr('comment-id');
		var user_id = Number($('input[name=user-id]').val());
		var reply_text = $('input[name=reply-text_'+comment_id+']').val();

		if( reply_text == "" )
			$('textarea[name=comment]').addClass('focus-error');
		else{
			$('textarea[name=comment]').removeClass('focus-error');

			var formData = {
				'action'	: 'reply',
				'user_id'	: user_id,
				'comment_id'	: comment_id,
				'reply_text'	: reply_text
			};
			console.log(formData);
			$.ajax({
				method	: 'POST',
				dataType: 'json',
				url		: PROCESS_AJAX,
				data: formData,
				success: function(data){
					console.log(data);
					if(data.success){
						// window.location = data.redirect;
						var html = ''
							+'<div class="comment-wrap">'
							+'	<div class="comment">'
							+'		<div class="row">'
							+'			<div class="avatar-wrap">'
							+'				<div class="avatar-wrap-inner">'
							+'					<div class="avatar align-center">'
							+'						<img src="'+BASE_URL+'/users/'+USERNAME+'/'+AVATAR+'">'
							+'					</div>'
							+'				</div>'
							+'			</div>'
							+'			<div class="comment-box-wrap">'
							+'				<div class="comment-box-inner">'
							+'					<div class="comment-box">'
							+'						<div class="comment-user">'
							+'							@'+USERNAME+' - Just now'
							+'						</div>'
							+'						<div class="comment-text">'
							+'							<p>'+reply_text+'</p>'
							+'						</div>'
							+'					</div>'
							+'					<div class="comment-reaction">'
							+'						<div class="like-wrap">'
							+'							<strong>Like : </strong><span><?php  ?></span>'
							+'						</div>'
							+'						<div class="reply-wrap">'
							+'							<strong>Reply</strong>'
							+'						</div>'
							+'						<div class="edit-wrap">'
							+'							<strong>Edit </strong><span></span>'
							+'						</div>'
							+'					</div>'
							+'					<div class="comment-reply">'
							+'		'
							+'					</div><!-- .comment-reply -->'
							+'				</div>'
							+'			</div>'
							+'		</div><!-- .row -->'
							+'	</div><!-- .comment-main -->'
							+'</div><!-- .comment -->'
						'';

						$('#FORM_COMMENT_REPLY_'+comment_id+'').before(html);
						$('#REPLY_COUNT_'+comment_id+'').text(data.reply_count);
					}
					else{
						alert('error');
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
	$('.LIKE').click(function(event){
		var comment_id = Number($(this).attr('comment-id'));
		var user_id = Number($('input[name=user-id]').val());
		// var pressed = $(this).attr('aria-pressed');

		if( isNaN(comment_id) || comment_id == "" || comment_id == 0 ){
			alert('Error LIKE');
		}
		else if( isNaN(user_id) || user_id == "" || user_id == 0 ){
			alert('Please login to use this feature');
		}
		else{
			var formData = {
				'action'		: 'like',
				'comment_id'	: comment_id,
				'user_id'		: user_id
				// 'pressed'		: pressed
			};

			$.ajax({
				method	: 'POST',
				dataType: 'json',
				url		: PROCESS_AJAX,
				data: formData,
				success: function(data){
					console.log(data);
					if(data.success){
						// window.location = data.redirect;
						$('#LIKE_COUNT_'+comment_id+'').text(data.like_count);
					}
					else{
						alert('error');
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

	$('.LIKE_COUNT').click(function(event){
		var comment_id = Number($(this).attr('comment-id'));
		var user_id = Number($('input[name=user-id]').val());

		if( isNaN(comment_id) || comment_id == "" || comment_id == 0 ){
			alert('Error LIKE');
		}
		else if( isNaN(user_id) || user_id == "" || user_id == 0 ){
			alert('Please login to use this feature');
		}
		else{
			var formData = {
				'action'		: 'who_like',
				'comment_id'	: comment_id,
				'user_id'		: user_id
			};

			$.ajax({
				method	: 'POST',
				dataType: 'json',
				url		: PROCESS_AJAX,
				data: formData,
				success: function(data){
					console.log(data);
					if(data.success){
						// console.log( data );
					}
					else{
						alert('error');
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