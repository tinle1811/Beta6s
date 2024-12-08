<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang Loại Tài Khoản";
        return view('admin.role.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm loại tài khoản";
        return view("admin.role.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang Cập nhật loại tài khoản";
        return view("admin.role.edit")->with("viewData",$viewData);
    }
}
