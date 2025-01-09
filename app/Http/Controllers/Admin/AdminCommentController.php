<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BinhLuan;
use App\Models\SanPham;
use App\Events\SanPhamUpdated;

class AdminCommentController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý bình luận";
        $viewData['comments'] = BinhLuan::with(['khachHang', 'sanPham'])->get();
        return view('admin.comment.index')->with('viewData', $viewData);
    }

    // public function updateStatus(Request $request)
    // {
    //    // Tìm comment theo MaBL thay vì dùng id
    //    $comment = BinhLuan::where('MaBL', $request->id)->first();
    //
    //    if ($comment) {
    //        // Thay đổi trạng thái
    //        $comment->TrangThai = $request->status;
    //       $comment->save();  // Lưu thay đổi
    //
    //       return response()->json(['success' => true]);
    //    }
    //
    //    return response()->json(['success' => false], 400);
    // }

    public function updateStatus(Request $request)
    {
        // Tìm comment theo MaBL thay vì dùng id
        $comment = BinhLuan::where('MaBL', $request->id)->first();

        if ($comment) {
            // Thay đổi trạng thái
            $comment->TrangThai = $request->status;
            $comment->save();  // Lưu thay đổi

            // Tìm sản phẩm liên quan đến bình luận
            $sanPham = SanPham::find($comment->MaSP);

            if ($sanPham) {
                // Tính toán điểm rating trung bình mới cho sản phẩm
                $danhGiaTB = BinhLuan::where('MaSP', $sanPham->MaSP)->where('TrangThai', 1)->avg('DanhGia');
                $sanPham->DiemRatingTB = round($danhGiaTB, 2);  // Làm tròn điểm rating trung bình

                // Lưu thay đổi vào sản phẩm
                $sanPham->save();

                // Gửi sự kiện để thông báo về sự thay đổi của sản phẩm
                //event(new SanPhamUpdated($sanPham));
                event(new SanPhamUpdated([
                    'MaSP' => $sanPham->MaSP,
                    'SoLuotYeuThich' => $sanPham->SoLuotYeuThich,
                    'SoLuotXem' => $sanPham->SoLuotXem,
                    'DiemRatingTB' => $sanPham->DiemRatingTB,
                ]));
                return response()->json(['success' => true]);
            }


            return response()->json(['success' => false, 'message' => 'Sản phẩm không tìm thấy.'], 400);
        }

        return response()->json(['success' => false, 'message' => 'Bình luận không tìm thấy.'], 400);
    }
    public function delete(Request $request)
    {
        $comment = BinhLuan::where('MaBL', $request->id)->first();

        if ($comment) {
            // Cập nhật TrangThai thành 2
            $comment->TrangThai = 2;
            $comment->save();

            // Tìm sản phẩm liên quan đến bình luận
            $sanPham = SanPham::find($comment->MaSP);

            if ($sanPham) {
                // Tính toán điểm rating trung bình mới cho sản phẩm
                $danhGiaTB = BinhLuan::where([
                    'MaSP' => $sanPham->MaSP,
                    'TrangThai' => 1
                ])->avg('DanhGia') ?? 0;
                $sanPham->DiemRatingTB = round($danhGiaTB, 2);  // Làm tròn điểm rating trung bình

                // Lưu thay đổi vào sản phẩm
                $sanPham->save();

                // Gửi sự kiện để thông báo về sự thay đổi của sản phẩm
                //event(new SanPhamUpdated($sanPham));
                event(new SanPhamUpdated([
                    'MaSP' => $sanPham->MaSP,
                    'SoLuotYeuThich' => $sanPham->SoLuotYeuThich,
                    'SoLuotXem' => $sanPham->SoLuotXem,
                    'DiemRatingTB' => $sanPham->DiemRatingTB,
                ]));
                return response()->json(['success' => true]);
            }


            return response()->json(['success' => false, 'message' => 'Sản phẩm không tìm thấy.'], 400);
        }

        return response()->json(['success' => false, 'message' => 'Bình luận không tìm thấy.'], 400);
    }
}
