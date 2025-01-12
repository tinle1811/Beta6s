@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 profile-sidebar">
                <div class="profile-avatar-wrapper">
                    <img src="{{asset('/assetsUser/img_product/4-4.jpg')}}" alt="avata" class="profile-avatar">
                    <p>Khoa Nguyễn</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.account.index') }}"><i class="bi bi-person"></i><span class="text">Tài khoản của tôi</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.account.purchaseHistory') }}"><i class="bi bi-cart-check"></i><span class="text">Lịch sử mua hàng</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.account.historyEvaluate') }}"><i class="bi bi-chat-left"></i><span class="text">Lịch sử đánh giá</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 profile-content">
                <ul class="d-flex justify-content-between align-items-center list-unstyled bg-black py-3 px-4 fs-6">
                    <li><a href="{{ route('user.account.purchase')}}" class="text-white text-decoration-none {{ $type == '0' ? 'fw-bold' : '' }}">Tất cả</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 1]) }}" class="text-white text-decoration-none {{ $type == 1 ? 'fw-bold' : '' }}">Chờ xử lý</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 2]) }}" class="text-white text-decoration-none {{ $type == 2 ? 'fw-bold' : '' }}">Đang giao hàng</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 3]) }}" class="text-white text-decoration-none {{ $type == 3 ? 'fw-bold' : '' }}">Hoàn thành</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 4]) }}" class="text-white text-decoration-none {{ $type == 4 ? 'fw-bold' : '' }}">Hủy</a></li>

                </ul>
                <div class="container mt-4">
                    <!-- Danh sách sản phẩm -->
                    <div class="p-3 bg-light mb-3 border rounded">
                        @foreach ($hoaDons as $hoaDon)  <!-- Lặp qua từng hóa đơn -->
                        <!-- Sản phẩm -->
                        <div class="p-3 rounded">
                            <!-- Trạng thái đơn hàng -->
                            <div class="mb-2 text-end">
                                <span class="text-danger fs-5k">{{ $hoaDon->getTrangThaiName() }}</span>
                            </div>
        
                            <!-- Thông tin sản phẩm -->
                            <div class="info-producct d-flex justify-content-between align-items-center">
                                <!-- Thông tin chi tiết -->
                                <div class="d-flex">
                                    <img src="{{ asset('assetsUser/img_product/' . $hoaDon->HinhAnh) }}" class="img-thumbnail rounded me-3" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div>
                                        <h5 class="mb-1">{{ $hoaDon->TenSP }}</h5>
                                        <p class="mb-1">Giá: {{ number_format($hoaDon->DonGia, 0, ',', '.' )}} đ</p>
                                        <p class="mb-0">Số lượng: {{ $hoaDon->SoLuong }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end py-3">
                            <p class="fw-bold mb-0 fs-5">Tổng tiền: {{ number_format($hoaDon->TongTien, 0, ',', '.' )}}đ</p>
                        </div>
                        <div class="text-end">
                            {{-- Các nút thao tác có thể tiếp tục ở đây --}}
                            @if($hoaDon->TrangThai == 1) <!-- Chờ lấy hàng -->
                                <button class="btn btn-danger me-2">Hủy</button>
                                <button class="btn btn-primary me-2">Liên hệ</button>
                            @elseif($hoaDon->TrangThai == 2) <!-- Chờ giao hàng -->
                                <button class="btn btn-success me-2">Đã nhận được hàng</button>
                                <button class="btn btn-primary me-2">Liên hệ</button>
                            @elseif($hoaDon->TrangThai == 3) <!-- Hoàn thành -->
                                <button class="btn btn-warning me-2">Đánh giá</button>
                                <button class="btn btn-success me-2">Mua lại</button>
                                <button class="btn btn-primary me-2">Liên hệ</button>
                            @elseif($hoaDon->TrangThai == 4) <!-- Hủy -->
                                <button class="btn btn-success me-2">Mua lại</button>
                                <button class="btn btn-primary me-2">Liên hệ</button>
                            @endif
                        </div>
                            {{-- @foreach ($hoaDon->chiTietHoaDons as $cthd)  <!-- Lặp qua chi tiết hóa đơn của từng hóa đơn -->
                            @endforeach --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection