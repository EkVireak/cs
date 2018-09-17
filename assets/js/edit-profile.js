$(document).ready(function(){
	
    $('#edit-profile-info').click(function() {
        $('#edit-profile').fadeIn();
    });
    $('#edit-profile-cancel').click(function(){
        $('#edit-profile').fadeOut();
    });


    $('form#form-edit-profile').submit(function(event){

        var firstname = $('input[name=firstname]').val();
        var lastname = $('input[name=lastname]').val();
        var birthday = $('select[name=birth-day]').val();
        var birthmonth = $('select[name=birth-month]').val();
        var birthyear = $('input[name=birth-year]').val();
        var gender = $('select[name=gender]').val();

        var formData = {
            'action'        : 'edit-profile',
            'firstname'     : firstname,
            'lastname'      : lastname,
            'birth-day'     : birthday,
            'birth-month'   : birthmonth,
            'birth-year'    : birthyear,
            'gender'        : gender
        };
        console.log(formData);

        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: CS_AJAX,
            data: formData,
            success: function(data){
                console.log(data);
                if(data.success){
                    alert('success');
                    $('.profile-info #profile-firstname').text(data.user['firstname']);
                    $('.profile-info #profile-lastname').text(data.user['lastname']);
                    $('.profile-info #profile-birthday').text(data.user['birth_day']+"-"+data.user['birth_month']+"-"+data.user['birth_year']);
                    $('.profile-info #profile-gender').text(data.user['gender']);
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

        event.preventDefault();
    });

});