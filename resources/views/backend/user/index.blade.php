@extends('backend.layouts.master')

@section('main-content')
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <img style="height: 50px; width: 165px" src="{{asset('backend/images/logo.png')}}" alt="logo">

        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab"
              aria-expanded="true">Sản phẩm</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"
              aria-expanded="false">Khách hàng</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab"
              aria-expanded="false">Users</a>
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
                <p style="color: black;
                                  font-size: 12px;
                                  font-weight: 500;">Hiển thị từ 1 ~ 10 trong tổng số {{count($users)}} user </p>
              </div>
            </div>
            <div class="x_content">

              <a style="height: 25px;width: 85px;" href="{{route('users.create')}}" class="btn btn-success btn-xs"><i
                  class="fa fa-user"></i> &nbsp; Thêm mới</a>

              <!-- start project list -->
              <table class="table table-striped projects">
                <thead>
                  <tr>
                    <th style="width: 1%">#</th>
                    <th style="width: 20%">Họ tên</th>
                    <th tyle="width: 20%">Email</th>
                    <th tyle="width: 10%">Nhóm</th>
                    <th tyle="width: 10%">Trạng Thái</th>
                    <th tyle="width: 40%"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>
                      <a>{{$user->name}}</a>
                    </td>
                    <td>
                      <a>{{$user->email}}</a>
                    </td>
                    <td>
                      <a>{{$user->group_role}}</a>
                    </td>
                    <td class="project_progress">
                      @if($user->is_active === 1)
                      <a style="color: rgb(34, 100, 54)">Đang hoạt động</a>
                      @else
                      <a style="color: red">Tạm khóa</a>
                      @endif
                    </td>
                    <td>
                      <div style="display: inline-flex">
                        <button><i class="fa fa-edit"></i></button>
                        <button><i class="fa fa-remove"></i></button>
                        <button><i class="fa fa-lock"></i></button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- end project list -->
              {!! $users->links() !!}

            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
@push('styles')
<style>
  /* .badge {
    background-color: #cc1313;
  } */

  .swal2-popup {
    font-size: 1.6rem !important;
  }
</style>
@endpush
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function(){
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
              $.ajax({
              url:"{{ route('users.index') }}",
              data:{
                name:name, 
                email:email, 
                role:role,
                status:status
              },
              success:function(data){
                // $('.data').html(data);
              }
            });
          //   $('body').on('click', '.pagination a', function (e) {
          //     e.preventDefault();
          //     $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 10000;" src="https://i.imgur.com/v3KWF05.gif />');
          //     var url = $(this).attr('href');
          //     window.history.pushState("", "", url);
          //     // loadProducts(url);
          // });

          // function loadProducts(url) {
          //     $.ajax({
          //         type:'get',
          //         url: url,
          //         data:{start:startDate, end:endDate, phone:phone},
          //     }).done(function (data) {
          //         $('.data').html(data);
          //     }).fail(function () {
          //         console.log("Failed to load data!");
          //     });
          // }
            }
            
    });   
});
        
</script>
@endpush