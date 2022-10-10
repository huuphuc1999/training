@extends('backend.layouts.master')

@section('main-content')
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <img style="height: 100px; width: 300px" src="{{asset('backend/images/logo.png')}}" alt="logo">

        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a style="cursor: pointer;" href="#tab_content1" id="product-tab"
              role="tab" data-toggle="tab" aria-expanded="true">Sản phẩm</a>
          </li>
          <li role="presentation" class=""><a style="cursor: pointer;" href="#tab_content2" role="tab" id="customer-tab"
              data-toggle="tab" aria-expanded="false">Khách hàng</a>
          </li>
          <li role="presentation" class=""><a style="cursor: pointer;" href="#tab_content3" role="tab" id="user-tab"
              data-toggle="tab" aria-expanded="false">Users</a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            <div class="x_title">
              <div style="display: flex;justify-content: center;">
                <form id="searchProductForm" action="">
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Tên sản phẩm</label>
                    <input class="form-control col-md-3 col-xs-12" id="productName" type="text" name="productName"
                      placeholder="Nhập họ tên">
                  </div>
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Tình trạng</label>
                    <select class="form-control col-md-3 col-xs-12" id="productStatus" name="productStatus">
                      <option selected disabled>Chọn trạng thái</option>
                      <option value="1">Đang bán</option>
                      <option value="0">Ngưng bán</option>
                    </select>
                  </div>
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Giá bán từ</label>
                    <input class="form-control col-md-3 col-xs-12" id="productPriceFrom" type="number"
                      name="productPriceFrom">
                  </div>
                  <div style="float:left;margin-right:20px;padding-top: 30px;">
                    ~
                  </div>
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Giá bán đến</label>
                    <input class="form-control col-md-3 col-xs-12" id="productPriceTo" type="number"
                      name="productPriceTo">
                  </div>
                </form>
              </div>
              <div class="clearfix"></div>

            </div>
            <div class=" x_content">
              <button id="addProductBtn" type="button" class="btn btn-primary" data-toggle="modal"
                data-target=".popupProduct"><i class="fa fa-user"></i> &nbsp;Thêm mới</button>
              <div style="margin-top: 5px;
                          float: right;
                          display: block;">
                <button type="button" id="searchProduct" class="btn btn-primary">
                  <i class="fa fa-edit"></i>
                  Tìm kiếm
                </button>
                <button id="refreshProductPage" class="btn btn-info"><i class="fa fa-edit"></i>Xóa tìm</button>
              </div>
              <table class="table table-striped projects" id="products-table">
                <thead>
                  <tr>
                    <th style="width: 1%">#</th>
                    <th style="width: 20%!important">Tên sản phẩm</th>
                    <th style="width: 40%!important">Mô tả</th>
                    <th style="width: 10%!important">Giá</th>
                    <th style="width: 10%!important">Tình trạng</th>
                    <th style="width: 19%!important"></th>
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

                <div class="modal fade bs-example-modal-sm popupProduct" tabindex="-1" role="dialog" aria-hidden="true"
                  style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div style="width: 550px;" class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title" id="popupProductTitle">Thêm sản phẩm</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div>
                          <form id="addProductForm" action="{{route('products.store')}}" method="POST"
                            enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩn</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="text" class="form-control " name="product_name" id="addProductName"
                                  placeholder="Nhập họ tên">
                                <span id="product_name-err" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Giá bán</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="number" class="form-control " name="product_price" id="addProductPrice"
                                  placeholder="Nhập giá bán">
                                <span id="product_price-err" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Mô tả</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <textarea name="description" id="addProductDescription" placeholder="Mô tả sản phẩm"
                                  style="width: 368px; height: 115px;" cols="30" rows="5"></textarea>
                              </div>
                            </div>
                            <div class="form-group">

                              <label class="col-sm-2 control-label">Preview </label>
                              <img style="
                              margin-left: 10px;
                              width: 300px;
                              height: 200px;" id="imgPreview" src="{{asset('backend/images/default.jpg')}}"
                                alt="your image" />


                              <button id="removeImage" type="button" class="btn btn-danger">Xóa
                                ảnh</button>
                              <div style="margin-left: 92px;" class="col-sm-10">
                                <span id="product_image-err" style="display: inline-block"
                                  class="error text-danger d-none"></span>
                              </div>


                            </div>

                            <div class="form-group">

                              <label class="col-sm-2 control-label">Hình ảnh </label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="file-drop-area">
                                  <span class="fake-btn">Chọn ảnh</span>
                                  <span class="file-msg">Hoặc kéo thả ảnh vào đây</span>
                                  <input class="file-input" id="addProductImage" type="file"
                                    accept="image/png, image/jpg, image/jpeg">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Tình trạng</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="checkbox" class="form-control" id="addProductStatus" data-toggle="toggle"
                                  checked data-on="Đang bán" data-off="Ngừng bán" data-onstyle="success"
                                  data-offstyle="danger">
                                <span id="status-err" class="error text-danger d-none"></span>

                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" id="closePopupProductButton" class="btn btn-secondary"
                                data-dismiss="modal">Hủy</button>
                              <button id="addProductButton" type="submit" class="btn btn-danger">Lưu</button>
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
          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
            <div class="x_title">
              <div style="display: flex;justify-content: center;">
                <form id="searchCustomerForm" action="">
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Họ và Tên</label>
                    <input class="form-control col-md-3 col-xs-12" id="customerSearchName" type="text"
                      name="customerSearchName" placeholder="Nhập họ tên">
                  </div>
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Email</label>
                    <input class="form-control col-md-3 col-xs-12" id="customerSearchEmail" type="text"
                      placeholder="Nhập email" name="customerSearchEmail">
                  </div>

                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Trạng thái</label>
                    <select class="form-control col-md-3 col-xs-12" id="customerSearchStatus"
                      name="customerSearchStatus">
                      <option selected disabled>Chọn trạng thái</option>
                      <option value="1">Đang hoạt động</option>
                      <option value="0">Tạm khóa</option>
                    </select>
                  </div>
                  <div style="float:left;margin-right:20px;">
                    <label for="middle-name">Địa chỉ</label>
                    <input class="form-control col-md-3 col-xs-12" id="customerSearchAddress" type="text"
                      name="customerSearchAddress" placeholder="Nhập địa chỉ">
                  </div>
                </form>
              </div>
              <div class="clearfix"></div>

            </div>
            <div class=" x_content">
              <div style="display: flex">
                <button id="addCustomerBtn" style="margin-right: 20px" type="button" class="btn btn-primary"
                  data-toggle="modal" data-target=".popupCustomer"><i class="fa fa-user"></i> &nbsp;Thêm mới</button>
                {{-- <button id="importCSV" style="margin-right: 20px" type="button" class="btn btn-info "><i
                    class="fa fa-upload"></i> &nbsp;Import
                  CSV</button> --}}
                <form id="uploadFileCSV" enctype="multipart/form-data">
                  <label class="btn btn-info " style="margin-right: 20px"> <i class="fa fa-upload"></i> &nbsp;Import
                    CSV
                    <input class="hidden" name="customersFile" id="importCSV" type="file" size="60">
                  </label>
                </form>

                <button type="button" id="exportCSV" class="btn btn-success"><i class="fa fa-download"></i> &nbsp;Export
                  CSV</button>
                <div style="
                  position: absolute;
                  right: 0;
                  display: block;">
                  <button type="button" id="searchCustomer" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                    Tìm kiếm
                  </button>
                  <button id="refreshCustomerPage" class="btn btn-info"><i class="fa fa-edit"></i>Xóa tìm</button>
                </div>
              </div>

              <table class="table table-striped projects" id="customers-table">
                <thead>
                  <tr>
                    <th style="width: 1%">#</th>
                    <th style="width: 20%!important">Họ tên</th>
                    <th style="width: 20%!important">Email</th>
                    <th style="width: 20%!important">Địa chỉ</th>
                    <th style="width: 20%!important">Điện thoại</th>
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

                <div class="modal fade bs-example-modal-sm popupCustomer" tabindex="-1" role="dialog" aria-hidden="true"
                  style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div style="width: 550px;" class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title" id="popupCustomerTitle">Thêm khách hàng</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div>
                          <form id="addCustomerForm" class="form-horizontal">
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="text" class="form-control " name="customer_name" id="addCustomerName"
                                  placeholder="Nhập họ tên">
                                <span id="customer_name-errors" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="email" class="form-control " name="email" id="addCustomerEmail"
                                  placeholder="Nhập email">
                                <span id="email-errors" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Điện thoai</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="number" class="form-control " name="tel_num" id="addCustomerPhone"
                                  placeholder="Điện thoại">
                                <span id="tel_num-errors" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Địa chỉ</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="text" class="form-control " name="address" id="addCustomerAddress"
                                  placeholder="Địa chỉ">
                                <span id="address-errors" class="error text-danger d-none"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Trạng thái</label>
                              <div style="width: 75%;" class="col-sm-10">
                                <input type="checkbox" class="form-control" id="addCustomerStatus" data-toggle="toggle"
                                  checked data-on="Hoạt động" data-off="Tạm khóa" data-onstyle="success"
                                  data-offstyle="danger">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" id="closePopupCustomerButton" class="btn btn-secondary"
                                data-dismiss="modal">Hủy</button>
                              <button id="addCustomerButton" type="button" class="btn btn-danger">Lưu</button>
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

            </div>
            <div class=" x_content">
              <button id="addUserBtn" type="button" class="btn btn-primary" data-toggle="modal"
                data-target=".popupUser"><i class="fa fa-user"></i> &nbsp;Thêm mới</button>
              <div style="margin-top: 5px;
                float: right;
                display: block;">
                <button type="button" id="search" class="btn btn-primary">
                  <i class="fa fa-edit"></i>
                  Tìm kiếm
                </button>
                <button id="refreshPage" class="btn btn-info"><i class="fa fa-edit"></i>Xóa tìm</button>
              </div>
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
  .hidden {
    display: none;
  }

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

  .file-drop-area {
    /* position: relative; */
    /* display: flex; */
    /* align-items: center; */
    /* width: 450px; */
    max-width: 100%;
    padding: 25px;
    border: 1px dashed rgb(203 0 53 / 40%);
    border-radius: 3px;
    transition: 0.2s;

    &.is-active {
      background-color: rgba(255, 255, 255, 0.05);
    }
  }

  .fake-btn {
    flex-shrink: 0;
    background-color: rgb(18 189 162 / 4%);
    border: 1px solid rgb(8 98 85 / 10%);
    border-radius: 3px;
    padding: 8px 15px;
    margin-right: 10px;
    font-size: 12px;
    text-transform: uppercase;
  }

  .file-msg {
    font-size: small;
    font-weight: 300;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .file-input {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    cursor: pointer;
    opacity: 0;

    &:focus {
      outline: none;
    }
  }

  .hoverDisplayImage span {
    display: none;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    color: black;
    background: white;
  }

  .hoverDisplayImage {
    text-decoration: none;
    position: relative;
  }

  .hoverDisplayImage span img {
    float: left;
    height: 130px;
    width: 130px;
  }

  .hoverDisplayImage:hover span {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1000;
    width: auto;
    max-width: 320px;
    min-height: 128px;
    border: 1px solid black;
    margin-top: 12px;
    margin-left: 32px;
    overflow: hidden;
    padding: 8px;
  }
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{asset('backend/js/training/user-screen.js')}}"></script>
<script src="{{asset('backend/js/training/product-screen.js')}}"></script>
<script src="{{asset('backend/js/training/customer-screen.js')}}"></script>
<script>
  var $fileInput = $('.file-input');
  var $droparea = $('.file-drop-area');

  // highlight drag area
  $fileInput.on('dragenter focus click', function() {
    $droparea.addClass('is-active');
  });

  // back to normal state
  $fileInput.on('dragleave blur drop', function() {
    $droparea.removeClass('is-active');
  });

  // change inner text
  $fileInput.on('change', function() {
    var filesCount = $(this)[0].files.length;
    var $textContainer = $(this).prev();

    if (filesCount === 1) {
      // if single file is selected, show file name
      $('#removeImage').show();
      var fileName = $(this).val().split('\\').pop();
      $textContainer.text(fileName);
    } else {
      // otherwise show number of files
      $textContainer.text(filesCount + ' ảnh đã chọn');
    }
  });
</script>
<script>
  $(document).ready(() => {
    /**
     * Put the uploaded photo in preview
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     */
    var defaultImage = $("#imgPreview").attr("src");
      $("#addProductImage").change(function () {
          const file = this.files[0];
          if (file) {
              let reader = new FileReader();
              reader.onload = function (event) {
                  $("#imgPreview")
                    .attr("src", event.target.result);
              };
              reader.readAsDataURL(file);
          }
      });
      /**
     * Handle button remove image 
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     */
      $('#removeImage').click(function () {
        $('#removeImage').hide();
        $("#imgPreview").attr("src", defaultImage);
        $("#addProductImage").val("");
        $('.file-msg').text('Hoặc kéo thả ảnh vào đây');
        $('.fake-btn').text('Chọn ảnh');
        $("#product_image-err").empty();
      });
  });
</script>
@endpush