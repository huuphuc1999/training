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
              <button id="addCustomerBtn" style="margin-right: 20px" type="button" class="btn btn-primary"
                data-toggle="modal" data-target=".popupCustomer"><i class="fa fa-user"></i> &nbsp;Thêm mới</button>
              <button id="importCSV" style="margin-right: 20px" type="button" class="btn btn-info "><i
                  class="fa fa-upload"></i> &nbsp;Import
                CSV</button>
              <button type="button" id="exportCSV" class="btn btn-success"><i class="fa fa-download"></i> &nbsp;Export
                CSV</button>
              <div style="margin-top: 5px;
                float: right;
                display: block;">
                <button type="button" id="searchCustomer" class="btn btn-primary">
                  <i class="fa fa-edit"></i>
                  Tìm kiếm
                </button>
                <button id="refreshCustomerPage" class="btn btn-info"><i class="fa fa-edit"></i>Xóa tìm</button>
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
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
  $(document).on('click', '#user-tab',function(){
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
              userID = data.data.id;
              $('#addUserButton').attr('id','editUserButton');
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
    function getUserByID(id){
      var user = null;
      $.ajax({
            url: `{{ url('/admin/users/'.'${id}') }}`,
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
     $(document).on('click','.removeUserButton', function(e){
      var id =$(this).data("id");
      var userData = getUserByID(id);
      e.preventDefault();
      Swal.fire({
      title: 'Are you sure?',
      text: "Bạn có muốn xóa thành viên " + userData.name +  " không",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK, Delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `{{ url('/admin/users/'.'${id}') }}`,
            type: "delete",
            async: false,
            data: {
              id: id,
            },
            success: function (response){ 
              Swal.fire(
              'Thành công!',
              'Người dùng ' + userData.name +  ' đã bị xóa.',
              'success'
            ),
            
            getUserData();
          },
          error: function (err) {
            Swal.fire(
              'Thất bại!',
              'Admin ' + userData.name +  ' không thể bị xóa.',
              'error'
              
          )},
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
     $(document).on('click','.lockUserButton', function(e){
      var id =$(this).data("id");
      var userData = getUserByID(id);
      e.preventDefault();
      if(userData.is_active === 1){
        Swal.fire({
        title: 'Are you sure?',
        text: "Bạn có muốn khóa thành viên " + userData.name +  " không",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK, khóa ' + userData.name
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: `{{ url('/admin/users/status/'.'${id}') }}`,
              type: "post",
              async: false,
              data: {
                id: id,
              },
              success: function (response){ 
                Swal.fire(
                'Thành công!',
                'Người dùng ' + userData.name +  ' đã bị khóa.',
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
      }else{
        Swal.fire({
      title: 'Are you sure?',
      text: "Bạn có muốn mở khóa thành viên " + userData.name +  " không",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK, mở khóa ' + userData.name
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `{{ url('/admin/users/status/'.'${id}') }}`,
            type: "post",
            async: false,
            data: {
              id: id,
            },
            success: function (response){ 
              Swal.fire(
              'Thành công!',
              'Người dùng ' + userData.name +  ' đã mở khóa.',
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
        
</script>
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
    var idProduct = null;
    var defaultImage = $("#imgPreview").attr("src");
    var dataSearch = {load: 'index'};
    var productStatus = "1";
    getProductData();
    /**
     * Create events for close popup
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#closePopupProductButton').on('click', function (e) {
      $('#editProductButton').attr('id','addProductButton');
        dataSearch = {load: 'index'};
        getProductData();
    });
    /**
     * Reset form before display
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function clearProductErrorsMessage(){
      $("#product_name-err").empty();
      $("#product_price-err").empty();
      $("#product_image-err").empty();
      
    }
    function resetForm(){
          $("#imgPreview").attr("src", defaultImage);
          $('#addProductForm').trigger("reset");
          $('#removeImage').hide();
          $('#addProductStatus').bootstrapToggle('on');
        }
    $('#addProductBtn').on('click',function(){
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
    $('#refreshProductPage').on('click', function (e) {
      $('#productStatus').prop('selectedIndex', -1);
      $(':input').val('');
      dataSearch = {load: 'index'};
      getProductData();
    });
    /**
     * Create events for data searching
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#searchProduct').on('click', function (e) {
      var productName = $("#productName").val();
      var productStatus = $("#productStatus").val();
      var productPriceFrom = $("#productPriceFrom").val();
      var productPriceTo = $('#productPriceTo').val();
        if( (productName == '') && (productStatus == null) && (productPriceFrom == '') && (productPriceTo == '')){
          Swal.fire(
          'Do you forget somethings?',
          'Vui lòng nhập ít nhất một thông tin để tìm kiếm!',
          'warning'
        )
        }else{
          dataSearch = {
            productName:productName, 
            productStatus:productStatus, 
            productPriceFrom:productPriceFrom,
            productPriceTo:productPriceTo,
            load:'search'
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
    function getProductData(){
      var $data_table = $( '#products-table');
      $('#products-table').DataTable({
      createdRow: function( row, data, dataIndex){
        if (data['is_sales'] == 'Đang bán') {
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
          url : '{!! route('products.index') !!}',
          type : "GET",
          data: dataSearch,
      },
      columns: [
          { data: 'product_id', name: 'product_id' },
          { data: 'product_name', name: 'product_name' },
          { data: 'description', name: 'description' },
          { data: 'product_price', name: 'product_price' },
          { data: 'is_sales', name: 'is_sales' },
          { data: 'action', name: 'action', orderable: false, searchable: false},
      ],
    }); 
  }  

      $('#addProductStatus').change(function(){
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
            url: "{{route('products.store')}}",
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
            beforeSend: function(){
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
     $(document).on('click','.popupEditProduct', function(){
      var base_url = window.location.origin;
      $('#popupProductTitle').html('Chỉnh sửa sản phẩm')
      var id = $(this).data("id");
      $.ajax({
            url: `{{ url('/admin/products/details/'.'${id}') }}`,
            type: "GET",
            data: {
              id: id,
            },
            dataType: 'json',
            success: function (data) {
              idProduct = data.data.product_id;
              $('#addProductButton').attr('id','editProductButton');
              $("#addProductName").val(data.data.product_name);
              $("#addProductPrice").val(data.data.product_price);
              $("#addProductDescription").val(data.data.description);
              data.data.product_image != null ? $("#imgPreview").attr("src", base_url + '/storage/' + data.data.product_image) :  $("#imgPreview").attr("src", defaultImage);
              data.data.product_image != null ? $('#removeImage').show() :  $('#removeImage').hide();
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
            url: `{{ url('/admin/products/update/'.'${idProduct}') }}`,
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
            beforeSend: function(){
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
    function getProductByID(id){
      var product = null;
      $.ajax({
            url: `{{ url('/admin/products/details/'.'${id}') }}`,
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
     $(document).on('click','.removeProductButton', function(e){
      var id =$(this).data("id");
      var productData = getProductByID(id);
      e.preventDefault();
      Swal.fire({
      title: 'Are you sure?',
      text: "Bạn có muốn xóa sản phẩm " + productData.product_name +  " không",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK, Delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `{{ url('/admin/products/delete/'.'${id}') }}`,
            type: "delete",
            async: false,
            data: {
              id: id,
            },
            success: function (response){ 
              Swal.fire(
              'Thành công!',
              'Sản phẩm ' + productData.product_name +  ' đã bị xóa.',
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
</script>
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
    var $fileInput = $('.file-input');
    var $droparea = $('.file-drop-area');
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
<script>
  $(document).on('click', '#customer-tab',function(){
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
    var idCustomer = null;
    var dataSearch = {load: 'index'};
    var customerStatus = "1";
    getCustomerData();
    /**
     * Create events for close popup
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#closePopupCustomerButton').on('click', function (e) {
      $('#editCustomerButton').attr('id','addCustomerButton');
        dataSearch = {load: 'index'};
        getCustomerData();
    });
    /**
     * Reset form before display
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    function clearCustomerErrorsMessage(){
      $("#customer_name-errors").empty();
      $("#email-errors").empty();
      $("#tel_num-errors").empty();
      $("#address-errors").empty();
      
    }
    function resetForm(){
          $('#addCustomerForm').trigger("reset");
          $('#addCustomerStatus').bootstrapToggle('on');
        }
    $('#addCustomerBtn').on('click',function(){
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
    $('#refreshCustomerPage').on('click', function (e) {
      $('#customerStatus').prop('selectedIndex', -1);
      $(':input').val('');
      dataSearch = {load: 'index'};
      getCustomerData();
    });
    /**
     * Create events for data searching
     * 
     * @author Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
     * 
     * @returns {Json}
     */
    $('#searchCustomer').on('click', function (e) {
      var name = $("#customerSearchName").val();
      var email = $("#customerSearchEmail").val();
      var address = $("#customerSearchAddress").val();
      var status = $('#customerSearchStatus').val();
        if( (name == '') && (status == null) && (email == '') && (address == '')){
          Swal.fire(
          'Do you forget somethings?',
          'Vui lòng nhập ít nhất một thông tin để tìm kiếm!',
          'warning'
        )
        }else{
          dataSearch = {
            name:name, 
            email:email, 
            address:address,
            status:status,
            load:'search'
          };
          getCustomerData();
        }
    }) 
    $('#exportCSV').click(function(){
      var name = $("#customerSearchName").val();
      var email = $("#customerSearchEmail").val();
      var address = $("#customerSearchAddress").val();
      var status = $('#customerSearchStatus').val();
        if( (name == '') && (status == null) && (email == '') && (address == '')){
          dataSearch = {
            load:'index'
          };
        }else{
          dataSearch = {
            name:name, 
            email:email, 
            address:address,
            status:status,
            load:'search'
          };
        };
      Swal.fire({
        title: 'Are you sure?',
        text: "Xuất file excel khách hàng "+  " không",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, Xuất file '
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "{{URL::to('/admin/customers/export')}}?" + $.param(dataSearch);
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
    function getCustomerData(){
      var $data_table = $( '#customers-table');
      $('#customers-table').DataTable({
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
          url : '{!! route('customers.index') !!}',
          type : "GET",
          data: dataSearch,
      },
      columns: [
          { data: 'customer_id', name: 'customer_id' },
          { data: 'customer_name', name: 'customer_name' },
          { data: 'email', name: 'email' },
          { data: 'address', name: 'address' },
          { data: 'tel_num', name: 'tel_num' },
          { data: 'action', name: 'action', orderable: false, searchable: false},
      ],
    }); 
  }  

      $('#addCustomerStatus').change(function(){
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
        
        $('body').on('click', '#addCustomerButton', function (e) {
          e.preventDefault();
          var form = $('#addCustomerForm')[0];
          var formData = new FormData(form);
          formData.append('is_active', customerStatus);
          $.ajax({
            url: "{{route('customers.store')}}",
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
            beforeSend: function(){
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
     $(document).on('click','.popupEditCustomer', function(){
      $('#popupCustomerTitle').html('Chỉnh sửa khách hàng')
      var id = $(this).data("id");
      $.ajax({
            url: `{{ url('/admin/customers/details/'.'${id}') }}`,
            type: "GET",
            data: {
              id: id,
            },
            dataType: 'json',
            success: function (data) {
              idCustomer = data.data.customer_id;
              $('#addCustomerButton').attr('id','editCustomerButton');
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
        $('body').on('click', '#editCustomerButton', function (e) {
          e.preventDefault();
          clearCustomerErrorsMessage();
          var form = $('#addCustomerForm')[0];
          var formData = new FormData(form);
          formData.append('is_active', customerStatus);
          formData.append('customer_id', idCustomer);
          $.ajax({
            url: `{{ url('/admin/customers/update/'.'${idCustomer}') }}`,
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
            beforeSend: function(){
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
   
});
</script>
@endpush