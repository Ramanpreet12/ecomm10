// $(document).ready(function(){
//     $('[data-toggle="tooltip"]').tooltip();
//   });


$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('.select2').select2()

    //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   theme: 'bootstrap4'
    // })


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
        // console.log('module :' +module , 'id:'+ module_id , 'route will be : '+'http://127.0.0.1:8000/admin' + module+'/delete/'+module_id);
        // var route = window.location.href=module+'/delete/'+module_id;
        // console.log(route);

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
              window.location.href='http://127.0.0.1:8000/admin/'+module+'/delete/'+module_id;
            }
          });

    });



    // update Category page status
    $(document).on("click", ".updateCategoryStatus", function () {
        var status = $(this).find(".status").attr("category_status");

        var category_id = $(this).attr('category_id');
        $.ajax({
            type: 'post',
            url: 'update-category-status',
            data: { status: status, category_id: category_id },
            success: function (resp) {
                if (resp['status'] == 1) {
                    $('#category-' + category_id).html('<i class="fa-solid fa-toggle-on status"  data-toggle="tooltip" title="Active" style="color:#007bff"  category_status="Active"></i>');
                } else if (resp['status'] == 0) {
                    $('#category-' + category_id).html('<i class="fa-solid fa-toggle-off status"  data-toggle="tooltip" title="Inactive" style="color:grey"  category_status="Inactive"></i>');
                }
            }, error: function () {
                console.log('error' + resp);
            }
        });
    });

});
