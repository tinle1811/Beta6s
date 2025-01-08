<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPayController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý hình thức thanh toán";
        return view('admin.pay.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm hình thức thanh toán";
        return view("admin.pay.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang cập nhật hình thức thanh toán";
        return view("admin.pay.edit")->with("viewData",$viewData);
    }
}
