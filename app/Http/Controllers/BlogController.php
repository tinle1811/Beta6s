<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
 
    public function index()
    {
        $viewData = [];
        $viewData['title'] = "Trang Blog";
        $viewData['blogs'] = Blog::paginate(4); // Hiển thị 4 bản ghi mỗi trang
        return view('user.blog.index')->with('viewData', $viewData);
    }    */

    public function index(Request $request)
    {
        $viewData = [];
        $viewData['title'] = "Trang Blog";

        // Nhận từ khóa tìm kiếm từ request
        $search = $request->input('search');

        // Truy vấn tìm kiếm
        $query = Blog::query();
        if ($search) {
            $query->where('TieuDe', 'like', '%' . $search . '%');
        }

        // Phân trang
        $viewData['blogs'] = $query->paginate(4); // Hiển thị 4 bài viết mỗi trang

        return view('user.blog.index')->with('viewData', $viewData);
    }
    public function show($id)
    {
        $viewData = [];
        $viewData['title'] = "Trang chi tiết Blog";
        $viewData['blogDetail'] = Blog::where('MaBV', $id)->firstOrFail();
        $noiDung = $viewData['blogDetail']->NoiDung; // Lấy nội dung từ cơ sở dữ liệu

        $noiDung = preg_replace_callback('/{{\s*asset\(\'([^\']+)\'\)\s*}}/', function ($matches) {
                return asset($matches[1]); // Trả về đường dẫn đầy đủ
            }, $noiDung);

        // Lưu nội dung đã thay đổi vào viewData
        $viewData['noiDung'] = $noiDung;

        return View('user.blog.show')->with('viewData', $viewData);
    }
}