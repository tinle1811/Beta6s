<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý Tài Khoản";
        return view('admin.account.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm tài khoản";
        return view("admin.account.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang cập nhật tài khoản";
        return view("admin.account.edit")->with("viewData",$viewData);
    }
}
