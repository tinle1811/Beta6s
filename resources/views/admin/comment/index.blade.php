@extends('admin.layouts.app')
{{--   --}}
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">{{ $viewData['title'] }} <span
                                class="badge badge-soft-dark ml-2"></span></h1>

                        <div class="mt-2">
                            <a class="text-body mr-3" href="javascript:;" data-toggle="modal"
                                data-target="#exportProductsModal">
                                {{-- <i class="tio-download-to mr-1"></i> Export --}}
                            </a>
                            <a class="text-body" href="javascript:;" data-toggle="modal" data-target="#importProductsModal">
                                {{-- <i class="tio-publish mr-1"></i> Import --}}
                            </a>
                        </div>
                    </div>

                    {{-- <div class="col-sm-auto">
            <a class="btn btn-primary" href="ecommerce-add-product.html">Add</a>
          </div> --}}
                </div>
                <!-- End Row -->

                <!-- Nav Scroller -->
                <div class="js-nav-scroller hs-nav-scroller-horizontal">
                    <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                            <i class="tio-chevron-left"></i>
                        </a>
                    </span>

                    <span class="hs-nav-scroller-arrow-next" style="display: none;">
                        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                            <i class="tio-chevron-right"></i>
                        </a>
                    </span>

                    <!-- Nav -->
                    <div class="text-left">
                        <ul class="nav nav-segment nav-pills mb-7" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="nav-one-eg1-tab" data-toggle="pill" href="#nav-one-eg1"
                                    role="tab" aria-controls="nav-one-eg1" aria-selected="true">Tất cả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-two-eg1-tab" data-toggle="pill" href="#nav-two-eg1"
                                    role="tab" aria-controls="nav-two-eg1" aria-selected="false">Chưa duyệt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-three-eg1-tab" data-toggle="pill" href="#nav-three-eg1"
                                    role="tab" aria-controls="nav-three-eg1" aria-selected="false">Đã duyệt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-four-eg1-tab" data-toggle="pill" href="#nav-four-eg1"
                                    role="tab" aria-controls="nav-four-eg1" aria-selected="false">Đã xóa</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Nav -->
                    <!-- Nav -->
                    <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="route{{ 'admin.comment' }}">Tất cả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Chưa duyệt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Đã duyệt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Đã xóa</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Nav Scroller -->
            </div>
            <!-- End Page Header -->

            <div class="row justify-content-end mb-3">
                <div class="col-lg">
                    <!-- Datatable Info : hiện các lựa chọn khi check vào checkbox -->
                    <div id="datatableCounterInfo" style="display: none;">
                        <div class="d-sm-flex justify-content-lg-end align-items-sm-center">
                            <span class="d-block d-sm-inline-block font-size-sm mr-3 mb-2 mb-sm-0">
                                <span id="datatableCounter">0</span>
                                Selected
                            </span>
                            <a class="btn btn-sm btn-outline-danger mb-2 mb-sm-0 mr-2" href="javascript:;">
                                <i class="tio-delete-outlined"></i> Delete
                            </a>
                            <a class="btn btn-sm btn-white mb-2 mb-sm-0 mr-2" href="javascript:;">
                                <i class="tio-archive"></i> Archive
                            </a>
                            <a class="btn btn-sm btn-white mb-2 mb-sm-0 mr-2" href="javascript:;">
                                <i class="tio-publish"></i> Publish
                            </a>
                            <a class="btn btn-sm btn-white mb-2 mb-sm-0" href="javascript:;">
                                <i class="tio-clear"></i> Unpublish
                            </a>
                        </div>
                    </div>
                    <!-- End Datatable Info -->
                </div>
            </div>
            <!-- End Row -->
            <div class="alert alert-soft-success" role="alert" style="display: none;" id="notificationDeleteComment">
            </div>




            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control"
                                        placeholder="Search users" aria-label="Search users">
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>


                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                  "columnDefs": [{
                      "targets": [0, 4, 9],
                      "width": "5%",
                      "orderable": false
                    }],
                  "order": [],
                  "info": {
                    "totalQty": "#datatableWithPaginationInfoTotalQty"
                  },
                  "search": "#datatableSearch",
                  "entries": "#datatableEntries",
                  "pageLength": 12,
                  "isResponsive": false,
                  "isShowPaging": false,
                  "pagination": "datatablePagination"
                }'>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="table-column-pr-0">
                                    <div class="custom-control custom-checkbox">
                                        <input id="datatableCheckAll" type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-pl-0">Bình luận</th>
                                <th>Khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Đánh giá</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                                <th>Ngày bình luận</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($viewData['comments'] as $comment)
                                <tr>
                                    {{-- cột 0: check --}}
                                    <td class="table-column-pr-0">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productsCheck1">
                                            <label class="custom-control-label" for="productsCheck1"></label>
                                        </div>
                                    </td>
                                    {{-- cột 1: mã bình luận --}}
                                    <td class="table-column-pl-0">
                                        <a class="media align-items-center" href="ecommerce-product-details.html">
                                            {{-- <img class="avatar avatar-lg mr-3" src="assets\img\400x400\img4.jpg" alt="Image Description"> --}}
                                            <div class="media-body">
                                                <h5 class="text-hover-primary mb-0">{{ $comment->MaBL }}</h5>
                                            </div>
                                        </a>
                                    </td>
                                    {{-- cột 2: khách hàng --}}
                                    <td>{{ $comment->khachHang->TenKH }}</td>

                                    {{-- cột 3: sản phẩm --}}
                                    <td style="word-wrap: break-word; white-space: normal;">
                                        {{ $comment->sanPham->TenSP }}
                                    </td>

                                    {{-- cột 4: đánh giá --}}
                                    <td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $comment->DanhGia)
                                                <i class="fas fa-star text-warning"></i> <!-- Ngôi sao vàng -->
                                            @else
                                                <i class="far fa-star text-muted"></i> <!-- Ngôi sao xám -->
                                            @endif
                                        @endfor
                                    </td>


                                    {{-- cột 5: nội dung --}}
                                    <td style="word-wrap: break-word; white-space: normal;">
                                        {{ $comment->NoiDung }}
                                    </td>

                                    {{-- cột 6: trang thái --}}
                                    <td>
                                        <button type="submit"
                                            class="btn {{ $comment->TrangThai == 1 ? 'btn-soft-primary' : 'btn-outline-warning' }} toggleStatus{{ $comment->MaBL }}"
                                            data-id="{{ $comment->MaBL }}" data-status="{{ $comment->TrangThai }}"
                                            onclick="toggleCommentStatus({{ $comment->MaBL }}, {{ $comment->TrangThai }})">
                                            {{ $comment->TrangThai == 1 ? 'Đã duyệt' : 'Chưa duyệt' }}
                                        </button>
                                    </td>

                                    {{-- cột 7: ngày bình luận --}}
                                    <td>{{ $comment->created_at }}</td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-danger"
                                                data-id="{{ $comment->MaBL }}"
                                                onclick="deleteComment({{ $comment->MaBL }})">
                                                <i class="tio-add-to-trash"></i> Xóa
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
                <!-- Tab Content : làm phần chia ra chưa duyệt, đã duyệt, đã xóa-->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel"
                        aria-labelledby="nav-one-eg1-tab">
                        <p>First tab content...</p>
                    </div>

                    <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
                        <p>Second tab content...</p>
                    </div>

                    <div class="tab-pane fade" id="nav-three-eg1" role="tabpanel" aria-labelledby="nav-three-eg1-tab">
                        <p>Third tab content...</p>
                    </div>

                    <div class="tab-pane fade" id="nav-four-eg1" role="tabpanel" aria-labelledby="nav-four-eg1-tab">
                        <p>Four tab content...</p>
                    </div>
                </div>
                <!-- End Tab Content -->

                <!-- Footer -->
                <div class="card-footer">
                    <!-- Pagination -->
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                <span class="mr-2">Showing:</span>

                                <!-- Select -->
                                <select id="datatableEntries" class="js-select2-custom"
                                    data-hs-select2-options='{
                          "minimumResultsForSearch": "Infinity",
                          "customClass": "custom-select custom-select-sm custom-select-borderless",
                          "dropdownAutoWidth": true,
                          "width": true
                        }'>
                                    <option value="12" selected="">12</option>
                                    <option value="14">14</option>
                                    <option value="16">16</option>
                                    <option value="18">18</option>
                                </select>
                                <!-- End Select -->

                                <span class="text-secondary mr-2">of</span>

                                <!-- Pagination Quantity -->
                                <span id="datatableWithPaginationInfoTotalQty"></span>
                            </div>
                        </div>

                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                            </div>
                        </div>
                    </div>
                    <!-- End Pagination -->
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->


    </main>
    <script>
        // Hàm thay đổi trạng thái
        function toggleCommentStatus(commentId, currentStatus) {
            var newStatus = currentStatus == 1 ? 0 : 1; // Thay đổi trạng thái
            alert('Đang thay đổi trạng thái của bình luận ' + commentId);

            //Gửi AJAX request
            $.ajax({
                url: '/admin/comment/update', // URL xử lý AJAX
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Đảm bảo token CSRF được gửi
                    id: commentId,
                    status: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        // // Cập nhật trạng thái trên giao diện
                        // $('button.toggleStatus' + commentId).text(newStatus == 1 ? 'Đã duyệt' :
                        // 'Chưa duyệt'); // Cập nhật văn bản của nút
                        // $('button.toggleStatus' + commentId).data('status',
                        // newStatus); // Cập nhật trạng thái mới
                        alert('Cập nhật thành công');
                        var button = document.querySelector('.toggleStatus' + commentId);
                        button.innerText = newStatus == 1 ? 'Đã duyệt' : 'Chưa duyệt';
                        button.setAttribute('data-status', newStatus);

                        if (newStatus == 1) {
                            button.classList.remove('btn-outline-warning');
                            button.classList.add('btn-soft-primary');
                        } else {
                            button.classList.remove('btn-soft-primary');
                            button.classList.add('btn-outline-warning');
                        }

                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        }

        function deleteComment(commentId) {
            if (confirm('Bạn có chắc chắn muốn xóa bình luận này không?')) {
                $.ajax({
                    url: '/admin/comment/delete', // URL xử lý
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Token CSRF
                        id: commentId
                    },
                    success: function(response) {
                        if (response.success) {

                            // Hiển thị thông báo
                            const notificationDiv = document.getElementById('notificationDeleteComment');
                            notificationDiv.textContent = 'Bình luận đã được xóa thành công!';
                            notificationDiv.style.display = 'block';

                            // Tự động ẩn sau 5 giây
                            setTimeout(() => {
                                notificationDiv.style.display = 'none';
                            }, 5000);

                            // Xóa bình luận khỏi giao diện
                            document.querySelector(`button[data-id='${commentId}']`).closest('tr').remove();
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    },
                    error: function() {
                        alert('Không thể gửi yêu cầu. Vui lòng kiểm tra lại.');
                    }
                });
            }
        }
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('.toggleStatus{{ $comment->MaBL }}').click(function() {
                var commentId = $(this).data('id');
                var currentStatus = $(this).data('status');
                var newStatus = currentStatus == 1 ? 0 : 1; // Thay đổi trạng thái
                alert(newStatus);

                Gửi AJAX request
                $.ajax({
                    url: '/admin/comment/update', // URL xử lý AJAX
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Đảm bảo token CSRF được gửi
                        id: commentId,
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật trạng thái trên giao diện
                            $('#toggleStatus').text(newStatus == 1 ? 'Đã duyệt' : 'Chưa duyệt');
                            $('#toggleStatus').data('status',
                            newStatus); // Cập nhật trạng thái mới
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    }.bind(this)
                });
            });
        });
    </script> --}}
@endsection
