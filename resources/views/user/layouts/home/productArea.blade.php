<!--product area start-->
<section class="product_area mb-46">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Sản Phẩm Bán Chạy</h2>
                </div>
            </div>
        </div>
        <div class="product_list">
            @foreach ($viewData['DSSP-BanChay'] as $product)
                <div class="product_item">
                    <div class="product_thumbnail">
                        <a href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}">
                            <img src="{{ asset('/assetsUser/img_product/' . $product->getProductImage()) }}"
                                alt="{{ $product->getProductName() }}">
                        </a>
                    </div>
                    <div class="product_details">
                        <h3 class="product_title">
                            <a href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}">
                                {{ Str::limit($product->getProductName(), 15, '...') }}
                            </a>
                        </h3>
                        <div class="product_price">
                            {{ number_format($product->getProductPrice(), 0, ',', '.') }} đ
                        </div>
                        <p class="product_description">
                            {{ Str::limit($product->getProductDescription(), 50, '...') }}
                        </p>
                        <div class="product_actions">
                            @auth
                                <form action="{{ route('user.home.addWishlist', ['id' => $product->MaSP]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn_add_wishlist" title="Add to Wishlist">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endauth
                            <form action="{{ route('user.cart.add', ['id' => $product->MaSP]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn_add_cart">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
            @endforeach
        </div>

        <div class="pagination">
            {{ $viewData['DSSP-BanChay']->appends(['pageSPBanChay' => request('pageSPBanChay')])->links('') }}
        </div>

=======
                <div class="product_carousel product_column5 owl-carousel">
                    @foreach ($viewData["DSSP-BanChay"] as $product)
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="{{route('user.home.show',['slug' => $product->getProductSlug()])}}"><img src="{{ asset('/assetsUser/img_product/' . $product->getProductImage()) }}"
                                            alt="{{ $product->getProductName() }}"></a>
                                    {{-- <a class="secondary_img" href="{{route('user.home.show')}}"><img
                                            src="assets/img/product/product2.jpg" alt=""></a> --}}
                                    {{-- <div class="label_product">
                                        <span class="label_sale">sale</span>
                                    </div> --}}
                                    <div class="action_links">
                                        <ul>
                                            <li class="wishlist">
                                                @auth
                                                    <form action="{{route('user.home.addWishlist',['id' => $product->MaSP])}}" method="POST" class="add-to-cart-form" id="add-to-cart-form">
                                                        @csrf
                                                        <button type="submit" title="Add to Wishlist" style=" border-radius: 50%;" class="btn btn-primary"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                                                    </form>
                                                @endauth
                                            </li>
                                            <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a>
                                            </li>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box"
                                                    title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="add_to_cart">
                                        <form action="{{route('user.cart.add',['id'=>$product->MaSP])}}" method="POST" class="add-to-cart-form" id="add-to-cart-form">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                        </form>
                                    </div>
                                    {{-- <div class="product_timing">
                                        <div data-countdown="2023/12/15"></div>
                                    </div> --}}
                                </div>
                                <figcaption class="product_content">
                                    <div class="price_box">
                                        {{-- <span class="old_price">$86.00</span> --}}
                                        <span class="current_price">{{ number_format($product->getProductPrice(), 0, ',', '.') }} đ</span>
                                    </div>
                                    <h3 class="product_name"><a href="{{route('user.home.show',['slug'=>$product->getProductSlug()])}}">{{ $product->getProductName() }}</a></h3>
                                </figcaption>
                            </figure>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
>>>>>>> 0df39d88a4c6f1777dae42a08aa084060abd336c
    </div>
</section>
<!--product area end-->