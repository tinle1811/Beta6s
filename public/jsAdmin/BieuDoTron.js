var PhanTram_banChay = 0;
var PhanTram_noiBat = 0;
var PhanTram_moi = 0;

var PhanTram_banChay = banChay;
var PhanTram_noiBat = noiBat;
var PhanTram_moi = moi;

$(document).on('ready', function () {
// INITIALIZATION OF CHARTJS
// =======================================================
var updatingDoughnutChart = $.HSCore.components.HSChartJS.init($('#updatingDoughnutChart'));

// Datasets for chart, can be loaded from AJAX request
var updatingDoughnutChartDatasets = [
    [
    [PhanTram_noiBat, PhanTram_banChay, PhanTram_moi]
    ]
]

// Set datasets for chart when page is loaded
updatingDoughnutChart.data.datasets.forEach(function(dataset, key) {
    dataset.data = updatingDoughnutChartDatasets[0][key];
});
updatingDoughnutChart.update();

// Call when tab is clicked
    $('[data-toggle="chart-doughnut"]').click(function (e) {
    e.preventDefault();  // Ngừng hành động mặc định của thẻ <a>
        
        let keyDataset = $(e.currentTarget).attr('data-datasets')
        let URL;

        if (keyDataset == 0) { URL = '/admin/thisweek'; }
        else if (keyDataset == 1) { URL = '/admin/lastweek'; }
        
        $.ajax({
            url: URL,
            type: 'get',
            success: function (response) {
                $('#SPBC').html(response.TongLuotMua_SPBC + ' lượt mua');
                $('#SPNB').html(response.TongLuotMua_SPNB + ' lượt mua');
                $('#SPM').html(response.TongLuotMua_SPM + ' lượt mua');
                $('#TLM').html(response.TongLuotMua_ALLSP);

                var updatedData = [response.totalPurchases_spnb, response.totalPurchases_spbc, response.totalPurchases_spm];
                
                CheckStatisticalData(updatedData);
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra! Vui lòng thử lại.');
            }
        });
    })
    
    // Lắng nghe sự kiện tùy chỉnh 'daterangeApplied' từ file khác
    $(document).on('dataLoaded', function(event, data) {
        if (data && Array.isArray(data) && data.length > 0) {
            // Truy cập trực tiếp vào phần tử đầu tiên của mảng
            var item = data[0]; // Vì bạn chỉ muốn lấy một lần duy nhất

            $('#SPBC').html(item.TongLuotMua_SPBC + ' lượt mua');
            $('#SPNB').html(item.TongLuotMua_SPNB + ' lượt mua');
            $('#SPM').html(item.TongLuotMua_SPM + ' lượt mua');
            $('#TLM').html(item.TongLuotMua_ALLSP);

            var updatedData = [item.totalPurchases_spnb, item.totalPurchases_spbc, item.totalPurchases_spm];
            
            CheckStatisticalData(updatedData);
        }
        else
        {
            $('#SPBC').html(0 + ' lượt mua');
            $('#SPNB').html(0 + ' lượt mua');
            $('#SPM').html(0 + ' lượt mua');
            $('#TLM').html(0);

            var updatedData = [0, 0, 0];
            
            CheckStatisticalData(updatedData);
        }
    });

    function CheckStatisticalData(updatedData) {
        if (updatedData.every(val => val === 0)) {
            // Cập nhật dữ liệu trong biểu đồ
            updatingDoughnutChart.data.datasets[0].data = updatedData;

            // Cập nhật lại biểu đồ
            updatingDoughnutChart.update();

            // Hiển thị thông báo cho người dùng
            $('#updatingDoughnutChart').hide(); // Ẩn biểu đồ

            if ($('#text-muted').length === 0)
            {
                $('.content-pie-chart').append('<div class="text-center" id="text-muted">Không có lượt mua trong thời gian này</div>');
            }
        } else {
            // Xóa thông báo nếu có dữ liệu
            $('#updatingDoughnutChart').show(); // Hiển thị biểu đồ
            $('.content-pie-chart #text-muted').remove();

            // Cập nhật dữ liệu trong biểu đồ
            updatingDoughnutChart.data.datasets[0].data = updatedData;

            // Cập nhật lại biểu đồ
            updatingDoughnutChart.update();
        }
    }
});