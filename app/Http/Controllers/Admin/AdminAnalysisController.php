<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use App\Models\ThongKe; // Đảm bảo đã import model

class AdminAnalysisController extends Controller
{
    public $viewData = [];
    public function index(Request $request)
    {
        $viewData['title'] = "Thống Kê";
        $thongKes = ThongKe::orderBy('order_date', 'asc')->get();
        $viewData['thongKes'] = $thongKes;
        return view('admin.analysis.index')->with('viewData', $viewData);
    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['startDate'];
        $to_date = $data['endDate'];

        $get = ThongKe::whereBetween('order_date', [$from_date, $to_date])
            ->orderBy('order_date', 'ASC')
            ->get();

        // Khai báo mảng trống
        $chart_data = [];

        foreach ($get as $key => $val) {

            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
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