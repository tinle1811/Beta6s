<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BinhLuan;

class AdminCommentController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý bình luận";
        $viewData['comments'] = BinhLuan::with(['khachHang', 'sanPham'])->get();
        return view('admin.comment.index')->with('viewData', $viewData);
    }

    public function updateStatus(Request $request)
    {
        // Tìm comment theo MaBL thay vì dùng id
        $comment = BinhLuan::where('MaBL', $request->id)->first();

        if ($comment) {
            // Thay đổi trạng thái
            $comment->TrangThai = $request->status;
            $comment->save();  // Lưu thay đổi

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
    public function delete(Request $request)
    {
        $comment = BinhLuan::where('MaBL', $request->id)->first();

        if ($comment) {
            // Cập nhật TrangThai thành 2
            $comment->TrangThai = 2;
            $comment->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}