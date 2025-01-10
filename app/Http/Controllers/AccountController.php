<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public $viewData= [];
    public function index(){
        $viewData['title']= "Trang tài khoản";

        return view('user.account.index')->with('viewData',$viewData);
    }
    public function purchase(Request $request){
        $viewData['title'] = "Trang đơn mua";
        $validStatuses = [1,2,3,4];
        $type = (int)$request->query('type');


        if (in_array($type, $validStatuses)) {
            $hoaDons = HoaDon::where('TrangThai', $type)->get();
        } else {
            $hoaDons = HoaDon::all(); 
            $type = 0;  
            
            // Lọc đơn hàng theo trạng thái
        }
        return view('user.account.purchase',compact('viewData','hoaDons','type'));
    }
}
