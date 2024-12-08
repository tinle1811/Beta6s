<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCatagoryController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang loại sản phẩm";
        return view('admin.catagory.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm loại Sản Phẩm";
        return view("admin.catagory.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang Cập nhật loại Sản Phẩm";
        return view("admin.catagory.edit")->with("viewData",$viewData);
    }
}
