@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    <!--Checkout page section-->
    <div class="Checkout_section mt-60">
        <div class="container">
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>Chi tiết thanh toán</h3>
                            <div class="row" style="margin:35px 0;">
                                <div class="col-lg-6 mb-20">
                                    <label for="first_name">Tên <span>*</span></label>
                                    <input id="first_name" name="first_name" type="text" required>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label for="last_name">Họ <span>*</span></label>
                                    <input id="last_name" name="last_name" type="text" required>
                                </div>
                                <div class="col-12 mb-20">
                                    <label for="address_street">Địa chỉ đường <span>*</span></label>
                                    <input id="address_street" name="address_street" placeholder="Số nhà và tên đường" type="text" required>
                                </div>
                                <div class="col-12 mb-20">
                                    <input placeholder="Căn hộ, dãy phòng" name="apartment" type="text">
                                </div>
                                <div class="col-12 mb-20">
                                    <label for="district">Huyện/Quận <span>*</span></label>
                                    <input id="district" name="district" type="text" required>
                                </div>
                                <div class="col-12 mb-20">
                                    <label for="city">Tỉnh/Thành phố <span>*</span></label>
                                    <input id="city" name="city" type="text" required>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label for="phone">Số điện thoại<span>*</span></label>
                                    <input id="phone" name="phone" type="text" required>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label for="email">Địa chỉ email <span>*</span></label>
                                    <input id="email" name="email" type="email" required>
                                </div>
                                <div class="col-12 mb-20">
                                    <input id="address_checkbox" name="address_checkbox" type="checkbox" />
                                    <label for="address_checkbox" class="righ_0">Gửi đến một địa chỉ khác?</label>
                                    <div id="collapsetwo" class="collapse one" data-bs-parent="#accordion">
                                        <div class="row">
                                            <div class="col-lg-6 mb-20">
                                                <label for="first_name_other">Tên <span>*</span></label>
                                                <input id="first_name_other" name="first_name_other" type="text" required>
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <label for="last_name_other">Họ <span>*</span></label>
                                                <input id="last_name_other" name="last_name_other" type="text" required>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <label for="address_street_other">Địa chỉ đường <span>*</span></label>
                                                <input id="address_street_other" name="address_street_other" placeholder="Số nhà và tên đường" type="text" required>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <input id="apartment_other" name="apartment_other" placeholder="Căn hộ, dãy phòng" type="text">
                                            </div>
                                            <div class="col-12 mb-20">
                                                <label for="district_other">Huyện/Quận <span>*</span></label>
                                                <input id="district_other" name="district_other" type="text" required>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <label for="city_other">Tỉnh/Thành phố <span>*</span></label>
                                                <input id="city_other" name="city_other" type="text" required>
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <label for="phone_other">Số điện thoại<span>*</span></label>
                                                <input id="phone_other" name="phone_other" type="text" required>
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <label for="email_other">Địa chỉ email <span>*</span></label>
                                                <input id="email_other" name="email_other" type="email" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="order-notes">
                                        <label for="order_note">Ghi chú</label>
                                        <textarea id="order_note" name="order_note" placeholder="Ghi chú đơn đặt hàng của bạn"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>Đơn hàng của bạn</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Sản Phẩm</th>
                                            <th>Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> Handbag fringilla <strong> × 2</strong></td>
                                            <td> $165.00</td>
                                        </tr>
                                        <tr>
                                            <td> Handbag justo <strong> × 2</strong></td>
                                            <td> $50.00</td>
                                        </tr>
                                        <tr>
                                            <td> Handbag elit <strong> × 2</strong></td>
                                            <td> $50.00</td>
                                        </tr>
                                        <tr>
                                            <td> Handbag Rutrum <strong> × 1</strong></td>
                                            <td> $50.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cart Subtotal</th>
                                            <td>$215.00</td>
                                        </tr>
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            <td><strong>$220.00</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">
                                <div class="panel-default">
                                    <input id="payment_defult" name="check_method" type="radio" />
                                    <label for="payment_defult">Ví momo
                                        <img src="assetsUser/momo.svg" alt=""></label>
                                </div>
                                <div class="panel-default">
                                    <input id="payment" name="check_method" type="radio" />
                                    <label for="payment" data-bs-target="#method" aria-controls="method">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            <div class="order_button">
                                <button type="submit" style="margin-left: 50px;">Tiếp tục với ví momo</button>
                            </div>
                        </form>
                        <div class="payment_button_div">
                            <button class="payment_button">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</script>
@endsection
