$(document).ready(function () {
    /**
    * Setup header for ajax
    * 
    * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
    * 
    * @returns {Json}
    */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var base_url = window.location.origin;
    var idProduct = null;
    var defaultImage = $("#imgPreview").attr("src");
    var dataSearch = { load: 'index' };
    var productStatus = "1";
    getProductData();
    /**
     * Create events for close popup
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#closePopupProductButton').unbind().on('click', function (e) {
        $('#editProductButton').attr('id', 'addProductButton');
        dataSearch = { load: 'index' };
        getProductData();
    });
    /**
     * Reset form before display
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function clearProductErrorsMessage() {
        $("#product_name-err").empty();
        $("#product_price-err").empty();
        $("#product_image-err").empty();

    }
    function resetForm() {
        $("#imgPreview").attr("src", defaultImage);
        $('#addProductForm').trigger("reset");
        $('#removeImage').hide();
        $('#addProductStatus').bootstrapToggle('on');
    }
    $('#addProductBtn').on('click', function () {
        clearProductErrorsMessage();
        resetForm();
    });
    /**
     * Create events for delete searched items
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#refreshProductPage').unbind().on('click', function (e) {
        $('#productStatus').prop('selectedIndex', -1);
        $(':input').val('');
        dataSearch = { load: 'index' };
        getProductData();
    });
    /**
     * Create events for data searching
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#searchProduct').unbind().on('click', function (e) {
        var productName = $("#productName").val();
        var productStatus = $("#productStatus").val();
        var productPriceFrom = $("#productPriceFrom").val();
        var productPriceTo = $('#productPriceTo').val();
        if ((productName == '') && (productStatus == null) && (productPriceFrom == '') && (productPriceTo == '')) {
            Swal.fire(
                'Do you forget somethings?',
                'Vui lòng nhập ít nhất một thông tin để tìm kiếm!',
                'warning'
            )
        } else {
            dataSearch = {
                productName: productName,
                productStatus: productStatus,
                productPriceFrom: productPriceFrom,
                productPriceTo: productPriceTo,
                load: 'search'
            };
            getProductData();
        }
    })
    /**
     * Get data from server and display 
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function getProductData() {
        var $data_table = $('#products-table');
        $('#products-table').DataTable({
            createdRow: function (row, data, dataIndex) {
                if (data['is_sales'] == 'Đang bán') {
                    $('td', row).eq(4).addClass('statusActive');
                } else {
                    $('td', row).eq(4).addClass('statusInactive');

                }
            },
            drawCallback: function () {
                var page_min = 1;
                var $api = this.api();
                var pages = $api.page.info().pages;
                var rows = $api.data().length;

                // Tailor the settings based on the row count
                if (rows <= page_min) {
                    // Not enough rows for really any features, hide filter/pagination/length
                    $data_table
                        .next('.dataTables_info').css('display', 'none')
                        .next('.dataTables_paginate').css('display', 'none');

                    $data_table
                        .prev('.dataTables_filter').css('display', 'none')
                        .prev('.dataTables_length').css('display', 'none')
                } else if (pages === 1) {
                    // With this current length setting, not more than 1 page, hide pagination
                    $data_table
                        .next('.dataTables_info').css('display', 'none')
                        .next('.dataTables_paginate').css('display', 'none');
                } else {
                    // SHow everything
                    $data_table
                        .next('.dataTables_info').css('display', 'block')
                        .next('.dataTables_paginate').css('display', 'block');
                }
            },
            language: {
                processing: "Đang tải dữ liệu, chờ tí",
                lengthMenu: "Đang hiển thị 1 ~ _MENU_ ",
                info: "Hiển thị từ _START_ ~ _END_ trong tổng số _TOTAL_ user",
                infoEmpty: "Không có dữ liệu",
                emptyTable: "Không có dữ liệu",
                paginate: {
                    first: "Trang đầu",
                    previous: "Trang trước",
                    next: "Trang sau",
                    last: "Trang cuối"
                },
            },
            lengthMenu: [20, 50, 100, 200, 500],
            searching: false,
            "ordering": false,
            "bDestroy": true,
            processing: true,
            serverSide: true,
            ajax: {
                url: base_url + '/admin/products/',
                type: "GET",
                data: dataSearch,
            },
            columns: [
                { data: 'product_id', name: 'product_id' },
                { data: 'product_name', name: 'product_name', orderable: false, searchable: false },
                { data: 'description', name: 'description' },
                { data: 'product_price', name: 'product_price' },
                { data: 'is_sales', name: 'is_sales' },

                { data: 'action', name: 'action', orderable: false, searchable: false },
                // { data: 'product_image', name: 'product_image', orderable: false, searchable: false },

            ],
        });
    }

    $('#addProductStatus').change(function () {
        if (document.getElementById('addProductStatus').checked)
            productStatus = '1';
        else
            productStatus = '0';
    });
    /**
   * Save data to database
   * 
   * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
   * 
   * @returns {Response}
   */

    $('body').on('click', '#addProductButton', function (e) {
        e.preventDefault();
        var form = $('#addProductForm')[0];
        var formData = new FormData(form);
        formData.append('is_sales', productStatus);
        formData.append('product_image', $('#addProductImage')[0].files[0]);
        $.ajax({
            url: base_url + '/admin/products/',
            type: "POST",
            data: formData,
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            dataType: 'json',
            success: function (data) {
                $('#addProductForm').trigger("reset");
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: 'Thêm sản phẩm mới thành công'
                })
            },
            beforeSend: function () {
                clearProductErrorsMessage();
            },
            error: function (err) {
                $.each(err.responseJSON.errors, function (key, value) {
                    $("#" + key + '-err').html(value[0]);
                    $("#" + key + '-err').next().removeClass('d-none');
                });
            }
        });
    });
    /**
     * Append user info to input field
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Response}
     */
    $(document).on('click', '.popupEditProduct', function () {
        clearProductErrorsMessage();
        $('#popupProductTitle').html('Chỉnh sửa sản phẩm')
        var id = $(this).data("id");
        $.ajax({
            url: base_url + '/admin/products/details/' + id,
            type: "GET",
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (data) {
                idProduct = data.data.product_id;
                $('#addProductButton').attr('id', 'editProductButton');
                $("#addProductName").val(data.data.product_name);
                $("#addProductPrice").val(data.data.product_price);
                $("#addProductDescription").val(data.data.description);
                data.data.product_image != null ? $("#imgPreview").attr("src", base_url + '/storage/' + data.data.product_image) : $("#imgPreview").attr("src", defaultImage);
                $('#removeImage').hide();
                data.data.is_sales === 1 ? $('#addProductStatus').bootstrapToggle('on') : $('#addProductStatus').bootstrapToggle('off');
            },
            error: function (err) {
                alert('Somethings went wrong!');
            },
        });
    })
    /**
     * Update product data to database
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Response}
     */
    $('body').on('click', '#editProductButton', function (e) {
        e.preventDefault();
        clearProductErrorsMessage();
        var form = $('#addProductForm')[0];
        var formData = new FormData(form);
        formData.append('is_sales', productStatus);
        formData.append('product_id', idProduct);
        formData.append('product_image', $('#addProductImage')[0].files[0]);
        $.ajax({
            url: base_url + '/admin/products/update/' + idProduct,
            type: "post",
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#closePopupProductButton").trigger("click");
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: 'Chỉnh sửa sản phẩm thành công'
                })
            },
            beforeSend: function () {
                clearProductErrorsMessage();
            },
            error: function (err) {
                $.each(err.responseJSON.errors, function (key, value) {
                    $("#" + key + '-err').html(value[0]);
                    $("#" + key + '-err').next().removeClass('d-none');
                });
            }
        });
    });
    function getProductByID(id) {
        var product = null;
        $.ajax({
            url: base_url + '/admin/products/details/' + id,
            type: "GET",
            async: false,
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (data) {
                product = data;
            },
            error: function (err) {
                alert('Somethings went wrong!');
            },
        });
        return product.data;
    }
    /**
     * Delete user 
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Response}
     */
    $(document).on('click', '.removeProductButton', function (e) {
        var id = $(this).data("id");
        var productData = getProductByID(id);
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Bạn có muốn xóa sản phẩm " + productData.product_name + " không",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK, Delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + '/admin/products/delete/' + id,
                    type: "delete",
                    async: false,
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        Swal.fire(
                            'Thành công!',
                            'Sản phẩm ' + productData.product_name + ' đã bị xóa.',
                            'success'
                        ),

                            getProductData();
                    },
                    error: function (err) {
                        alert('Somethings went wrong!');
                    },
                });
            }
        })
    });
});