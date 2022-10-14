$().ready(function () {
    // validate signup form on keyup and submit
    $("#addCustomerForm").validate({
        onkeyup: function (element) {
            this.element(element);
        },
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            customer_name: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true,
            },
            tel_num: {
                required: true,
                digits: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            customer_name: {
                required: "Vui lòng nhập tên khách hàng",
                minlength: "Tên khách hàng phải lớn hơn 5 ký tự"
            },
            address: {
                required: "Vui lòng nhập địa chỉ",
            },
            tel_num: {
                required: "Vui lòng số điện thoại",
                digits: "Số điện thoại sai định dạng",
            },
            email: {
                email: "Email sai định dạng",
                required: "Email không được bỏ trống",
            },
        },
        submitHandler: function (form) { // for demo
            alert('valid form');
            return false;
        }
    });
});
$(document).on('click', '#customer-tab', function () {
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
    var idCustomer = null;
    var dataSearch = { load: 'index' };
    var customerStatus = "1";
    var validator = $("#addCustomerForm").validate();
    getCustomerData();
    /**
     * Create events for close popup
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#closePopupCustomerButton').unbind().on('click', function (e) {
        $('#editCustomerButton').attr('id', 'addCustomerButton');
        dataSearch = { load: 'index' };
        getCustomerData();
    });
    /**
     * Reset form before display
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function clearCustomerErrorsMessage() {
        $("#customer_name-errors").empty();
        $("#email-errors").empty();
        $("#tel_num-errors").empty();
        $("#address-errors").empty();
        validator.resetForm();
    }
    function resetForm() {
        $('#addCustomerForm').trigger("reset");
        $('#addCustomerStatus').bootstrapToggle('on');
    }
    $('#addCustomerBtn').on('click', function () {
        clearCustomerErrorsMessage();
        resetForm();
    });
    /**
     * Create events for delete searched items
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#refreshCustomerPage').unbind().on('click', function (e) {
        $('#customerStatus').prop('selectedIndex', -1);
        $(':input').val('');
        dataSearch = { load: 'index' };
        getCustomerData();
    });
    /**
     * Create events for data searching
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#searchCustomer').unbind().on('click', function (e) {
        var name = $("#customerSearchName").val();
        var email = $("#customerSearchEmail").val();
        var address = $("#customerSearchAddress").val();
        var status = $('#customerSearchStatus').val();
        if ((name == '') && (status == null) && (email == '') && (address == '')) {
            Swal.fire(
                'Do you forget somethings?',
                'Vui lòng nhập ít nhất một thông tin để tìm kiếm!',
                'warning'
            )
        } else {
            dataSearch = {
                name: name,
                email: email,
                address: address,
                status: status,
                load: 'search'
            };
            getCustomerData();
        }
    })
    var numRows = 0;

    $('#exportCSV').click(function () {
        var name = $("#customerSearchName").val();
        var email = $("#customerSearchEmail").val();
        var address = $("#customerSearchAddress").val();
        var status = $('#customerSearchStatus').val();
        if ((name == '') && (status == null) && (email == '') && (address == '')) {
            dataSearch = {
                load: 'index',
                numRows: numRows
            };
        } else {
            dataSearch = {
                name: name,
                email: email,
                address: address,
                status: status,
                numRows: numRows,
                load: 'search'
            };
        };
        Swal.fire({
            title: 'Are you sure?',
            text: "Xuất file excel khách hàng " + " không",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, Xuất file '
        }).then((result) => {
            if (result.isConfirmed) {
                var url = base_url + '/admin/customers/export?' + $.param(dataSearch);
                window.location = url;
                Swal.fire(
                    'Thành công!',
                    'Xuất file excel thành công',
                    'success'
                )
            }
        })

    });
    /**
     * Get data from server and display 
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function getCustomerData() {
        var $data_table = $('#customers-table');
        $('#customers-table').DataTable({
            drawCallback: function () {
                var page_min = 1;
                var $api = this.api();
                var pages = $api.page.info().pages;
                var rows = $api.data().length;
                numRows = rows;
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
            "lengthMenu": [[20, 50, 100, 500, -1], [20, 50, 100, 500, "All"]],
            searching: false,
            "ordering": false,
            "bDestroy": true,
            processing: true,
            serverSide: true,
            ajax: {
                url: base_url + '/admin/customers/',
                type: "GET",
                data: dataSearch,
            },
            columns: [
                { data: 'customer_id', name: 'customer_id' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'email', name: 'email' },
                { data: 'address', name: 'address' },
                { data: 'tel_num', name: 'tel_num' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });
    }

    $('#addCustomerStatus').change(function () {
        if (document.getElementById('addCustomerStatus').checked)
            customerStatus = '1';
        else
            customerStatus = '0';
    });
    /**
   * Save data to database
   * 
   * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
   * 
   * @returns {Response}
   */

    $(document).on('click', '#addCustomerButton', function (e) {
        e.preventDefault();
        var form = $('#addCustomerForm')[0];
        var formData = new FormData(form);
        formData.append('is_active', customerStatus);
        $.ajax({
            url: base_url + '/admin/customers/',
            type: "POST",
            data: formData,
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            dataType: 'json',
            success: function (data) {
                $('#addCustomerForm').trigger("reset");
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
                    title: 'Thêm khách hàng mới thành công'
                })
            },
            beforeSend: function () {
                clearCustomerErrorsMessage();
            },
            error: function (err) {
                $.each(err.responseJSON.errors, function (key, value) {
                    $("#" + key + '-errors').html(value[0]);
                    $("#" + key + '-errors').next().removeClass('d-none');
                });
            }
        });
    });
    /**
     * Append customers info to input field
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Response}
     */
    $(document).on('click', '.popupEditCustomer', function () {
        clearCustomerErrorsMessage();
        $('#popupCustomerTitle').html('Chỉnh sửa khách hàng')
        var id = $(this).data("id");
        $.ajax({
            url: base_url + '/admin/customers/details/' + id,
            type: "GET",
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (data) {
                idCustomer = data.data.customer_id;
                $('#addCustomerButton').attr('id', 'editCustomerButton');
                $("#addCustomerName").val(data.data.customer_name);
                $("#addCustomerEmail").val(data.data.email);
                $("#addCustomerAddress").val(data.data.address);
                $("#addCustomerPhone").val(data.data.tel_num);
                data.data.is_active === 1 ? $('#addCustomerStatus').bootstrapToggle('on') : $('#addCustomerStatus').bootstrapToggle('off');
            },
            error: function (err) {
                alert('Somethings went wrong!');
            },
        });
    })
    /**
     * Update customer data to database
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Response}
     */
    $('body').unbind().on('click', '#editCustomerButton', function (e) {
        e.preventDefault();
        clearCustomerErrorsMessage();
        var form = $('#addCustomerForm')[0];
        var formData = new FormData(form);
        formData.append('is_active', customerStatus);
        formData.append('customer_id', idCustomer);
        $.ajax({
            url: base_url + '/admin/customers/update/' + idCustomer,
            type: "post",
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#closePopupCustomerButton").trigger("click");
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
                    title: 'Chỉnh sửa khách hàng thành công'
                })
            },
            beforeSend: function () {
                clearCustomerErrorsMessage();
            },
            error: function (err) {
                $.each(err.responseJSON.errors, function (key, value) {
                    $("#" + key + '-errors').html(value[0]);
                    $("#" + key + '-errors').next().removeClass('d-none');
                });
            }
        });
    });
    $('#importCSV').on('change', function () {
        var form = $('#uploadFileCSV')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + '/admin/customers/import',
            type: "post",
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            data: formData,
            dataType: 'json',
            success: function (data) {
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
                    title: 'Import khách hàng thành công'
                })
            },
            error: function (err) {
                Swal.fire(
                    'Thất bại!',
                    err.responseJSON.message,
                    'error'
                )
            }
        });
    });

});