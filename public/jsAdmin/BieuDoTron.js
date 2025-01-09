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
        
        if (keyDataset == 0)
        {
            $.ajax({
                url: '/admin/thisweek',
                type: 'get',
                success: function (response) {
                    $('#SPBC').html(response.TongLuotMua_SPBC + ' lượt mua');
                    $('#SPNB').html(response.TongLuotMua_SPNB + ' lượt mua');
                    $('#SPM').html(response.TongLuotMua_SPM + ' lượt mua');
                    $('#TLM').html(response.TongLuotMua_ALLSP);

                    var updatedData = [response.totalPurchases_spnb, response.totalPurchases_spbc, response.totalPurchases_spm];
                    
                    // Cập nhật dữ liệu trong biểu đồ mà không thay đổi cấu trúc ban đầu
                    updatingDoughnutChart.data.datasets[0].data = updatedData; // Cập nhật mảng dữ liệu của biểu đồ

                    // Cập nhật lại biểu đồ
                    updatingDoughnutChart.update();
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra! Vui lòng thử lại.');
                }
            });
        }
        else if (keyDataset == 1)
        {
            $.ajax({
                url: '/admin/lastweek',
                type: 'get',
                success: function (response) {
                    $('#SPBC').html(response.TongLuotMua_SPBC + ' lượt mua');
                    $('#SPNB').html(response.TongLuotMua_SPNB + ' lượt mua');
                    $('#SPM').html(response.TongLuotMua_SPM + ' lượt mua');
                    $('#TLM').html(response.TongLuotMua_ALLSP);

                    var updatedData = [response.totalPurchases_spnb, response.totalPurchases_spbc, response.totalPurchases_spm];
                    
                    // Cập nhật dữ liệu trong biểu đồ mà không thay đổi cấu trúc ban đầu
                    updatingDoughnutChart.data.datasets[0].data = updatedData; // Cập nhật mảng dữ liệu của biểu đồ

                    // Cập nhật lại biểu đồ
                    updatingDoughnutChart.update();
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra! Vui lòng thử lại.');
                }
            });
        }
        // Update datasets for chart
        // updatingDoughnutChart.data.datasets.forEach(function(dataset, key) {
        // dataset.data = updatingDoughnutChartDatasets[keyDataset][key];
        // });
        // updatingDoughnutChart.update();
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
            
            // Cập nhật dữ liệu trong biểu đồ mà không thay đổi cấu trúc ban đầu
            updatingDoughnutChart.data.datasets[0].data = updatedData; // Cập nhật mảng dữ liệu của biểu đồ

            // Cập nhật lại biểu đồ
            updatingDoughnutChart.update();
        }
        else
        {
            $('#SPBC').html(0 + ' lượt mua');
            $('#SPNB').html(0 + ' lượt mua');
            $('#SPM').html(0 + ' lượt mua');
            $('#TLM').html(0);

            var updatedData = [0, 0, 0];
            
            // Cập nhật dữ liệu trong biểu đồ mà không thay đổi cấu trúc ban đầu
            updatingDoughnutChart.data.datasets[0].data = updatedData; // Cập nhật mảng dữ liệu của biểu đồ

            // Cập nhật lại biểu đồ
            updatingDoughnutChart.update();
        }
    });
});