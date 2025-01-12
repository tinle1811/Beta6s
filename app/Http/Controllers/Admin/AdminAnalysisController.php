<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use App\Models\ThongKe;
// Đảm bảo đã import model
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminAnalysisController extends Controller {
    public $viewData = [];
    public function index(Request $request)
    {
        $viewData['title'] = "Thống Kê";
        $thongKes = ThongKe::orderBy('order_date', 'asc')->get();
        $viewData['thongKes'] = $thongKes;

        // Lấy ngày bắt đầu và kết thúc của tuần hiện tại
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $viewData['PieChartData'] = $this->getPieChartData( $startOfWeek, $endOfWeek );
        
        return view('admin.analysis.index')->with('viewData', $viewData);
    }

    public function filter_by_date( Request $request ) {
        $data = $request->all();
        $from_date = $data[ 'startDate' ];
        $to_date = $data[ 'endDate' ];

        $get = ThongKe::whereBetween( 'order_date', [ $from_date, $to_date ] )
        ->orderBy( 'order_date', 'ASC' )
        ->get();

        // Lấy dữ liệu thông kê biểu đồ tròn theo ngày bắt đầu và kết thúc
        $viewData[ 'PieChartData' ] = $this->getPieChartData( $from_date, $to_date );

        // Khai báo mảng trống
        $chart_data = [];

        foreach ( $get as $key => $val ) {

            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
                // Các giá trị để thống kê biểu đồ tròn
                'TongLuotMua_SPBC' => $viewData[ 'PieChartData' ][ 'TongLuotMua_SPBC' ],
                'TongLuotMua_SPNB' => $viewData[ 'PieChartData' ][ 'TongLuotMua_SPNB' ],
                'TongLuotMua_SPM' => $viewData[ 'PieChartData' ][ 'TongLuotMua_SPM' ],
                'TongLuotMua_ALLSP' => $viewData[ 'PieChartData' ][ 'TongLuotMua_ALLSP' ],
                'totalPurchases_spbc' => $viewData[ 'PieChartData' ][ 'totalPurchases_spbc' ],
                'totalPurchases_spnb' => $viewData[ 'PieChartData' ][ 'totalPurchases_spnb' ],
                'totalPurchases_spm' => $viewData[ 'PieChartData' ][ 'totalPurchases_spm' ],
            );
        }

        echo $data = json_encode( $chart_data );
    }

    public function filter_by_thisweek() {
        // Lấy ngày bắt đầu và kết thúc của tuần hiện tại
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $viewData = $this->getPieChartData( $startOfWeek, $endOfWeek );

        // Trả về dữ liệu dưới dạng JSON
        return response()->json( [
            'TongLuotMua_SPBC' => $viewData[ 'TongLuotMua_SPBC' ],
            'TongLuotMua_SPNB' => $viewData[ 'TongLuotMua_SPNB' ],
            'TongLuotMua_SPM' => $viewData[ 'TongLuotMua_SPM' ],
            'TongLuotMua_ALLSP' => $viewData[ 'TongLuotMua_ALLSP' ],
            'totalPurchases_spbc' => $viewData[ 'totalPurchases_spbc' ],
            'totalPurchases_spnb' => $viewData[ 'totalPurchases_spnb' ],
            'totalPurchases_spm' => $viewData[ 'totalPurchases_spm' ],
        ] );
    }

    public function filter_by_lastweek() {
        // Lấy ngày bắt đầu và kết thúc của tuần trước
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $viewData = $this->getPieChartData( $startOfLastWeek, $endOfLastWeek );

        // Trả về dữ liệu dưới dạng JSON
        return response()->json( [
            'TongLuotMua_SPBC' => $viewData[ 'TongLuotMua_SPBC' ],
            'TongLuotMua_SPNB' => $viewData[ 'TongLuotMua_SPNB' ],
            'TongLuotMua_SPM' => $viewData[ 'TongLuotMua_SPM' ],
            'TongLuotMua_ALLSP' => $viewData[ 'TongLuotMua_ALLSP' ],
            'totalPurchases_spbc' => $viewData[ 'totalPurchases_spbc' ],
            'totalPurchases_spnb' => $viewData[ 'totalPurchases_spnb' ],
            'totalPurchases_spm' => $viewData[ 'totalPurchases_spm' ],
        ] );
    }

    public function getPieChartData( $startDay, $endDay ) {
        // Tổng lượt mua của nhóm sản phẩm bán chạy
        $DSSP_BanChay = SanPham::join( 'chi_tiet_hoa_dons', 'san_phams.MaSP', '=', 'chi_tiet_hoa_dons.MaSP' )
        ->join( 'hoa_dons', 'chi_tiet_hoa_dons.MaHD', '=', 'hoa_dons.MaHD' )
        ->where( 'hoa_dons.TrangThai', 2 )
        ->where( 'san_phams.TrangThai', 1 )
        ->whereBetween( 'hoa_dons.created_at', [ $startDay, $endDay ] )
        ->SUM( 'chi_tiet_hoa_dons.SoLuong' );

        // Tổng lượt mua của nhóm sản phẩm nổi bật
        $DSSP_NoiBat = SanPham::join( 'chi_tiet_hoa_dons', 'san_phams.MaSP', '=', 'chi_tiet_hoa_dons.MaSP' )
        ->join( 'hoa_dons', 'chi_tiet_hoa_dons.MaHD', '=', 'hoa_dons.MaHD' )
        ->where( 'hoa_dons.TrangThai', 2 )
        ->where( 'san_phams.TrangThai', 2 )
        ->whereBetween( 'hoa_dons.created_at', [ $startDay, $endDay ] )
        ->SUM( 'chi_tiet_hoa_dons.SoLuong' );

        // Lấy danh sách sản phẩm mới
        $DSSP_Moi = SanPham::where( 'created_at', '>=', Carbon::now()->subMonth() )
        ->where( 'TrangThai', 1 )
        ->get();

        // Tổng lượt mua của nhóm sản phẩm mới
        $DSSP_Moi_tuan_hien_tai = SanPham::join( 'chi_tiet_hoa_dons', 'san_phams.MaSP', '=', 'chi_tiet_hoa_dons.MaSP' )
        ->join( 'hoa_dons', 'chi_tiet_hoa_dons.MaHD', '=', 'hoa_dons.MaHD' )
        ->where( 'hoa_dons.TrangThai', 2 )
        ->whereBetween( 'hoa_dons.created_at', [ $startDay, $endDay ] )
        ->whereIn( 'san_phams.MaSP', $DSSP_Moi->pluck( 'MaSP' ) ) // Chỉ tính cho các sản phẩm mới đã lấy
        ->SUM( 'chi_tiet_hoa_dons.SoLuong' );

        // Kiểm tra Tổng lượt mua của nhóm sản phẩm bán chạy
        $totalPurchases_spbc = $DSSP_BanChay ? $DSSP_BanChay : 0;

        // Kiểm tra Tổng lượt mua của nhóm sản phẩm nổi bật
        $totalPurchases_spnb = $DSSP_NoiBat ? $DSSP_NoiBat : 0;

        // Kiểm tra Tổng lượt mua của nhóm sản phẩm mới
        $totalPurchases_spm = $DSSP_Moi_tuan_hien_tai ? $DSSP_Moi_tuan_hien_tai : 0;

        // Tính tổng lượt mua của tất cả nhóm sản phẩm
        $TongLuotMua = $totalPurchases_spbc + $totalPurchases_spnb + $totalPurchases_spm;

        if ( $TongLuotMua > 0 ) {
            // Tính phần trăm cho từng nhóm sản phẩm
            $PhanTram_banChay = ( $totalPurchases_spbc / $TongLuotMua ) * 100;
            $PhanTram_noiBat = ( $totalPurchases_spnb / $TongLuotMua ) * 100;
            $PhanTram_moi = ( $totalPurchases_spm / $TongLuotMua ) * 100;

            // Làm tròn phần trăm cho từng nhóm sản phẩm
            $PhanTram_banChay = round( $PhanTram_banChay, 2 );
            $PhanTram_noiBat = round( $PhanTram_noiBat, 2 );
            $PhanTram_moi = round( $PhanTram_moi, 2 );
        }
        else
        {
            $PhanTram_banChay = 0;
            $PhanTram_noiBat = 0;
            $PhanTram_moi = 0;
        }

        // Dữ liệu cho thống kê biểu đồ tròn
        $viewData[ 'TongLuotMua_SPBC' ] = $totalPurchases_spbc;
        $viewData[ 'TongLuotMua_SPNB' ] = $totalPurchases_spnb;
        $viewData[ 'TongLuotMua_SPM' ] = $totalPurchases_spm;
        $viewData[ 'TongLuotMua_ALLSP' ] = $TongLuotMua;
        $viewData[ 'totalPurchases_spbc' ] = $PhanTram_banChay;
        $viewData[ 'totalPurchases_spnb' ] = $PhanTram_noiBat;
        $viewData[ 'totalPurchases_spm' ] = $PhanTram_moi;

        return $viewData;
    }

    public function export()
    {
        // Lấy dữ liệu thống kê từ bảng thong_kes
        $thongKes = ThongKe::orderBy('order_date', 'asc')->get();
        // Tạo một đối tượng Spreadsheet mới
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Đặt tiêu đề cột
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Ngày Thống Kê');
        $sheet->setCellValue('C1', 'Doanh Thu');
        $sheet->setCellValue('D1', 'Lợi Nhuận');
        $sheet->setCellValue('E1', 'Số Lượng');
        $sheet->setCellValue('F1', 'Tổng Đơn Hàng');
        $sheet->setCellValue('G1', 'Ngày Tạo');
        $sheet->setCellValue('H1', 'Ngày Cập Nhật');

        // Duyệt qua các dữ liệu và thêm vào bảng tính
        $row = 2;
        foreach ($thongKes as $thongKe) {
            $sheet->setCellValue('A' . $row, $thongKe->id);
            $sheet->setCellValue('B' . $row, $thongKe->order_date);
            $sheet->setCellValue('C' . $row, $thongKe->sales);
            $sheet->setCellValue('D' . $row, $thongKe->profit);
            $sheet->setCellValue('E' . $row, $thongKe->quantity);
            $sheet->setCellValue('F' . $row, $thongKe->total_order);
            $sheet->setCellValue('G' . $row, $thongKe->created_at);
            $sheet->setCellValue('H' . $row, $thongKe->updated_at);
            $row++;
        }

        // Tạo file Excel và lưu vào thư mục public
        $writer = new Xlsx($spreadsheet);
        $fileName = 'thong_ke_' . now()->format('Ymd_His') . '.xlsx';
        $filePath = public_path($fileName);
        $writer->save($filePath);

        // Trả về file để người dùng tải về
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}