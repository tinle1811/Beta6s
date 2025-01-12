<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('assetsAdmin\css\vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsAdmin\vendor\icon-set\style.css') }}">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('assetsAdmin\css\theme.min.css?v=1.0') }}">
    <!-- CSS Category -->
    <link rel="stylesheet" href="{{asset('CssAdmin\category.css')}}">
    {{-- sử dụng biểu đồ morris thống kê --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    {{-- sử dụng icon star cho bình luận --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- css thống kê lượt mua -->
    <link rel="stylesheet" href="{{ asset('/cssAdmin/BieuDoTron.css') }}">


</head>

<body class="footer-offset">
    <script src="{{ asset('assetsAdmin\vendor\hs-navbar-vertical-aside\hs-navbar-vertical-aside-mini-cache.js') }}">
    </script>

    <!-- Builder -->
    @include('admin.layouts.builder')
    <!-- End Builder -->
    <!-- Builder Toggle -->
    @include('admin.layouts.toggle')
    <!-- End Builder Toggle -->
    <!-- JS Preview mode only -->
    @include('admin.layouts.navbar')
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')

    <script src="{{ asset('assetsAdmin\js\demo.js') }}"></script>

    <!-- END ONLY DEV -->
    @yield('content')
    @include('admin.layouts.footer')
    <!-- JS Implementing Plugins -->
    <script src="{{ asset('assetsAdmin\js\vendor.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin\vendor\chart.js\dist\Chart.min.js') }}"></script>
    <script src="{{ asset('assetsAdmin\vendor\chart.js.extensions\chartjs-extensions.js') }}"></script>
    <script src="{{ asset('assetsAdmin\vendor\chartjs-plugin-datalabels\dist\chartjs-plugin-datalabels.min.js') }}">
    </script>
    {{-- thống kê doanh thu --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- JS Front -->
    <script src="{{ asset('assetsAdmin\js\theme.min.js') }}"></script>
    <!-- JS Plugins Init. -->
    <script>
        $(document).on('ready', function() {

            //Chạy thống kê doanh thu mặc định
            //chartdaysorder();
            // ONLY DEV
            // =======================================================

            if (window.localStorage.getItem('hs-builder-popover') === null) {
                $('#builderPopover').popover('show')
                    .on('shown.bs.popover', function() {
                        $('.popover').last().addClass('popover-dark')
                    });

                $(document).on('click', '#closeBuilderPopover', function() {
                    window.localStorage.setItem('hs-builder-popover', true);
                    $('#builderPopover').popover('dispose');
                });
            } else {
                $('#builderPopover').on('show.bs.popover', function() {
                    return false
                });
            }

            // END ONLY DEV
            // =======================================================


            // BUILDER TOGGLE INVOKER
            // =======================================================
            $('.js-navbar-vertical-aside-toggle-invoker').click(function() {
                $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
            });


            // INITIALIZATION OF MEGA MENU
            // =======================================================
            var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
                desktop: {
                    position: 'left'
                }
            }).init();



            // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
            // =======================================================
            var sidebar = $('.js-navbar-vertical-aside').hsSideNav();


            // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
            // =======================================================
            $('.js-nav-tooltip-link').tooltip({
                boundary: 'window'
            })

            $(".js-nav-tooltip-link").on("show.bs.tooltip", function(e) {
                if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                    return false;
                }
            });


            // INITIALIZATION OF UNFOLD
            // =======================================================
            $('.js-hs-unfold-invoker').each(function() {
                var unfold = new HSUnfold($(this)).init();
            });


            // INITIALIZATION OF FORM SEARCH
            // =======================================================
            $('.js-form-search').each(function() {
                new HSFormSearch($(this)).init()
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });



            // INITIALIZATION OF CHARTJS
            // =======================================================
            Chart.plugins.unregister(ChartDataLabels);

            $('.js-chart').each(function() {
                $.HSCore.components.HSChartJS.init($(this));
            });

            // INITIALIZATION OF CHARTJS
            // =======================================================
            var updatingChartDatasets = [
                [
                    [18, 51, 60, 38, 88, 50, 40, 52, 88, 80, 60, 70],
                    [27, 38, 60, 77, 40, 50, 49, 29, 42, 27, 42, 50]
                ],
                [
                    [77, 40, 50, 49, 27, 38, 60, 42, 50, 29, 42, 27],
                    [60, 38, 18, 51, 88, 50, 40, 52, 60, 70, 88, 80]
                ]
            ]


            // INITIALIZATION OF CHARTJS
            // =======================================================
            var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'), {
                data: {
                    datasets: [{
                            data: updatingChartDatasets[0][0]
                        },
                        {
                            data: updatingChartDatasets[0][1]
                        }
                    ]
                }
            });

            // CALL WHEN TAB IS CLICKED
            // =======================================================
            $('[data-toggle="chart-bar"]').click(function(e) {
                let keyDataset = $(e.currentTarget).attr('data-datasets')

                if (keyDataset === 'lastWeek') {
                    updatingChart.data.labels = ["Apr 22", "Apr 23", "Apr 24", "Apr 25", "Apr 26", "Apr 27",
                        "Apr 28", "Apr 29", "Apr 30", "Apr 31"
                    ];
                    updatingChart.data.datasets = [{
                            "data": [120, 250, 300, 200, 300, 290, 350, 100, 125, 320],
                            "backgroundColor": "#377dff",
                            "hoverBackgroundColor": "#377dff",
                            "borderColor": "#377dff"
                        },
                        {
                            "data": [250, 130, 322, 144, 129, 300, 260, 120, 260, 245, 110],
                            "backgroundColor": "#e7eaf3",
                            "borderColor": "#e7eaf3"
                        }
                    ];
                    updatingChart.update();
                } else {
                    updatingChart.data.labels = ["May 1", "May 2", "May 3", "May 4", "May 5", "May 6",
                        "May 7", "May 8", "May 9", "May 10"
                    ];
                    updatingChart.data.datasets = [{
                            "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220],
                            "backgroundColor": "#377dff",
                            "hoverBackgroundColor": "#377dff",
                            "borderColor": "#377dff"
                        },
                        {
                            "data": [150, 230, 382, 204, 169, 290, 300, 100, 300, 225, 120],
                            "backgroundColor": "#e7eaf3",
                            "borderColor": "#e7eaf3"
                        }
                    ]
                    updatingChart.update();
                }
            })


            // INITIALIZATION OF BUBBLE CHARTJS WITH DATALABELS PLUGIN
            // =======================================================
            $('.js-chart-datalabels').each(function() {
                $.HSCore.components.HSChartJS.init($(this), {
                    plugins: [ChartDataLabels],
                    options: {
                        plugins: {
                            datalabels: {
                                anchor: function(context) {
                                    var value = context.dataset.data[context.dataIndex];
                                    return value.r < 20 ? 'end' : 'center';
                                },
                                align: function(context) {
                                    var value = context.dataset.data[context.dataIndex];
                                    return value.r < 20 ? 'end' : 'center';
                                },
                                color: function(context) {
                                    var value = context.dataset.data[context.dataIndex];
                                    return value.r < 20 ? context.dataset.backgroundColor :
                                        context.dataset.color;
                                },
                                font: function(context) {
                                    var value = context.dataset.data[context.dataIndex],
                                        fontSize = 25;

                                    if (value.r > 50) {
                                        fontSize = 35;
                                    }

                                    if (value.r > 70) {
                                        fontSize = 55;
                                    }

                                    return {
                                        weight: 'lighter',
                                        size: fontSize
                                    };
                                },
                                offset: 2,
                                padding: 0
                            }
                        }
                    },
                });
            });


            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            //Bảng custom ngày
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            //Bảng chọn selector
            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format(
                    'MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            // Gửi dữ liệu qua AJAX khi chọn ngày
            $('#js-daterangepicker-predefined').on('apply.daterangepicker', function(ev, picker) {
                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');
                // Lấy token CSRF để bảo mật yêu cầu
                var token = $('meta[name="csrf-token"]').attr('content');
                // Gửi AJAX request tới controller
                // Gửi yêu cầu Ajax
                $.ajax({
                    url: "{{ url('/admin/date') }}", // Đảm bảo URL đúng
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        _token: token, // Token CSRF
                        startDate: startDate, // Ngày bắt đầu
                        endDate: endDate // Ngày kết thúc
                    },
                    success: function(data) {
                        if (data.length === 0) {
                            $('#ThongKeRong').text('Không có dữ liệu thống kê.').show();
                            // Gọi hàm để vẽ dữ liệu vào biểu đồ hoặc hiển thị dữ liệu
                            $('#chart').hide();
                        } else {
                            $('#ThongKeRong').hide();
                            $('#chart').show();
                            chart.setData(data);
                        }
                        // Lưu trữ dữ liệu vào biến toàn cục
                        window.data = data;  // Biến toàn cục chứa dữ liệu data

                        // Phát ra sự kiện để thông báo cho các file JS khác biết rằng dữ liệu đã sẵn sàng
                        $(document).trigger('dataLoaded', [window.data]);  // Phát sự kiện 'dataLoaded'
                    },
                    error: function(xhr, status, error) {
                        alert('Đã xảy ra lỗi: ' + error);
                    }
                });
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3" src="./assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                        '<p class="mb-0">No data to show</p>' +
                        '</div>'
                }
            });

            $('.js-datatable-filter').on('change', function() {
                var $this = $(this),
                    elVal = $this.val(),
                    targetColumnIndex = $this.data('target-column-index');

                datatable.column(targetColumnIndex).search(elVal).draw();
            });

            $('#datatableSearch').on('mouseup', function(e) {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function() {
                    var newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
            });


            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function() {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });
        });



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

        function getWeekDates(type) {
            const currentDate = new Date();
            let startOfWeek, endOfWeek;

            if (type === 'thisWeek') {
                const dayOfWeek = currentDate.getDay();
                const diffToMonday = (dayOfWeek === 0 ? 6 : dayOfWeek - 1);
                startOfWeek = new Date(currentDate);
                startOfWeek.setDate(currentDate.getDate() - diffToMonday);
                endOfWeek = new Date(startOfWeek);
                endOfWeek.setDate(startOfWeek.getDate() + 6);
            }

            if (type === 'lastWeek') {
                startOfWeek = new Date(currentDate);
                startOfWeek.setDate(currentDate.getDate() - currentDate.getDay() - 7);
                endOfWeek = new Date(startOfWeek);
                endOfWeek.setDate(startOfWeek.getDate() + 6);
            }

            return {
                startOfWeek: startOfWeek.toISOString().split('T')[0],
                endOfWeek: endOfWeek.toISOString().split('T')[0]
            };
        }

        $('#thisWeek').click(function() {
            // Lấy giá trị từ hàm getWeekDates cho tuần này
            var weekDates = getWeekDates('thisWeek');
            var from_date = weekDates.startOfWeek;
            var to_date = weekDates.endOfWeek;

            // Kiểm tra xem các trường ngày có được nhập hay không
            if (!from_date || !to_date) {
                alert('Vui lòng chọn cả ngày bắt đầu và kết thúc.');
                return;
            }

            // Lấy token CSRF để bảo mật yêu cầu
            var token = $('meta[name="csrf-token"]').attr('content');

            // Gửi yêu cầu Ajax
            $.ajax({
                url: "{{ url('/admin/date') }}", // Đảm bảo URL đúng
                method: "POST",
                dataType: "JSON",
                data: {
                    _token: token, // Token CSRF
                    startDate: from_date, // Ngày bắt đầu
                    endDate: to_date // Ngày kết thúc
                },
                success: function(data) {
                    if (data.length === 0) {
                        $('#ThongKeRong').text('Không có dữ liệu thống kê.').show();
                        // Gọi hàm để vẽ dữ liệu vào biểu đồ hoặc hiển thị dữ liệu
                        $('#chart').hide();
                    } else {
                        $('#ThongKeRong').hide();
                        $('#chart').show();
                        chart.setData(data);
                    }
                    // Gọi hàm để vẽ dữ liệu vào biểu đồ hoặc hiển thị dữ liệu
                    chart.setData(data);
                },
                error: function(xhr, status, error) {
                    alert('Đã xảy ra lỗi: ' + error);
                }
            });
        });
        $('#lastWeek').click(function() {
            // Lấy giá trị từ hàm getWeekDates cho tuần này
            var weekDates = getWeekDates('lastWeek');
            var from_date = weekDates.startOfWeek;
            var to_date = weekDates.endOfWeek;

            // Kiểm tra xem các trường ngày có được nhập hay không
            if (!from_date || !to_date) {
                alert('Vui lòng chọn cả ngày bắt đầu và kết thúc.');
                return;
            }
            // Lấy token CSRF để bảo mật yêu cầu
            var token = $('meta[name="csrf-token"]').attr('content');

            // Gửi yêu cầu Ajax
            $.ajax({
                url: "{{ url('/admin/date') }}", // Đảm bảo URL đúng
                method: "POST",
                dataType: "JSON",
                data: {
                    _token: token, // Token CSRF
                    startDate: from_date, // Ngày bắt đầu
                    endDate: to_date // Ngày kết thúc
                },
                success: function(data) {
                    if (data.length === 0) {
                        $('#ThongKeRong').text('Không có dữ liệu thống kê.').show();
                        // Gọi hàm để vẽ dữ liệu vào biểu đồ hoặc hiển thị dữ liệu
                        $('#chart').hide();
                    } else {
                        $('#ThongKeRong').hide();
                        $('#chart').show();
                        chart.setData(data);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Đã xảy ra lỗi: ' + error);
                }
            });
        });
    </script>
    @yield('jsThongKe')

    <!-- Thong Ke doanh thu -->

    <!-- IE Support -->
    <script>
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write(
            '<script src="./assetsAdmin/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>

    <!-- Thống Kê Lượt Mua -->
    <script src="{{ asset('/jsAdmin/BieuDoTron.js') }}"></script>

</body>

</html>
