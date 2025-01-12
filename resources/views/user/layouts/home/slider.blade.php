<!--slider area start-->
<section class="slider_section mb-70">
    <div class="slider_area owl-carousel">
        @foreach ($viewData['DSSP-Slider'] as $product)
            <div class="single_slider d-flex align-items-center"
                data-bgimg="{{ asset('/assetsUser/img_product/' . $product->getProductImage()) }}"
                style="background-repeat: no-repeat; background-position: right center; background-size:  600px 500px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider_content">
                                <h1> Gấu Bearbrick</h1>
                                <h2>{{ Str::limit($product->getProductName(), 15, '...') }}</h2>
                                {{-- <p>exclusive offer <span> 20% off </span> this week</p> --}}
                                <p>{{ Str::limit($product->getProductDescription(), 60, '...') }}</p>
                                <a class="button"
                                    href="{{ route('user.home.show', ['slug' => $product->getProductSlug()]) }}">Xem
                                    thêm</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</section>
<!--slider area end-->