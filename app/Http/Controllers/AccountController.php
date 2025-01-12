<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public $viewData= [];
    public function index(){
        $viewData['title']= "Trang tài khoản";

        return view('user.account.index')->with('viewData',$viewData);
    }
    private function getTabMessage($type)
    {
        switch ($type) {
            case 1:
                return "cần xử lý"; 
            case 2:
                return "đang giao"; 
            case 3:
                return "đã hoàn thành"; 
            case 4:
                return "đã hủy"; 
        }
    }
    public function purchase(Request $request)
    {
        $userId = Auth::id(); 
        $viewData['title'] = "Trang đơn mua";
        
        $type = (int)$request->query('type', 0); // Mặc định type là 0 nếu không có query

        $statusMap = [
            1 => 0, // "Chờ xử lý" => TrangThai = 0
            2 => 1, // "Đang giao hàng" => TrangThai = 1
            3 => 2, // "Đã hoàn thành" => TrangThai = 2
            4 => 3  // "Đã hủy" => TrangThai = 3
        ];

        // Nếu type = 0 thì lấy tất cả hóa đơn
        if ($type == 0) {
            $hoaDons = HoaDon::where('MaKH', $userId)->get();
        } else {
            $hoaDons = HoaDon::where('TrangThai', $statusMap[$type])
                            ->where('MaKH', $userId)
                            ->get();
            $viewData['TabMessage'] = $this->getTabMessage($type);
        }

        return view('user.account.purchase', compact('viewData', 'hoaDons', 'type'));
    }

    public function cancelOrder(Request $request)
    {
        $user = Auth::user();
        $id = $request->input('MaHD');  // Lấy MaHD từ dữ liệu POST

        $hoaDon = HoaDon::where('MaHD', $id)->where('MaKH', $user->MaTK)->first();

        // Kiểm tra nếu không tìm thấy đơn hàng
        if (!$hoaDon) {
            return response()->json(['status' => 'error', 'message' => 'Đơn hàng không tồn tại.']);
        }

        if ($hoaDon->TrangThai == 0) {
            // Cập nhật trạng thái đơn hàng thành "3" (hủy)
            $hoaDon->TrangThai = 3;
            $hoaDon->save();

            // Cập nhật số lượng sản phẩm trong đơn hàng
            $chiTietHoaDons = ChiTietHoaDon::where('MaHD', $hoaDon->MaHD)->get();
            foreach ($chiTietHoaDons as $chitiet) {
                $product = SanPham::find($chitiet->MaSP);
                $product->SoLuong += $chitiet->SoLuong;
                $product->save();
            }

            return response()->json(['success' => true, 'message' => 'Đơn hàng đã được hủy thành công']);
        }

        return response()->json(['success' => false, 'message' => 'Không thể hủy đơn hàng này']);
    }

}
