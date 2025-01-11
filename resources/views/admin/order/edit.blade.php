@extends('admin.layouts.app')
@section('title', $viewData['title'])
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('admin.order.update', ['maHD' => $viewData['hoaDon']->MaHD]) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Page Header -->
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-no-gutter">
                                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="ecommerce-orders.html">Hóa
                                            đơn</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chi tiết hóa đơn</li>
                                </ol>
                            </nav>

                            <div class="d-sm-flex align-items-sm-center">
                                <h1 class="page-header-title">Mã hóa đơn: {{ $viewData['hoaDon']->MaHD }}</h1>
                                <span
                                    class="badge 
                                    @if ($viewData['hoaDon']->TrangThai == 0) badge-soft-warning
                                    @elseif($viewData['hoaDon']->TrangThai == 1) badge-soft-primary @endif
                                    ml-sm-3">
                                    <span
                                        class="legend-indicator 
                                      @if ($viewData['hoaDon']->TrangThai == 0) bg-warning
                                      @elseif($viewData['hoaDon']->TrangThai == 1) bg-primary @endif
                                  ">
                                    </span>
                                    @if ($viewData['hoaDon']->TrangThai == 0)
                                        Chờ xử lý
                                    @elseif($viewData['hoaDon']->TrangThai == 1)
                                        Đang giao
                                    @endif
                                </span>
                                <span class="ml-2 ml-sm-3">
                                    <i class="tio-date-range"></i> {{ $viewData['hoaDon']->created_at }}
                                </span>
                            </div>

                            <div class="mt-2">
                                <a class="text-body mr-3" href="javascript:;" onclick="window.print(); return false;">
                                    <i class="tio-print mr-1"></i> In hóa đơn
                                </a>

                                <!-- Unfold -->
                                <!-- End Unfold -->
                            </div>
                        </div>

                        {{-- <div class="col-sm-auto">
                        <a class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle mr-1" href="#"
                            data-toggle="tooltip" data-placement="top" title="Previous order">
                            <i class="tio-arrow-backward"></i>
                        </a>
                        <a class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="#"
                            data-toggle="tooltip" data-placement="top" title="Next order">
                            <i class="tio-arrow-forward"></i>
                        </a>
                    </div> --}}
                    </div>
                </div>
                <!-- End Page Header -->


                <div class="row">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">Chi tiết</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                @foreach ($viewData['hoaDon']->chiTietHoaDons as $chiTiet)
                                    <!-- Media -->
                                    <div class="media">
                                        <div class="avatar avatar-xl mr-3">
                                            <img class="img-fluid"
                                                src="{{ asset('storage/' . $chiTiet->sanPham->getProductImage()) }}"
                                                alt="Image Description">
                                        </div>

                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3 mb-md-0">
                                                    <a class="h5 d-block" href="#">{{ $chiTiet->sanPham->TenSP }}</a>
                                                </div>

                                                <div class="col col-md-2 align-self-center">
                                                    <h5>{{ number_format($chiTiet->DonGia, 2) }} VND</h5>
                                                </div>

                                                <div class="col col-md-2 d-flex align-items-start justify-content-center">
                                                    <h5>{{ $chiTiet->SoLuong }}</h5>
                                                </div>

                                                <div class="col col-md-2 align-self-center text-right">
                                                    <h5>{{ number_format($chiTiet->SoLuong * $chiTiet->DonGia, 2) }} VND
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Media -->
                                @endforeach

                                <hr>


                                <div class="row justify-content-md-end mb-3">
                                    <div class="col-md-8 col-lg-7">
                                        <dl class="row text-sm-right">

                                            <dt class="col-sm-6">Shipping fee:</dt>
                                            <dd class="col-sm-6">0 VND</dd>

                                            <dt class="col-sm-6">Total:</dt>
                                            <dd class="col-sm-6">{{ number_format($viewData['hoaDon']->TongTien, 2) }} VND
                                            </dd>

                                        </dl>
                                        <!-- End Row -->
                                    </div>
                                </div>
                                <!-- End Row -->
                            </div>
                            <!-- End Body -->
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">
                                    Trạng thái
                                </h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            {{-- <div class="card-body">
                            <div class="row form-group">
                                <label for="categoryLabel" class="col-sm-3 col-form-label input-label">Phương thức thanh
                                    toán</label>
                                <div class="col-sm-9">
                                    <!-- Input để hiển thị phương thức thanh toán, không cho nhập -->
                                    <input type="text" class="form-control"
                                        value="{{ $viewData['hoaDon']->phuongThucThanhToan->TenPT ?? 'Không rõ' }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="TrangThaiThanhToan" class="col-sm-3 col-form-label input-label">Trạng thái
                                    thanh
                                    toán</label>
                                <div class="col-sm-9">
                                    <!-- Select cho trạng thái thanh toán -->
                                    <select name="TrangThaiThanhToan" class="js-select2-custom custom-select" size="1"
                                        style="opacity: 0;">
                                        <option label="empty"></option>
                                        <option value="0"
                                            {{ $viewData['hoaDon']->TrangThaiThanhToan == '0' ? 'selected' : '' }}>Chờ
                                            thanh
                                            toán</option>
                                        <option value="1"
                                            {{ $viewData['hoaDon']->TrangThaiThanhToan == '1' ? 'selected' : '' }}>Đã
                                            thanh toán</option>

                                        <!-- Thêm các lựa chọn khác tùy theo dữ liệu có sẵn -->
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="TrangThai" class="col-sm-3 col-form-label input-label">Trạng thái đơn
                                    hàng</label>
                                <div class="col-sm-9">
                                    <!-- Select cho trạng thái đơn hàng -->
                                    <select name="TrangThai" id="TrangThai" class="js-select2-custom custom-select"
                                        size="1" style="opacity: 0;">
                                        <option label="empty"></option>
                                        <option value="0"
                                            {{ $viewData['hoaDon']->TrangThai == '0' ? 'selected' : '' }}>
                                            Chờ
                                            xử lý</option>
                                        <option value="1"
                                            {{ $viewData['hoaDon']->TrangThai == '1' ? 'selected' : '' }}>
                                            Đang giao
                                        </option>
                                        <option value="2"
                                            {{ $viewData['hoaDon']->TrangThai == '2' ? 'selected' : '' }}>
                                            Hoàn thành
                                        </option>
                                        <option value="3"
                                            {{ $viewData['hoaDon']->TrangThai == '3' ? 'selected' : '' }}>
                                            Hủy
                                        </option>
                                        <!-- Thêm các lựa chọn khác tùy theo dữ liệu có sẵn -->
                                    </select>
                                </div>
                            </div>

                            <div class="alert alert-danger" id="error-message" style="display: none;">
                                Trạng thái thanh toán không hợp lệ với thay đổi đơn hàng.
                            </div>
                        </div> --}}

                            <div class="card-body">
                                <div class="row form-group">
                                    <label for="categoryLabel" class="col-sm-3 col-form-label input-label">Phương thức thanh
                                        toán</label>
                                    <div class="col-sm-9">
                                        <!-- Input để hiển thị phương thức thanh toán, không cho nhập -->
                                        <input type="text" class="form-control"
                                            value="{{ $viewData['hoaDon']->phuongThucThanhToan->TenPT ?? 'Không rõ' }}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="TrangThaiThanhToan" class="col-sm-3 col-form-label input-label">Trạng thái
                                        thanh
                                        toán</label>
                                    <div class="col-sm-9">
                                        <!-- Select cho trạng thái thanh toán -->
                                        <select name="TrangThaiThanhToan" class="custom-select">
                                            <option value="0"
                                                {{ $viewData['hoaDon']->TrangThaiThanhToan == '0' ? 'selected' : '' }}>Chờ
                                                thanh
                                                toán</option>
                                            <option value="1"
                                                {{ $viewData['hoaDon']->TrangThaiThanhToan == '1' ? 'selected' : '' }}>Đã
                                                thanh toán</option>

                                            <!-- Thêm các lựa chọn khác tùy theo dữ liệu có sẵn -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="TrangThai" class="col-sm-3 col-form-label input-label">Trạng thái đơn
                                        hàng</label>
                                    <div class="col-sm-9">
                                        <!-- Select cho trạng thái đơn hàng -->
                                        <select name="TrangThai" id="TrangThai" class="custom-select">
                                            <option value="0"
                                                {{ $viewData['hoaDon']->TrangThai == '0' ? 'selected' : '' }}>
                                                Chờ
                                                xử lý</option>
                                            <option value="1"
                                                {{ $viewData['hoaDon']->TrangThai == '1' ? 'selected' : '' }}>
                                                Đang giao
                                            </option>
                                            <option value="2"
                                                {{ $viewData['hoaDon']->TrangThai == '2' ? 'selected' : '' }}>
                                                Hoàn thành
                                            </option>
                                            <option value="3"
                                                {{ $viewData['hoaDon']->TrangThai == '3' ? 'selected' : '' }}>
                                                Hủy
                                            </option>
                                            <!-- Thêm các lựa chọn khác tùy theo dữ liệu có sẵn -->
                                        </select>
                                    </div>
                                </div>

                                <div class="alert alert-danger" id="error-message" style="display: none;">
                                    Trạng thái thanh toán không hợp lệ với thay đổi đơn hàng.
                                </div>
                            </div>
                            <!-- End Body -->
                        </div>
                        <!-- End Card -->

                    </div>

                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">Thông tin khách hàng</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                <a class="media align-items-center" href="ecommerce-customer-details.html">
                                    {{-- <div class="avatar avatar-circle mr-3">
                                    <img class="avatar-img" src="assets\img\160x160\img10.jpg" alt="Image Description">
                                </div> --}}
                                    <div class="media-body">
                                        <span class="text-body text-hover-primary">
                                            {{ $viewData['hoaDon']->khachHang->TenKH }}</span>
                                    </div>
                                </a>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Thông tin liên lạc</h5>
                                </div>

                                <ul class="list-unstyled list-unstyled-py-2">
                                    <li>
                                        <i class="tio-online mr-2"></i>
                                        ella@example.com
                                    </li>
                                    <li>
                                        <i class="tio-android-phone-vs mr-2"></i>
                                        {{ $viewData['hoaDon']->khachHang->SDT }}
                                    </li>
                                </ul>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Địa chỉ giao hàng</h5>
                                    {{-- <a class="link" href="javascript:;">Edit</a> --}}
                                </div>

                                <span class="d-block">
                                    {{ $viewData['hoaDon']->khachHang->DiaChi }}
                                </span>

                                <hr>


                            </div>
                            <!-- End Body -->
                        </div>
                        <!-- End Card -->

                    </div>
                </div>
                <!-- End Row -->

                <div class="position-fixed bottom-0 content-centered-x w-100 z-index-99 mb-3" style="max-width: 40rem;">
                    <!-- Card -->
                    <div class="card card-sm bg-dark border-dark mx-2">
                        <div class="card-body">
                            <div class="row justify-content-center justify-content-sm-between">
                                <div class="col">
                                    <button type="button" class="btn btn-ghost-danger">Xóa</button>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-ghost-light mr-2" onclick="window.location.href='{{ route('admin.order') }}'">Hủy</button>
                                    <button type="submit" class="btn btn-primary" id="btnUpdateProduct">Lưu thay
                                        đổi</button>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            </form>
        </div>
        <!-- End Content -->

        <!-- Footer -->
        <div class="d-print-none">

            <div class="footer">
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <p class="font-size-sm mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2020
                                Htmlstream.</span></p>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex justify-content-end">
                            <!-- List Dot -->
                            <ul class="list-inline list-separator">
                                <li class="list-inline-item">
                                    <a class="list-separator-link" href="#">FAQ</a>
                                </li>

                                <li class="list-inline-item">
                                    <a class="list-separator-link" href="#">License</a>
                                </li>

                                <li class="list-inline-item">
                                    <!-- Keyboard Shortcuts Toggle -->
                                    <div class="hs-unfold">
                                        <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                            href="javascript:;"
                                            data-hs-unfold-options='{
                                "target": "#keyboardShortcutsSidebar",
                                "type": "css-animation",
                                "animationIn": "fadeInRight",
                                "animationOut": "fadeOutRight",
                                "hasOverlay": true,
                                "smartPositionOff": true
                               }'>
                                            <i class="tio-command-key"></i>
                                        </a>
                                    </div>
                                    <!-- End Keyboard Shortcuts Toggle -->
                                </li>
                            </ul>
                            <!-- End List Dot -->
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- End Footer -->
    </main>

    <script>
        function handleTrangThaiChange() {
            var trangThaiThanhToan = document.querySelector('[name="TrangThaiThanhToan"]').value;
            var trangThai = document.getElementById('TrangThai').value;
            var submitButton = document.getElementById('btnUpdateProduct');
            var errorMessage = document.getElementById('error-message');

            // Show the current values in the console for debugging
            console.log('Trạng thái thanh toán:', trangThaiThanhToan);
            console.log('Trạng thái đơn hàng:', trangThai);

            // Validate the order status against the payment status
            if (trangThai == '2' && trangThaiThanhToan != '1') { // Order is "Completed" but payment is not "Paid"
                errorMessage.style.display = 'block'; // Show error message
                submitButton.disabled = true; // Disable the submit button
            } else {
                errorMessage.style.display = 'none'; // Hide error message
                submitButton.disabled = false; // Enable the submit button
            }
        }

        // Attach the event listener to the status change dropdowns
        document.getElementById('TrangThai').addEventListener('change', handleTrangThaiChange);
        document.querySelector('[name="TrangThaiThanhToan"]').addEventListener('change', handleTrangThaiChange);

        // Initialize validation on page load
        handleTrangThaiChange();
    </script>
@endsection
