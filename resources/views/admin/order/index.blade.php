@extends('admin.layouts.app')
{{--   --}}
@section('title', $viewData['title'])
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">{{ $viewData['title'] }} </h1>
                    </div>
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
                    <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Tất cả hóa đơn</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Nav Scroller -->
            </div>
            <!-- End Page Header -->
            @if (session('error'))
                <div class="alert alert-soft-danger" role="alert" style="display: none;" id="notificationError">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('error'))
                <script>
                    // Hiển thị thông báo
                    var notification = document.getElementById('notificationError');
                    notification.style.display = 'block';

                    // Ẩn thông báo sau 5 giây
                    setTimeout(function() {
                        notification.style.display = 'none';
                    }, 5000);
                </script>
            @endif
            @if (session('success'))
                <div class="alert alert-soft-success" role="alert" style="display: none;" id="notificationUpdate">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('success'))
                <script>
                    // Hiển thị thông báo
                    var notification = document.getElementById('notificationUpdate');
                    notification.style.display = 'block';

                    // Ẩn thông báo sau 5 giây
                    setTimeout(function() {
                        notification.style.display = 'none';
                    }, 5000);
                </script>
            @endif

            <div class="row justify-content-end mb-3">
                <div class="col-lg">
                    <!-- Datatable Info -->
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

                        {{-- <div class="col-auto">
                            <!-- Unfold -->

                            <!-- End Unfold -->

                            <!-- Unfold -->
                            <!-- End Unfold -->
                        </div> --}}
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
                                <th class="table-column-pl-0">Mã</th>
                                <th>Ngày tạo</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                {{-- <th>Trạng thái thanh toán</th> --}}
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($viewData['hoaDons']->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">Không có hóa đơn nào được tìm thấy.</td>
                                </tr>
                            @else
                                @foreach ($viewData['hoaDons'] as $hoaDon)
                                    <tr>
                                        <td class="table-column-pr-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="productsCheck{{ $hoaDon->MaHD }}">
                                                <label class="custom-control-label"
                                                    for="productsCheck{{ $hoaDon->MaHD }}"></label>
                                            </div>
                                        </td>
                                        <td class="table-column-pl-0">
                                            <a class="media align-items-center"
                                                href="{{ route('admin.order.edit', ['maHD' => $hoaDon->MaHD]) }}">
                                                <div class="media-body">
                                                    <h5 class="text-hover-primary mb-0">{{ $hoaDon->MaHD }}</h5>
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{ $hoaDon->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $hoaDon->khachHang->TenKH ?? 'Không rõ' }}</td>
                                        <td>{{ number_format($hoaDon->TongTien, 0, ',', '.') }} VNĐ</td>
                                        <td>
                                            {{ $hoaDon->phuongThucThanhToan->TenPT ?? 'Không rõ' }} -
                                            <button type="button"
                                                class="btn {{ $hoaDon->TrangThaiThanhToan == 0 ? 'btn-outline-primary' : 'btn-soft-success' }} toggleStatus{{ $hoaDon->MaHD }}"
                                                data-id="{{ $hoaDon->MaHD }}"
                                                data-status="{{ $hoaDon->TrangThaiThanhToan }}"
                                                onclick="togglePaymentStatus({{ $hoaDon->MaHD }}, {{ $hoaDon->TrangThaiThanhToan }})">
                                                {{ $hoaDon->TrangThaiThanhToan == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                            </button>
                                        </td>
                                        <td>
                                            @switch($hoaDon->TrangThai)
                                                @case(0)
                                                    <span class="badge badge-soft-warning">
                                                        <span class="legend-indicator bg-warning"></span>Chờ xử lý
                                                    </span>
                                                @break

                                                @case(1)
                                                    <span class="badge badge-soft-primary">
                                                        <span class="legend-indicator bg-primary"></span>Đang giao
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span class="badge badge-soft-success">
                                                        <span class="legend-indicator bg-success"></span>Hoàn thành
                                                    </span>
                                                @break

                                                @case(3)
                                                    <span class="badge badge-soft-danger">
                                                        <span class="legend-indicator bg-danger"></span>Đã hủy
                                                    </span>
                                                @break

                                                @default
                                                    <span class="badge badge-soft-secondary">
                                                        <span class="legend-indicator bg-secondary"></span>Không xác định
                                                    </span>
                                            @endswitch
                                        </td>
                                        <td>{{ $hoaDon->GhiChu }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('admin.order.edit', ['maHD' => $hoaDon->MaHD]) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                {{-- xóa đơn hàng --}}
                                                <a data-id="{{ $hoaDon->MaHD }}" onclick="remove({{$hoaDon->MaHD}})" class="btn btn-sm btn-danger remove" href="javascript:void(0)">
                                                    <i class="tio-add-to-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

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
        function togglePaymentStatus(maHD, currentStatus) {
            if (currentStatus == 1) {
                // Nếu trạng thái là "Đã thanh toán", không thực hiện thay đổi
                alert('Trạng thái đã là "Đã thanh toán" và không thể thay đổi!');
                return; // Ngừng thực hiện
            }

            // Lấy trạng thái thanh toán mới (0 -> 1)
            let newStatus = 1;

            $.ajax({
                url: '/admin/order/toggle-status', // Route của bạn
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token
                    maHD: maHD,
                    trangThaiThanhToan: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        // Cập nhật lại giao diện
                        let button = $('.toggleStatus' + maHD);
                        button.text('Đã thanh toán');
                        button.removeClass('btn-outline-primary');
                        button.addClass('btn-soft-success');
                        button.data('status', 1); // Cập nhật trạng thái mới cho button
                    } else {
                        alert('Có lỗi xảy ra!');
                    }
                }
            });
        }
        function remove(MaHD) {
            // Hiển thị confirm box xác nhận
            if (confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')) {
                $.ajax({
                    url: '/admin/order/remove' , 
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
                    error: function() {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            }
        }
    </script>
@endsection
