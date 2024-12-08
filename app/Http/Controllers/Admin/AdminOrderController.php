<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang hoá đơn";
        return view('admin.order.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm hoá đơn";
        return view("admin.order.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang Cập nhật hoá đơn";
        return view("admin.order.edit")->with("viewData",$viewData);
    }
}
