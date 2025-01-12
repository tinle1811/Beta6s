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
                        <a class="nav-link active" href="#"><i class="bi bi-person"></i><span class="text">Tài khoản
                                của tôi</span></a>
                    </li>
                    <li class="nav-item sub">
                        <a class="nav-link" href="#"> <span class="text">Hồ sơ</span></a>
                    </li>
                    <li class="nav-item sub">
                        <a class="nav-link" href="#"><span class="text">Địa chỉ</span></a>
                    </li>
                    <li class="nav-item sub">
                        <a class="nav-link" href="#"><span class="text">Đổi mật khẩu</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-cart"></i><span class="text">Đơn mua</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 profile-content">
                <ul class="d-flex justify-content-between align-items-center list-unstyled bg-black py-3 px-4 fs-6">
                    <li><a href="#" class="text-white text-decoration-none">Tất cả</a></li>
                </ul>
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="notificationReview"
                    style="display: none;">
                    Đã đánh giá đơn hàng xong!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @if ($hoaDons->isEmpty())
                    <p>Không có hóa đơn nào.</p>
                @else
                    <div class="container mt-4">
                        <!-- Danh sách sản phẩm -->
                        <div class="p-3 bg-light mb-3 border rounded">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Ngày</th>
                                        <th>Chi tiết</th>
                                        <th>Tổng</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hoaDons as $hoaDon)
                                        <tr>
                                            <td>{{ $hoaDon->MaHD }}</td>
                                            <td>{{ $hoaDon->created_at->format('d/m/Y H:i') }}</td>

                                            <td>
                                                <ul>
                                                    @foreach ($hoaDon->chiTietHoaDons as $chiTiet)
                                                        <li>
                                                            {{ $chiTiet->sanPham->TenSP ?? 'Sản phẩm không tồn tại' }} - SL:
                                                            {{ $chiTiet->SoLuong }} <br>
                                                        </li>
                                                        <hr>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ number_format($hoaDon->TongTien, 2) }} VNĐ</td>
                                            <td>
                                                @php
                                                    $trangThai = [
                                                        0 => 'Chờ xử lý',
                                                        1 => 'Đang giao hàng',
                                                        2 => 'Hoàn thành',
                                                        3 => 'Đã hủy',
                                                    ];
                                                @endphp
                                                {{ $trangThai[$hoaDon->TrangThai] ?? 'Không xác định' }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="#" class="btn btn-primary me-2">
                                                        <i class="bi bi-eye"></i> <!-- Icon xem chi tiết -->
                                                    </a>
                                                    @if ($hoaDon->TrangThai == 0)
                                                        <!-- Nút hủy đơn khi trạng thái là "Chờ xử lý" -->
                                                        <form action="#" method="POST"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn?')">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="button" class="btn btn-danger me-2">
                                                                <i class="bi bi-x-circle"></i> <!-- Icon hủy -->
                                                            </button>
                                                        </form>
                                                    @elseif ($hoaDon->TrangThai == 2)
                                                        <!-- Kiểm tra số lượng chi tiết hóa đơn và số lượng bình luận -->
                                                        @php
                                                            // Đếm số lượng chi tiết hóa đơn và số lượng bình luận
                                                            $chiTietHoaDonCount = $hoaDon->chiTietHoaDons->count();
                                                            $binhLuanCount = $hoaDon->binhLuans->count();
                                                        @endphp

                                                        <!-- Nếu số lượng chi tiết hóa đơn lớn hơn số lượng bình luận, hiển thị nút đánh giá -->
                                                        @if ($chiTietHoaDonCount > $binhLuanCount)
                                                            <!-- Nút đánh giá, khi nhấn sẽ hiển thị modal -->
                                                            <!-- Nút đánh giá, khi nhấn sẽ hiển thị modal -->
                                                            <a href="#" class="btn btn-info me-2"
                                                                data-bs-toggle="modal" data-bs-target="#ratingModal"
                                                                data-mahd="{{ $hoaDon->MaHD }}"
                                                                data-chiTietHoaDons="{{ json_encode($hoaDon->chiTietHoaDons->toArray()) }}"
                                                                onclick="openRatingModal(this)">
                                                                <i class="bi bi-star"></i> <!-- Icon đánh giá -->
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- div đánh giá --}}
    <!-- Modal -->
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

    <script>
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
