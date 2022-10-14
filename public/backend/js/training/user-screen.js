$().ready(function () {
    // validate signup form on keyup and submit
    $("#addUserForm").validate({
        onkeyup: function (element) {
            this.element(element);
        },
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            addUserName: {
                required: true,
                minlength: 5
            },
            addUserPassword: {
                required: true,
                minlength: 5,
                pwcheck: true
            },
            addUserPasswordConfirm: {
                required: true,
                equalTo: "#addUserPassword"
            },
            email: {
                required: true,
                email: true
            },

        },
        messages: {
            addUserName: {
                required: "Vui lòng nhập tên user",
                minlength: "Tên user phải lớn hơn 5 ký tự"
            },
            addUserPassword: {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu phải lớn hơn 5 ký tự",
                pwcheck: "Mật khẩu phải có cả chữ hoa, thường, số và kí tự đặt biệt",
            },
            addUserPasswordConfirm: {
                required: "Vui lòng xác nhận mật khẩu",
                equalTo: "Mật khẩu xác nhận không khớp"
            },
            addUserEmail: "Email chưa đúng định dạng",
        },
        submitHandler: function (form) { // for demo
            alert('valid form');
            return false;
        }
    });
    $.validator.addMethod("pwcheck", function (value) {
        return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
            && /[#?!@$%^&*-]/.test(value) // has special character
    });
});
$(document).on('click', '#user-tab', function () {
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
    var userID = null;
    var base_url = window.location.origin;
    var dataSearch = { load: 'index' };
    var validator = $("#addUserForm").validate();
    getUserData();
    /**
     * Create events for close popup
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#closePopupUserButton').unbind().on('click', function (e) {
        $('#editUserButton').attr('id', 'addUserButton');
        dataSearch = { load: 'index' };
        getUserData();
    });
    /**
     * Reset form before display
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function clearErrorsMessage() {
        $("#name-err").empty();
        $("#email-err").empty();
        $("#password-err").empty();
        $("#password_confirmation-err").empty();
        $("#status-err").empty();
        $("#group_role-err").empty();
        validator.resetForm();

    }
    $('#addUserBtn').on('click', function () {
        clearErrorsMessage();
        $('#addUserForm').trigger("reset");
    });
    /**
     * Create events for delete searched items
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#refreshPage').unbind().on('click', function (e) {
        $('#status').prop('selectedIndex', -1);
        $('#role').prop('selectedIndex', -1);
        $(':input').val('');
        dataSearch = { load: 'index' };
        getUserData();
    });
    /**
     * Create events for data searching
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#search').unbind().on('click', function (e) {
        var name = $("#name").val();
        var email = $("#email").val();
        var role = $("#role").val();
        var status = $('#status').val();
        e.preventDefault();
        if ((email == '') && (name == '') && (role == null) && (status == null)) {
            Swal.fire(
                'Do you forget somethings?',
                'Vui lòng nhập ít nhất một thông tin để tìm kiếm!',
                'warning'
            )
        } else {
            dataSearch = {
                name: name,
                email: email,
                role: role,
                status: status,
                load: 'search'
            };
            getUserData();
        }
    })
    /**
     * Get data from server and display 
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function getUserData() {
        var $data_table = $('#users-table');
        $('#users-table').DataTable({
            createdRow: function (row, data, dataIndex) {
                if (data['is_active'] == 'Đang hoạt động') {
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
                url: base_url + '/admin/users/',
                type: "GET",
                data: dataSearch,
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'group_role', name: 'group_role' },
                { data: 'is_active', name: 'is_active' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });
    }

    var userStatus = "1";
    $('#addUserStatus').change(function () {
        if (document.getElementById('addUserStatus').checked)
            userStatus = '1';
        else
            userStatus = '0';
    });
    /**
   * Save data to database
   * 
   * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
   * 
   * @returns {Response}
   */
    $('body').on('click', '#addUserButton', function (e) {
        e.preventDefault();
        var name = $("#addUserName").val();
        var email = $("#addUserEmail").val();
        var password = $("#addUserPassword").val();
        var password_confirmation = $("#addUserPasswordConfirm").val();
        var role = $("#addUserRole").val();
        $.ajax({
            url: base_url + '/admin/users/',
            type: "POST",
            data: {
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation,
                group_role: role,
                is_active: userStatus,
            },
            dataType: 'json',
            success: function (data) {
                $('#addUserForm').trigger("reset");
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
                    title: 'Thêm mới user thành công'
                })
            },
            beforeSend: function () {
                clearErrorsMessage();
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
    $(document).on('click', '.popupEditUser', function () {
        clearErrorsMessage();
        $('#popupUserTitle').html('Chỉnh sửa User')
        var idUSer = $(this).data("id");
        $.ajax({
            url: base_url + '/admin/users/' + idUSer,
            type: "GET",
            data: {
                id: idUSer,
            },
            dataType: 'json',
            success: function (data) {
                userID = data.data.id;
                $('#addUserButton').attr('id', 'editUserButton');
                $("#addUserName").val(data.data.name);
                $("#addUserEmail").val(data.data.email);
                $("#addUserRole").val(data.data.group_role);
                data.data.is_active === 1 ? $('#addUserStatus').bootstrapToggle('on') : $('#addUserStatus').bootstrapToggle('off');
            },
            error: function (err) {
                alert('Somethings went wrong!');
            },
        });
    })
    /**
     * Update user data to database
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Response}
     */
    $('body').on('click', '#editUserButton', function (e) {
        e.preventDefault();
        clearErrorsMessage();
        var name = $("#addUserName").val();
        var email = $("#addUserEmail").val();
        var password = $("#addUserPassword").val();
        var password_confirmation = $("#addUserPasswordConfirm").val();
        var role = $("#addUserRole").val();
        $.ajax({
            url: base_url + '/admin/users/' + userID,
            type: "PUT",
            data: {
                id: userID,
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation,
                group_role: role,
                is_active: userStatus,
                _method: 'PUT',
            },
            dataType: 'json',
            success: function (data) {
                $("#closePopupUserButton").trigger("click");
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
                    title: 'Chỉnh sửa user thành công'
                })
            },
            beforeSend: function () {
                clearErrorsMessage();
            },
            error: function (err) {
                $.each(err.responseJSON.errors, function (key, value) {
                    $("#" + key + '-err').html(value[0]);
                    $("#" + key + '-err').next().removeClass('d-none');
                });
            }
        });
    });
    function getUserByID(id) {
        var user = null;
        $.ajax({
            url: base_url + '/admin/users/' + id,
            type: "GET",
            async: false,
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (data) {
                user = data;
            },
            error: function (err) {
                alert('Somethings went wrong!');
            },
        });
        return user.data;
    }
    /**
     * Delete user 
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Response}
     */
    $(document).on('click', '.removeUserButton', function (e) {
        var id = $(this).data("id");
        var userData = getUserByID(id);
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Bạn có muốn xóa thành viên " + userData.name + " không",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK, Delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + '/admin/users/' + id,
                    type: "delete",
                    async: false,
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        Swal.fire(
                            'Thành công!',
                            'Người dùng ' + userData.name + ' đã bị xóa.',
                            'success'
                        ),

                            getUserData();
                    },
                    error: function (err) {
                        Swal.fire(
                            'Thất bại!',
                            'Admin ' + userData.name + ' không thể bị xóa.',
                            'error'

                        )
                    },
                });
            }
        })
    });
    /**
       * Lock user or unlock user
       * 
       * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
       * 
       * @returns {Response}
       */
    $(document).on('click', '.lockUserButton', function (e) {
        var id = $(this).data("id");
        var userData = getUserByID(id);
        e.preventDefault();
        if (userData.is_active === 1) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Bạn có muốn khóa thành viên " + userData.name + " không",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK, khóa ' + userData.name
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: base_url + '/admin/users/status/' + id,
                        type: "post",
                        async: false,
                        data: {
                            id: id,
                        },
                        success: function (response) {
                            Swal.fire(
                                'Thành công!',
                                'Người dùng ' + userData.name + ' đã bị khóa.',
                                'success'
                            ),

                                getUserData();
                        },
                        error: function (err) {
                            alert('Somethings went wrong!');
                        },
                    });
                }
            })
        } else {
            Swal.fire({
                title: 'Are you sure?',
                text: "Bạn có muốn mở khóa thành viên " + userData.name + " không",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK, mở khóa ' + userData.name
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: base_url + '/admin/users/status/' + id,
                        type: "post",
                        async: false,
                        data: {
                            id: id,
                        },
                        success: function (response) {
                            Swal.fire(
                                'Thành công!',
                                'Người dùng ' + userData.name + ' đã mở khóa.',
                                'success'
                            ),

                                getUserData();
                        },
                        error: function (err) {
                            alert('Somethings went wrong!');
                        },
                    });
                }
            })
        }
    });


});