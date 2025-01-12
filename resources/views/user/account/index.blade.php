@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 profile-sidebar">
                <div class="profile-avatar-wrapper">
                    <img src="{{ asset('/assetsUser/img_product/4-4.jpg') }}" alt="avata" class="profile-avatar">
                    <p>Khoa Nguyễn</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-person"></i><span class="text">Tài khoản
                                của tôi</span></a>
                    </li>
                    <li class="nav-item sub">
                        <a class="nav-link" href="#"> <span class="text">Hồ sơ</span></a>
                    </li>
                    <li class="nav-item sub">
                        <a class="nav-link" href="#"><span class="text">Địa chỉ</span></a>
                    </li>
                    <li class="nav-item sub">
                        <a class="nav-link" href="#"><span class="text">Đổi mật khẩu</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.account.purchase') }}"><i class="bi bi-cart"></i><span
                                class="text">Đơn mua</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('test') }}"><i class="bi bi-cart"></i><span class="text">Danh
                                sách đơn hàng</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 profile-content">
                <h4>Hồ sơ của tôi</h4>
                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                <hr>
                <form>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row form-group">
                                <label for="username" class="col-sm-4 col-form-label">Tên đăng nhập:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="username" value="Nguyễn Hải Đăng Khoa"
                                        disabled>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="displayName" class="col-sm-4 col-form-label">Tên khách hàng:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="displayName" value="Khoa Nguyễn">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="email" class="col-sm-4 col-form-label">Email:</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email"
                                        value="0306221240@caothang.edu.vn" disabled>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="phone" class="col-sm-4 col-form-label">Số điện thoại:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="phone" value="0373275100">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-4 col-form-label">Giới tính:</label>
                                <div class="col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="male" name="gender"
                                            value="male" checked>
                                        <label class="form-check-label" for="male">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="female" name="gender"
                                            value="female">
                                        <label class="form-check-label" for="female">Nữ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="dob" class="col-sm-4 col-form-label">Ngày sinh:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="dob" value="2004-12-23">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-8 offset-sm-4">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 avatar-section text-center">
                            <img src="{{ asset('/assetsUser/img_product/4-4.jpg') }}" alt="Khoa Nguyễn"
                                class="profile-avatar mb-3">
                            <button type="button" class="btn btn-primary btn-change-avatar" data-bs-toggle="modal"
                                data-bs-target="#changeAvatarModal" style="margin-left:35%">Đổi Ảnh</button>
                            <p class="text-small">Dung lượng file tối đa 1MB<br>Định dạng: .JPEG, .PNG</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Change Avatar -->
    <div class="modal fade" id="changeAvatarModal" tabindex="-1" aria-labelledby="changeAvatarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeAvatarModalLabel">Đổi ảnh đại diện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" class="form-control" accept=".jpg, .jpeg, .png">
                    <small class="text-muted">Dung lượng tối đa 1MB, định dạng .JPEG, .PNG</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
