<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

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

    public function show()
    {
        $viewData['title'] = "Trang chi tiết";
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
        if(!Auth::check()){
            return redirect()->route('user.home.index')->with('error','Vui lòng đăng nhập để thêm vào yêu thích');
        }
        $maTk = Auth::user()->MaTK;

        $yeuThich = YeuThich::where('MaTK', $maTk)->with('product')->get();

        $viewData = [
            'title'=>"Trang yêu thích",
            'yeuThich'=>$yeuThich,
        ];
        return view('user.home.wishlist')->with('viewData', $viewData);
    }
    public function addToWishlist(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('user.home.index')->with('error','Vui lòng đăng nhập để thêm vào yêu thích');
        }

        $validated = $request->validate([
            'MaSP' => 'required|exists:san_phams,MaSP',
        ]);

        $maTk = Auth::user()->MaTK;
        $productId = $validated['MaSP'];

        $wishlistItems = YeuThich::where('MaTK', $maTk)->where('MaSP', $productId)->first();
        if(!$wishlistItems){
            YeuThich::create([
                'MaTK'=>$maTk,
                'MaSP'=>$productId,
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