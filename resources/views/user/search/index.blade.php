@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
<div class="container my-4">
    @if(isset($viewData['keyword']) && $viewData['keyword'] != '' && (!isset($viewData['loai_san_pham']) || $viewData['loai_san_pham'] == ''))
        <h2 class="mb-4 text-center">{{ $viewData['title'] }} "{{ $viewData['keyword'] }}"</h2>
        <h4>{{ $viewData['resultCount'] }} kết quả được tìm thấy</p>
    @endif
    
        @if(isset($viewData['loai_san_pham']) && $viewData['loai_san_pham'] != '' && (!isset($viewData['keyword']) || $viewData['keyword'] == ''))
            <h2 class="mb-4 text-center">{{ $viewData['title'] }}: Loại sản phẩm {{ $viewData['loai_san_pham'] }}</h2>
            <h4>{{ $viewData['resultCount'] }} kết quả được tìm thấy</h4>
        @endif
    
        @if(isset($viewData['keyword']) && $viewData['keyword'] != '' && isset($viewData['loai_san_pham']) && $viewData['loai_san_pham'] != '')
            <h2 class="mb-4 text-center">{{ $viewData['title'] }} "{{ $viewData['keyword'] }}" trong loại sản phẩm
                {{ $viewData['loai_san_pham'] }}</h2>
            <h4>{{ $viewData['resultCount'] }} kết quả được tìm thấy</h4>
        @endif
    
        @if((!isset($viewData['keyword']) || $viewData['keyword'] == '') && (!isset($viewData['loai_san_pham']) || $viewData['loai_san_pham'] == ''))
            <h2 class="mb-4 text-center">{{ $viewData['title'] }} "Tất cả"</h2>
            <h4>{{ $viewData['resultCount'] }} kết quả được tìm thấy</h4>
        @endif
    <div class="row">
        @foreach ($viewData['products'] as $product)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <!-- Hình ảnh sản phẩm -->
                    <a href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}">
                        <img src="{{ asset('/storage/' . $product->getProductImage()) }}"
                            alt="{{ $product->getProductName() }}" class="card-img-top img-fluid">
                    </a>
                    <!-- Nội dung sản phẩm -->
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}" class="text-decoration-none text-dark">
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
            </div>
        @endforeach
    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        {{ $viewData['products']->appends(request()->input())->links('pagination::bootstrap-5') }}
    </div>
@endsection