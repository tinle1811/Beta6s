<!--header area start-->

<!--Offcanvas menu area start-->
<div class="off_canvars_overlay">

</div>
<div class="Offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                </div>
                <div class="Offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                    </div>
                    <div class="support_info">
                        <p>Hotline: <a href="tel:{{$websiteInfo->hotline}}">{{$websiteInfo->hotline}}</a></p>
                    </div>
                    <div class="top_right text-end">
                        <ul>
                            @auth
                                <li><a href="{{ route('user.account.index') }}">Xin chào, {{ Auth::user()->TenDN }}</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="button-link">Đăng xuất</button>
                                    </form>
                                </li>
                            @else
                                <li><button class="button-link" onclick="openLoginPopup()">Đăng Nhập</button></li>
                                <li><a href="{{ route('user.auth.register') }}">Đăng ký</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="search_container">
                        <form action="GET" action="{{ route('user.search.index') }}">
                            @csrf
                            <div class="hover_category">
                                <select class="select_option" name="loai_san_pham" id="categori">
                                    <option selected value="">Các loại sản phẩm</option>
                                    @foreach($loaiSanPhams as $loaiSanPham)
                                        <option value="{{ $loaiSanPham->MaLSP }}">{{ $loaiSanPham->TenLoaiSP }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search_box">
                                <input placeholder="Tìm sản phẩm..." type="text" name="keyword">
                                <button type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>

                    <div class="middel_right_info">
                        <div class="header_wishlist">
                            <a href="{{ route('user.home.wishlist') }}"><i class="fa fa-heart-o"
                                    aria-hidden="true"></i></a>
                            <span class="wishlist_quantity">{{ $viewData['wishlistCount'] }}</span>
                        </div>
                        <div class="mini_cart_wrapper">
                            <a href="javascript:void(0)"><i class="fa fa-shopping-bag"
                                    aria-hidden="true"></i>{{ number_format($viewData['subtotal'], 0, ',', '.') }}đ<i
                                    class="fa fa-angle-down"></i></a>
                            <span class="cart_quantity">{{ $viewData['cartCount'] }}</span>
                            <!--mini cart-->
                            <div class="mini_cart">
                                @forelse ($viewData['cartItems'] as $item)
                                    <div class="cart_item">
                                        <div class="cart_img">
                                            <a href="{{route('user.home.index')}}"><img
                                                    src="{{ asset('/assetsUser/img_product/' . $item->product->HinhAnh) }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="cart_info">
                                            <a href="#">{{ $item->product->TenSP }}</a>
                                            <p>Slượng: {{ $item->soLuong }} X <span>
                                                    {{ number_format($item->product->Gia, 0, ',', '.') }}đ </span></p>
                                        </div>
                                        <div class="cart_remove">
                                            <form action="{{ route('user.cart.remove', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-link">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div style="text-align: center">
                                        <span>Giỏ hàng của bạn hiện đang trống!</span>
                                    </div>
                                @endforelse
                                <div class="mini_cart_table">
                                    <div class="cart_total">
                                        <span>Tạm tính:</span>
                                        <span
                                            class="price">{{ number_format($viewData['subtotal'], 0, ',', '.') }}đ</span>
                                    </div>
                                </div>
                                <div class="mini_cart_footer">
                                    <div class="cart_button">
                                        <a href="{{ route('user.cart.index') }}">View cart</a>
                                    </div>
                                    <div class="cart_button">
                                        <a href="{{ route('user.cart.checkout') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                            <!--mini cart end-->
                        </div>
                    </div>
                    <div id="menu" class="text-start ">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item-has-children active">
                                <a href="{{ route('user.home.index') }}">Trang chủ</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Shop</a>
                                <ul class="sub-menu">
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop Layouts</a>
                                        <ul class="sub-menu">
                                            <li><a href="shop.html">shop</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">other Pages</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('user.cart.index') }}">cart</a></li>
                                            <li><a href="{{ route('user.home.wishlist') }}">Wishlist</a></li>
                                            <li><a href="{{ route('user.cart.checkout') }}">Checkout</a></li>
                                            <li><a href="{{ route('user.account.index') }}">my account</a></li>
                                            <li><a href="404.html">Error 404</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Product Types</a>
                                        <ul class="sub-menu">
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                        
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">pages </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('user.home.about') }}">Giới thiệu</a></li>
                                    <li><a href="services.html">services</a></li>
                                    <li><a href="privacy-policy.html">privacy policy</a></li>
                                    <li><a href="faq.html">Frequently Questions</a></li>
                                    <li><a href="{{ route('user.home.contact') }}">contact</a></li>
                                    <li><a href="login.html">login</a></li>
                                    <li><a href="404.html">Error 404</a></li>
                                    <li><a href="compare.html">Compare</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('user.account.index') }}">my account</a>
                            </li>
                            <li><a href="#">Giới thiệu <i class="fa fa-angle-down"></i></a>
                                <ul class="sub_menu pages">
                                    <li><a href="{{ route('user.home.about') }}">Về chúng tôi</a></li>
                                    <li><a href="{{ route('user.blog.index') }}">Danh sách bài viết</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('user.home.contact') }}"> Liên hệ</a>
                            </li>
                        </ul>
                    </div>

                    <div class="Offcanvas_footer">
                        <span><a href="#"><i class="fa fa-envelope-o"></i> info@yourdomain.com</a></span>
                        <ul>
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Offcanvas menu area end-->

