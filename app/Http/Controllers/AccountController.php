<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
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

}
