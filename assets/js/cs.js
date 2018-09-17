$(document).ready(function() {
    
    $('select').change(function(){
        if( $(this).val() == "" ){
            $(this).addClass('focus-error');
        }
        else{
            $(this).removeClass('focus-error');
        }
        
    });
    $('input').keyup(function(){
        if( $(this).val() == "" ){
            $(this).addClass('focus-error');
        }
        else{
            $(this).removeClass('focus-error');
        }
    });

    // logout
    $('#btn-logout').click(function(event){
        var formData = {
            'action'    : 'logout'
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
        event.preventDefault();
    });

    // 

    $('#btn-drop-list').click(function(){
        $('#list-drop').slideToggle(500);
    });


});