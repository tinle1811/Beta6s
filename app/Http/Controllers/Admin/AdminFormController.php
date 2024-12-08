<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFormController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Phiếu Nhập";
        return view('admin.form.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm Phiếu Nhập";
        return view("admin.form.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang Cập nhật Phiếu Nhập";
        return view("admin.form.edit")->with("viewData",$viewData);
    }
}