<header>
    <div class="main_header">
        <!--header top start-->
        <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="support_info">
                            <p>Hotline: <a href="tel:{{$websiteInfo->hotline}}">{{$websiteInfo->hotline}}</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="top_right text-end">
                            <ul>
                                @auth
                                    <li><a href="{{ route('user.account.index') }}">Xin chào,
                                            {{ Auth::user()->TenDN }}</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="button-link">Đăng xuất</button>
                                        </form>
                                    </li>
                                @else
                                    <li><button class="button-link" onclick="openLoginPopup()">Đăng Nhập</button></li>
                                    <li><a href="{{ route('user.auth.register') }}">Đăng ký</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header top start-->
        <!--header middel start-->
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="logo">
                            <a href="{{ route('user.home.index') }}">
                                @if ($websiteInfo && $websiteInfo->logo)
                                    <img src="{{ asset('storage/logos/' . $websiteInfo->logo) }}" alt="Website Logo">
                                @else
                                    <img src="{{ asset('images/default-logo.png') }}" alt="Default Logo">
                                @endif
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-6">
                        <div class="middel_right">
                                <div class="search_container">
                                    <form method="GET" action="{{ route('user.search.index') }}">
                                        <div class="hover_category">
                                            <select class="select_option" name="loai_san_pham" id="categori">
                                                <option value="" {{ request('loai_san_pham') == '' ? 'selected' : '' }}>Các loại sản phẩm</option>
                                                @foreach($viewData['DS-DanhMuc'] as $loaiSanPham)
                                                    <option value="{{ $loaiSanPham->MaLSP }}" {{ request('loai_san_pham') == $loaiSanPham->MaLSP ? 'selected' : '' }}
                                                        >{{ $loaiSanPham->TenLSP }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="search_box">
                                            <input placeholder="Tìm sản phẩm..." type="text" name="keyword" value="{{ request('keyword') }}">
                                            <button type="submit">Tìm kiếm</button>
                                        </div>
                                    </form>
                                </div>
                            <div class="middel_right_info">
                                <div class="header_wishlist">
                                    <a href="{{ route('user.home.wishlist') }}"><i class="fa fa-heart-o"
                                            aria-hidden="true"></i></a>
                                    <span class="wishlist_quantity">{{ $viewData['wishlistCount'] }}</span>
                                </div>
                                <!-- sử dụng View Composer khai báo trong app/Providers/AppServiceProvider.php để truyền dữ liệu cho tất cả các view cùng một lúc -->
                                <div class="mini_cart_wrapper">
                                    <a href="javascript:void(0)"><i class="fa fa-shopping-bag"
                                            aria-hidden="true"></i>{{ number_format($viewData['subtotal'], 0, ',', '.') }}đ<i
                                            class="fa fa-angle-down"></i></a>
                                    <span class="cart_quantity">{{ $viewData['cartCount'] }}</span>
                                    <!--mini cart-->
                                    <div class="mini_cart">
                                        @forelse ($viewData['cartItems'] as $item)
                                            <div class="cart_item">
                                                <div class="cart_img">
                                                    <a href="#"><img
                                                            src="{{ asset('/assetsUser/img_product/' . $item->product->HinhAnh) }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="cart_info">
                                                    <a href="#">{{ $item->product->TenSP }}</a>
                                                    <p>Slượng: {{ $item->soLuong }} X <span>
                                                            {{ number_format($item->product->Gia, 0, ',', '.') }}đ
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="cart_remove">
                                                    <form
                                                        action="{{ route('user.cart.remove', ['id' => $item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="button-link">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @empty
                                            <div style="text-align: center">
                                                <span>Giỏ hàng của bạn hiện đang trống!</span>
                                            </div>
                                        @endforelse
                                        <div class="mini_cart_table">
                                            <div class="cart_total">
                                                <span>Tạm tính:</span>
                                                <span
                                                    class="price">{{ number_format($viewData['subtotal'], 0, ',', '.') }}đ</span>
                                            </div>
                                        </div>
                                        <div class="mini_cart_footer">
                                            <div class="cart_button">
                                                <a href="{{ route('user.cart.index') }}">Giỏ hàng</a>
                                            </div>
                                            <div class="cart_button">
                                                <a href="{{ route('user.cart.checkout') }}">Thanh toán</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--mini cart end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header middel end-->
        <!--header bottom satrt-->
        <div class="main_menu_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-12">
                        <div class="categories_menu">
                            <div class="categories_title">
                                <h2 class="categori_toggle">LOẠI SẢN PHẨM</h2>
                            </div>
                            <div class="categories_menu_toggle">
                                <ul>
                                    <li class="menu_item_children"><a href="#">Thường</a></li>
                                    <li class="menu_item_children"><a href="#">Đặc biệt</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="main_menu menu_position">
                            <nav>
                                <ul>
                                    <li><a class="active" href="{{ route('user.home.index') }}">Trang chủ</a></li>
                                    <li class="mega_items"><a href="#">shop<i
                                                class="fa fa-angle-down"></i></a>
                                        <div class="mega_menu">
                                            <ul class="mega_menu_inner">
                                               
                                            </ul>
                                        </div>
                                    </li>
                                    </li>
                                    <li><a href="#">Các trang <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="{{ route('user.home.about') }}">Giới thiệu</a></li>
                                            <li><a href="{{ route('user.home.contact') }}">Liên hệ</a></li>
                                            <li><a href="404.html">Error 404</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="#">Giới thiệu <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="{{ route('user.home.about') }}">Về chúng tôi</a></li>
                                            <li><a href="{{ route('user.blog.index') }}">Danh sách bài viết</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('user.home.contact') }}"> Liên hệ</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header bottom end-->
    </div>
