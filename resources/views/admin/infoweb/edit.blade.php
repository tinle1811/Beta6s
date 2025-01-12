@extends('admin.layouts.app')
@section('title', $viewData['title'])
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item">
                                    <a class="breadcrumb-link" href="settings.html">Admin</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Admin/ Chỉnh sửa website</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">{{ $viewData['title'] }}</h1>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Form -->
            @if ($viewData['websiteInfo'])
                <form method="POST" action="{{ route('admin.infoweb.update') }}" enctype="multipart/form-data">

                    @csrf
                    @method('PUT') <!-- chỉ định phương thức PUT -->

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Card -->
                            <div class="card mb-3 mb-lg-5">
                                <div class="card-header">
                                    <h4 class="card-header-title">CHỈNH SỬA THÔNG TIN WEBSITE</h4>
                                </div>

                                <div class="card-body">
                                    <!-- Logo -->
                                    <div class="form-group d-flex flex-column align-items-center mb-3">
                                        <!-- Logo Label in the center -->
                                        <label for="logo"
                                            class="col-sm-3 col-form-label input-label text-center">Logo</label>

                                        <!-- Avatar image below the label (Hiển thị logo cũ mặc định) -->
                                        <span class="avatar avatar-xxl avatar-4by3">
                                            <img class="avatar-img" id="logoPreview"
                                                src="{{ asset('storage/logos/' . $viewData['websiteInfo']->logo) }}"
                                                alt="Logo cũ">
                                        </span>

                                        <!-- File input below the image -->
                                        <input type="file" class="col-sm-3 col-form-label input-label text-center"
                                            name="logo" id="logo">
                                    </div>


                                    <!-- Address -->
                                    <div class="form-group d-flex align-items-center mb-3">
                                        <label for="address" class="col-sm-3 col-form-label input-label">Địa chỉ: </label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            value="{{ $viewData['websiteInfo']->address }}">
                                    </div>

                                    <!-- Hotline -->
                                    <div class="form-group d-flex align-items-center mb-3">
                                        <label for="hotline" class="col-sm-3 col-form-label input-label">Hotline: </label>
                                        <input type="text" class="form-control" name="hotline" id="hotline"
                                            value="{{ $viewData['websiteInfo']->hotline }}">
                                    </div>

                                    <!-- Email Support -->
                                    <div class="form-group d-flex align-items-center mb-3">
                                        <label for="email_support" class="col-sm-3 col-form-label input-label">Email hỗ trợ:
                                        </label>
                                        <input type="email" class="form-control" name="email_support" id="email_support"
                                            value="{{ $viewData['websiteInfo']->email }}">
                                    </div>

                                    <!-- Social Media Links -->
                                    <div class="form-group d-flex align-items-center mb-3">
                                        <label for="facebook" class="col-sm-3 col-form-label input-label">Facebook</label>
                                        <input type="url" class="form-control" name="facebook" id="facebook"
                                            value="{{ $viewData['websiteInfo']->facebook }}">
                                    </div>

                                    <div class="form-group d-flex align-items-center mb-3">
                                        <label for="instagram" class="col-sm-3 col-form-label input-label">Instagram</label>
                                        <input type="url" class="form-control" name="instagram" id="instagram"
                                            value="{{ $viewData['websiteInfo']->instagram }}">
                                    </div>

                                    <div class="form-group d-flex align-items-center mb-3">
                                        <label for="twitter" class="col-sm-3 col-form-label input-label">Twitter</label>
                                        <input type="url" class="form-control" name="twitter" id="twitter"
                                            value="{{ $viewData['websiteInfo']->twitter }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Save Buttons -->
                    <div class="form-group d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-secondary mr-2" onclick="window.history.back();">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            @else
                <p>Thông tin website không có sẵn.</p>
            @endif
        </div>
    </main>

    <script>
        // Lắng nghe sự kiện thay đổi của input file
        document.getElementById('logo').addEventListener('change', function(event) {
            var reader = new FileReader();

            // Khi file đã được đọc thành công
            reader.onload = function(e) {
                // Lấy đối tượng img có id là 'logoPreview' để hiển thị logo mới
                var img = document.getElementById('logoPreview');

                // Cập nhật thuộc tính src của img để hiển thị ảnh mới
                img.src = e.target.result;
            };

            // Đọc file vừa được chọn
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    </script>
@endsection
