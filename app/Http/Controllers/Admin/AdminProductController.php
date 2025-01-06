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
        $products = SanPham::orderBy('created_at', 'desc')->limit(10)->get();

        $viewData = [
            'title' => 'Danh sách sản phẩm',
            'products' => $products,
        ];

        return view('admin.product.index', $viewData);
    }
    public function create(){
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

        // Kiểm tra nếu có ảnh thì upload
        if ($request->hasFile('HinhAnh')) {
            $imagePath = $request->file('HinhAnh')->store('product_images', 'public');
            $sanpham->HinhAnh = $imagePath;
        } else {
            $sanpham->HinhAnh = null; // Nếu không có ảnh thì gán giá trị NULL
        }

        // Lưu sản phẩm vào cơ sở dữ liệu
        $sanpham->save();

        // Quay lại trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('admin.product')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    public function edit(){
        $viewData['title'] = "Trang sửa Sản Phẩm";
        return view("admin.product.edit")->with("viewData",$viewData);
    }
    public function delete(){
        $viewData['title'] = "Trang Xoá Sản Phẩm";
        return view("admin.product.delete")->with("viewData",$viewData);
    }
}