</header>
<!--header area end-->

<!--sticky header area start-->
<div class="sticky_header_area sticky-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3">
                <div class="logo">
                    <a href="{{route('user.home.index')}}">
                        @if ($websiteInfo && $websiteInfo->logo)
                            <img src="{{ asset('storage/logos/' . $websiteInfo->logo) }}" alt="Website Logo">
                        @else
                            <img src="{{ asset('images/default-logo.png') }}" alt="Default Logo">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="sticky_header_right menu_position">
                    <div class="main_menu">
                        <nav>
                            <ul>
                                <li><a class="active" href="{{ route('user.home.index') }}">Trang chủ</a></li>
                                <li class="mega_items"><a href="shop.html">shop<i class="fa fa-angle-down"></i></a>
                                    <div class="mega_menu">
                                        <ul class="mega_menu_inner">
                        
                                        </ul>
                                    </div>
                                </li>
                                </li>
                                <li><a href="#">Các trang <i class="fa fa-angle-down"></i></a>
                                    <ul class="sub_menu pages">
                                        <li><a href="{{ route('user.home.about') }}">Giới thiệu</a></li>
                                        <li><a href="{{ route('user.home.contact') }}">contact</a></li>
                                        <li><a href="404.html">Error 404</a></li>
                                    </ul>
                                </li>

                                <li><a href="#">Giới thiệu <i class="fa fa-angle-down"></i></a>
                                    <ul class="sub_menu pages">
                                        <li><a href="{{ route('user.home.about') }}">Về chúng tôi</a></li>
                                        <li><a href="{{ route('user.blog.index') }}">Danh sách bài viết</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('user.home.contact') }}"> Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="middel_right_info">
                        <div class="header_wishlist">
                            <a href="{{ route('user.home.wishlist') }}"><i class="fa fa-heart-o"
                                    aria-hidden="true"></i></a>
                            <span class="wishlist_quantity">{{ $viewData['wishlistCount'] }}</span>
                        </div>
                        <div class="mini_cart_wrapper">
                            <a href="javascript:void(0)"><i class="fa fa-shopping-bag"
                                    aria-hidden="true"></i>{{ number_format($viewData['subtotal'], 0, ',', '.') }}đ<i
                                    class="fa fa-angle-down"></i></a>
                            <span class="cart_quantity">{{ $viewData['cartCount'] }}</span>
                            <!--mini cart-->
                            <div class="mini_cart">
                                @forelse ($viewData['cartItems'] as $item)
                                    <div class="cart_item">
                                        <div class="cart_img">
                                            <a href="#"><img
                                                    src="{{ asset('/assetsUser/img_product/' . $item->product->HinhAnh) }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="cart_info">
                                            <a href="#">{{ $item->product->TenSP }}</a>
                                            <p>Slượng: {{ $item->soLuong }} X <span>
                                                    {{ number_format($item->product->Gia, 0, ',', '.') }}đ </span></p>
                                        </div>
                                        <div class="cart_remove">
                                            <form action="{{ route('user.cart.remove', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-link">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div style="text-align: center">
                                        <span>Giỏ hàng của bạn hiện đang trống!</span>
                                    </div>
                                @endforelse
                                <div class="mini_cart_table">
                                    <div class="cart_total">
                                        <span>Tạm tính:</span>
                                        <span
                                            class="price">{{ number_format($viewData['subtotal'], 0, ',', '.') }}đ</span>
                                    </div>
                                </div>
                                <div class="mini_cart_footer">
                                    <div class="cart_button">
                                        <a href="{{ route('user.cart.index') }}">View cart</a>
                                    </div>
                                    <div class="cart_button">
                                        <a href="{{ route('user.cart.checkout') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                            <!--mini cart end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--sticky header area end-->
