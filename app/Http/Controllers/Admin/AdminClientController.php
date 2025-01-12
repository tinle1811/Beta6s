<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý thông tin khách hàng";
        return view('admin.client.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm thông tin khách hàng";
        return view("admin.client.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang cập nhật thông tin khách hàng";
        return view("admin.client.edit")->with("viewData",$viewData);
    }
}
