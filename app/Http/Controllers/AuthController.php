<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang đăng ký";
        return view('user.auth.register')->with('viewData', $viewData);
    }
    // Phương thức đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'TenDN' => 'required|unique:tai_khoans',
            'Email' => 'required|email|unique:tai_khoans',
            'Password' => 'required|min:6',
        ]);

        $user = TaiKhoan::create([
            'TenDN' => $request->TenDN,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'LoaiTK' => 1,
            'TrangThai' => 1,
            'remember_token' => \Str::random(60), // Thêm remember_token
        ]);

        // Chuyển hướng về trang chủ với thông báo chào mừng
        return redirect('/')->with('success', 'Xin chào ' . $user->TenDN . '!');
    }
}
