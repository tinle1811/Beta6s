@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    <!--Checkout page section-->
    <div class="Checkout_section mt-60">
        <div class="container">
            <div class="checkout_form">
                <div class="row">
                    <form action="{{ route('user.cart.payment') }}" method="POST" id="formCheckout">
                        <div class="col-lg-6 col-md-6 me-2">
                                @csrf
                                <h3>Chi tiết thanh toán</h3>
                                <div class="row" style="margin:35px 0;">
                                    <div class="col-lg-6 mb-20">
                                        <label for="first_name">Tên <span>*</span></label>
                                        <input id="first_name" name="first_name" type="text" value="{{ $khachHang->TenKH ? explode(' ', $khachHang->TenKH)[0] : '' }}" required>
                                        @error('first_name')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-20">
                                        <label for="last_name">Họ <span>*</span></label>
                                        <input id="last_name" name="last_name" type="text" value="{{ $khachHang->TenKH ? explode(' ', $khachHang->TenKH)[1] : '' }}" required>
                                        @error('last_name')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label for="address_street">Địa chỉ đường <span>*</span></label>
                                        <input id="address_street" name="address_street" placeholder="Số nhà và tên đường" type="text"
                                            value="{{ $khachHang->DiaChi ? explode(',', $khachHang->DiaChi)[0] : '' }}" required>
                                        @error('address_street')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-20">
                                        <input placeholder="Căn hộ, dãy phòng" name="apartment" type="text">
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label for="district">Huyện/Quận <span>*</span></label>
                                        <input id="district" name="district" type="text" value="{{ $khachHang->DiaChi ? explode(',', $khachHang->DiaChi)[1] : '' }}" required>
                                        @error('district')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label for="city">Tỉnh/Thành phố <span>*</span></label>
                                        <input id="city" name="city" type="text" value="{{ $khachHang->DiaChi ? explode(',', $khachHang->DiaChi)[2] : '' }}" required>
                                        @error('city')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-20">
                                        <label for="phone">Số điện thoại<span>*</span></label>
                                        <input id="phone" name="phone" type="text" value="{{ $khachHang->SDT }}" required>
                                        @error('phone')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-20">
                                        <label for="email">Địa chỉ email <span>*</span></label>
                                        <input id="email" name="email" type="email" value="{{ $user->Email }}" readonly required>
                                        @error('email')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Checkbox section -->
                                    <div class="col-12 mb-20">
                                        <input id="address_checkbox" name="address_checkbox" type="checkbox" value="1"/>
                                        <input type="hidden" name="address_checkbox" value="0"/>
                                        <label for="address_checkbox" class="righ_0">Gửi đến một địa chỉ khác?</label>
                                        <div id="collapsetwo" class="collapse one" data-bs-parent="#accordion">
                                            <div class="row">
                                                <div class="col-lg-6 mb-20">
                                                    <label for="first_name_other">Tên <span>*</span></label>
                                                    <input id="first_name_other" name="first_name_other" type="text">
                                                    @error('first_name_other')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 mb-20">
                                                    <label for="last_name_other">Họ <span>*</span></label>
                                                    <input id="last_name_other" name="last_name_other" type="text">
                                                    @error('last_name_other')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <label for="address_street_other">Địa chỉ đường <span>*</span></label>
                                                    <input id="address_street_other" name="address_street_other" placeholder="Số nhà và tên đường" type="text" required>
                                                    @error('address_street_other')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <input placeholder="Căn hộ, dãy phòng" name="apartment_other" type="text">
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <label for="district_other">Huyện/Quận <span>*</span></label>
                                                    <input id="district_other" name="district_other" type="text" required>
                                                    @error('district_other')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-20">
                                                    <label for="city_other">Tỉnh/Thành phố <span>*</span></label>
                                                    <input id="city_other" name="city_other" ty_otherpe="text" required>
                                                    @error('city')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 mb-20">
                                                    <label for="phone_other">Số điện thoại<span>*</span></label>
                                                    <input id="phone_other" name="phone_other" type="text" required>
                                                    @error('phone_other')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 mb-20">
                                                    <label for="email_other">Địa chỉ email <span>*</span></label>
                                                    <input id="email_other" name="email_other" type="email" value="{{ $user->Email }}" readonly >
                                                    @error('email_other')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="order-notes">
                                            <label for="order_note">Ghi chú</label>
                                            <textarea id="order_note" name="order_note" placeholder="Ghi chú đơn đặt hàng của bạn"></textarea>
                                            @error('order_note')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                                @csrf
                                <h3>Đơn hàng của bạn</h3>
                                <div class="order_table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Sản Phẩm</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $item)
                                                <tr>
                                                    <td>{{ $item->product->TenSP }} <strong> × {{ $item->soLuong }}</strong></td>
                                                    <td>{{ number_format($item->product->Gia * $item->soLuong, 0, ',', '.' ) }} đ</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Tổng tiền</th>
                                                <td>{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment_method">

                                    @foreach($paymentMethods as $method)
                                        <div class="panel-default">
                                            <input id="payment_{{ $method->MaPT }}" name="check_method" type="radio" value="{{ $method->MaPT }}" />
                                            <label for="payment_{{ $method->MaPT }}">
                                                {{ $method->TenPT }}
                                                @if($method->MoTa)
                                                    <img src="assetsUser/{{ strtolower(str_replace(' ', '_', $method->TenPT)) }}.svg" >
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="order_button">
                                    <button type="hidden" style="margin-left: 50px;">Tiếp tục với ví momo</button>
                                </div>
                            <div class="payment_button_div">
                                <button type="submit" class="payment_button">Thanh toán</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <!--Checkout page section end-->
@endsection

@section('script')
<script>
    const checkbox = document.getElementById('address_checkbox');
    const collapseElement = document.getElementById('collapsetwo');
    const collapse = new bootstrap.Collapse(collapseElement, {
        toggle: false 
    });

    checkbox.addEventListener('change', function () {
        // Toggle trạng thái của collapse khi checkbox thay đổi
        collapse.toggle();
    });
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        // Kiểm tra checkbox
        var checkbox = document.getElementById('address_checkbox');

        // Nếu checkbox chưa được tick, gán value là 0
        if (!checkbox.checked) {
            checkbox.value = 0;
        }
    });
</script>

</script>
@endsection
