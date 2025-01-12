<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\BinhLuan;

class AccountController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang tài khoản";

        return view('user.account.index')->with('viewData', $viewData);
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

    public function purchaseHistory(){
        $userId = Auth::id();

        $viewData['title'] = "Trang lịch sử mua hàng";

        $viewData['DSSP_DaMua'] = HoaDon::join('chi_tiet_hoa_dons', 'hoa_dons.MaHD', '=', 'chi_tiet_hoa_dons.MaHD')
                                        ->join('san_phams', 'chi_tiet_hoa_dons.MaSP', '=', 'san_phams.MaSP')
                                        ->where('hoa_dons.MaKH', $userId)
                                        ->where('hoa_dons.TrangThai', 2)
                                        ->paginate(10, [
                                            'san_phams.MaSP',
                                            'san_phams.HinhAnh',
                                            'san_phams.TenSP',
                                            'chi_tiet_hoa_dons.SoLuong',
                                            'chi_tiet_hoa_dons.DonGia',
                                            'hoa_dons.created_at',
                                        ]);

        return view('user.account.purchaseHistory')->with('viewData',$viewData);
    }

    public function historyEvaluate(){
        $userId = Auth::id();

        $viewData['title'] = "Trang lịch sử đánh giá";

        $viewData['DSSP_DaDanhGia'] = BinhLuan::join('san_phams', 'binh_luans.MaSP', '=', 'san_phams.MaSP')
                                ->where('binh_luans.MaKH', $userId)
                                ->paginate(10, [
                                    'san_phams.MaSP',
                                    'san_phams.HinhAnh',
                                    'san_phams.TenSP',
                                    'binh_luans.DanhGia',
                                    'binh_luans.NoiDung',
                                    'binh_luans.created_at',
                                ]);

        return view('user.account.historyEvaluate')->with('viewData',$viewData);
    }
}
