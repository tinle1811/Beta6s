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
                <div class="product_carousel product_column5 owl-carousel">
                    @foreach ($viewData["DSSP-BanChay"] as $product)
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img" href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}">
                                    <img src="{{ asset('/assetsUser/img_product' . $product->getProductImage()) }}" alt="{{ $product->getProductName() }}">
                                </a>
                                <div class="action_links">
                                    <ul>
                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                        <li class="compare"><a href="#" title="compare"><span class="ion-levels"></span></a></li>
                                        <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <span class="ion-ios-search-strong"></span></a></li>
                                    </ul>
                                </div>
                                <div class="add_to_cart">
                                    <a href="cart.html" title="add to cart">Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                            <figcaption class="product_content">
                                <div class="price_box">
                                    <span class="current_price">{{ $product->getProductPrice() }}</span>
                                </div>
                                <h3 class="product_name">
                                    <a href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}">{{ $product->getProductName() }}</a>
                                </h3>
                            </figcaption>
                        </figure>
                    </article>
                @endforeach
                
                </div>
            </div>
        </section>
        <!--product area end-->