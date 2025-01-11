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
                    <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-person"></i><span class="text">Tài khoản của tôi</span></a></li>
                    <li class="nav-item sub"><a class="nav-link" href="#"><span class="text">Hồ sơ</span></a></li>
                    <li class="nav-item sub"><a class="nav-link" href="#"><span class="text">Địa chỉ</span></a></li>
                    <li class="nav-item sub"><a class="nav-link" href="#"><span class="text">Đổi mật khẩu</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-cart"></i><span class="text">Đơn mua</span></a></li>
                </ul>
            </div>
            <div class="col-md-9 profile-content">
                <ul class="d-flex justify-content-between align-items-center list-unstyled bg-black py-3 px-4 fs-6 mx-1">
                    <li><a href="{{ route('user.account.purchase', ['type' => 0]) }}" class="text-white text-decoration-none {{ $type == 0 ? 'fw-bold' : '' }}">Tất cả</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 1]) }}" class="text-white text-decoration-none {{ $type == 1 ? 'fw-bold' : '' }}">Chờ lấy hàng</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 2]) }}" class="text-white text-decoration-none {{ $type == 2 ? 'fw-bold' : '' }}">Chờ giao hàng</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 3]) }}" class="text-white text-decoration-none {{ $type == 3 ? 'fw-bold' : '' }}">Hoàn thành</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 4]) }}" class="text-white text-decoration-none {{ $type == 4 ? 'fw-bold' : '' }}">Đã hủy</a></li>
                </ul>
                <div class="container mt-4">
                    <div class="mb-3 rounded">
                        {{$hasOrders = false;}}
                        @foreach ($hoaDons as $hoaDon)
                            @php $hasOrders = true; @endphp
                            <div class="p-3 bg-light border mb-3 rounded">
                                <div class="mb-2 text-end">
                                    <span class="fs-5k {{ $hoaDon->getTrangThaiName()['class'] }}">
                                        {{ $hoaDon->getTrangThaiName()['name'] }}
                                    </span>
                                </div>
                                @foreach ($hoaDon->chiTietHoaDons as $cthd)
                                    <div class="info-producct d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <img src="{{ asset('assetsUser/img_product/' . $cthd->sanPham->HinhAnh) }}" class="img-thumbnail rounded me-3" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div>
                                                <h5 class="mb-1">{{ $cthd->sanPham->TenSP }}</h5>
                                                <p class="mb-1">Giá: {{ number_format($cthd->DonGia, 0, ',', '.' )}} đ</p>
                                                <p class="mb-0">Số lượng: {{ $cthd->SoLuong }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="fs-7">{{ number_format($cthd->DonGia * $cthd->SoLuong, 0, ',', '.' )}}đ</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-end py-3 me-3">
                                    <p class="fw-bold mb-0 fs-5">Tổng tiền: {{ number_format($hoaDon->TongTien, 0, ',', '.' )}}đ</p>
                                </div>
                                <div class="text-end">
                                    @if($hoaDon->TrangThai == 0)
                                        <button class="btn btn-danger me-2">Hủy</button>
                                        <button class="btn btn-primary me-2">Liên hệ</button>
                                    @elseif($hoaDon->TrangThai == 1)
                                        <button class="btn btn-success me-2">Đã nhận được hàng</button>
                                        <button class="btn btn-primary me-2">Liên hệ</button>
                                    @elseif($hoaDon->TrangThai == 2)
                                        <button class="btn btn-warning me-2">Đánh giá</button>
                                        <button class="btn btn-success me-2">Mua lại</button>
                                        <button class="btn btn-primary me-2">Liên hệ</button>
                                    @elseif($hoaDon->TrangThai == 3)
                                        <button class="btn btn-success me-2">Mua lại</button>
                                        <button class="btn btn-primary me-2">Liên hệ</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if(!$hasOrders)
                        <p class="text-center text-muted bg-light py-3 rounded">Bạn chưa có đơn hàng nào {{ $viewData['TabMessage'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
