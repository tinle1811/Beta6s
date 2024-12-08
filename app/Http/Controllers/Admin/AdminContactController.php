<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang Liên Hệ";
        return view('admin.contact.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm Liên Hệ";
        return view("admin.contact.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang Cập nhật Liên Hệ";
        return view("admin.contact.edit")->with("viewData",$viewData);
    }
}
