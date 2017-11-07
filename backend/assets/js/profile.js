$(document).ready(function (e) {
    $('#change').click(function () {
        $('#image').show();
        $('#vProfileImg').hide();
        $('#cancel').show();
        $('#change').hide();
        $('#hiddenval').val('0');
    });

    $('#cancel').click(function () {
        $('#image').hide();
        $('#vProfileImg').show();
        $('#cancel').hide();
        $('#change').show();
        $('#hiddenval').val('1');
    });

    $("#Deleteimg").click(function () {
        if (confirm('Are you sure you want to delete this ?')) {
            var userid = $("#aid").val();
            $.ajax({
                type: "POST",
                url: site_url + "profile/profile_image_delete",
                data: {id: userid},
                success: function () {
                    $('#image').show();
                    $('#vProfileImg').hide();
                    $('#hiddenval').val('0')
                    $('#cancelbtn4all').trigger('click');
                    $('#confirmbtn4all').html('Confirm');
                    $('#confirmbtn4all').attr('disabled', false);
                }
            });
        }
    });
    $(document).ready(function () {
        $('#successmodal').on('hidden.bs.modal', function () {
            window.location.reload();
        });
    });
    $(".integer").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $("#profile_form").validate({
        rules: {
            Firstname: {
                required: true,
            },
            Lastname: {
                required: true,
            },
            Email: {
                required: true,
                email: true
            },
            City: {
                required: true,
            },
            State: {
                required: true,
            },
            Zip: {
                required: true,
                minlength: 5,
                maxlength: 6

            }
        }
    });
    $("#change_pass_form").validate({
        rules: {
            txt_currentpassword: {
                required: true,
            },
            txt_newpassword: {
                required: true,
                minlength: 8
            },
            txt_confirmpassword: {
                required: true,
                equalTo: '#txt_newpassword'
            }
        }
    });

    /*UPDATE PASSWORD*/
    $("#update_pass_form").validate({
        rules: {
            txt_newpassword: {
                required: true,
                minlength: 8
            },
            txt_confirmpassword: {
                required: true,
                equalTo: '#txt_newpassword'
            }
        }, submitHandler: function (form) {

            $.ajax({
                url: site_url + "profile/update_password_action",
                type: "POST",
                data: $("#update_pass_form").serialize(),
                success: function (data) {
                    if (data == true) {
                        $("#successmodal").modal("show");
                        setTimeout(function (e) {
                            window.location.reload();
                        }, 2000);

                    } else {
                        alert(data);
                    }
                }
            });
        }
    });
});