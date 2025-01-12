@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
@include('user.layouts.breadcrumbs')
<!--blog body area start-->
<div class="blog_details mt-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <!--blog grid area start-->
                <div class="blog_wrapper">
                    <article class="single_blog">
                        <figure>
                            <div class="post_header">
                                <h3 class="post_title">{{ $viewData['blogDetail']->TieuDe }}</h3>
                                <div class="blog_meta">
                                    <span class="author">Đăng bởi: <a href="#">{{ $viewData['blogDetail']->TacGia }}</a>
                                        / </span>
                                    <span class="post_date">Ngày : <a
                                            href="#">{{ $viewData['blogDetail']->created_at }}</a> /</span>
                                </div>
                            </div>
                            {{-- {!! $viewData['blogDetail']->NoiDung !!} --}}
                            {!! $viewData['noiDung'] !!}


                            {{-- <figcaption class="blog_content">
                                <div class="post_content">
                                    <br />
                                    <div class="blog_thumb_detail">
                                        <img src="{{ asset('assets/img/blog/8.png') }}" alt="portfolio image" />
                                    </div>
                                    <p><b>Năm sản xuất : 2018 – Giá bán: $13,000</b></p>
                                    <br />


                                    <p>Karimoku là công ty đồ gỗ nội thất nổi tiếng của Nhật Bản đã tồn tại được 80 năm.
                                        Medicom thường xuyên làm việc với Karimoku để làm đồ chơi thủ công bằng gỗ. Một
                                        trong những collab Bearbrick x Karimoku được tìm kiếm nhiều nhất là Bearbrick
                                        1000% bằng gỗ đầu tiên đầu tiên.

                                        Bearbrick 1000% được làm hoàn toàn bằng quả óc chó, được làm thủ công tại Nhật
                                        Bản và chỉ được làm theo đơn đặt hàng vì mỗi Bearbrick 1000% bằng gỗ này đòi hỏi
                                        sự cẩn thận và tỉ mỉ cao. Vì vậy chúng rất đắt tiền – một chú Baby Milo x
                                        Karimoku Bearbrick 11 inch và 400 inch đã được phát hành và được bán với giá
                                        2.000 đô la vào năm 2018.Theo StockX, 1000% Karimoku bearbrick đã được bán với
                                        giá 13.000 đô la. Điều đáng ngạc nhiên vì giá bán lẻ thấp nhất cho của Bearbrick
                                        1000% này là 40.000 USD.</p>

                                </div>
                            </figcaption> --}}


                            {{-- <div class="blog_thumb">
                                <a href="#"><img src="assets/img/blog/blog-big1.jpg" alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="post_content">
                                    <p>Aenean et tempor eros, vitae sollicitudin velit. Etiam varius enim nec quam
                                        tempor, sed efficitur ex ultrices. Phasellus pretium est vel dui vestibulum
                                        condimentum. Aenean nec suscipit nibh. Phasellus nec lacus id arcu facilisis
                                        elementum. Curabitur lobortis, elit ut elementum congue, erat ex bibendum
                                        odio, nec iaculis lacus sem non lorem. Duis suscipit metus ante, sed
                                        convallis quam posuere quis. Ut tincidunt eleifend odio, ac fringilla mi
                                        vehicula nec. Nunc vitae lacus eget lectus imperdiet tempus sed in dui. Nam
                                        molestie magna at risus consectetur, placerat suscipit justo dignissim. Sed
                                        vitae fringilla enim, nec ullamcorper arcu.</p>
                                    <blockquote>
                                        <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu
                                            consectetur. In venenatis elit ac ultrices convallis. Duis est nisi,
                                            tincidunt ac urna sed, cursus blandit lectus. In ullamcorper sit amet
                                            ligula ut eleifend. Proin dictum tempor ligula, ac feugiat metus. Sed
                                            finibus tortor eu scelerisque scelerisque.</p>
                                    </blockquote>
                                    <p>Aenean et tempor eros, vitae sollicitudin velit. Etiam varius enim nec quam
                                        tempor, sed efficitur ex ultrices. Phasellus pretium est vel dui vestibulum
                                        condimentum. Aenean nec suscipit nibh. Phasellus nec lacus id arcu facilisis
                                        elementum. Curabitur lobortis, elit ut elementum congue, erat ex bibendum
                                        odio, nec iaculis lacus sem non lorem. Duis suscipit metus ante, sed
                                        convallis quam posuere quis. Ut tincidunt eleifend odio, ac fringilla mi
                                        vehicula nec. Nunc vitae lacus eget lectus imperdiet tempus sed in dui. Nam
                                        molestie magna at risus consectetur, placerat suscipit justo dignissim. Sed
                                        vitae fringilla enim, nec ullamcorper arcu.</p>
                                    <p>Suspendisse turpis ipsum, tempus in nulla eu, posuere pharetra nibh. In
                                        dignissim vitae lorem non mollis. Praesent pretium tellus in tortor viverra
                                        condimentum. Nullam dignissim facilisis nisl, accumsan placerat justo
                                        ultricies vel. Vivamus finibus mi a neque pretium, ut convallis dui lacinia.
                                        Morbi a rutrum velit. Curabitur sagittis quam quis consectetur mattis.
                                        Aenean sit amet quam vel turpis interdum sagittis et eget neque. Nunc ante
                                        quam, luctus et neque a, interdum iaculis metus. Aliquam vel ante mattis,
                                        placerat orci id, vehicula quam. Suspendisse quis eros cursus, viverra urna
                                        sed, commodo mauris. Cras diam arcu, fringilla a sem condimentum, viverra
                                        facilisis nunc. Curabitur vitae orci id nulla maximus maximus. Nunc pulvinar
                                        sollicitudin molestie.</p>
                                </div>
                            </figcaption> --}}
                        </figure>
                    </article>
                </div>
                <!--blog grid area start-->
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="blog_sidebar_widget">
                    <div class="widget_list widget_search">
                        <h3>Search</h3>
                        @include('user.blog.blogSearch')
                    </div>
                    {{-- <div class="widget_list widget_post">
                        <h3>Recent Posts</h3>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog12.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="blog-details.html">Blog image post</a></h3>
                                <span>March 16, 2022 </span>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog13.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="blog-details.html">Post with Gallery</a></h3>
                                <span>March 16, 2022 </span>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog14.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="blog-details.html">Post with Audio</a></h3>
                                <span>March 16, 2022 </span>
                            </div>
                        </div>
                        <div class="post_wrapper">
                            <div class="post_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog15.jpg" alt=""></a>
                            </div>
                            <div class="post_info">
                                <h3><a href="blog-details.html">Post with Video</a></h3>
                                <span>March 16, 2022 </span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!--blog section area end-->
@endsection