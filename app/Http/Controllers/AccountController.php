<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BinhLuan;
use App\Models\SanPham;
use App\Models\KhachHang;
use App\Events\SanPhamUpdated;

class AccountController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang tài khoản";

        // lấy id tài khoản người dùng
        $maTk = Auth::user()->MaTK;

        $viewData['ThongTinTaiKhoan'] = KhachHang::join('tai_khoans', 'khach_hangs.MaTK', '=', 'tai_khoans.MaTK')
            ->where('tai_khoans.MaTK', $maTk)
            ->first();

        return view('user.account.index')->with('viewData', $viewData);
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
        $user = Auth::user();
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
            $hoaDons = HoaDon::where('MaKH', $userId)
                ->with(['chiTietHoaDons.sanPham', 'binhLuans'])
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            $hoaDons = HoaDon::where('TrangThai', $statusMap[$type])
                ->where('MaKH', $userId)
                ->with(['chiTietHoaDons.sanPham', 'binhLuans'])
                ->orderBy('created_at', 'asc')
                ->get();
            $viewData['TabMessage'] = $this->getTabMessage($type);
        }

        //return view('user.account.purchase', compact('viewData', 'hoaDons', 'type'));
        return view('user.account.purchase', [
            'user' => $user,
            'hoaDons' => $hoaDons,
            'viewData' => $viewData,
            'type' => $type
        ]);
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
                
                event(new SanPhamUpdated([
                    'MaSP' => $product->MaSP,
                    'SoLuotYeuThich' => $product->SoLuotYeuThich,
                    'SoLuotXem' => $product->SoLuotXem,
                    'DiemRatingTB' => $product->DiemRatingTB,
                    'SoLuongTon' => $product->SoLuong,
                ]));
            }

            return response()->json(['success' => true, 'message' => 'Đơn hàng đã được hủy thành công']);
        }

        return response()->json(['success' => false, 'message' => 'Không thể hủy đơn hàng này']);
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

    public function purchaseHistory()
    {
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

        return view('user.account.purchaseHistory')->with('viewData', $viewData);
    }

    public function historyEvaluate()
    {
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

        return view('user.account.historyEvaluate')->with('viewData', $viewData);
    }
}