@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    @include('user.layouts.breadcrumbs')
        <!--shopping cart area start -->
        <div class="shopping_cart_area mt-60">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product_thumb">Hình ảnh</th>
                                            <th class="product_name">Tên sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product_quantity">Số lượng</th>
                                            <th class="product_total">Thành tiền</th>
                                            <th class="product_remove">Xoá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($viewData['cartItems'] as $item)
                                            <tr>
                                                <td class="product_thumb">
                                                    <img src="{{ asset('/assetsUser/img_product/' . $item->product->HinhAnh) }}" alt="">
                                                </td>
                                                <td class="product_name">{{ $item->product->TenSP }}</td>
                                                <td class="product-price">{{ number_format($item->product->Gia, 0, ',', '.') }} đ</td>
                                                <td class="product_quantity">
                                                    <form action="{{route('user.cart.update', ['id' => $item->id])}}" method="POST">
                                                        @csrf
                                                        <input type="number" name="soLuong" value="{{ $item->soLuong }}" min="1" class="form-control text-center"
                                                            style="width: 80px; display: inline-block;">
                                                        <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                                    </form>
                                                </td>
                                                <td class="product_total">{{ number_format($item->soLuong * $item->product->Gia, 0, ',', '.') }} đ</td>
                                                <td class="product_remove">
                                                    <form action="{{ route('user.cart.remove', ['id' => $item->id]) }}" method="POST">
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
                                                <td colspan="6">Giỏ hàng của bạn hiện đang trống!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Phân trang -->
                            <div class="d-flex justify-content-center">
                                {{ $viewData['cartItems']->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Coupon & Cart Totals -->
                <div class="row mt-4">
                    <!-- Coupon Code Section -->
                    <div class="col-12">
                        <div class="coupon_code left">
                            <h3>Hình thức thanh toán</h3>
                            <div class="d-flex justify-content-center">
                                <!-- Thẻ bên trái: Thanh toán khi nhận hàng -->
                                <div class="m-4 w-100">
                                    <button class="btn btn-primary p-3 w-100">Thanh toán khi nhận hàng</button>
                                </div>
                                <!-- Thẻ bên phải: Master Card/Visa -->
                                <div class="m-4 w-100">
                                    <button class="btn btn-warning p-3 w-100">Master Card/Visa</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Totals Section -->
                    <div class="col-12 mt-4">
                        <div class="coupon_code right">
                            <h3>Tổng cộng giỏ hàng</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Tổng tiền sản phẩm:</p>
                                    <p class="cart_amount">{{ number_format($viewData['subtotal'], 0, ',', '.') }}đ</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Tổng số lượng sản phẩm:</p>
                                    <p class="cart_amount">{{ $viewData['totalQuantity'] }}</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Phí vận chuyển:</p>
                                    <p class="cart_amount">{{ number_format($viewData['shipping'], 0, ',', '.') }}đ</p>
                                </div>
                                <hr>
                                <div class="cart_subtotal">
                                    <p>Tổng:</p>
                                    <p class="cart_amount text-success">{{ number_format($viewData['total'], 0, ',', '.') }} VNĐ</p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="" class="btn btn-success">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Coupon & Cart Totals End -->

                </div>
                </div>
                <!-- Shopping Cart Area End -->
@endsection