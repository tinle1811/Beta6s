    <!--footer area start-->
    <footer class="footer_widgets">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widgets_container contact_us">
                            <div class="footer_logo">
                                <a href="#">
                                    @if ($websiteInfo && $websiteInfo->logo)
                                        <img src="{{ asset('storage/logos/' . $websiteInfo->logo) }}" alt="Website Logo">
                                    @else
                                        <img src="{{ asset('images/default-logo.png') }}" alt="Default Logo">
                                    @endif
                                </a>
                            </div>
                            <div class="footer_contact">
                                <p>Mấy đứa ơi cố lên !!! Ra trường mình đi lấy chồng đại gia!!!!</p>
                                <p><span>Địa chỉ: </span> {{$websiteInfo->address}}.</p>
                                <p><span>Hotline: </span>{{$websiteInfo->hotline}} </p>
                                <p><span>Email hỗ trợ: </span>{{$websiteInfo->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="widgets_container widget_menu">
                            <h3>Thông tin</h3>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="about.html">Trang chủ</a></li>
                                    <li><a href="blog.html">Shop</a></li>
                                    <li><a href="contact.html">Blog</a></li>
                                    <li><a href="services.html">Page</a></li>
                                    <li><a href="#">Giới thiệu</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="widgets_container widget_menu">
                            <h3>Tài khoản</h3>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="#">Tài khoản</a></li>
                                    <li><a href="#">Đơn hàng</a></li>
                                    <li><a href="wishlist.html">Danh sách yêu thích</a></li>                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="widgets_container newsletter">
                            <h3>Theo dõi shop tại</h3>
                            <div class="footer_social_link">
                                <ul>
                                    <li><a class="facebook" href="{{$websiteInfo->facebook}}" title="Facebook"><i
                                                class="fa fa-facebook"></i></a>
                                    </li>
                                    <li><a class="twitter" href="{{$websiteInfo->twitter}}" title="Twitter"><i
                                                class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a class="instagram" href="{{$websiteInfo->instagram}}" title="instagram"><i
                                                class="fa fa-instagram"></i></a></li>

                                </ul>
                            </div>
                            <div class="subscribe_form">
                                <h3></h3>
                                <form id="mc-form" class="mc-form footer-newsletter">
                                    <input id="mc-email" type="email" autocomplete="off"
                                        placeholder="Your email address..." hidden/>
                                    <button id="mc-submit"></button>
                                </form>
                                <!-- mailchimp-alerts Start -->
                                <div class="mailchimp-alerts text-centre">
                                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                    <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                    <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                                </div><!-- mailchimp-alerts end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright_area">
                            <p class="copyright-text">&copy; 2024 <a href="index.html">BREABRICK-Shop</a>. Chúng tôi ở đây vì bạn <i
                                    class="fa fa-heart text-danger"></i><a href="https://hasthemes.com/"
                                    target="_blank"></a> </p>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6 col-md-6">
                        <div class="footer_payment text-end">
                            <a href="#"><img src="assets/img/icon/payment.png" alt=""></a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </footer>
    <!--footer area end-->
