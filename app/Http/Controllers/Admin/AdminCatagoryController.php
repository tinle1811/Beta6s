<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiSanPham;

class AdminCatagoryController extends Controller {
    public $viewData = [];

    public function index() {
        $viewData[ 'title' ] = 'Trang loại sản phẩm';
        $viewData[ 'categorys' ] = LoaiSanPham::paginate(10);
        return view( 'admin.catagory.index' )->with( 'viewData', $viewData );
    }

    public function create() {
        $viewData[ 'title' ] = 'Trang thêm loại Sản Phẩm';
        return view( 'admin.catagory.create' )->with( 'viewData', $viewData );
    }

    public function createSubmitForm( Request $request ) {
        $request->validate( [
            'categoryName' => 'required|max:255',
        ] );
        $newCategory = new LoaiSanPham();
        $newCategory->setCategoryName( $request->input( 'categoryName' ) );
        $newCategory->setCategoryStatus( 1 );
        $newCategory->save();
        return redirect()->action( [ AdminCatagoryController::class, 'index' ] )->with('success', 'Thêm loại sản phẩm thành công!');
    }

    public function edit( $id ) {
        $viewData[ 'title' ] = 'Trang Cập nhật loại Sản Phẩm';
        $viewData[ 'category' ] = LoaiSanPham::findOrFail( $id );
        return view( 'admin.catagory.edit' )->with( 'viewData', $viewData );
    }

    public function editSubmitForm( Request $request, $id ) {
        $request->validate( [
            'categoryName' => 'required|max:255',
        ] );
        $category = LoaiSanPham::findOrFail( $id );
        $category->setCategoryName( $request->input( 'categoryName' ) );
        $category->setCategoryStatus( $request->input( 'categoryStatus' ) );
        $category->save();
        return redirect()->action( [ AdminCatagoryController::class, 'index' ] )->with('success', 'Cập nhật loại sản phẩm thành công!');
    }

    public function delete( $id ) {
        $category = LoaiSanPham::findOrFail( $id );
        $category->setCategoryStatus( 0 );
        $category->save();
        return response()->json([
            'success' => 'Loại sản phẩm đã được xóa.',
            'newStatus' => $category->getCategoryStatus()
        ]);
    }

        public function search(Request $request)
    {
        $query = LoaiSanPham::query();

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('MaLSP', 'like', "%{$search}%")
                ->orWhere('TenLSP', 'like', "%{$search}%");

            // Kiểm tra nếu có lọc theo trạng thái hoạt động
            if ($search == 'Hoạt động') {
                $query->orWhere('TrangThai', 1); 
            } elseif ($search == 'Không hoạt động') {
                $query->orWhere('TrangThai', 0); 
            }
        }

        // Phân trang kết quả, mặc định 10 sản phẩm mỗi trang
        $viewData['categorys'] = $query->paginate(10); 
        $viewData['title'] = 'Trang loại sản phẩm';

        // Trả về view với dữ liệu tìm kiếm và tiêu đề
        return view('admin.catagory.index', compact('viewData'));
    }
}