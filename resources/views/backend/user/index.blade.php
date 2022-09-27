@extends('backend.layouts.master')

@section('main-content')
<div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <img style="height: 50px; width: 165px" src="{{asset('backend/images/logo.png')}}" alt="logo">

            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Sản phẩm</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Khách hàng</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Users</a>
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
                        <form action="">
                            <div style="float:left;margin-right:20px;">
                                <label for="middle-name" >Tên</label>
                                <input class="form-control col-md-3 col-xs-12" type="text" name="name" placeholder="Nhập họ tên">
                            </div>
                            <div style="float:left;margin-right:20px;">
                                <label for="middle-name">Email</label>
                                <input  class="form-control col-md-3 col-xs-12" type="text" placeholder="Nhập email" name="email" >
                            </div>
                            <div style="float:left;margin-right:20px;">
                                <label for="middle-name" >Nhóm</label>
                                <select class="form-control col-md-3 col-xs-12" name="myselect">
                                    <option selected disabled>Chọn nhóm</option>
                                    @foreach ($groupRole as $role)
                                        <option value="{{ $role }}"
                                        >{{ $role }}</option>
                                    @endforeach
                                    </select>
                                {{-- <input  class="form-control col-md-3 col-xs-12" type="text" placeholder="Chọn nhóm" name="group_role" > --}}
                            </div>
                            <div style="float:left;">
                                <label for="middle-name" >Trạng thái</label>
                                <input  class="form-control col-md-3 col-xs-12" type="text" placeholder="Chọn trạng thái" name="is_active" >
                            </div>
                        </form>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div style="margin-top: 5px;
                                float: right;
                                display: block;">
                        <button class="btn btn-primary"><i class="fa fa-edit"></i>Tìm kiếm</button>
                        <button class="btn btn-info"><i class="fa fa-edit"></i>Xóa tìm</button>
                        <p style="color: black;
                                  font-size: 12px;
                                  font-weight: 500;">Hiển thị từ 1 ~ 10 trong tổng số {{count($users)}} user </p>

                    </div>
                  </div>
                  <div class="x_content">
          
                    <a style="height: 25px;width: 85px;" href="{{route('users.create')}}" class="btn btn-success btn-xs"><i class="fa fa-user"></i>	&nbsp; Thêm mới</a>
          
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
    input, label {
    display:block;
}
    /* .badge{
      background-color: #cc1313;
    }
    .swal2-popup {
  font-size: 1.6rem !important;
} */
  </style>
   @endpush