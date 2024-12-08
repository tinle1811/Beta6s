<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang Blog";
        return view('admin.blog.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm Blog";
        return view("admin.blog.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang Cập nhật Blog";
        return view("admin.blog.edit")->with("viewData",$viewData);
    }
}
