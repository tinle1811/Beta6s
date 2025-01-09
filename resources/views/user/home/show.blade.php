@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
@include('user.layouts.breadcrumbs')
<!--product details start-->
<div class="product_details mt-60 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <img id="zoom1" src="{{asset('storage/'.$viewData['sanpham']->getProductImage())}}"
                            alt="Sản phẩm" />

                    </div>
                    <div class="single-zoom-thumb ">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">


                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">
                        <h1>{{$viewData['sanpham']->getProductName()}}</h1>
                        <div class="product_nav">

                        </div>
                        <div class="product_ratting">
                            <ul>
                                @for ($i = 1; $i <= 5; $i++)
                                    <li>
                                        <a href="#">
                                            <i class="fa {{ $i <= round($viewData['averageRating']) ? 'fa-star' : 'fa-star-o' }}"></i>
                                        </a>
                                    </li>
                                @endfor
                                <li class="review"><a href="#">({{ $viewData['comments']->count()}} customer reviews)</a></li>
                            </ul>
                        </div>
                        <h2>{{ $viewData['comments']->count() }} review(s) for {{ $viewData['sanpham']->TenSP }}</h2>
                        <div class="price_box">
                            <span
                                class="current_price">{{number_format($viewData['sanpham']->getProductPrice(), 0, ',', '.') }}đ</span>

                        </div>
                        <div class="product_desc">
                            <p>{{$viewData['sanpham']->getProductDescription()}}</p>
                        </div>
                        <div class="product_status">
                            @if($viewData['sanpham']->TrangThai == 1)
                                <span style="color: green; font-weight: bold;font-size:30px">Còn hàng</span>
                            @else
                                <span style="color: red; font-weight: bold;font-size:30px">Hết hàng</span>
                            @endif
                        </div>
                        <div class="product_variant quantity">
                            <form action="{{ route('user.cart.add', ['id', $viewData['sanpham']->getProductId()]) }}" method="POST">
                                @csrf
                                <label>Số lượng</label>
                                <input type="hidden" name="MaSP" value="{{$viewData['sanpham']->getProductId()}}">
                                <input min="1" max="100" name="soLuong" value="1" type="number">
                                <button class="button" type="submit">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                        <div class="product_meta">
                            <span>Loại: <a href="#">Clothing</a></span>
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
                                    aria-selected="false">Mô Tả</a>
                            </li>
                            <li>
                                <a data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                    aria-selected="false">Reviews (1)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="product_info_content">
                                <p>{{$viewData['sanpham']->getProductDescription()}}</p>
                            </div>
                        </div>
                      
                    </div>

                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="reviews_wrapper">
                            <h2>Đánh Giá</h2>
                                                        <!-- Form Đánh Giá -->
                            <form action="{{ route('product.storeRating', $viewData['sanpham']->Slug) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="rating">Đánh giá (1 đến 5 sao)</label>
                                    <select name="rating" id="rating" class="form-control">
                                        <option value="1">1 sao</option>
                                        <option value="2">2 sao</option>
                                        <option value="3">3 sao</option>
                                        <option value="4">4 sao</option>
                                        <option value="5">5 sao</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="comment">Bình luận</label>
                                    <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                            </form>

                            <div class="reviews_comment_box">
                                @foreach ($viewData['comments'] as $comment)
                                    <div class="comment_text">
                                        <div class="reviews_meta">
                                            <div class="star_rating">
                                                <ul>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            <a href="#">
                                                                <i class="ion-ios-star {{ $i <= round($comment->DanhGia) ? '' : '-outline' }}"></i>
                                                            </a>
                                                        </li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <p><strong>{{ $comment->khachHang->TenKH }}</strong> - {{ $comment->created_at->format('F d, Y') }}</p>
                                            <span>{{ $comment->khachHang->SDT }}</span>
                                        </div>
                                        <p>{{ $comment->NoiDung }}</p>  <!-- Nội dung bình luận -->
                                    </div>
                                @endforeach
                            </div>
                            <!-- <div class="comment_title">
                                <h2>Add a review </h2>
                                <p>Your email address will not be published. Required fields are marked </p>
                            </div>
                            <div class="product_ratting mb-10">
                                <h3>Your rating</h3>
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product_review_form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="review_comment">Your review </label>
                                            <textarea name="comment" id="review_comment"></textarea>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="author">Name</label>
                                            <input id="author" type="text">

                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="email">Email </label>
                                            <input id="email" type="text">
                                        </div>
                                    </div>
                                    <button type="submit">Submit</button>
                                </form>
                            </div> -->
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
                            <a class="primary_img" href="product-details.html"><img
                                    src="{{asset('storage/' . $related->getProductImage())}}" alt=""></a>
                            <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg"
                                    alt=""></a>
                            <div class="label_product">
                                <span class="label_sale">sale</span>
                            </div>
                            <div class="action_links">
                                <ul>
                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                                class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                    <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                    </li>
                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                            title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                                </ul>
                            </div>
                            <div class="add_to_cart">
                                <a href="cart.html" title="add to cart">Add to cart</a>
                            </div>
                        </div>
                        <figcaption class="product_content">
                            <div class="price_box">
                                <span class="current_price">{{number_format($related->getProductPrice(), 0, ',', '.') }}
                                    đ</span>
                            </div>
                            <h3 class="product_name"><a
                                    href="{{route('user.home.show', ['slug' => $related->getProductSlug()])}}">{{$related->TenSP}}</a>
                            </h3>
                        </figcaption>
                    </figure>
                </article>
            @endforeach
            {{--
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Itaque earum velit elementum</a>
                        </h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Mauris tincidunt eros posuere
                                placerat</a></h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Morbi ornare vestibulum massa</a>
                        </h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Porro quisquam eget feugiat
                                pretium</a></h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product11.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product12.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Laudantium enim fringilla dignissim
                                ipsum primis</a></h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product4.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product5.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Natus erro at congue massa commodo
                                sit</a></h3>
                    </figcaption>
                </figure>
            </article> --}}
        </div>
    </div>
