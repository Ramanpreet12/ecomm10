$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#current_pwd').keyup(function(){
        var current_pwd = $(this).val();
        // alert(current_pwd);
        $.ajax({
            type:'post',
            url: 'check-current-password',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if (resp=="true") {
                    $('#verifyCurrentPassword').html('Current password is correct');
                } else {
                    $('#verifyCurrentPassword').html('Current password is incorrect!');
                }
            },error:function(){
                console.log('error' , resp);
            }
        });
    });
});
