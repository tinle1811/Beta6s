<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý bình luận";
        return view('admin.comment.index')->with('viewData',$viewData);
    }
    public function create(){
        $viewData['title'] = "Trang thêm bình luận";
        return view("admin.comment.create")->with("viewData",$viewData);
    }
    public function edit(){
        $viewData['title'] = "Trang cập nhật bình luận";
        return view("admin.comment.edit")->with("viewData",$viewData);
    }
}
