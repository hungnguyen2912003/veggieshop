@extends('layouts.client.client')

@section('title', 'Tài khoản')

@section('breadcrumb', 'Tài khoản của tôi')

@section('content')
<div class="liton__wishlist-area pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- PRODUCT TAB AREA START -->
                <div class="ltn__product-tab-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="ltn__tab-menu-list mb-50">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_tab_dashboard">Bảng điều khiển <i class="fas fa-home"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_order">Đơn hàng <i class="fas fa-file-alt"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_address">Địa chỉ <i class="fas fa-map-marker-alt"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_account">Chi tiết tài khoản <i class="fas fa-user"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_password">Đổi mật khẩu <i class="fas fa-user"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="liton_tab_dashboard">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <p>Xin chào <strong>{{ $user->email }}</strong> (Không phải bạn <strong>{{ $user->email }}</strong>? <small><a href="{{ route('logout') }}">Đăng xuất</a></small>)</p>
                                            <p>Từ bằng điều khiến tài khoản của bạn, bạn có thế xem <span>các đơn hàng gần đây</span>, quản lý <span>địa chỉ giao hàng và thanh toán của bạn</span>, và <span>chỉnh sửa mặt khẩu và thông tin chi tiết về tài khoản của bạn</span>.</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="liton_tab_order">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái</th>
                                                            <th>Tổng tiền</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Jun 22, 2019</td>
                                                            <td>Pending</td>
                                                            <td>$3000</td>
                                                            <td><a href="cart.html">View</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="liton_tab_address">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <p>Các địa chỉ sau đây sẽ được sử dụng trên trang thanh toán theo mặc định.</p>
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên người nhận</th>
                                                                <th>Địa chỉ</th>
                                                                <th>Thành phố</th>
                                                                <th>Số điện thoại</th>
                                                                <th>Mặc định</th>
                                                                <th>Hành động</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($addresses as $address)
                                                                <tr>
                                                                    <td>{{ $address->full_name }}</td>
                                                                    <td>{{ $address->address }}</td>
                                                                    <td>{{ $address->city }}</td>
                                                                    <td>{{ $address->phone }}</td>
                                                                    <td>
                                                                        @if ($address->default)
                                                                            <span class="badge bg-success">Mặc định</span>
                                                                        @else
                                                                            <form action="{{ route('account.addresses.update', $address->id) }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button type="submit" class="btn btn-sm btn-warning">Chọn</button>
                                                                            </form>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <form action="{{ route('account.addresses.delete', $address->id) }}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?')">Xóa</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="6" class="text-center text-muted">Chưa có địa chỉ nào được thêm</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="btn-wrapper">
                                                    <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase" data-bs-toggle="modal" data-bs-target="#addAddressModal">Thêm địa chỉ mới</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="padding: 5px 10px">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="addAddressModal">Thêm địa chỉ mới</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('account.addresses.add') }}" method="POST" id="addAddressForm">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="full_name" class="form-label">Tên người nhận</label>
                                                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nhập tên người nhận">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="address" class="form-label">Địa chỉ</label>
                                                                <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="city" class="form-label">Thành phố</label>
                                                                <input type="text" class="form-control" id="city" name="city" placeholder="Nhập thành phố">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">Số điện thoại</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                                                            </div>
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input" type="checkbox" id="default_address" name="default_address">
                                                                <label class="form-check-label" for="default_address">
                                                                    Đặt làm địa chỉ mặc định
                                                                </label>
                                                            </div>
                                                            <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Lưu thay đổi</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="liton_tab_account">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="ltn__form-box">
                                                <form action="{{ route('account.update') }}" method="POST" id="update-account-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row mb-50">
                                                        <div class="col-md-12 text-center mb-3">
                                                            <div class="profile-pic-container">
                                                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('storage/uploads/users/default-avatar.png') }}" alt="Avatar" id="preview-image" class="profile-pic">
                                                                <input type="file" name="avatar" id="avatar" accept="image/*" class="d-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Họ và tên:</label>
                                                            <input type="text" name="ltn__name" placeholder="Nhập họ và tên" value="{{ $user->name }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Số điện thoại:</label>
                                                            <input type="text" name="ltn__phone" placeholder="Nhập số điện thoại" value="{{ $user->phone_number }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email:</label>
                                                            <input type="email" name="ltn__email" placeholder="Nhập email" value="{{ $user->email }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Địa chỉ:</label>
                                                            <input type="text" name="ltn__address" placeholder="Nhập địa chỉ" value="{{ $user->address }}">
                                                        </div>
                                                    </div>

                                                    <div class="btn-wrapper">
                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Lưu thay đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="liton_tab_password">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="ltn__form-box">
                                                <form action="{{ route('account.change-password') }}" method="POST" id="change-password-form">
                                                    <fieldset>
                                                        <div class="row mb-50">
                                                            <div class="col-md-12">
                                                                <label>Mật khẩu hiện tại:</label>
                                                                <input type="password" name="ltn__current-password" placeholder="Nhập mật khẩu hiện tại">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Mật khẩu mới:</label>
                                                                <input type="password" name="ltn__new-password" placeholder="Nhập mật khẩu mới">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Nhập lại mật khẩu mới:</label>
                                                                <input type="password" name="ltn__confirm-new-password" autocomplete="new-password" placeholder="Nhập lại mật khẩu mới">
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="btn-wrapper">
                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Lưu thay đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT TAB AREA END -->
            </div>
        </div>
    </div>
</div>
@endsection