<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý bài viết";
        return view('admin.blog.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm bài viết";
        return view("admin.blog.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang cập nhật bài viết";
        return view("admin.blog.edit")->with("viewData",$viewData);
    }
}
