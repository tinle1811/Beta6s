@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 profile-sidebar">
                <div class="profile-avatar-wrapper">
                    <img src="{{ asset('/assetsUser/img_product/4-4.jpg') }}" alt="avata" class="profile-avatar">
                    <p>Khoa Nguyễn</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.account.index') }}"><i class="bi bi-person"></i><span
                                class="text">Tài khoản của tôi</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.account.purchaseHistory') }}"><i
                                class="bi bi-cart-check"></i><span class="text">Lịch sử mua hàng</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.account.historyEvaluate') }}"><i
                                class="bi bi-chat-left"></i><span class="text">Lịch sử đánh giá</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-cart"></i><span
                                class="text">Đơn mua</span></a></li>
                </ul>
            </div>
            <div class="col-md-9 profile-content">
                <ul class="d-flex justify-content-between align-items-center list-unstyled bg-black py-3 px-4 fs-6 mx-1">
                    <li><a href="{{ route('user.account.purchase', ['type' => 0]) }}"
                            class="text-white text-decoration-none {{ $type == 0 ? 'fw-bold' : '' }}">Tất cả</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 1]) }}"
                            class="text-white text-decoration-none {{ $type == 1 ? 'fw-bold' : '' }}">Chờ lấy hàng</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 2]) }}"
                            class="text-white text-decoration-none {{ $type == 2 ? 'fw-bold' : '' }}">Chờ giao hàng</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 3]) }}"
                            class="text-white text-decoration-none {{ $type == 3 ? 'fw-bold' : '' }}">Hoàn thành</a></li>
                    <li><a href="{{ route('user.account.purchase', ['type' => 4]) }}"
                            class="text-white text-decoration-none {{ $type == 4 ? 'fw-bold' : '' }}">Đã hủy</a></li>
                </ul>
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="notificationReview"
                    style="display: none;">
                    Đã đánh giá đơn hàng xong!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="container mt-4">
                    <div class="mb-3 rounded">
                        {{ $hasOrders = false }}
                        @foreach ($hoaDons as $hoaDon)
                            @php $hasOrders = true; @endphp
                            <div class="p-3 bg-light border mb-3 rounded">
                                <div class="mb-2 text-end">
                                    <span class="fs-5k {{ $hoaDon->getTrangThaiName()['class'] }}">
                                        {{ $hoaDon->getTrangThaiName()['name'] }}
                                    </span>
                                </div>
                                @foreach ($hoaDon->chiTietHoaDons as $cthd)
                                    <div class="info-producct d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <img src="{{ asset('assetsUser/img_product/' . $cthd->sanPham->HinhAnh) }}"
                                                class="img-thumbnail rounded me-3"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                            <div>
                                                <h5 class="mb-1">{{ $cthd->sanPham->TenSP }}</h5>
                                                <p class="mb-1">Giá: {{ number_format($cthd->DonGia, 0, ',', '.') }} đ
                                                </p>
                                                <p class="mb-0">Số lượng: {{ $cthd->SoLuong }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="fs-7">
                                                {{ number_format($cthd->DonGia * $cthd->SoLuong, 0, ',', '.') }}đ</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-end py-3 me-3">
                                    <p class="fw-bold mb-0 fs-5">Tổng tiền:
                                        {{ number_format($hoaDon->TongTien, 0, ',', '.') }}đ</p>
                                </div>
                                <div class="text-end">
                                    @if ($hoaDon->TrangThai == 0)
                                        <button data-id="{{ $hoaDon->MaHD }}" onclick="cancelOrder({{ $hoaDon->MaHD }})"
                                            class="btn btn-danger me-2 cancel-order">Hủy</button>
                                        <button class="btn btn-primary me-2">Liên hệ</button>
                                    @elseif($hoaDon->TrangThai == 1)
                                        <button class="btn btn-success me-2">Đã nhận được hàng</button>
                                        <button class="btn btn-primary me-2">Liên hệ</button>
                                    @elseif($hoaDon->TrangThai == 2)
                                        @php
                                            // Đếm số lượng chi tiết hóa đơn và số lượng bình luận
                                            $chiTietHoaDonCount = $hoaDon->chiTietHoaDons->count();
                                            $binhLuanCount = $hoaDon->binhLuans->count();
                                        @endphp
                                        @if ($chiTietHoaDonCount > $binhLuanCount)
                                            <!-- Nút đánh giá, khi nhấn sẽ hiển thị modal -->
                                            <!-- Nút đánh giá, khi nhấn sẽ hiển thị modal -->
                                            <a href="#" class="btn btn-warning me-2" data-bs-toggle="modal"
                                                data-bs-target="#ratingModal" data-mahd="{{ $hoaDon->MaHD }}"
                                                data-chiTietHoaDons="{{ json_encode($hoaDon->chiTietHoaDons->toArray()) }}"
                                                onclick="openRatingModal(this)">Đánh giá
                                                {{-- <i class="bi bi-star"></i> <!-- Icon đánh giá --> --}}
                                            </a>
                                        @endif
                                        <button class="btn btn-success me-2">Mua lại</button>
                                        <button class="btn btn-primary me-2">Liên hệ</button>
                                    @elseif($hoaDon->TrangThai == 3)
                                        <button class="btn btn-success me-2">Mua lại</button>
                                        <button class="btn btn-primary me-2">Liên hệ</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if (!$hasOrders)
                            <p class="text-center text-muted bg-light py-3 rounded">Bạn chưa có đơn hàng nào
                                {{ $viewData['TabMessage'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Đánh giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="ratingFormsContainer"></div> <!-- Chứa các form đánh giá -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" id="btnCreateReview">Gửi Đánh Giá</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function cancelOrder(MaHD) {
            // Hiển thị confirm box xác nhận
            if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) {
                $.ajax({
                    url: '/purchase/cancel-order',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Gửi token CSRF
                        MaHD: MaHD
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload(); // Tự động làm mới trang
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            }
        }

        function openRatingModal(element) {
            const maHD = element.getAttribute('data-mahd');
            const chiTietHoaDons = JSON.parse(element.getAttribute('data-chiTietHoaDons'));

            if (!Array.isArray(chiTietHoaDons)) {
                console.error("Dữ liệu chiTietHoaDons không hợp lệ.");
                return;
            }

            // Xóa tất cả form đánh giá cũ trước khi thêm mới
            const ratingFormsContainer = document.getElementById('ratingFormsContainer');
            ratingFormsContainer.innerHTML = '';

            // Lặp qua từng chi tiết hóa đơn và tạo form đánh giá cho mỗi sản phẩm
            chiTietHoaDons.forEach(function(chiTiet) {
                const formHtml = `
            <div class="product-rating">
                <h5>Sản phẩm: ${chiTiet.san_pham.TenSP}</h5>
                <form class="mb-3">
                    <input type="hidden" name="maHD" value="${maHD}">
                    <input type="hidden" name="maSP" value="${chiTiet.san_pham.MaSP}">

                    
                   <div class="mb-2">
                        <label for="rating_${chiTiet.san_pham.MaSP}" class="form-label">Đánh giá:</label>
                        <select class="form-select" id="rating_${chiTiet.san_pham.MaSP}" name="rating">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="comment_${chiTiet.san_pham.MaSP}" class="form-label">Bình luận:</label>
                        <textarea class="form-control" id="comment_${chiTiet.san_pham.MaSP}" name="comment"></textarea>
                    </div>
                </form>
            </div>
            <hr>
        `;

                // Thêm form vào container
                ratingFormsContainer.innerHTML += formHtml;
            });
        }

        document.querySelector('#btnCreateReview').addEventListener('click', function() {
            const ratingFormsContainer = document.getElementById('ratingFormsContainer');
            const ratingForms = ratingFormsContainer.querySelectorAll('form');

            const reviews = [];

            ratingForms.forEach(function(form) {
                const maHD = form.querySelector('input[name="maHD"]').value;
                const maSP = form.querySelector('input[name="maSP"]').value;
                const rating = form.querySelector('select[name="rating"]').value;
                const comment = form.querySelector('textarea[name="comment"]').value;

                // Kiểm tra nếu dữ liệu hợp lệ
                if (rating && comment) {
                    reviews.push({
                        maHD: maHD,
                        maSP: maSP,
                        rating: rating,
                        comment: comment
                    });
                }
            });
            console.log(reviews);

            // Gửi AJAX đến controller để xử lý dữ liệu
            if (reviews.length > 0) {
                $.ajax({
                    url: '/addReview', // Đường dẫn đến controller
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token
                        reviews: reviews
                    },
                    success: function(response) {
                        if (response.success) {
                            //alert('Đánh giá đã được gửi thành công!');
                            // Đóng modal nếu cần
                            const modal = bootstrap.Modal.getInstance(document.getElementById(
                                'ratingModal'));
                            modal.hide();

                            // Tải lại trang sau khi gửi thành công
                            location.reload();
                            // Lưu trạng thái thông báo vào localStorage
                            localStorage.setItem('reviewSuccess', 'true');

                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    },
                    error: function(error) {
                        console.error('Có lỗi xảy ra:', error);
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            } else {
                alert('Vui lòng điền đầy đủ thông tin đánh giá.');
            }
        });

        window.addEventListener('load', function() {
            const notificationDiv = document.getElementById('notificationReview');
            if (localStorage.getItem('reviewSuccess') === 'true') {
                // Hiển thị thông báo thành công
                notificationDiv.textContent = 'Cảm ơn bạn đã đánh giá !';
                notificationDiv.style.display = 'block';

                // Tự động ẩn sau 5 giây
                setTimeout(() => {
                    notificationDiv.style.display = 'none';
                }, 1000);

                // Xóa trạng thái thông báo sau khi hiển thị
                localStorage.removeItem('reviewSuccess');
            }
        });
    </script>
@endsection
