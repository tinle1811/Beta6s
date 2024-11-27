<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData=[];
        $viewData['title'] = "Trang Blog";
        return view('user.blog.index')->with('viewData',$viewData);
    }
    public function show(){
        $viewData=[];
        $viewData['title']= "Trang chi tiết Blog";
        return View('user.blog.show')->with('viewData',$viewData);
    }
}
