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
                                                @auth
                                                    <input type="hidden" name="MaSP" value="{{ $product->MaSP}}">
                                                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                                @else
                                                    <a href="javascript:void(0)" onclick="openLoginPopup()" class="btn btn-primary" title="add to cart">Thêm vào giỏ
                                                        hàng</a>
                                                @endauth
                                            </form>
                                        </div>
                                    </div>
                                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $viewData['DSSP-BanChay']->appends(['pageSPBanChay' => request('pageSPBanChay')])->links('') }}
        </div>

    </div>
</section>
<!--product area end-->