</section>
<!--product area end-->

<!--product area start-->
{{-- <section class="product_area upsell_products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Upsell Products </h2>
                </div>
            </div>
        </div>
        <div class="product_carousel product_column5 owl-carousel">
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product10.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Natus erro at congue massa commodo
                                sit</a></h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product8.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Itaque earum velit elementum</a>
                        </h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product6.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Mauris tincidunt eros posuere
                                placerat</a></h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product4.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Morbi ornare vestibulum massa</a>
                        </h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product2.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Porro quisquam eget feugiat
                                pretium</a></h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product15.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product16.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Laudantium enim fringilla dignissim
                                ipsum primis</a></h3>
                    </figcaption>
                </figure>
            </article>
            <article class="single_product">
                <figure>
                    <div class="product_thumb">
                        <a class="primary_img" href="product-details.html"><img src="assets/img/product/product17.jpg"
                                alt=""></a>
                        <a class="secondary_img" href="product-details.html"><img src="assets/img/product/product18.jpg"
                                alt=""></a>
                        <div class="label_product">
                            <span class="label_sale">sale</span>
                        </div>
                        <div class="action_links">
                            <ul>
                                <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                </li>
                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                        title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                            </ul>
                        </div>
                        <div class="add_to_cart">
                            <a href="cart.html" title="add to cart">Add to cart</a>
                        </div>
                    </div>
                    <figcaption class="product_content">
                        <div class="price_box">
                            <span class="old_price">$86.00</span>
                            <span class="current_price">$79.00</span>
                        </div>
                        <h3 class="product_name"><a href="product-details.html">Natus erro at congue massa commodo
                                sit</a></h3>
                    </figcaption>
                </figure>
            </article>
        </div>
    </div>
</section> --}}
<!--product area end-->
@endsection