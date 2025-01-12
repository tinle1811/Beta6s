<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KhachHang;

class AccountController extends Controller
{
    public $viewData= [];
    public function index(){
        $viewData['title']= "Trang tài khoản";

        // lấy id tài khoản người dùng
        $maTk = Auth::user()->MaTK;

        $viewData['ThongTinTaiKhoan'] = KhachHang::join('tai_khoans', 'khach_hangs.MaTK', '=', 'tai_khoans.MaTK')
                                                    ->where('tai_khoans.MaTK', $maTk)
                                                    ->first();

        return view('user.account.index')->with('viewData',$viewData);
    }
}
