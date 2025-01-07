<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminOrderController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang hóa đơn";
        $viewData['hoaDons'] = HoaDon::with(['khachHang', 'phuongThucThanhToan'])->get();
        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function create()
    {
        $viewData['title'] = "Trang thêm hoá đơn";
        return view("admin.order.create")->with("viewData", $viewData);
    }
    public function edit($maHD)
    {
        // Lấy hóa đơn với thông tin khách hàng và chi tiết hóa đơn
        $hoaDon = HoaDon::with(['khachHang', 'chiTietHoaDons.sanPham'])->find($maHD);

        if (!$hoaDon) {
            return redirect()->route('admin.order')->with('error', 'Hóa đơn không tồn tại');
        }
        if ($hoaDon->TrangThai == 2) {
            return redirect()->route('admin.order')->with('error', 'Hóa đơn đã hoàn thành, không thể chỉnh sửa');
        }

        $viewData['title'] = 'Chi tiết hóa đơn';
        $viewData['hoaDon'] = $hoaDon;
        return view("admin.order.edit")->with("viewData", $viewData);
    }
    public function update(Request $request, $MaHD)
    {
        // Lấy thông tin hóa đơn từ CSDL theo mã hóa đơn
        $hoaDon = HoaDon::find($MaHD);

        if (!$hoaDon) {
            // Trường hợp không tìm thấy hóa đơn
            return redirect()->back()->with('error', 'Hóa đơn không tồn tại!');
        }

        // Lấy giá trị từ form (người dùng đã chọn)
        $trangThaiThanhToan = $request->input('TrangThaiThanhToan');
        $trangThai = $request->input('TrangThai');

        // Cập nhật thông tin
        $hoaDon->TrangThaiThanhToan = $trangThaiThanhToan;
        $hoaDon->TrangThai = $trangThai;

        // Lưu lại thay đổi vào CSDL
        $hoaDon->save();

        // Nếu trạng thái hóa đơn là "2" (hoàn thành), cập nhật bảng thong_kes
        if ($trangThai == 2) {
            $order_date = $hoaDon->created_at->toDateString(); // Lấy ngày tạo hóa đơn
            $sales = DB::table('hoa_dons')
                ->whereDate('created_at', $order_date)
                ->where('TrangThai', 2) // Hóa đơn hoàn thành
                ->sum('TongTien');
            $profit = $sales - DB::table('phieu_nhaps')
                ->whereDate('created_at', $order_date)
                ->sum('TongTien');
            $quantity = DB::table('chi_tiet_hoa_dons')
                ->join('hoa_dons', 'chi_tiet_hoa_dons.MaHD', '=', 'hoa_dons.MaHD')
                ->whereDate('hoa_dons.created_at', $order_date)
                ->where('hoa_dons.TrangThai', 2) // Hóa đơn hoàn thành
                ->sum('SoLuong');
            $totalOrder = DB::table('hoa_dons')
                ->whereDate('created_at', $order_date)
                ->where('TrangThai', 2) // Hóa đơn hoàn thành
                ->count();

            // Kiểm tra xem đã có bản ghi thống kê cho ngày này chưa
            $thongKe = DB::table('thong_kes')->where('order_date', $order_date)->first();

            if ($thongKe) {
                // Cập nhật nếu đã tồn tại
                DB::table('thong_kes')->where('order_date', $order_date)->update([
                    'sales' => $sales,
                    'profit' => $profit,
                    'quantity' => $quantity,
                    'total_order' => $totalOrder,
                    'updated_at' => now(),
                ]);
            } else {
                // Thêm mới nếu chưa tồn tại
                DB::table('thong_kes')->insert([
                    'order_date' => $order_date,
                    'sales' => $sales,
                    'profit' => $profit,
                    'quantity' => $quantity,
                    'total_order' => $totalOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        // Chuyển hướng lại trang chi tiết hóa đơn với thông báo thành công
        return redirect()->route('admin.order')->with('success', 'Cập nhật trạng thái thành công!');
    }
    public function togglePaymentStatus(Request $request)
    {
        // Lấy thông tin từ request
        $maHD = $request->input('maHD');
        $trangThaiThanhToan = $request->input('trangThaiThanhToan');

        // Tìm hóa đơn theo MaHD và kiểm tra trạng thái
        $hoaDon = HoaDon::find($maHD);
        if ($hoaDon) {
            // Kiểm tra nếu trạng thái thanh toán đã là "Đã thanh toán" (1), không cho phép thay đổi
            if ($hoaDon->TrangThaiThanhToan == 1) {
                return response()->json(['success' => false, 'message' => 'Trạng thái thanh toán đã là "Đã thanh toán"']);
            }

            // Cập nhật trạng thái thanh toán
            $hoaDon->TrangThaiThanhToan = $trangThaiThanhToan;
            $hoaDon->save();  // Lưu lại thay đổi
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Hóa đơn không tồn tại']);
    }
}