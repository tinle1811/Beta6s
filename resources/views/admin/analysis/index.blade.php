@extends('admin.layouts.app')
@section('title', $viewData['title'])
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="bg-dark">
            <div class="content container-fluid" style="height: 25rem;">
                <!-- Page Header -->
                <div class="page-header page-header-light">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="page-header-title">Dashboard</h1>
                        </div>

                        <div class="col-auto">
                            <!-- Daterangepicker -->
                            <button id="js-daterangepicker-predefined" class="btn btn-sm btn-ghost-light dropdown-toggle">
                                <i class="tio-date-range"></i>
                                <span class="js-daterangepicker-predefined-preview ml-1"></span>
                            </button>
                            <!-- End Daterangepicker -->
                        </div>
                    </div>
                    <!-- End Row -->

                    <!-- Nav Scroller -->
                    <div class="js-nav-scroller hs-nav-scroller-horizontal">
                        <span class="hs-nav-scroller-arrow-prev hs-nav-scroller-arrow-dark-prev" style="display: none;">
                            <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                                <i class="tio-chevron-left"></i>
                            </a>
                        </span>

                        <span class="hs-nav-scroller-arrow-next hs-nav-scroller-arrow-dark-next" style="display: none;">
                            <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                                <i class="tio-chevron-right"></i>
                            </a>
                        </span>

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-tabs-light page-header-tabs" id="pageHeaderTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript:;">Thống kê</a>
                            </li>

                        </ul>


                        <!-- End Nav -->
                    </div>
                    <!-- End Nav Scroller -->
                </div>
                <!-- End Page Header -->
            </div>
        </div>
        <!-- End Content -->

        <!-- Content -->
        <div class="content container-fluid" style="margin-top: -17rem;">
            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                    <h4 class="card-header-title">Thống kê doanh thu</h4>

                    <!-- Nav -->
                    <ul class="nav nav-segment nav-fill" id="projectsTab" role="tablist">
                        {{-- <li class="nav-item" data-toggle="chart" data-datasets="0" data-trigger="click"
                            data-action="toggle">
                            <a class="nav-link active" href="javascript:;" data-toggle="tab" id="thisWeek"
                                onclick="loadData('thisWeek')">Tuần này</a>
                        </li>
                        <li class="nav-item" data-toggle="chart" data-datasets="1" data-trigger="click"
                            data-action="toggle">
                            <a class="nav-link" href="javascript:;" data-toggle="tab" id="lastWeek"
                                onclick="loadData('lastWeek')">Tuần
                                trước</a>
                        </li> --}}
                        <li class="nav-item" data-toggle="chart" data-datasets="0" data-trigger="click"
                            data-action="toggle">
                            <a class="nav-link" href="javascript:;" data-toggle="tab" id="thisWeek">Tuần này</a>
                        </li>
                        <li class="nav-item" data-toggle="chart" data-datasets="1" data-trigger="click"
                            data-action="toggle">
                            <a class="nav-link" href="javascript:;" data-toggle="tab" id="lastWeek">Tuần
                                trước</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;" data-toggle="tab" id="resetData"><i
                                    class="tio-update"></i></a>
                        </li>

                    </ul>

                    <!-- Content to display the data -->
                    {{-- <div id="dataContainer"></div> --}}
                    <!-- End Nav -->
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body">
                    <div class="row align-items-sm-center mb-4">
                        <div class="col-sm mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <span class="h1 mb-0"></span>

                                <span class="text-success ml-2">
                                    <i class="tio-trending-up"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-auto">
                            <!-- Legend Indicators -->
                            <div class="row font-size-sm">
                                <div class="col-auto">
                                    <span class="legend-indicator" style="background-color: #ff69b4;"></span> Doanh thu
                                </div>
                                <div class="col-auto">
                                    <span class="legend-indicator" style="background-color: #800080;"></span> Lợi nhuận
                                </div>
                            </div>
                            <!-- End Legend Indicators -->
                        </div>
                    </div>
                    <!-- End Row -->

                    <!-- Bar Chart -->
                    {{-- <div class="chartjs-custom" style="height: 18rem;">
                        <canvas id="updatingData"
                            data-hs-chartjs-options='{
                      "type": "line",
                      "data": {
                         "labels": ["Feb","Jan","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                         "datasets": [{
                          "backgroundColor": ["rgba(55, 125, 255, .5)", "rgba(255, 255, 255, .2)"],
                          "borderColor": "#377dff",
                          "borderWidth": 2,
                          "pointRadius": 0,
                          "hoverBorderColor": "#377dff",
                          "pointBackgroundColor": "#377dff",
                          "pointBorderColor": "#fff",
                          "pointHoverRadius": 0
                        },
                        {
                          "backgroundColor": ["rgba(0, 201, 219, .5)", "rgba(255, 255, 255, .2)"],
                          "borderColor": "#00c9db",
                          "borderWidth": 2,
                          "pointRadius": 0,
                          "hoverBorderColor": "#00c9db",
                          "pointBackgroundColor": "#00c9db",
                          "pointBorderColor": "#fff",
                          "pointHoverRadius": 0
                        }]
                      },
                      "options": {
                        "gradientPosition": {"y1": 200},
                         "scales": {
                            "yAxes": [{
                              "gridLines": {
                                "color": "#e7eaf3",
                                "drawBorder": false,
                                "zeroLineColor": "#e7eaf3"
                              },
                              "ticks": {
                                "min": 0,
                                "max": 100,
                                "stepSize": 20,
                                "fontColor": "#97a4af",
                                "fontFamily": "Open Sans, sans-serif",
                                "padding": 10,
                                "postfix": "k"
                              }
                            }],
                            "xAxes": [{
                              "gridLines": {
                                "display": false,
                                "drawBorder": false
                              },
                              "ticks": {
                                "fontSize": 12,
                                "fontColor": "#97a4af",
                                "fontFamily": "Open Sans, sans-serif",
                                "padding": 5
                              }
                            }]
                        },
                        "tooltips": {
                          "prefix": "$",
                          "postfix": "k",
                          "hasIndicator": true,
                          "mode": "index",
                          "intersect": false,
                          "lineMode": true,
                          "lineWithLineColor": "rgba(19, 33, 68, 0.075)"
                        },
                        "hover": {
                          "mode": "nearest",
                          "intersect": true
                        }
                      }
                    }'>
                        </canvas>
                    </div> --}}
                    <div class="alert alert-soft-dark" role="alert" style="display:none;" id="ThongKeRong">
                    </div>

                    <div id="chart" style="height: 250px;">
                    </div>
                    <!-- End Bar Chart -->
                </div>
                <!-- End Body -->

                <!-- Table -->
                <!-- End Table -->

                <!-- Card Footer -->
                <!-- End Card Footer -->
            </div>
            <!-- End Card -->


        </div>
        <!-- End Content -->

        <div class="content container-fluid ">
            <div class="card mb-3 mb-lg-5 shadow-soft p-3 mb-5 bg-white rounded">
                <div class="card-header border border-dark ">
                    <h1>Thống kê tổng</h1>

                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a href="{{ route('admin.analysis.export') }}" class="btn btn-primary">
                                <i class="tio-download-to mr-1"></i> Export
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Table -->
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center;">STT</th>
                            <th scope="col" style="text-align: center;">Ngày thống kê</th>
                            <th scope="col" style="text-align: center;">Doanh Thu</th>
                            <th scope="col" style="text-align: center;">Lợi Nhuận</th>
                            <th scope="col" style="text-align: center;">Số lượng bán</th>
                            <th scope="col" style="text-align: center;">Tổng Đơn Hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewData['thongKes'] as $thongKe)
                            <tr>
                                <td scope="row" style="text-align: center;">{{ $thongKe->id }}</td>
                                <td style="text-align: center;">{{ $thongKe->order_date }}</td>
                                <td style="text-align: center;">{{ $thongKe->sales }}</td>
                                <td style="text-align: center;">{{ $thongKe->profit }}</td>
                                <td style="text-align: center;">{{ $thongKe->quantity }}</td>
                                <td style="text-align: center;">{{ $thongKe->total_order }}</td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
        <!-- Content -->
        <div class="purchase-statistics">
            <style>
                #text-muted {
                    font-size: 1.2rem;
                    font-weight: 700;
                    color: green;
                    margin-top: 20px;
                    text-align: center;
                }
            </style>
            <div class="content-pie-chart">
                <h4 style="margin-left: 20px; margin-top: 30px;">Thống kê lượt mua</h4>
                <div class="d-flex justify-content-end mb-3" style="border-top: solid 1px silver; position: relative;">
                    <h6
                        style="position: absolute; top: 7.5px; left: 30px; padding: 5px 5px; box-shadow: 0 3px 6px silver; border-radius: 5px">
                        <b>Tổng lượt mua: </b><span style="color: red"
                            id="TLM">{{ $viewData['PieChartData']['TongLuotMua_ALLSP'] }}</span>
                    </h6>
                    <!-- Nav -->
                    <ul class="nav nav-segment" id="expensesTab" role="tablist">
                        <li class="nav-item" data-toggle="chart-doughnut" data-datasets="0" data-trigger="click"
                            data-action="toggle">
                            <a class="nav-link active" href="javascript:;" data-toggle="tab">Tuần này</a>
                        </li>
                        <li class="nav-item" data-toggle="chart-doughnut" data-datasets="1" data-trigger="click"
                            data-action="toggle">
                            <a class="nav-link" href="javascript:;" data-toggle="tab">Tuần trước</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>

                <!-- Pie Chart -->
                <div class="chartjs-custom mb-3 mb-sm-5" style="height: 14rem;">
                    <canvas id="updatingDoughnutChart"
                        data-hs-chartjs-options='{
                "type": "doughnut",
                "data": {
                "labels": ["sản phẩm nổi bật", "sản phẩm bán chạy", "sản phẩm mới"],
                "datasets": [{
                    "backgroundColor": ["#377dff", "#00c9db", "#e7eaf3"],
                    "borderWidth": 5,
                    "hoverBorderColor": "#fff"
                }]
                },
                "options": {
                "cutoutPercentage": 80,
                "tooltips": {
                    "postfix": "%",
                    "hasIndicator": true,
                    "mode": "index",
                    "intersect": false
                },
                "hover": {
                    "mode": "nearest",
                    "intersect": true
                }
                }
            }'></canvas>
                </div>
                <!-- End Pie Chart -->

                <!-- Legend Indicators -->
                <div class="row justify-content-center">
                    <div class="col-auto mb-3 mb-sm-0">
                        <span class="card-title h4" id="SPNB">{{ $viewData['PieChartData']['TongLuotMua_SPNB'] }} lượt mua</span>
                        <span class="legend-indicator bg-primary"></span> sản phẩm nổi bật
                    </div>

                    <div class="col-auto mb-3 mb-sm-0">
                        <span class="card-title h4" id="SPBC">{{ $viewData['PieChartData']['TongLuotMua_SPBC'] }} lượt mua</span>
                        <span class="legend-indicator bg-info"></span> sản phẩm bán chạy
                    </div>

                    <div class="col-auto">
                        <span class="card-title h4" id="SPM">{{ $viewData['PieChartData']['TongLuotMua_SPM'] }} lượt mua</span>
                        <span class="legend-indicator"></span> sản phẩm mới
                    </div>
                </div>
                <!-- End Legend Indicators -->
            </div>
        </div>
        <!-- End Content -->

        <!-- Footer -->

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



        <!-- End Footer -->
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var banChay = {{ $viewData['PieChartData']['totalPurchases_spbc'] }};
        var noiBat = {{ $viewData['PieChartData']['totalPurchases_spnb'] }};
        var moi = {{ $viewData['PieChartData']['totalPurchases_spm'] }};
    </script>
