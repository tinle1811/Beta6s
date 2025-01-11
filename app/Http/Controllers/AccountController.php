<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BinhLuan;

class AccountController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang tài khoản";

        return view('user.account.index')->with('viewData', $viewData);
    }
    public function purchase(Request $request)
    {
        $viewData['title'] = "Trang đơn mua";
        $validStatuses = [1, 2, 3, 4];
        $type = (int)$request->query('type');


        if (in_array($type, $validStatuses)) {
            $hoaDons = HoaDon::where('TrangThai', $type)->get();
        } else {
            $hoaDons = HoaDon::all();
            $type = 0;

            // Lọc đơn hàng theo trạng thái
        }
        return view('user.account.purchase', compact('viewData', 'hoaDons', 'type'));
    }
    public function orderlist(Request $request)
    {
        $viewData['title'] = "Trang đơn mua";
        // Lấy tài khoản đã đăng nhập
        $user = Auth::user();

        // Lấy danh sách hóa đơn theo tài khoản
        //$hoaDons = HoaDon::where('MaKH', $user->MaTK)->get();

        // Trả về View với dữ liệu hóa đơn
        //return view('user.orders', ['hoaDons' => $hoaDons]);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem thông tin.');
        }
        // Lấy danh sách hóa đơn theo tài khoản
        //$hoaDons = HoaDon::where('MaKH', $user->MaTK)->get();
        $hoaDons = HoaDon::where('MaKH', $user->MaTK)
            ->with(['chiTietHoaDons.sanPham', 'binhLuans'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('user.account.orderlist', [
            'user' => $user,
            'hoaDons' => $hoaDons,
            'viewData' => $viewData,
        ]);
    }

    public function addReview(Request $request)
    {
        $validated = $request->validate([
            'reviews' => 'required|array',
            'reviews.*.maHD' => 'required|integer',
            'reviews.*.maSP' => 'required|integer',
            'reviews.*.rating' => 'required|integer|min:1|max:5',
            'reviews.*.comment' => 'required|string|max:1000',
        ]);

        foreach ($validated['reviews'] as $review) {
            BinhLuan::create([
                'MaHD' => $review['maHD'],
                'MaKH' => Auth::user()->MaTK,
                'MaSP' => $review['maSP'],
                'DanhGia' => $review['rating'],
                'NoiDung' => $review['comment'],
                'TrangThai' => 0, // chưa duyệt
                'created_at' => now(),
            ]);
        }

        // Trả về phản hồi thành công
        return response()->json(['success' => true]);
    }
}