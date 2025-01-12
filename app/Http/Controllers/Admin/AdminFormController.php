<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFormController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý phiếu nhập";
        return view('admin.form.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm phiếu nhập";
        return view("admin.form.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang cập nhật phiếu nhập";
        return view("admin.form.edit")->with("viewData",$viewData);
    }
}
