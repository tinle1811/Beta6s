<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LoaiSanPham;

class SearchController extends Controller
{
    
    public function index()
    {
        $productPagi = SanPham::paginate(9); 
        $viewData = [
            'products' => $productPagi
        ];
        
        return view('user.search.index', compact('viewData'));
    }

    public function search(Request $request)
    {
       
        $query = SanPham::query();

        // Tìm kiếm theo từ khóa trong tên và mô tả
        if ($request->has('keyword') && $request->keyword) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('TenSP', 'like', "%{$keyword}%")
                  ->orWhere('MoTa', 'like', "%{$keyword}%");
            });
        }

        // Tìm kiếm theo danh mục (nếu có)
        if ($request->has('category') && $request->category) {
            $query->where('LoaiSP', $request->category);
        }

        // Tìm kiếm theo giá (nếu có)
        if ($request->has('min_price') && $request->min_price) {
            $query->where('Gia', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('Gia', '<=', $request->max_price);
        }
        
      
        $products = $query->paginate(9);

        
        $categories = LoaiSanPham::all();

        // Truyền dữ liệu vào view
        $viewData = [
            'title' => 'Trang Tìm Kiếm',
            'products' => $products,
            'categories' => $categories
        ];
        
        return view('user.search.index', compact('viewData'));
    }
}