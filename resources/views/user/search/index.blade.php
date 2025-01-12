@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div class="container my-4">
        <h2 class="mb-4" style="color: blue">Kết Quả Tìm Kiếm</h2>

        <div class="row">
            <!-- Form tìm kiếm -->
            <form action="{{ route('user.product.search') }}" method="GET" class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm theo từ khóa"
                            value="{{ request()->get('keyword') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <select name="category" class="form-control">
                            <option value="">Chọn danh mục</option>
                            @foreach ($viewData['categories'] as $category)
                                <option value="{{ $category->MaLSP }}"
                                    {{ request()->category == $category->MaLSP ? 'selected' : '' }}>
                                    {{ $category->TenLSP }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="number" name="min_price" class="form-control" placeholder="Giá tối thiểu"
                            value="{{ request()->min_price }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="number" name="max_price" class="form-control" placeholder="Giá tối đa"
                            value="{{ request()->max_price }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                    </div>
                </div>
            </form>

            <!-- Hiển thị các sản phẩm -->
            @if ($viewData['products']->count() > 0)
                <div class="row">
                    @foreach ($viewData['products'] as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $product->HinhAnh) }}" class="card-img-top"
                                    alt="{{ $product->TenSP }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->TenSP }}</h5>
                                    <p class="card-text">{{ Str::limit($product->MoTa, 100) }}</p>
                                    <p class="card-text">Giá: {{ number_format($product->Gia) }} VNĐ</p>
                                    <a href="{{ route('user.home.show', $product->Slug) }}" class="btn btn-info">Xem chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- phân trang -->
                <div class="d-flex justify-content-center">
                    {{ $viewData['products']->links('pagination::bootstrap-4') }}
                </div>
            @else
                <p>Không có sản phẩm nào phù hợp với tiêu chí tìm kiếm của bạn.</p>
            @endif
        </div>
    </div>
@endsection
