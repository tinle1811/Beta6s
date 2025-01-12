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
    public function purchase(Request $request){
        $userId = Auth::id();

        $viewData['title'] = "Trang đơn mua";
        $validStatuses = [1, 2, 3, 4];
        $type = (int)$request->query('type');


        if (in_array($type, $validStatuses)) {
            //$hoaDons = HoaDon::where('TrangThai', $type)->get();
            $hoaDons = HoaDon::join('chi_tiet_hoa_dons', 'hoa_dons.MaHD', '=', 'chi_tiet_hoa_dons.MaHD')
                                ->join('san_phams', 'san_phams.MaSP', '=', 'chi_tiet_hoa_dons.MaSP')
                                ->where('hoa_dons.MaKH', $userId)
                                ->where('hoa_dons.TrangThai', $type)
                                ->select([
                                    'san_phams.MaSP',
                                    'san_phams.HinhAnh',
                                    'san_phams.TenSP',
                                    'chi_tiet_hoa_dons.DonGia',
                                    'chi_tiet_hoa_dons.SoLuong',
                                    'hoa_dons.TrangThai',
                                    'hoa_dons.TongTien',
                                ])
                                ->get();
        } else {
            //$hoaDons = HoaDon::all();
            $hoaDons = HoaDon::join('chi_tiet_hoa_dons', 'hoa_dons.MaHD', '=', 'chi_tiet_hoa_dons.MaHD')
                                ->join('san_phams', 'san_phams.MaSP', '=', 'chi_tiet_hoa_dons.MaSP')
                                ->where('hoa_dons.MaKH', $userId)
                                ->select([
                                    'san_phams.MaSP',
                                    'san_phams.HinhAnh',
                                    'san_phams.TenSP',
                                    'chi_tiet_hoa_dons.DonGia',
                                    'chi_tiet_hoa_dons.SoLuong',
                                    'hoa_dons.TrangThai',
                                    'hoa_dons.TongTien',
                                ])
                                ->get();

            $type = 0;  
            
            // Lọc đơn hàng theo trạng thái
        }
        return view('user.account.purchase', compact('viewData', 'hoaDons', 'type'));
    }
    public function orderlist(Request $request)
    {
        $viewData['title'] = "Trang đơn mua";
        // Lấy tài khoản đã đăng nhập
        $user = Auth::user();

        // Lấy danh sách hóa đơn theo tài khoản
        //$hoaDons = HoaDon::where('MaKH', $user->MaTK)->get();

        // Trả về View với dữ liệu hóa đơn
        //return view('user.orders', ['hoaDons' => $hoaDons]);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem thông tin.');
        }
        // Lấy danh sách hóa đơn theo tài khoản
        //$hoaDons = HoaDon::where('MaKH', $user->MaTK)->get();
        $hoaDons = HoaDon::where('MaKH', $user->MaTK)
            ->with(['chiTietHoaDons.sanPham', 'binhLuans'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('user.account.orderlist', [
            'user' => $user,
            'hoaDons' => $hoaDons,
            'viewData' => $viewData,
        ]);
    }

    public function addReview(Request $request)
    {
        $validated = $request->validate([
            'reviews' => 'required|array',
            'reviews.*.maHD' => 'required|integer',
            'reviews.*.maSP' => 'required|integer',
            'reviews.*.rating' => 'required|integer|min:1|max:5',
            'reviews.*.comment' => 'required|string|max:1000',
        ]);

        foreach ($validated['reviews'] as $review) {
            BinhLuan::create([
                'MaHD' => $review['maHD'],
                'MaKH' => Auth::user()->MaTK,
                'MaSP' => $review['maSP'],
                'DanhGia' => $review['rating'],
                'NoiDung' => $review['comment'],
                'TrangThai' => 0, // chưa duyệt
                'created_at' => now(),
            ]);
        }

        // Trả về phản hồi thành công
        return response()->json(['success' => true]);
    }

    public function purchaseHistory(){
        $userId = Auth::id();

        $viewData['title'] = "Trang sản phẩm đã mua";

        $viewData['DSSP_DaMua'] = HoaDon::join('chi_tiet_hoa_dons', 'hoa_dons.MaHD', '=', 'chi_tiet_hoa_dons.MaHD')
                                        ->join('san_phams', 'chi_tiet_hoa_dons.MaSP', '=', 'san_phams.MaSP')
                                        ->where('hoa_dons.MaKH', $userId)
                                        ->where('hoa_dons.TrangThai', 2)
                                        ->orderBy('hoa_dons.created_at', 'Desc')
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
                                ->orderBy('binh_luans.created_at', 'Desc')
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
