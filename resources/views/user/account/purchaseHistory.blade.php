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
                    <!-- Các menu khác -->
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.account.index') }}"><i class="bi bi-person"></i><span class="text">Tài khoản của tôi</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.account.purchase')}}"><i class="bi bi-cart"></i><span class="text">Đơn mua</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.account.historyEvaluate') }}"><i class="bi bi-chat-left"></i><span class="text">Lịch sử đánh giá</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 profile-content">
                <h4>Danh sách sản phẩm đã mua</h4>
                <p>Danh sách các sản phẩm bạn đã mua trong các đơn hàng của mình.</p>
                <hr>

                <!-- Hiển thị danh sách sản phẩm đã mua -->
                <div class="product-list">
                    @forelse ($viewData['DSSP_DaMua'] as $order)
                        <div class="product-item d-flex align-items-center">
                            <!-- Hình ảnh sản phẩm -->
                            <img src="{{ asset('/assetsUser/img_product/' . $order->HinhAnh) }}" alt="{{ $order->TenSP }}" class="product-img me-3">
                            
                            <!-- Thông tin sản phẩm -->
                            <div class="product-details">
                                <h5 class="product-title">{{ Str::limit($order->TenSP, 60, '...') }}</h5>
                                <p><strong>Giá:</strong> {{ number_format($order->DonGia, 0, ',', '.') }} đ</p>
                                <p><strong>Số lượng:</strong> {{ $order->SoLuong }}</p>
                                <p><strong>Ngày mua:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y - H:i:s') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-success fw-bold">Bạn chưa mua sản phẩm nào! <br> Danh sách sản phẩm đã mua hiện đang trống</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $viewData['DSSP_DaMua']->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
