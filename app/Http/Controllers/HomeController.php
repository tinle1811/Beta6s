<?php

namespace App\Http\Controllers;

//use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

use App\Models\SanPham;
use App\Models\YeuThich;
use App\Models\Blog;
use App\Events\SanPhamUpdated;

class HomeController extends Controller
{

    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang chủ";
        $viewData["DSSP-BanChay"] = SanPham::limit(10)->get();
        $viewData["DSSP-NoiBat"] = SanPham::skip(10)->limit(10)->get();
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
        // Tính tổng số lượt yêu thích của sản phẩm
        $tongYeuThich = YeuThich::where('MaSP', $productId)->count();

        // Lấy thông tin sản phẩm cần cập nhật
        $sanpham = SanPham::find($productId);
        if ($sanpham) {
            $sanpham->SoLuotYeuThich = $tongYeuThich; // Cập nhật số lượt yêu thích
            $sanpham->save(); // Lưu lại thay đổi
        }

        // Phát sự kiện Pusher với dữ liệu cập nhật
        event(new SanPhamUpdated([
            'MaSP' => $sanpham->MaSP,
            'SoLuotYeuThich' => $sanpham->SoLuotYeuThich,
            'SoLuotXem' => $sanpham->SoLuotXem,
            'DiemRatingTB' => $sanpham->DiemRatingTB,
        ]));
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

        $productId = $wishlistItem->MaSP;

        // Xóa sản phẩm khỏi giỏ hàng
        $wishlistItem->delete();

        // Tính tổng số lượt yêu thích của sản phẩm
        $tongYeuThich = YeuThich::where('MaSP', $productId)->count();

        // Lấy thông tin sản phẩm cần cập nhật
        $sanpham = SanPham::find($productId);
        if ($sanpham) {
            $sanpham->SoLuotYeuThich = $tongYeuThich; // Cập nhật số lượt yêu thích
            $sanpham->save(); // Lưu lại thay đổi
        }

        // Phát sự kiện Pusher với dữ liệu cập nhật
        event(new SanPhamUpdated([
            'MaSP' => $sanpham->MaSP,
            'SoLuotYeuThich' => $sanpham->SoLuotYeuThich,
            'SoLuotXem' => $sanpham->SoLuotXem,
            'DiemRatingTB' => $sanpham->DiemRatingTB,
        ]));

        // Chuyển hướng về trang giỏ hàng với thông báo
        return redirect()->route('user.home.wishlist')->with('success', 'Sản phẩm đã được xóa khỏi yêu thích.');
    }
}
