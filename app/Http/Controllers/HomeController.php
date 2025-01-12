<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\BinhLuan;
use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\YeuThich;
use App\Models\Blog;
use App\Events\SanPhamUpdated;
use App\Http\Controllers\Cacbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;       // For database queries
use Illuminate\Support\Carbon;          // For date and time handling
use Illuminate\Support\Facades\Log;     // For logging

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
        $comments = BinhLuan::with('khachHang') // Lấy bình luận cùng thông tin khách hàng
                ->where('MaSP', $sanpham->MaSP)
                ->get();

        // Tính toán điểm đánh giá trung bình
        $averageRating = $comments->avg('DanhGia');  

        $viewData = [
            'title' => 'Chi tiết sản phẩm',
            'sanpham' => $sanpham,
            'relatedProducts' => $relatedProducts,
            'comments' => $comments,
            'averageRating' => $averageRating,
        ];
       
        return view('user.home.show')->with('viewData', $viewData);
    }
        public function storeRating(Request $request, $slug)
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đánh giá.');
        }

        // Lấy thông tin sản phẩm từ slug
        $sanpham = SanPham::where('Slug', $slug)->firstOrFail();

        // Xử lý lưu bình luận và đánh giá
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
        ]);

        // Lưu bình luận
        BinhLuan::create([
            'MaSP' => $sanpham->MaSP,
            'MaKH' => Auth::user()->MaTK,  
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        // Tính lại rating trung bình của sản phẩm
        $averageRating = BinhLuan::where('MaSP', $sanpham->MaSP)->avg('rating');
        $sanpham->update(['average_rating' => $averageRating]);

        return redirect()->route('user.product.show', $sanpham->Slug)->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm.');
    }

    public function about()
    {
        $viewData['title'] = "Trang giới thiệu";
        return view('user.home.about')->with('viewData', $viewData);
    }
    public function contact()
    {
        $viewData['title'] = "Trang liên hệ";
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
}
