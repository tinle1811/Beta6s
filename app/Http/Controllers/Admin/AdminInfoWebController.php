<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminInfoWebController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang thông tin website";
        return view('admin.infoweb.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm thông tin website";
        return view("admin.infoweb.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang Cập nhật thông tin website";
        return view("admin.infoweb.edit")->with("viewData",$viewData);
    }
}
