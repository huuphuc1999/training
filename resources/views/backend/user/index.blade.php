@extends('backend.layouts.master')

@section('main-content')
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <img style="height: 50px; width: 165px" src="{{asset('backend/images/logo.png')}}" alt="logo">

        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a style="cursor: pointer;" href="#tab_content1" id="home-tab"
              role="tab" data-toggle="tab" aria-expanded="true">Sản phẩm</a>
          </li>
          <li role="presentation" class=""><a style="cursor: pointer;" href="#tab_content2" role="tab" id="profile-tab"
              data-toggle="tab" aria-expanded="false">Khách hàng</a>
          </li>
          <li role="presentation" class=""><a style="cursor: pointer;" href="#tab_content3" role="tab" id="profile-tab2"
              data-toggle="tab" aria-expanded="false">Users</a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">



          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">



          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
            <div class="x_title">
              <div style="display: flex;justify-content: center;">
                <form id="searchForm" action="">
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Tên</label>
                    <input class="form-control col-md-3 col-xs-12" id="name" type="text" name="name"
                      placeholder="Nhập họ tên">
                  </div>
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Email</label>
                    <input class="form-control col-md-3 col-xs-12" id="email" type="text" placeholder="Nhập email"
                      name="email">
                  </div>
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Nhóm</label>
                    <select class="form-control col-md-3 col-xs-12" id="role" name="role">
                      <option selected disabled>Chọn nhóm</option>
                      @foreach ($groupRole as $role)
                      <option value="{{ $role }}">{{ $role }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div style="float:left;">
                    <label for="middle-name">Trạng thái</label>
                    <select class="form-control col-md-3 col-xs-12" id="status" name="status">
                      <option selected disabled>Chọn trạng thái</option>
                      <option value="1">Đang hoạt động</option>
                      <option value="0">Tạm khóa</option>
                    </select>
                  </div>
                </form>
              </div>
              <div class="clearfix"></div>
              <div style="margin-top: 5px;
                          float: right;
                          display: block;">
                <button type="button" id="search" class="btn btn-primary">
                  <i class="fa fa-edit"></i>
                  Tìm kiếm
                </button>
                <button id="refreshPage" class="btn btn-info"><i class="fa fa-edit"></i>Xóa tìm</button>
              </div>
            </div>
            <div class=" x_content">
              <button id="addUserBtn" type="button" class="btn btn-primary" data-toggle="modal"
                data-target=".popupUser"><i class="fa fa-user"></i> &nbsp;Thêm mới</button>
              <table class="table table-striped projects" id="users-table">
                <thead>
                  <tr>
                    <th style="width: 1%">#</th>
                    <th style="width: 20%!important">Họ tên</th>
                    <th style="width: 20%!important">Email</th>
                    <th style="width: 20%!important">Nhóm</th>
                    <th style="width: 20%!important">Trạng Thái</th>
                    <th style="width: 19%!important"></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
              <!-- end end list -->
              <div class="x_content">

                <!-- modals -->
                <!-- Small modal -->

                <div class="modal fade bs-example-modal-sm popupUser" tabindex="-1" role="dialog" aria-hidden="true"
                  style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div style="width: 550px;" class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title" id="popupUserTitle">Thêm User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div>
                          <form id="addUserForm" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="text" class="form-control " name="addUserName" id="addUserName"
                                  placeholder="Nhập họ tên">
                                <span id="name-err" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="email" class="form-control " name="addUserEmail" id="addUserEmail"
                                  placeholder="Nhập email">
                                <span id="email-err" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Mật khẩu</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="password" class="form-control " name="addUserPassword" id="addUserPassword"
                                  placeholder="Mật khẩu">
                                <span id="password-err" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Xác nhận</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="password" class="form-control " name="addUserPassword"
                                  id="addUserPasswordConfirm" placeholder="Xác nhận mật khẩu">
                                <span id="password_confirmation-err" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Nhóm</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <select class="form-control col-md-3 col-xs-12 " id="addUserRole" name="addUserRole">
                                  <option selected disabled>Chọn nhóm</option>
                                  @foreach ($groupRole as $role)
                                  <option value="{{ $role }}">{{ $role }}</option>
                                  @endforeach
                                </select>
                                <span id="group_role-err" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Trạng thái</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="checkbox" class="form-control" id="addUserStatus" data-toggle="toggle"
                                  checked data-on="Hoạt động" data-off="Tạm khóa" data-onstyle="success"
                                  data-offstyle="danger">
                                <span id="status-err" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" id="closePopupUserButton" class="btn btn-secondary"
                                data-dismiss="modal">Hủy</button>
                              <button id="addUserButton" type="submit" class="btn btn-danger">Lưu</button>
                            </div>
                          </form>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /modals -->
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
@push('styles')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
  rel="stylesheet">

<style>
  .swal2-popup {
    font-size: 1.6rem !important;
  }

  .statusActive {
    color: green;
  }

  .statusInactive {
    color: red;
  }

  .dataTables_paginate {
    cursor: pointer;
  }

  .col-sm-2 {
    width: 17%;
  }

  .toggle.btn {
    min-width: 10.7rem;
    min-height: 3.15rem;
  }
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function(){
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

    var dataSearch = {load: 'index'};
    getUserData();
    /**
     * Create events for close popup
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#closePopupUserButton').on('click', function (e) {
      $('#editUserButton').attr('id','addUserButton');
      dataSearch = {load: 'index'};
      getUserData();
    });
    /**
     * Reset form before display
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function clearErrorsMessage(){
      $("#name-err").empty();
      $("#email-err").empty();
      $("#password-err").empty();
      $("#password_confirmation-err").empty();
      $("#status-err").empty();
      $("#group_role-err").empty();
    }
    $('#addUserBtn').on('click',function(){
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
    $('#refreshPage').on('click', function (e) {
      $('#status').prop('selectedIndex', -1);
      $('#role').prop('selectedIndex', -1);
      $(':input').val('');
      dataSearch = {load: 'index'};
      getUserData();
    });
    /**
     * Create events for data searching
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#search').on('click', function (e) {
      var name = $("#name").val();
      var email = $("#email").val();
      var role = $("#role").val();
      var status = $('#status').val();
      e.preventDefault();
        if( (email == '') && (name == '') && (role == null) && (status == null)){
          Swal.fire(
          'Do you forget somethings?',
          'Vui lòng nhập ít nhất một thông tin để tìm kiếm!',
          'warning'
        )
        }else{
          dataSearch = {
            name:name, 
            email:email, 
            role:role,
            status:status,
            load:'search'
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
    function getUserData(){
      var $data_table = $( '#users-table');
      $('#users-table').DataTable({
      createdRow: function( row, data, dataIndex){
        if (data['is_active'] == 'Đang hoạt động') {
            $('td', row).eq(4).addClass('statusActive');
        }else {
            $('td', row).eq(4).addClass('statusInactive');

        }
      },
      drawCallback:function(){
        var page_min = 1;
        var $api = this.api();
        var pages = $api.page.info().pages;
        var rows = $api.data().length;

        // Tailor the settings based on the row count
        if(rows <= page_min){
            // Not enough rows for really any features, hide filter/pagination/length
            $data_table
                .next('.dataTables_info').css('display','none')
                .next('.dataTables_paginate').css('display','none');

            $data_table
                .prev('.dataTables_filter').css('display', 'none')
                .prev('.dataTables_length').css('display', 'none')
        } else if(pages === 1){
            // With this current length setting, not more than 1 page, hide pagination
            $data_table
                .next('.dataTables_info').css('display','none')
                .next('.dataTables_paginate').css('display','none');
        } else {
            // SHow everything
            $data_table
                .next('.dataTables_info').css('display','block')
                .next('.dataTables_paginate').css('display','block');
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
          url : '{!! route('users.index') !!}',
          type : "GET",
          data: dataSearch,
      },
      columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'group_role', name: 'group_role' },
          { data: 'is_active', name: 'is_active' },
          { data: 'action', name: 'action', orderable: false, searchable: false},
      ],
    }); 
  }  

      var userStatus = "1";
      $('#addUserStatus').change(function(){
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
            url: "{{route('users.store')}}",
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
            beforeSend: function(){
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
     $(document).on('click','.popupEditUser', function(){
      $('#popupUserTitle').html('Chỉnh sửa User')
      var idUSer = $(this).data("id");
      $.ajax({
            url: `{{ url('/admin/users/'.'${idUSer}') }}`,
            type: "GET",
            data: {
              id: idUSer,
            },
            dataType: 'json',
            success: function (data) {
              userID = data.user.id;
              $('#addUserButton').attr('id','editUserButton');
              $("#addUserName").val(data.user.name);
              $("#addUserEmail").val(data.user.email);
              $("#addUserRole").val(data.user.group_role); 
              data.user.is_active === 1 ? $('#addUserStatus').bootstrapToggle('on') : $('#addUserStatus').bootstrapToggle('off');
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
            url: `{{ url('/admin/users/'.'${userID}') }}`,
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
            beforeSend: function(){
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
});
        
</script>
@endpush