@endsection
@section('jsThongKe')
    <script>
        //THONG KE DOANH THU
        var chart = new Morris.Bar({
            element: 'chart',
            //Line
            barColors: ['#ff69b4', '#800080'],
            pointFillColors: ['#ffffff'],
            pointStrokeColors: ['black'],
            fillopacity: 0.6,
            hideHover: 'auto',
            parseTime: false,

            xkey: 'period',
            ykeys: ['sales', 'profit'],

            behavelikeLine: true,
            labels: ['doanh thu', 'lợi nhuận']
        });


        // Hàm thống kê tổng hết
        var thongKesData = @json($viewData['thongKes']);

        function chartdaysorder() {
            var chartData = thongKesData.map(function(item) {
                return {
                    period: item.order_date, // Giả sử 'created_at' là ngày thống kê
                    sales: item.sales, // Giá trị doanh thu
                    profit: item.profit // Giá trị lợi nhuận
                };
            });

            if (chartData.length === 0) {
                $('#ThongKeRong').text('Không có dữ liệu thống kê.').show();
                // Gọi hàm để vẽ dữ liệu vào biểu đồ hoặc hiển thị dữ liệu
                return;
            } else {
                $('#ThongKeRong').hide();
                $('#chart').show();
                chart.setData(chartData); // Cập nhật dữ liệu cho chart
            }


        }

        $('#resetData').click(function() {
            chartdaysorder();
        });
        $(document).ready(function() {

            //Chạy thống kê doanh thu mặc định
            chartdaysorder();
        });
    </script>
@endsection
