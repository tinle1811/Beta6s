@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 profile-sidebar">
                <div class="profile-avatar-wrapper">
                    <img src="{{ asset('/assetsUser/img_product/4-4.jpg') }}" alt="avatar" class="profile-avatar">
                    <p>Khoa Nguyễn</p>
                </div>
                <ul class="nav flex-column">
                    <!-- Các menu khác -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.account.index') }}"><i class="bi bi-person"></i><span class="text">Tài khoản của tôi</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.account.purchase')}}"><i class="bi bi-cart"></i><span class="text">Đơn mua</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.account.purchaseHistory') }}"><i class="bi bi-cart-check"></i><span class="text">Lịch sử mua hàng</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 profile-content">
                <h4>Danh sách sản phẩm đã đánh giá</h4>
                <p>Danh sách các sản phẩm bạn đã đánh giá.</p>
                <hr>

                <!-- Hiển thị danh sách sản phẩm đã đánh giá -->
                <div class="product-list">
                    @forelse ($viewData['DSSP_DaDanhGia'] as $review)
                        <div class="product-item d-flex align-items-center">
                            <!-- Hình ảnh sản phẩm -->
                            <img src="{{ asset('/assetsUser/img_product/' . $review->HinhAnh) }}" alt="{{ $review->TenSP }}" class="product-img me-3">
                            
                            <!-- Thông tin sản phẩm -->
                            <div class="product-details">
                                <h5 class="product-title">{{ Str::limit($review->TenSP, 60, '...') }}</h5>

                                <!-- Đánh giá bằng ngôi sao -->
                                <div class="rating-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star {{ $i <= $review->DanhGia ? 'filled' : '' }}">&#9733;</span>
                                    @endfor
                                </div>

                                <p><strong>Nội dung:</strong> {{ Str::limit($review->NoiDung, 120, '...') }}</p>
                                <p><strong>Ngày đánh giá:</strong> {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-success fw-bold">Bạn chưa đánh giá sản phẩm nào! <br> Danh sách sản phẩm đã đánh giá hiện đang trống</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $viewData['DSSP_DaDanhGia']->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
