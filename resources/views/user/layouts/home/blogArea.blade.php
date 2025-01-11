    <!--blog area start-->
    <section class="blog_section mb-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog_carousel blog_column4 owl-carousel">
                    @foreach ($viewData['blogs'] as $blog)
                        <div class="col-lg-3">
                            <article class="single_blog">
                                <figure>
                                    <div class="blog_thumb">
                                        <a href="{{ route('user.blog.show', ['id' => $blog->MaBV]) }}">
                                            <img src="{{ asset('assets/img/blog/' . $blog->HinhAnh) }}"
                                                alt=""></a>
                                    </div>
                                    <figcaption class="blog_content">
                                        <p class="post_author">By <a href="#">{{ $blog->TacGia }}</a>
                                            {{ $blog->created_at }}</p>
                                        <h3 class="post_title"><a
                                                href="{{ route('user.blog.show', ['id' => $blog->MaBV]) }}">{{ $blog->TieuDe }}</a>
                                        </h3>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--blog area end-->
