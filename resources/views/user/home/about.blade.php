@extends('user.layouts.app')
@section('title',$viewData['title'])
@section('content')
        @include('user.layouts.breadcrumbs')
        <!--about section area -->
        <section class="about_section mt-60">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <figure>
                        <div class="about_thumb d-flex justify-content-center align-items-center">
                            <img src="assets/img/logoBeta6s.jpg" class="" style="width:80%">
                        </div>
                        <figcaption class="about_content">
                            <h1 class="fw-bold text-center">Giới thiệu về chúng tôi</h1>
                            <p>Chào mừng bạn đến với Beta6s! Chúng tôi chuyên cung cấp các sản phẩm Bearbrick độc đáo và chất lượng cao,
                                dành cho những tín đồ yêu thích sưu tập đồ chơi nghệ thuật. Với đa dạng mẫu mã từ các phiên bản giới hạn
                                đến những thiết kế đặc biệt, chúng tôi cam kết mang đến những sản phẩm đáng giá cho bộ sưu tập của bạn</p>
                            <p>
                                Tại Beta6s, chúng tôi hiểu rằng mỗi Bearbrick không chỉ là một món đồ chơi, mà là một tác phẩm nghệ thuật
                                đầy giá trị. Hãy cùng chúng tôi khám phá thế giới Bearbrick và nâng tầm bộ sưu tập của bạn với những sản phẩm chất lượng, được lựa chọn kỹ càng từ các thương hiệu nổi tiếng trên toàn thế giới.
                            </p>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!--about section end-->

    <!--services img area-->
    <div class="about_gallery_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="assetsUser/img_about/gioithieu1.jpg" alt="">
                            </div>
                            <figcaption class="about_gallery_content ms-4">
                                <h3>Chúng tôi làm gì</h3>
                                <p>Beta6s chuyên cung cấp các sản phẩm Bearbrick chính hãng, bao gồm các phiên bản giới hạn 
                                và thiết kế độc đáo. Chúng tôi mang đến cho khách hàng những món đồ chơi nghệ thuật chất lượng cao, 
                                phục vụ cho việc sưu tầm và trang trí. Với cam kết về chất lượng và dịch vụ, chúng tôi giúp bạn xây dựng 
                                và nâng tầm bộ sưu tập Bearbrick của mình.</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-6 col-md-6">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="assetsUser/img_about/gioithieu2.jpg" alt="">
                            </div>
                            <figcaption class="about_gallery_content ms-4">
                                <h3>Lịch sử của chúng tôi</h3>
                                <p>Beta6s được thành lập vào năm 2024 với niềm đam mê Bearbrick và mong muốn cung cấp những sản phẩm 
                                độc đáo cho cộng đồng sưu tập. Chúng tôi luôn tìm kiếm các phiên bản giới hạn và chất lượng cao từ các 
                                thương hiệu nổi tiếng, mang đến cho khách hàng những lựa chọn tuyệt vời. Qua năm tháng, chúng tôi tự hào 
                                đã trở thành điểm đến tin cậy cho những người yêu thích Bearbrick.</p>
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
                            <img src="assets/img/about/About_icon1.png" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>Đảm bảo hoàn tiền</h3>
                            <p>Chúng tôi cam kết bảo vệ quyền lợi của khách hàng.
                                Nếu sản phẩm/dịch vụ không đáp ứng mong đợi,
                                bạn có thể yêu cầu hoàn tiền trong vòng 7 ngày kể từ khi nhận hàng.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single_chose">
                        <div class="chose_icone">
                            <img src="assets/img/about/About_icon2.png" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>Thiết kế sáng tạo</h3>
                            <p>Chúng tôi mang đến giải pháp thiết kế độc đáo,
                                sáng tạo và phù hợp với nhu cầu riêng của bạn.
                                Mỗi sản phẩm thiết kế đều được chăm chút tỉ mỉ,
                                kết hợp giữa tính thẩm mỹ và hiệu quả truyền tải thông điệp.
                                Hãy để chúng tôi biến ý tưởng của bạn thành hiện thực!</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single_chose">
                        <div class="chose_icone">
                            <img src="assets/img/about/About_icon3.png" alt="">
                        </div>
                        <div class="chose_content">
                            <h3>Chất lượng cao</h3>
                            <p>Chúng tôi cam kết mang đến sản phẩm/dịch vụ chất lượng vượt trội,
                                được kiểm tra kỹ lưỡng và đạt chuẩn cao nhất.
                                Mỗi chi tiết đều được chăm sóc tỉ mỉ,
                                đảm bảo sự hài lòng tuyệt đối cho khách hàng.
                                Chất lượng là ưu tiên hàng đầu của chúng tôi!</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--chose us area end-->

    <!--team area start-->
    <div class="team_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <article class="team_member">
                        <figure>
                            <div class="team_thumb">
                                <img src="assetsUser/img_about/Khanh.jpg" alt="">
                            </div>
                            <figcaption class="team_content">
                                <h3>Nguyễn Hoàng Khánh</h3>
                                <hr class="underline">
                                <p>Số điện thoại: 0362838087 <br> Email: 0306221238@caothang.edu.vn</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4">
                    <article class="team_member">
                        <figure>
                            <div class="team_thumb">
                                <img src="assetsUser/img_about/Ngan.jpg" alt="">
                            </div>
                            <figcaption class="team_content">
                                <h3>Tạ Kiều Ngân</h3>
                                <hr class="underline">
                                <p>Số điện thoại: 0393416405 <br> Email: 0306221253@caothang.edu.vn</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4">
                    <article class="team_member">
                        <figure>
                            <div class="team_thumb">
                                <img src="assetsUser/img_about/Truc.jpg" alt="">
                            </div>
                            <figcaption class="team_content">
                                <h3>Đặng Phan Thanh Trúc</h3>
                                <hr class="underline">
                                <p>Số điện thoại: 0968963040 <br> Email: 0306221288@caothang.edu.vn</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4 mt-5">
                    <article class="team_member">
                        <figure>
                            <div class="team_thumb">
                                <img src="assetsUser/img_about/Khoa.png" alt="">
                            </div>
                            <figcaption class="team_content">
                                <h3>Nguyễn Hải Đăng Khoa</h3>
                                <hr class="underline">
                                <p>Số điện thoại: 0373275100 <br> Email: 0306221240@caothang.edu.vn</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4 mt-5">
                    <article class="team_member">
                        <figure>
                            <div class="team_thumb">
                                <img src="assetsUser/img_about/Manh.jpg" alt="">
                            </div>
                            <figcaption class="team_content">
                                <h3>Huỳnh Đức Mạnh</h3>
                                <hr class="underline">
                                <p>Số điện thoại: 0388630137 <br> Email: 0306221250@caothang.edu.vn</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4 mt-5">
                    <article class="team_member">
                        <figure>
                            <div class="team_thumb">
                                <img src="assetsUser/img_about/Tin.jpg" alt="">
                            </div>
                            <figcaption class="team_content">
                                <h3>Lê Trung Tín</h3>
                                <hr class="underline">
                                <p>Số điện thoại: 0378439127 <br> Email: 0306221284@caothang.edu.vn</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <!--team area end-->
@endsection
