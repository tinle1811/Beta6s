@extends('user.layouts.app')
@section('title', $viewData['sanpham']->getProductName())
@section('content')
@include('user.layouts.breadcrumbs')
<!--product details start-->
<div class="product_details mt-60 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <img id="zoom1" src="{{ asset('storage/' . $viewData['sanpham']->getProductImage()) }}"
                            alt="Sản phẩm" />
                    </div>
                    <div class="single-zoom-thumb ">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01"></ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">
                    <h1>{{ $viewData['sanpham']->getProductName() }}</h1>
                    <div id="sanPhamContainer" class="d-flex flex-column align-items-start gap-3">
                        <div id="sanPhamMau" class="d-flex gap-3">
                            <p id="eventID" class="mb-0" style="display: none;">
                                <strong>Mã sản phẩm:</strong> {{ $viewData['sanpham']->getProductId() }}
                            </p>
                            <p id="eventSoLuotYeuThich" class="mb-0">
                                <strong><i class="fa-regular fa-thumbs-up"></i></strong>
                                {{ $viewData['sanpham']->SoLuotYeuThich }}
                            </p>
                            <p id="eventSoLuotXem" class="mb-0">
                                <strong><i class="fa-solid fa-eye"></i></strong> {{ $viewData['sanpham']->SoLuotXem }}
                            </p>
                            @auth
                                <form action="{{ route('user.home.addWishlist', ['id' => $viewData['sanpham']->MaSP]) }}"
                                    method="POST" class="add-to-cart-form" id="add-to-cart-form">
                                    @csrf
                                    <button type="submit" title="Add to Wishlist" style="background: none; border:none">
                                        <i class="fa fa-heart-o" style="color: black" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endauth
                        </div>

                        <div class="product_ratting">
                            <ul>
                                <li>
                                    <p id="eventRatingRealTime">{{ $viewData['sanpham']->DiemRatingTB }}
                                        <i class="fa fa-star"></i> / 5
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="price_box">
                            <span class="current_price">
                                {{ number_format($viewData['sanpham']->getProductPrice(), 0, ',', '.') }}đ
                            </span>
                        </div>

                        <div>
                            @if ($viewData['sanpham']->TrangThai == 1)
                                <p>Tình trạng: <span style="color:#757575">Còn hàng</span></p>
                            @else
                                <p>Tình trạng: <span class="text-danger">Hết hàng</span></p>
                            @endif
                        </div>

                        @auth
                            <form action="{{ route('user.cart.add', ['id' => $viewData['sanpham']->getProductId()]) }}"
                                method="POST" class="w-100">
                                @csrf
                                <div class="product_variant quantity d-flex align-items-center gap-3">
                                    <label>Số lượng: </label>
                                    <input min="1" max="100" name="soLuong" value="1" type="number"
                                        class="form-control w-auto">
                                </div>
                                <div class="product_meta mt-3 d-flex align-items-center gap-3">
                                    @if($viewData['sanpham']->LoaiSP == 1)
                                        <span>Phiên bản: <a href="#">Thường</a></span>
                                    @else
                                        <span>Phiên bản: <a href="#">Đặc biệt</a></span>
                                    @endif
                                </div>
                                <div class="product_variant quantity mt-3">
                                    <input type="hidden" name="MaSP" value="{{ $viewData['sanpham']->getProductId() }}">
                                    <button type="submit" class="btn btn-warning" style="color:white">Thêm vào giỏ
                                        hàng</button>
                                </div>
                            </form>
                            <div class="product_variant quantity mt-3">
                                <form action="{{ route('user.cart.checkout') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Mua ngay</button>
                                </form>
                            </div>
                        @else
                            <a href="javascript:void(0)" onclick="openLoginPopup()" class="btn btn-success mt-3"
                                title="add to cart">
                                Thêm vào giỏ hàng
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--product details end-->

<!--product info start-->
<div class="product_d_info mb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-bs-toggle="tab" href="#info" role="tab" aria-controls="info"
                                    aria-selected="false">Mô tả</a>
                            </li>
                            <li>
                                <a data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                    aria-selected="false">Đánh giá (1)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="product_info_content">
                                <p>{{ $viewData['sanpham']->getProductDescription() }}</p>
                            </div>
                        </div>
                        <div class="product_info_content">
                            <p>Fashion has been creating well-designed collections since 2010. The brand offers
                                feminine designs delivering stylish separates and statement dresses which have
                                since evolved into a full ready-to-wear collection in which every item is a
                                vital part of a woman's wardrobe. The result? Cool, easy, chic looks with
                                youthful elegance and unmistakable signature style. All the beautiful pieces are
                                made in Italy and manufactured with the greatest attention. Now Fashion extends
                                to a range of accessories including shoes, hats, belts and more!</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="reviews_wrapper">
                            <h2>1 review for Donec eu furniture</h2>
                            <div class="reviews_comment_box">
                                <div class="comment_thmb">
                                    <img src="assets/img/blog/comment2.jpg" alt="">
                                </div>
                                <div class="comment_text">
                                    <div class="reviews_meta">
                                        <div class="star_rating">
                                            <ul>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <p><strong>admin </strong>- September 12, 2022</p>
                                        <span>roadthemes</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--product info end-->

<!--product area start-->
<section class="product_area related_products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>SẢN PHẨM TƯƠNG TỰ </h2>
                </div>
            </div>
        </div>
        <div class="product_carousel product_column5 owl-carousel">
            @foreach ($viewData['relatedProducts'] as $related)
                <article class="single_product">
                    <figure>
                        <div class="product_thumb">
                            <a class="primary_img" href="{{ route('user.home.show', ['slug' => $related->Slug]) }}"><img
                                    src="{{ asset('storage/' . $related->getProductImage()) }}" alt=""></a>
                            <div class="label_product">
                                <span class="label_sale">sale</span>
                            </div>
                            <div class="action_links">
                                <ul>
                                    @auth
                                        <form action="{{ route('user.home.addWishlist', ['id' => $related->getProductId()]) }}"
                                            method="POST" class="add-to-cart-form" id="add-to-cart-form">
                                            @csrf
                                            <button type="submit" title="Add to Wishlist" style=" border-radius: 50%;"
                                                class="btn btn-primary"><i class="fa fa-heart-o"
                                                    aria-hidden="true"></i></button>
                                        </form>
                                    @endauth
                                    <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                    </li>
                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                            title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                                </ul>
                            </div>
                            <div class="add_to_cart">
                                @auth
                                    <form action="{{ route('user.cart.add', ['id' => $related->getProductId()]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="MaSP" value="{{$related->getProductId() }}">
                                        <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                        <figcaption class="product_content">
                            <div class="price_box">
                                <span class="current_price">{{ number_format($related->getProductPrice(), 0, ',', '.') }}
                                    đ</span>
                            </div>
                            <h3 class="product_name"><a
                                    href="{{ route('user.home.show', ['slug' => $related->getProductSlug()]) }}">{{ $related->TenSP }}</a>
                            </h3>
                        </figcaption>
                    </figure>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection