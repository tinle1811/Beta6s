@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    @include('user.layouts.notice')
        <!--shopping cart area start -->
        <div class="shopping_cart_area mt-60">
        <div class="container">
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
                        </div>
                        @if(count($viewData['cartItems']) > 0)
                            <form action="{{ route('user.cart.clear') }}" method="POST" class="text-end">
                                @csrf
                                <button type="submit" class="btn btn-primary">Xóa hết giỏ hàng</button>
                            </form>
                        @endif
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
                                @foreach($paymentMethods as $method)
                                <div class="m-4 w-100">
                                    <button type="button" 
                                            class="btn p-3 w-100 {{ session('paymentMethod') == $method->MaPT ? 'btn-success' : 'btn-primary' }}" 
                                            data-payment-method="{{ $method->MaPT }}"
                                            onclick="selectPaymentMethod(this)">
                                        {{ $method->TenPT }}
                                    </button>
                                </div>
                            @endforeach
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
                                    {{-- <form action="" method="GET">
                                        <button type="submit" class="btn btn-primary">Thanh toán</button>
                                    </form> --}}
                                    <a href="{{ route('user.cart.checkout') }}" class="btn btn-success">Thanh toán</a>
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
@section('script')
<script>
    function selectPaymentMethod(button) {
        var paymentMethod = $(button).data('payment-method'); // Lấy giá trị phương thức thanh toán

        // Gửi dữ liệu qua AJAX
        $.ajax({
            url: '{{ route("user.cart.paymentMethod") }}', // Đảm bảo route này đúng
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Thêm CSRF token
                paymentMethod: paymentMethod
            },
            success: function(response) {
                // Sau khi thành công, cập nhật lại màu sắc của các button
                location.reload(); // Tải lại trang để hiển thị trạng thái mới của các button
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
</script>
@endsection