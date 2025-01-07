@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
<div class="container my-4">
    <h2 class="mb-4">{{ $viewData['title'] }}</h2>
    <div class="row">
        @foreach ($viewData['products'] as $product)
            <div class="col-md-4 mb-4">
                @if(isset($sanPhams) && $sanPhams->isNotEmpty())
                        <div class="card shadow-sm">
                            <!-- Hình ảnh sản phẩm -->
                            <a href="{{ route('user.home.show', $product->id) }}">
                                <img src="{{ asset('/assetsUser/img_product/' . $product->getProductImage()) }}"
                                    alt="{{ $product->getProductName() }}" class="card-img-top img-fluid">
                            </a>
                            <!-- Nội dung sản phẩm -->
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('user.home.show', $product->id) }}" class="text-decoration-none text-dark">
                                        {{ $product->getProductName() }}
                                    </a>
                                </h5>
                                <p class="card-text text-success fw-bold">
                                    {{ number_format($product->getProductPrice(), 0, ',', '.') }} đ
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="cart.html" class="btn btn-primary btn-sm">Thêm vào giỏ hàng</a>
                                    <a href="wishlist.html" class="btn btn-outline-secondary btn-sm">Yêu thích</a>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
            @endforeach

    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        {{ $viewData['products']->links('pagination::bootstrap-5') }}
    </div>
@endsection