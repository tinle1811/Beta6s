<!--featured product area start-->
<section class="featured_product_area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
            </div>
        </div>
        <div class="row featured_container featured_column3">
            @foreach ($viewData['DSSP-NoiBat'] as $product)
                <div class="col-lg-4">
                    <article class="single_product">
                        <figure>
                            <div class="product_thumb">
                                <a class="primary_img"
                                    href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}"><img
                                        src="{{ asset('/assetsUser/img_product/' . $product->getProductImage()) }}"
                                        alt="{{ $product->getProductName() }}"></a>
                                {{-- <a class="secondary_img" href="{{ route('user.home.show') }}"><img
                                        src="assets/img/product/product14.jpg" alt=""></a> --}}
                                {{-- <div class="label_product">
                                    <span class="label_sale">sale</span>
                                </div> --}}
                            </div>
                            <figcaption class="product_content">
                                <div class="price_box">
                                    <span
                                        class="current_price">{{ number_format($product->getProductPrice(), 0, ',', '.') }}
                                        đ</span>
                                </div>
                                <h3 class="product_name"><a
                                        href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}">{{ $product->getProductName() }}</a>
                                </h3>
                                <div class="add_to_cart">
                                    <form action="{{route('user.cart.add', ['id' => $product->MaSP])}}" method="POST"
                                        class="add-to-cart-form" id="add-to-cart-form">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                    </form>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
