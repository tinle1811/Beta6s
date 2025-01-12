<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Auth;


use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\YeuThich;
use App\Models\Blog;
use App\Events\SanPhamUpdated;

class HomeController extends Controller
{

    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang chủ";
        $viewData["DSSP-Slider"] = SanPham::limit(3)->get();
        $viewData["DSSP-BanChay"] = SanPham::join('chi_tiet_hoa_dons', 'san_phams.MaSP', '=', 'chi_tiet_hoa_dons.MaSP')
            ->join('hoa_dons', 'chi_tiet_hoa_dons.MaHD', '=', 'hoa_dons.MaHD')
            ->select('san_phams.MaSP', 'san_phams.Slug', 'san_phams.HinhAnh', 'san_phams.Gia', 'san_phams.TenSP', 'san_phams.MoTa', DB::raw('SUM(chi_tiet_hoa_dons.SoLuong) as total_quantity'))
            ->where('hoa_dons.TrangThai', 2)
            ->where('san_phams.TrangThai', 1)
            ->groupBy('san_phams.MaSP', 'san_phams.Slug', 'san_phams.HinhAnh', 'san_phams.Gia', 'san_phams.TenSP', 'san_phams.MoTa')
            ->orderBy('total_quantity', 'Desc')
            ->paginate(10, ['*'], 'pageSPBanChay');
        $viewData["DSSP-NoiBat"] = SanPham::where('TrangThai', 2)->get();
        $viewData["DSSP-Moi"] = SanPham::where('created_at', '>=', Carbon::now()->subMonth())
            ->where('TrangThai', 1)
            ->orderBy('created_at', 'Desc')
            ->paginate(10, ['*'], 'pageSPMoi');
        $viewData["blogs"] = Blog::limit(5)->get();
        return view('user.home.index')->with('viewData', $viewData);
    }

    public function show($slug)
    {
        $sanpham = SanPham::where('Slug', $slug)->firstOrFail();

        //realtime
        // Tăng số lượt xem
        $sanpham->SoLuotXem += 1;

        // Lưu lại số lượt xem vào cơ sở dữ liệu
        $sanpham->save();

        event(new SanPhamUpdated([
            'MaSP' => $sanpham->MaSP,
            'SoLuotYeuThich' => $sanpham->SoLuotYeuThich,
            'SoLuotXem' => $sanpham->SoLuotXem,
            'DiemRatingTB' => $sanpham->DiemRatingTB,
        ]));

        // Phát sự kiện SanPhamUpdated với sản phẩm đã cập nhật
        //event(new SanPhamUpdated($sanpham));
        Log::info('SanPhamUpdated event fired', ['sanpham' => $sanpham]);
        Log::info('SanPhamUpdated event fired', [
            'MaSP' => $sanpham->MaSP,
            'SoLuotYeuThich' => $sanpham->SoLuotYeuThich,
            'SoLuotXem' => $sanpham->SoLuotXem,
            'DiemRatingTB' => $sanpham->DiemRatingTB,
        ]);

        $relatedProducts = SanPham::where('LoaiSP', $sanpham->LoaiSP)
            ->where('MaSP', '!=', $sanpham->MaSP)
            ->limit(5)
            ->get();

        $viewData = [
            'title' => 'Chi tiết sản phẩm',
            'sanpham' => $sanpham,
            'relatedProducts' => $relatedProducts
        ];

        return view('user.home.show')->with('viewData', $viewData);
    }
    public function about()
    {
        $viewData['title'] = "Trang giới thiệu";
        return view('user.home.about')->with('viewData', $viewData);
    }
    public function contact()
    {
        $viewData['title'] = "Trang liên hệ";
        $viewData['errors'] = "";
        $viewData['taikhoan'] = TaiKhoan::find(auth()->id());
        return view('user.home.contact')->with('viewData', $viewData);
    }
    public function wishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('user.home.index')->with('error', 'Vui lòng đăng nhập để thêm vào yêu thích');
        }
        $maTk = Auth::user()->MaTK;

        $yeuThich = YeuThich::where('MaTK', $maTk)->with('product')->get();

        $viewData = [
            'title' => "Trang yêu thích",
            'yeuThich' => $yeuThich,
        ];
        return view('user.home.wishlist')->with('viewData', $viewData);
    }
    public function addToWishlist(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('user.home.index')->with('error', 'Vui lòng đăng nhập để thêm vào yêu thích');
        }

        $maTk = Auth::user()->MaTK;
        $productId = $id;

        $wishlistItems = YeuThich::where('MaTK', $maTk)->where('MaSP', $productId)->first();
        if (!$wishlistItems) {
            YeuThich::create([
                'MaTK' => $maTk,
                'MaSP' => $productId,
            ]);
        }
        return redirect()->route('user.home.wishlist');
    }
    public function removeToWishlist($id)
    {
        // Lấy thông tin sản phẩm trong giỏ hàng dựa trên ID
        $wishlistItem = YeuThich::find($id);

        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$wishlistItem) {
            return redirect()->route('user.home.wishlist')->with('error', 'Sản phẩm không tồn tại trong yêu thích.');
        }

        // Xóa sản phẩm khỏi giỏ hàng
        $wishlistItem->delete();

        // Chuyển hướng về trang giỏ hàng với thông báo
        return redirect()->route('user.home.wishlist')->with('success', 'Sản phẩm đã được xóa khỏi yêu thích.');
    }

    public function handleContactForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits_between:10,15',
            'message' => 'required|string',
        ]);

        Contact::create([
            'TenKH' => $validated['name'],
            'Email' => $validated['email'],
            'SDT' => $validated['phone'],
            'NoiDung' => $validated['message'],
            'TrangThai' => 0, // Mặc định là chưa xử lý
        ]);

        return response()->json(['success' => true, 'message' => 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.']);
    }
}