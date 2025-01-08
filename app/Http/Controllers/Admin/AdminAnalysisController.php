<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAnalysisController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản trị - thống kê";
        return view('admin.analysis.index')->with('viewData',$viewData);
    }
}
