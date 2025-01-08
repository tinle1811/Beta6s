@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
@include('user.layouts.breadcrumbs')
@include('user.layouts.notice')
<!--wishlist area start -->
<div class="wishlist_area mt-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table_desc wishlist">
                    <div class="cart_page table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product_thumb">Hình ảnh</th>
                                    <th class="product_name">Tên sản phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-price">Tình trạng hàng</th>
                                    <th class="product_quantity">Thêm vào giỏ hàng</th>
                                    <th class="product_remove">Xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($viewData['yeuThich'] as $item)
                                    <tr>
                                        <td class="product_thumb">
                                            <img src="{{ asset('/assetsUser/img_product/' . $item->product->HinhAnh) }}" alt="">
                                        </td>
                                        <td class="product_name">{{$item->product->TenSP}}</td>
                                        <td class="product-price">{{ number_format($item->product->Gia, 0, ',', '.') }} đ</td>
                                        <td class="product-price">
                                            @if($item->product->TrangThai == 1)
                                                <span>Còn Hàng</span>
                                            @else
                                                <span>Hết hàng</span>
                                            @endif
                                        </td>
                                        <td class="product_quantity">
                                            <form action="{{route('user.cart.add', ['id' => $item->product->MaSP])}}" method="POST" class="add-to-cart-form" id="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="MaSP" value="{{ $item->product->MaSP }}">
                                                <button type="submit" class="btn btn-primary">Thêm</button>
                                            </form>
                                        </td>
                                        <td class="product_remove">
                                            <form action="{{ route('user.home.removeWishlist', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-link">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Yêu thích của bạn hiện đang trống!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="wishlist_share">
                    <h4>Share on:</h4>
                    <ul>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<!--wishlist area end -->
@endsection