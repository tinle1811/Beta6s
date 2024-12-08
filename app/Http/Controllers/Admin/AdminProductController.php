<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang Sản Phẩm";
        return view('admin.product.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm Sản Phẩm";
        return view("admin.product.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang sửa Sản Phẩm";
        return view("admin.product.edit")->with("viewData",$viewData);
    }
}
