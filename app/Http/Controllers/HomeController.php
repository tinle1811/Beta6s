<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\BinhLuan;
use App\Models\SanPham;
use App\Models\YeuThich;

class HomeController extends Controller
{

    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang chủ";
        $viewData["DSSP-BanChay"] = SanPham::limit(10)->get();
        $viewData["DSSP-NoiBat"] = SanPham::skip(10)->limit(10)->get();
        return view('user.home.index')->with('viewData', $viewData);
    }

    public function show($slug)
    {
        $sanpham = SanPham::where('Slug', $slug)->firstOrFail();
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