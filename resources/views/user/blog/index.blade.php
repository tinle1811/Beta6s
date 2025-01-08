@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    <!--blog area start-->
    <div class="blog_page_section mt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="blog_wrapper">
                        <div class="blog_header">
                            <a href="{{ route('user.blog.index') }}">
                                <h1>Danh sách bài viết</h1>
                            </a>
                        </div>
                        <div class="row">
                            @if (request('search') && $viewData['blogs']->isNotEmpty())
                                <p>Kết quả tìm kiếm cho từ khóa: "{{ request('search') }}"</p>
                            @endif
                            @if (request('search') && $viewData['blogs']->isEmpty())
                                <div class="alert alert-soft-info" role="alert">
                                    Không tìm thấy bài viết nào.
                                </div>
                            @endif
                            @foreach ($viewData['blogs'] as $blog)
                                <div class="col-lg-6 col-md-6">
                                    <article class="single_blog mb-60">
                                        <figure>
                                            <div class="blog_thumb">
                                                <a href="{{ route('user.blog.show', ['id' => $blog->MaBV]) }}">
                                                    <img src="{{ asset('assets/img/blog/' . $blog->HinhAnh) }}"
                                                        alt="{{ $blog->TieuDe }}">
                                                </a>
                                            </div>
                                            <figcaption class="blog_content">
                                                <h4>
                                                    <a href="{{ route('user.blog.show', ['id' => $blog->MaBV]) }}">
                                                        {{ $blog->TieuDe }}
                                                    </a>
                                                </h4>
                                                <div class="blog_meta">
                                                    <span class="author">Posted by : <a
                                                            href="#">{{ $blog->TacGia }}</a> / </span>
                                                    <span class="post_date">On : <a
                                                            href="#">{{ $blog->created_at }}</a></span>
                                                </div>
                                                <div class="blog_desc">
                                                    <p>{{ Str::limit($blog->content, 150, '...') }}</p>
                                                </div>
                                                <footer class="readmore_button">
                                                    <a href="{{ route('user.blog.show', ['id' => $blog->MaBV]) }}">Xem chi
                                                        tiết</a>
                                                </footer>
                                            </figcaption>
                                        </figure>
                                    </article>
                                </div>
                            @endforeach

                            {{-- <div class="col-lg-6 col-md-6">
                                <article class="single_blog mb-60">
                                    <figure>
                                        <div class="blog_thumb">
                                            <a href="{{ route('user.blog.show') }}"><img src="assets/img/blog/blog1.jpg"
                                                    alt=""></a>
                                        </div>
                                        <figcaption class="blog_content">
                                            <h3><a href="{{ route('user.blog.show') }}">Blog image post (sticky)</a></h3>
                                            <div class="blog_meta">
                                                <span class="author">Posted by : <a href="#">admin</a> / </span>
                                                <span class="post_date">On : <a href="#">April 10, 2022</a></span>
                                            </div>
                                            <div class="blog_desc">
                                                <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu
                                                    ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent
                                                    ornare tortor ac ante egestas hendrerit. Aliquam et metus pharetra,
                                                    bibendum massa nec, fermentum odio. </p>
                                            </div>
                                            <footer class="readmore_button">
                                                <a href="{{ route('user.blog.show') }}">read more</a>
                                            </footer>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div> --}}

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
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
    <!--blog area end-->

    <!--blog pagination area start-->
    <div class="blog_pagination">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pagination">
                        <!-- Hiển thị phân trang -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $viewData['blogs']->appends(request()->query())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--blog pagination area end-->
@endsection
