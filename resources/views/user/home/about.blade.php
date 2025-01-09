@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')

    <!--font-family-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="assetsAbout/logo/favicon.png" />

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="assetsAbout/css/font-awesome.min.css">

    <!--flat icon css-->
    <link rel="stylesheet" href="assetsAbout/css/flaticon.css">

    <!--animate.css-->
    <link rel="stylesheet" href="assetsAbout/css/animate.css">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="assetsAbout/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assetsAbout/css/owl.theme.default.min.css">

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="assetsAbout/css/bootstrap.min.css">

    <!-- bootsnav -->
    <link rel="stylesheet" href="assetsAbout/css/bootsnav.css">

    <!--style.css-->
    <link rel="stylesheet" href="assetsAbout/css/style.css">

    <!--responsive.css-->
    <link rel="stylesheet" href="assetsAbout/css/responsive.css">

    <!--about section area -->
    <section class="about_section mt-60">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <figure>
                        <div class="about_thumb">
                            {{-- <img src="assetsAbout/images/about/about1.png" alt=""> --}}
                            <!-- Thêm video tại đây -->
                            <div class="about_video mt-4">
                                <video id="aboutVideo" width="100%">
                                    <source src="assetsAbout/images/about/about-video.mp4" type="video/mp4">
                                    Trình duyệt của bạn không hỗ trợ thẻ video.
                                </video>
                            </div>
                        </div>
                        <figcaption class="about_content">
                            <h1>Trong mỗi chú gấu Bearbrick, là một câu chuyện tình yêu bất tận.</h1>
                            <p>Dành cho những ai trân trọng giá trị của những điều nhỏ bé.</p>
                            <p>"Mỗi chú gấu Bearbrick tại Beta6S là một cánh cửa dẫn đến một thế giới mới. Ở đó, bạn có thể
                                là một nhà thám hiểm dũng cảm, một nghệ sĩ tài hoa, hoặc đơn giản chỉ là một người mơ mộng.
                                Hãy để những chú gấu này đồng hành cùng bạn, khám phá những khía cạnh khác nhau của bản thân
                                và tạo nên những kỷ niệm đáng nhớ." - "Bạn là duy nhất, gấu của bạn cũng vậy."</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!--about section end-->

    <!--about start -->
    <section id="about" class="about">
        <div class="section-heading text-center">
            <h2>Về chúng tôi</h2>
        </div>
        <div class="container">
            <div class="about-content">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="single-about-txt">
                            <h3 class="stylish-heading">
                                Beta6S: Lãng mạn trong từng đường nét.
                            </h3>
                            <p style="color:black">
                                Beta6S - Không chỉ là một cửa hàng, mà còn là cánh cửa dẫn đến một thế giới đầy màu sắc của
                                những chú gấu Bearbrick. Mỗi chú gấu tại Beta6S đều mang trong mình một câu chuyện riêng,
                                một linh hồn độc đáo. Chúng tôi tự hào mang đến cho bạn những sản phẩm chính hãng từ Medicom
                                Toy (Nhật Bản), cùng với đó là những trải nghiệm sưu tầm độc đáo, giúp bạn khám phá và tạo
                                dựng những kỷ niệm đáng nhớ.
                            </p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="single-about-add-info">
                                        <h3>HotLine</h3>
                                        <p>{{ $websiteInfo->hotline }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="single-about-add-info">
                                        <h3>Email:</h3>
                                        <p>{{ $websiteInfo->email }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="single-about-add-info">
                                        <h3>website</h3>
                                        <p>{{ $websiteInfo->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-offset-1 col-sm-5">
                        <div class="single-about-img">
                            <img src="assetsAbout/images/about/about4.jpg" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!--/.about-->
    <!--about end -->

    <!--services img area-->
    <div class="about_gallery_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="assetsAbout/images/about/about1.png" alt="Background Image">
                                <img src="assetsAbout/images/about/about6.png" alt="Floating Image">
                            </div>
                            <figcaption class="about_gallery_content">
                                <h3 class="h3-about">Lĩnh vực kinh doanh</h3>
                                <p>Beta6S là thiên đường dành cho những tín đồ yêu thích nghệ thuật và sưu tầm. Chúng tôi
                                    chuyên cung cấp các mẫu Bearbrick chính hãng từ Medicom Toy, Nhật Bản, với đa dạng mẫu
                                    mã và phiên bản giới hạn. Với niềm đam mê mãnh liệt dành cho thế giới Bearbrick, Beta6S
                                    cam kết mang đến cho khách hàng những trải nghiệm mua sắm tuyệt vời và những sản phẩm
                                    chất lượng cao nhất.</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-6 col-md-6">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="assetsAbout/images/about/about22.png" alt="Background Image">
                                <img src="assetsAbout/images/about/about7.png" alt="Floating Image" style="width: 35%">
                            </div>
                            <figcaption class="about_gallery_content">
                                <h3 class="h3-about" style="color: #98a987">Lịch sử phát triển</h3>
                                <p>Beta6S được thành lập vào năm 2022 với sứ mệnh mang đến cho cộng đồng những sản phẩm
                                    Bearbrick chính hãng và chất lượng cao nhất. Trải qua hơn 2 năm hình thành và phát
                                    triển, chúng tôi đã trở thành điểm đến quen thuộc của những người yêu thích nghệ thuật
                                    đường phố tại Việt Nam. Với đội ngũ nhân viên nhiệt tình và am hiểu về Bearbrick, chúng
                                    tôi luôn sẵn sàng đồng hành cùng bạn trên hành trình khám phá thế giới đầy màu sắc của
                                    những chú gấu này.
                                </p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <!--services img end-->

    <!--chose us area start-->
    <div class="choseus_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="single_chose">
                        <div class="chose_icone">
                            <img src="assetsAbout/images/about/About_icon1.png" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>Trải nghiệm hoàn hảo</h3>
                            <p>Tại Beta6S, mỗi bước chân của bạn đều là một trải nghiệm mua sắm hoàn hảo, từ không gian
                                trưng bày độc đáo đến dịch vụ khách hàng chu đáo.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single_chose">
                        <div class="chose_icone">
                            <img src="assetsAbout/images/about/About_icon2.png" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>Thiết kế độc đáo</h3>
                            <p>Từ những phiên bản giới hạn đến những thiết kế sáng tạo, chắc chắn sẽ có một chú gấu
                                Bearbrick phù hợp với phong cách của bạn.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single_chose">
                        <div class="chose_icone">
                            <img src="assetsAbout/images/about/About_icon3.png" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>Chất lượng cao</h3>
                            <p>Chất lượng là tiêu chí hàng đầu tại Beta6S cam kết mang đến cho bạn những sản phẩm Bearbrick
                                chính hãng với chất lượng cao nhất.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--chose us area end-->

    <!--profiles start -->
    <section id="profiles" class="profiles">
        <div class="profiles-details">
            <div class="section-heading text-center">
                <h2>Điều khoản & Chính sách</h2>
            </div>
            <div class="container">
                <div class="profiles-content">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="single-profile">
                                <div class="profile-txt">
                                    <a href=""><i class="flaticon-themeforest"></i></a>
                                    <div class="profile-icon-name">Quy định chung
                                    </div>
                                </div>
                                <div class="single-profile-overlay">
                                    <div class="profile-txt">
                                        <a href=""><i class="flaticon-themeforest"></i></a>
                                        <div class="profile-icon-name-detail">Khách hàng phải cung cấp thông tin cá nhân
                                            chính xác khi mua sắm.<br />
                                            Các giao dịch không đú̀ng chính sách sẽ báo hủy không báo trước.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="single-profile">
                                <div class="profile-txt">
                                    <a href=""><i class="flaticon-dribbble"></i></a>
                                    <div class="profile-icon-name">Quyển sở hữu trí tuệ</div>
                                </div>
                                <div class="single-profile-overlay">
                                    <div class="profile-txt">
                                        <a href=""><i class="flaticon-dribbble"></i></a>
                                        <div class="profile-icon-name-detail">BEARBRICK Beta6S giữ quyền sở hữu logo và
                                            hình
                                            ảnh sản phẩm.
                                            <br />
                                            Không sao chép thiết kế, sản phẩm nếu không có đồng ý bằng văn bản.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="single-profile">
                                <div class="profile-txt">
                                    <a href=""><i class="flaticon-behance-logo"></i></a>
                                    <div class="profile-icon-name">Bảo hành</div>
                                </div>
                                <div class="single-profile-overlay">
                                    <div class="profile-txt">
                                        <a href=""><i class="flaticon-behance-logo"></i></a>
                                        <div class="profile-icon-name-detail">Đảm bảo hàng chính hãng. <br /> Đổi trả trong
                                            vòng 7 ngày nếu sản phẩm lỗi từ nhà sản xuất.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="single-profile profile-no-border">
                                <div class="profile-txt">
                                    <a href=""><i class="flaticon-github-logo"></i></a>
                                    <div class="profile-icon-name">Vận chuyển</div>
                                </div>
                                <div class="single-profile-overlay">
                                    <div class="profile-txt">
                                        <a href=""><i class="flaticon-github-logo"></i></a>
                                        <div class="profile-icon-name-detail">Miễn phí giao hàng.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-border"></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="single-profile">
                                <div class="profile-txt">
                                    <a href=""><i class="flaticon-flickr-website-logo-silhouette"></i></a>
                                    <div class="profile-icon-name">Thanh toán</div>
                                </div>
                                <div class="single-profile-overlay">
                                    <div class="profile-txt">
                                        <a href=""><i class="flaticon-flickr-website-logo-silhouette"></i></a>
                                        <div class="profile-icon-name-detail">Chuyển khoản. <br /> Thanh toán khi nhận hàng
                                            (COD).</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="single-profile">
                                <div class="profile-txt">
                                    <a href=""><i class="flaticon-smug"></i></a>
                                    <div class="profile-icon-name">Báo giá</div>
                                </div>
                                <div class="single-profile-overlay">
                                    <div class="profile-txt">
                                        <a href=""><i class="flaticon-smug"></i></a>
                                        <div class="profile-icon-name-detail">Báo giá chi tiết tại website và hotline.
                                            <br />
                                            Giá bao gồm VAT cho các giao dịch trong nội địa.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="single-profile">
                                <div class="profile-txt">
                                    <a href=""><i class="flaticon-squarespace-logo"></i></a>
                                    <div class="profile-icon-name">Bảo mật thông tin</div>
                                </div>
                                <div class="single-profile-overlay">
                                    <div class="profile-txt">
                                        <a href=""><i class="flaticon-squarespace-logo"></i></a>
                                        <div class="profile-icon-name-detail">Mọi thông tin cá nhân của khách hàng sẽ được
                                            bảo mật tuyệt đối. <br />
                                            Chỉ sử dụng thông tin để phục vụ giao dịch và chăm sóc khách hàng.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="single-profile profile-no-border">
                                <div class="profile-txt">
                                    <a href=""><i
                                            class="flaticon-bitbucket-logotype-camera-lens-in-perspective"></i></a>
                                    <div class="profile-icon-name">Dịch vụ hỗ trợ</div>
                                </div>
                                <div class="single-profile-overlay">
                                    <div class="profile-txt">
                                        <a href=""><i
                                                class="flaticon-bitbucket-logotype-camera-lens-in-perspective"></i></a>
                                        <div class="profile-icon-name-detail">Hỡ trợ khách hàng kịp thời qua Email và dịch
                                            vụ Hotline.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!--/.profiles-->
    <!--profiles end -->

    <!--portfolio start -->
    <section id="portfolio" class="portfolio">
        <div class="portfolio-details">
            <div class="section-heading text-center">
                <h2>Bài viết nổi bật</h2>
            </div>
            <div class="container">
                <div class="portfolio-content">
                    <div class="isotope">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="assetsAbout/images/about/b2.png" alt="portfolio image" />
                                    <div class="isotope-overlay">
                                        <a href="#">
                                            NIKE X UNHCR 2006 WORLD CUP CHARITY BEARBRICK: PORTUGAL MODEL
                                        </a>
                                    </div><!-- /.isotope-overlay -->
                                </div><!-- /.item -->
                                <div class="item">
                                    <img src="assetsAbout/images/about/b3.png" alt="portfolio image" />
                                    <div class="isotope-overlay">
                                        <a href="#">

                                            SWAROVSKI X COLETTE “WHITE CRYSTAL CHRISTMAS”
                                        </a>
                                    </div><!-- /.isotope-overlay -->
                                </div><!-- /.item -->
                            </div><!-- /.col -->

                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="assetsAbout/images/about/b1.png" alt="portfolio image" />
                                    <div class="isotope-overlay">
                                        <a href="#">
                                            Bearbrick là ???
                                        </a>
                                    </div><!-- /.isotope-overlay -->
                                </div><!-- /.item -->
                            </div><!-- /.col -->

                            <div class="col-sm-4">
                                <div class="item">
                                    <img src="assetsAbout/images/about/b4.png" alt="portfolio image" />
                                    <div class="isotope-overlay">
                                        <a href="#">
                                            THE BLACK SENSE MARKET X THE CONTEMPORARY FIX 1000% STAINLESS STEEL BEARBRICK
                                        </a>
                                    </div><!-- /.isotope-overlay -->
                                </div><!-- /.item -->
                                <div class="item">
                                    <img src="assetsAbout/images/about/b5.png" alt="portfolio image" />
                                    <div class="isotope-overlay">
                                        <a href="#">
                                            KAWS Dissected 1000% Bearbrick
                                        </a>
                                    </div><!-- /.isotope-overlay -->
                                </div><!-- /.item -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!--/.isotope-->
                </div><!--/.gallery-content-->
            </div><!--/.container-->
        </div><!--/.portfolio-details-->

    </section><!--/.portfolio-->
    <!--portfolio end -->



    <script src="assetsAbout/js/jquery.js"></script>

    <!--modernizr.min.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <!--bootstrap.min.js-->
    <script src="assetsAbout/js/bootstrap.min.js"></script>

    <!-- bootsnav js -->
    <script src="assetsAbout/js/bootsnav.js"></script>

    <!-- jquery.sticky.js -->
    <script src="{{ asset('assetsAboutAbout/js/jquery.sticky.js') }}"></script>

    <!-- for progress bar start-->

    <!-- progressbar js -->
    <script src="assetsAbout/js/progressbar.js"></script>

    <!-- appear js -->
    <script src="assetsAbout/js/jquery.appear.js"></script>

    <!-- for progress bar end -->

    <!--owl.carousel.js-->
    <script src="assetsAbout/js/owl.carousel.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>


    <!--Custom JS-->
    <script src="assetsAbout/js/custom.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy thẻ video
            var videoElement = document.getElementById("aboutVideo");

            // Kiểm tra nếu video tồn tại
            if (videoElement) {
                // AJAX để kiểm tra xem video có sẵn không
                fetch("assetsAbout/images/about/about-video.mp4", {
                        method: "HEAD"
                    })
                    .then(response => {
                        if (response.ok) {
                            // Nếu video tồn tại, thêm các thuộc tính và sự kiện cần thiết
                            videoElement.autoplay = true; // Tự động phát
                            videoElement.loop = true; // Tự động phát lại
                            videoElement.muted = true; // Tắt tiếng (nếu cần)

                            // Phát video khi sẵn sàng
                            videoElement.load();
                            videoElement.play();
                        } else {
                            console.error("Video không tồn tại!");
                        }
                    })
                    .catch(error => {
                        console.error("Lỗi khi tải video:", error);
                    });
            }
        });
    </script>
@endsection
