<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">

    <!-- CSS 
    ========================= -->

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>

<body>

    <!--header area start-->
        @include('user.layouts.menu')
        @include('user.layouts.header')
    <!--header area end-->

    <!--navbar area start-->
        @include('user.layouts.navbar')
    <!--navbar area end-->

    <!--slider area start-->
        @include('user.layouts.slider')
    <!--slider area end-->

    <!--shipping area start-->
    <section class="shipping_area mb-70">
        <div class="container">
            <div class=" row">
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping1.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>Free Shipping</h2>
                            <p>Free shipping on all US order</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping2.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>Support 24/7</h2>
                            <p>Contact us 24 hours a day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping3.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>100% Money Back</h2>
                            <p>You have 30 days to Return</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping4.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>Payment Secure</h2>
                            <p>We ensure secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--shipping area end-->

        @yield('content')

    <!--blog area start-->
    <section class="blog_section mb-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Từ trang Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog_carousel blog_column4 owl-carousel">
                    <div class="col-lg-3">
                        <article class="single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog1.jpg" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <p class="post_author">By <a href="#">admin</a> July 04, 2022</p>
                                    <h3 class="post_title"><a href="blog-details.html">Blog image post</a></h3>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog2.jpg" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <p class="post_author">By <a href="#">admin</a> July 04, 2022</p>
                                    <h3 class="post_title"><a href="blog-details.html">Post with Gallery</a></h3>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog3.jpg" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <p class="post_author">By <a href="#">admin</a> July 04, 2022</p>
                                    <h3 class="post_title"><a href="blog-details.html">Post with Audio</a></h3>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog4.jpg" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <p class="post_author">By <a href="#">admin</a> July 04, 2022</p>
                                    <h3 class="post_title"><a href="blog-details.html">Post with Video</a></h3>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog5.jpg" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <p class="post_author">By <a href="#">admin</a> July 04, 2022</p>
                                    <h3 class="post_title"><a href="blog-details.html">Maecenas ultricies</a></h3>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--blog area end-->

    <!--footer area start-->
        @include('user.layouts.footer')
    <!--footer area end-->

    <!--news letter popup start-->
        @include('user.layouts.popup_login')
    <!--news letter popup start-->




    <!-- JS
============================================ -->

    <!-- Plugins JS -->
    <script src="{{asset('assets/js/plugins.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>