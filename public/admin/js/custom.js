// $(document).ready(function(){
//     $('[data-toggle="tooltip"]').tooltip();
//   });


$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#current_pwd').keyup(function () {
        var current_pwd = $(this).val();
        // alert(current_pwd);
        $.ajax({
            type: 'post',
            url: 'check-current-password',
            data: { current_pwd: current_pwd },
            success: function (resp) {
                if (resp == "true") {
                    $('#verifyCurrentPassword').html('Current password is correct');
                } else {
                    $('#verifyCurrentPassword').html('Current password is incorrect!');
                }
            }, error: function () {
                console.log('error', resp);
            }
        });
    });

    // update subadmin status
    $(document).on("click", ".updateSubadminStatus", function () {
        var status = $(this).find(".status").attr("subadmin_status");


        var subadmin_id = $(this).attr('subadmin_id');
        $.ajax({
            type: 'post',
            url: 'update-subadmin-status',
            data: { status: status, subadmin_id: subadmin_id },
            success: function (resp) {
                console.log('success'+resp);
                if (resp['status'] == 1) {
                    $('#subadmin-' + subadmin_id).html('<i class="fa-solid fa-toggle-on status"  data-toggle="tooltip" title="Active" style="color:#007bff"  subadmin_status="Active"></i>');
                } else if (resp['status'] == 0) {
                    $('#subadmin-' + subadmin_id).html('<i class="fa-solid fa-toggle-off status"  data-toggle="tooltip" title="Inactive" style="color:grey"  subadmin_status="Inactive"></i>');
                }
            }, error: function () {
                console.log('error' + resp);
            }
        });
    });




     // update CMS page status
     $(document).on("click", ".updateCmsPageStatus", function () {
        var status = $(this).find(".status").attr("page_status");

        var page_id = $(this).attr('page_id');
        $.ajax({
            type: 'post',
            url: 'update-cms-page-status',
            data: { status: status, page_id: page_id },
            success: function (resp) {
                if (resp['status'] == 1) {
                    $('#page-' + page_id).html('<i class="fa-solid fa-toggle-on status"  data-toggle="tooltip" title="Active" style="color:#007bff"  page_status="Active"></i>');
                } else if (resp['status'] == 0) {
                    $('#page-' + page_id).html('<i class="fa-solid fa-toggle-off status"  data-toggle="tooltip" title="Inactive" style="color:grey"  page_status="Inactive"></i>');
                }
            }, error: function () {
                console.log('error' + resp);
            }
        });
    });

    //delete with sweet alert

        $(document).on("click", ".confirmDelete", function () {

        var module = $(this).attr("module");
        var module_id = $(this).attr("module_id");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f6791',
            cancelButtonColor: '#e74c3c',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              window.location.href=module+'/delete/'+module_id;
            }
          });

    })
});
