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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm"><i
                  class="fa fa-user"></i> &nbsp;Thêm mới</button>
              <table class="table table-striped projects" id="users-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Nhóm</th>
                    <th>Trạng Thái</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
              <!-- end end list -->
              <div class="x_content">

                <!-- modals -->
                <!-- Small modal -->

                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true"
                  style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div style="width: 550px;" class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">Thêm User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div>
                          <form id="addUserForm" class="form-horizontal">
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="text" class="form-control " name="addUserName" id="addUserName"
                                  placeholder="Nhập họ tên">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="email" class="form-control " name="addUserEmail" id="addUserEmail"
                                  placeholder="Nhập email">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Mật khẩu</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="password" class="form-control " name="addUserPassword" id="addUserPassword"
                                  placeholder="Mật khẩu">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Xác nhận</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="password" class="form-control " name="addUserPasswordConfirm"
                                  id="addUserPasswordConfirm" placeholder="Xác nhận mật khẩu">
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
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Trạng thái</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="checkbox" class="form-control" id="addUserStatus" checked
                                  data-toggle="toggle" data-on="Hoạt động" data-off="Tạm khóa" value="TRUE"
                                  data-onstyle="success" data-offstyle="danger">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                              <button type="button" class="btn btn-danger">Lưu</button>
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
     * Create events for Adding Search
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    var dataSearch = {load: 'index'};
    getUserData();
    $('#refreshPage').on('click', function (e) {
    $('#status').prop('selectedIndex', -1);
    $('#role').prop('selectedIndex', -1);
    $(':input').val('');
    dataSearch = {load: 'index'};
    getUserData();
    });
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
      $('#addUserStatus').change(function(){
        if($(this).attr('checked')){
              $(this).val('TRUE');
        }else{
              $(this).val('FALSE');
        }
    });
      /**
     * Save data to database
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Response}
     */
      $('#addUserForm').submit(function(e){
          e.preventDefault();
          var name = $("#addUserName").val();
          var email = $("#addUserEmail").val();
          var password = $("#addUserPassword").val();
          var role = $("#role").val();
          var status = $("#addUserStatus").val();
          $.ajax({
            url: "{{route('users.store')}}",
            type: "POST",
            data: {
              name: name,
              email: email,
              password: password,
              role: role,
              status: status,
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
              title: 'New Role Added'
            })

            },
            error: function (data) {
            //   // console.log(data);
            //   Swal.fire({
            //   icon: 'error',
            //   title: 'Oops...',
            //   text: (typeof data.responseJSON.permission =='undefined')  ? data.responseJSON.name  : data.responseJSON.permission,
            // })
            }
        });
    });
});
        
</script>
@endpush