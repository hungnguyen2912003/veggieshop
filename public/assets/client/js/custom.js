$(document).ready(function () {
    $('.profile-pic').click(function(){
        $("#avatar").click();
    })

    $("#avatar").change(function(){
        let input = this;
        if(input.files && input.files[0]){
            let reader = new FileReader()
            reader.onload = function(e){
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });


    $("#update-account-form").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        let urlUpdate = $(this).attr('action');

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: urlUpdate,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $(".btn-wrapper button").text("Đang cập nhật ... ").attr("disabled", true);
            },

            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    if (response.avatar) {
                        $('#preview-image').attr('src', response.avatar);
                    } else {
                        toastr.error(response.message);
                    }
                }
            },

            error: function (xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {   
                    toastr.error(value[0]);    
                });
            },
            complete: function () {
                $(".btn-wrapper button")
                    .text("Cập nhật")
                    .attr("disabled", false);
            }
        })
    });

    $("#change-password-form").submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let urlUpdate = $(this).attr("action");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });

        $.ajax({
            url: urlUpdate,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(".btn-wrapper button").text("Đang cập nhật ...").attr("disabled", true);
            },
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    $("#change-password-form")[0].reset();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error("Đã xảy ra lỗi, vui lòng thử lại!");
                }
            },
            complete: function () {
                $(".btn-wrapper button").text("Lưu thay đổi").attr("disabled", false);
            }
        });
    });

})