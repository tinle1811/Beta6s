<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\SanPham;

class HomeController extends Controller
{
  
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang chủ";
        $viewData["DSSP-Slider"] = SanPham::limit(3)->get();
        $viewData["DSSP-BanChay"] = SanPham::join('chi_tiet_hoa_dons', 'san_phams.MaSP', '=', 'chi_tiet_hoa_dons.MaSP')
                                    ->join('hoa_dons', 'chi_tiet_hoa_dons.MaHD', '=', 'hoa_dons.MaHD')
                                    ->select('san_phams.HinhAnh', 'san_phams.Gia', 'san_phams.TenSP', 'san_phams.MoTa', DB::raw('SUM(chi_tiet_hoa_dons.SoLuong) as total_quantity'))
                                    ->where('hoa_dons.TrangThai', '1')
                                    ->groupBy('san_phams.HinhAnh', 'san_phams.Gia', 'san_phams.TenSP', 'san_phams.MoTa')
                                    ->orderBy('total_quantity', 'Desc')
                                    ->limit(10)
                                    ->get();
        $viewData["DSSP-NoiBat"] = SanPham::where('TrangThai',2)->get();
        $viewData["DSSP-Moi"] = SanPham::where('created_at', '>=', Carbon::now()->subDays(40))
                                ->orderBy('created_at', 'Desc')
                                ->limit(10)
                                ->get();
        return view('user.home.index')->with('viewData',$viewData);
    }

    public function show()
    {
        $viewData['title'] = "Trang chi tiết";
        return view('user.home.show')->with('viewData',$viewData);
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
