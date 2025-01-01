<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SanPham;

class HomeController extends Controller
{
  
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang chủ";
        $viewData["DSSP-BanChay"] = SanPham::limit(10)->get();
        $viewData["DSSP-NoiBat"] = SanPham::skip(10)->limit(10)->get();
        return view('user.home.index')->with('viewData',$viewData);
    }
    public function show($slug)
    {
        $sanpham = SanPham::where('Slug', $slug)->firstOrFail(); 
        $relatedProducts = SanPham::where('LoaiSP', $sanpham->LoaiSP)
                               ->where('MaSP', '!=', $sanpham->MaSP)
                               ->limit(5) 
                               ->get();

        $viewData = [
            'title' => 'Chi tiết sản phẩm',
            'sanpham' => $sanpham, 
            'relatedProducts' => $relatedProducts
        ];

        return view('user.home.show', $viewData); 
    }

    public function about()
    {
        $viewData['title'] = "Trang giới thiệu";
        return view('user.home.about')->with('viewData',$viewData);
    }
    public function contact()
    {
        $viewData['title'] = "Trang liên hệ";
        return view('user.home.contact')->with('viewData',$viewData);
    }
    public function wishlist()
    {
        $viewData['title']= "Trang yêu thích";
        return view('user.home.wishlist')->with('viewData',$viewData);
    }
}
