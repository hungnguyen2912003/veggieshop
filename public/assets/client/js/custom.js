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

    $("#addAddressForm").submit(function (e) {
        e.preventDefault();

        let fullName = $('#full_name').val().trim();
        let phone = $('#phone').val().trim();
        let address = $('#address').val().trim();
        let city = $('#city').val().trim();

        let isValid = true;

        $('.error-message').remove();

        if (fullName.length < 3) {
            isValid = false;
            $('#full_name').after(
                `<p class="error-message text-danger">Họ và tên không được ít hơn 3 ký tự.</p>`
            );
        }

        let phoneRegex = /^[0-9]{10,11}$/;
        if (!phoneRegex.test(phone)) {
            isValid = false;
            $('#phone').after(
                `<p class="error-message text-danger">Số điện thoại không hợp lệ.</p>`
            );
        }

        if (isValid) {
            this.submit();
        }
    });

    let currentPage = 1;
    $(document).on('click', '.pagination-link', function(e){
        e.preventDefault();
        let pageUrl = $(this).attr('href');
        let page = pageUrl.split('page=')[1];
        currentPage = page;
        fetchProducts();
    })

    function fetchProducts() {
        let category_id = $(".category-filter.active").data('id') || '';
        let minPrice = $(".slider-range").slider('values', 0);
        let maxPrice = $(".slider-range").slider('values', 1);
        let sort_by = $("#sort-by").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });

        $.ajax({
            url: 'products/filter?page=' + currentPage,
            type: "GET",
            data: {
                category_id: category_id,
                min_price: minPrice,
                max_price: maxPrice,
                sort_by: sort_by
            },
            beforeSend: function () {
                $("#loading-spinner").show();
                $("#liton_product_grid").hide();
            },
            success: function (response) {
                $("#liton_product_grid").html(response.products);
                $(".ltn__pagination").html(response.pagination);
            },
            error: function (xhr) {
                toastr.error("Đã xảy ra lỗi, vui lòng thử lại!");
            },
            complete: function () {
                $("#loading-spinner").hide();
                $("#liton_product_grid").show();
            }
        });
    }

    $('.category-filter').click(function() {
        $('.category-filter').removeClass('active');
        $(this).addClass('active');
        currentPage = 1;
        fetchProducts();
    })

    $('#sort-by').click(function() {
        currentPage = 1;
        fetchProducts();
    })

    $( ".slider-range" ).slider({
        range: true,
        min: 0,
        max: 300000,
        values: [ 0, 300000 ],
        slide: function( event, ui ) {
            $( ".amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] + "VNĐ");
        },
        change: function(e, ui) {
            currentPage = 1;
            fetchProducts();
        }
    });
    $( ".amount" ).val($( ".slider-range" ).slider( "values", 0 ) + $( ".slider-range" ).slider( "values", 1 ) + " VNĐ");

    if(window.location.pathname !== '/cart') {
        $(document).on('click', '.qtybutton', function() {
            let button = $(this);
            let input = button.siblings('input');
            let oldValue = parseInt(input.val());
            let maxStock = parseInt(input.data('max'));
    
            if(button.hasClass('inc')){
                if(oldValue < maxStock) {
                    input.val(oldValue + 1);
                }
            } else {
                if (oldValue > 1) {
                    input.val(oldValue - 1);
                }
            }
        })
    } else {
        $(document).on('click', '.qtybutton', function() {            
            let button = $(this);
            let input = button.siblings('input');
            let oldValue = parseInt(input.val());
            let maxStock = parseInt(input.data('max'));
            let productId = input.data('id');
            let newValue = oldValue;

            // Save old value for error recovery
            input.data('old-value', oldValue);
    
            if(button.hasClass('inc') && oldValue < maxStock){
                newValue = oldValue + 1;
            } else if (button.hasClass('dec') && oldValue > 1){
                newValue = oldValue - 1;
            }

            if (newValue != oldValue) {
                updateCart(productId, newValue, input);
            }
        })
    }

    //Add to cart
    $(document).on('click', '.add-to-cart-btn', function(e){
        e.preventDefault();

        let productId = $(this).data('id');
        let quantity = $(this).closest('li').prev().find('.cart-plus-minus-box').val();

        quantity = quantity ? quantity : 1;

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });

        $.ajax({
            url: '/cart/add',
            type: "POST",
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function (response) {
                $('#quick_view_modal-' + productId).modal('hide');
                $('#add_to_cart_modal-' + productId).modal('show');
                $('#cart_count').text(response.cart_count);
                toastr.success('Đã thêm vào giỏ hàng!');
            },
            error: function (xhr) {
                toastr.error("Đã xảy ra lỗi, vui lòng thử lại!");
            }
        });        
    })

    //Mini cart
    $('.mini-cart-icon').on('click', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });
        
        $.ajax({
            url: '/mini-cart',
            type: 'GET',
            success: function(response) {
                if(response.status) {
                    $('#ltn__utilize-cart-menu .ltn__utilize-menu-inner').html(response.html);
                    $('#ltn__utilize-cart-menu').addClass('ltn__utilize-open');
                } else {
                    toastr.error('Không thể tải giỏ hàng');
                }
            },
            error: function () {
                toastr.error('Đã xảy ra lỗi khi tải giỏ hàng');
            }
        })
    });

    $(document).on('click', '.ltn__utilize-close', function() {
        $('#ltn__utilize-cart-menu').removeClass('ltn__utilize-open');
        $('.ltn__utilize-overlay').hide();
    });

    $(document).on('click', '.mini-cart-item-delete', function() {
        let productId = $(this).data('id');

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });

        $.ajax({
            url: '/cart/remove',
            type: 'POST',
            data: {
                product_id: productId
            },
            success: function(response) {
                if(response.status) {
                    $('#cart_count').text(response.cart_count);
                    $('.mini-cart-icon').click();

                } else {
                    toastr.error('Không thể tải giỏ hàng');
                }
            },
            error: function () {
                toastr.error('Đã xảy ra lỗi khi tải giỏ hàng');
            }
        })        
    })
    
    function updateCart(productId, quantity, input) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });

        $.ajax({
            url: '/cart/update',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                input.val(response.quantity);
                input.closest('tr').find('.cart-product-subtotal').text(response.subtotal + ' VNĐ');
                $('.cart-total').text(response.total + ' VNĐ');
                $('.cart-grand-total').text(response.grandTotal + ' VNĐ');
                // Clear old value after successful update
                input.removeData('old-value');
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error('Đã xảy ra lỗi, vui lòng thử lại!');
                }
                // Reset input value on error
                input.val(input.data('old-value') || input.val());
            }
        })         
    }
})