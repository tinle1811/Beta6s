     <!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <!-- Đường dẫn về Trang chủ -->
                        <li><a href="{{ route('user.home.index') }}">Trang chủ</a></li>
                        
                        <!-- Tiêu đề trang hiện tại -->
                        <li>{{$title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
