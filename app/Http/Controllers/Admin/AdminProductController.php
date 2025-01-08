<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý sản phẩm";
        return view('admin.product.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm sản phẩm";
        return view("admin.product.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang cập nhật sản phẩm";
        return view("admin.product.edit")->with("viewData",$viewData);
    }
}
