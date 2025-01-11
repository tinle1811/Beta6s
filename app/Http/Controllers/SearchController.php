<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LoaiSanPham;

class SearchController extends Controller
{
    public $viewData = [];
    public function index(Request $request)
{
    $viewData['title'] = "Kết quả tìm kiếm";

    // Bắt đầu truy vấn sản phẩm
    $query = SanPham::join('loai_san_phams', 'san_phams.LoaiSP', '=', 'loai_san_phams.MaLSP')
                ->select('san_phams.*', 'loai_san_phams.TenLSP');

    // Nếu có loại sản phẩm trong request, lọc sản phẩm theo loại
    if ($request->has('loai_san_pham') && $request->input('loai_san_pham') != null) {
        $loai_san_pham = $request->input('loai_san_pham');
        $query->where('san_phams.LoaiSP', $loai_san_pham);

        $tenLoaiSanPham = LoaiSanPham::where('MaLSP', $loai_san_pham)->value('TenLSP');
        $viewData['loai_san_pham'] = $tenLoaiSanPham;
    }

    // Nếu có từ khóa tìm kiếm trong request, lọc sản phẩm theo tên
    if ($request->has('keyword') && $request->input('keyword') != null) {
        $keyword = $request->input('keyword');
        $query->where('san_phams.TenSP', 'like', '%' . $keyword . '%');
        $viewData['keyword'] = $keyword;
    }

    // Lấy tất cả sản phẩm sau khi lọc
    $viewData['products'] = $query->paginate(9);
    $viewData['resultCount'] = $viewData['products']->total();

    // Lấy tất cả loại sản phẩm
    $loaiSanPhams = LoaiSanPham::all();

    // Trả về view với dữ liệu tìm kiếm và danh sách loại sản phẩm
    return view('user.search.index', compact('loaiSanPhams', 'viewData'));
}
}
