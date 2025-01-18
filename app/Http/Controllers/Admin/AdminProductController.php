<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LoaiSanPham;

class AdminProductController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $products = SanPham::with('loaiSanPham')->orderBy('created_at', 'desc')->limit(10)->get();

        $viewData = [
            'title' => 'Danh sách sản phẩm',
            'products' => $products,
        ];

        return view('admin.product.index', $viewData);
    }
    public function create()
    {
        $categories = LoaiSanPham::where('TrangThai', 1)->get();
        $viewData = [
            'title' => 'Thêm sản phẩm mới',
            'categories' => $categories,
        ];
        return view('admin.product.create', $viewData);
    }
    public function createPost(Request $request)
    {

        $validatedData = $request->validate([
            'TenSP' => 'required|string|max:255',
            'Gia' => 'required|numeric|min:0',
            'SoLuong' => 'required|integer|min:0',
            'MoTa' => 'nullable|string',
            'Slug' => 'string|unique:san_phams,Slug', // Đảm bảo Slug là duy nhất
            'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Kiểm tra file ảnh
            'LoaiSP' => 'required|string',
            'TrangThai' => 'required|boolean',
        ]);

        // Tạo mới sản phẩm
        $sanpham = new SanPham();
        $sanpham->TenSP = $validatedData['TenSP'];
        $sanpham->Gia = $validatedData['Gia'];
        $sanpham->SoLuong = $validatedData['SoLuong'];
        $sanpham->MoTa = $validatedData['MoTa'];
        $sanpham->Slug = Str::slug($validatedData['TenSP']); // Tạo Slug tự động
        $sanpham->LoaiSP = $validatedData['LoaiSP'];
        $sanpham->TrangThai = $validatedData['TrangThai'];


        if ($request->hasFile('HinhAnh')) {
            $imagePath = $request->file('HinhAnh')->store('product_images', 'public');
            $sanpham->HinhAnh = $imagePath;
        } else {
            $sanpham->HinhAnh = null;
        }


        $sanpham->save();


        return redirect()->route('admin.product')->with('success', 'Sản phẩm đã được thêm thành công.');
    }
    public function edit($MaSP)
    {
        $product = SanPham::find($MaSP);

        if (!$product) {
            return redirect()->route('admin.product.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        $categories = LoaiSanPham::where('TrangThai', 1)->get();
        $viewData = [
            'title' => "Cập nhật sản phẩm",
            'product' => $product,
            'categories' => $categories,
        ];
        return view('admin.product.edit')->with("viewData", $viewData);
    }
    public function update(Request $request, $MaSP)
    {
        $validatedData = $request->validate([
            'TenSP' => 'required|string|max:255',
            'Gia' => 'required|numeric|min:0',
            'SoLuong' => 'required|integer|min:0',
            'LoaiSP' => 'required|exists:loai_san_phams,MaLSP',
            'TrangThai' => 'required|boolean',
            'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = SanPham::find($MaSP);

        if (!$product) {
            return redirect()->route('admin.product.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        $product->TenSP = $validatedData['TenSP'];
        $product->Gia = $validatedData['Gia'];
        $product->SoLuong = $validatedData['SoLuong'];
        $product->LoaiSP = $validatedData['LoaiSP'];
        $product->TrangThai = $validatedData['TrangThai'];


        if ($request->hasFile('HinhAnh')) {
            $imagePath = $request->file('HinhAnh')->store('products', 'public');
            $product->HinhAnh = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.product')->with('success', 'Cập nhật sản phẩm thành công.');
    }
    public function destroy($id)
    {

        $product = SanPham::find($id);

        if (!$product) {
            return redirect()->route('admin.product')->with('error', 'Sản phẩm không tồn tại.');
        }

        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Sản phẩm đã được xóa mềm thành công.');
    }

    public function search(Request $request)
    {
        $query = SanPham::query();

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->join('loai_san_phams', 'san_phams.LoaiSP', '=', 'loai_san_phams.MaLSP')
                ->where('TenSP', 'like', "%{$search}%")
                ->orWhere('MaSP', 'like', "%{$search}%")
                ->orWhere('MoTa', 'like', "%{$search}%")
                ->orWhere('Gia', 'like', "%{$search}%")
                ->orWhere('loai_san_phams.TenLSP', 'like', "%{$search}%");
        }

        // Lấy danh sách sản phẩm
        $products = $query->get();

        return view('admin.product.index', compact('products'))->with('title', 'Danh sách sản phẩm');
    }
}
