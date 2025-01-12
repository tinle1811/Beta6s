<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    {{-- <script src="resources/js/app.js'" defer></script> --}}

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        // Enable Pusher logging for debugging (only in development)
        Pusher.logToConsole = true;
        // Khởi tạo Pusher
        var pusher = new Pusher('709ad459a0af52dd0be9', {
            cluster: 'ap1'
        });

        // Đăng ký kênh 'san-pham'
        var channel = pusher.subscribe('san-pham');

        // Lắng nghe sự kiện 'SanPhamUpdated'
        channel.bind('sanpham.updated', function(data) {

            console.log('Received data:', data);
            if (data) {

                document.getElementById('eventID').innerHTML = `<strong>Mã sản phẩm:</strong> ${data.MaSP}`;
                document.getElementById('eventSoLuotYeuThich').innerHTML =
                    `<strong><i class="fa-regular fa-thumbs-up"></i></strong> ${data.SoLuotYeuThich}`;
                document.getElementById('eventSoLuotXem').innerHTML =
                    `<strong><i class="fa-solid fa-eye"></i></strong> ${data.SoLuotXem}`;
                document.getElementById('eventRatingRealTime').innerHTML =
                    `<strong>${data.DiemRatingTB} <i class="fa fa-star"></i> / 5 </strong> `;
            } else {
                console.error('Invalid data received:', data);
            }
            // Debugging line

        });
        pusher.connection.bind('connected', function() {
            console.log('Pusher connected');
        });
    </script>


    <!-- CSS
    ========================= -->

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/popup_login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/account.css') }}">

    <!-- Css Product List -->
    <link rel="stylesheet" href="{{ asset('/CssUser/ProductList.css') }}">

</head>

<body>
    @include('user.layouts.header')
    @yield('content')
    @include('user.layouts.popupLogin')
    @include('user.layouts.popupChat')

    @include('user.layouts.footer')
    <!-- JS
============================================ -->

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/chat.js') }}"></script>
    <script src="{{ asset('assets/js/popup_login.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
