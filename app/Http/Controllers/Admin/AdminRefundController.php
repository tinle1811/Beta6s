<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRefundController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý phiếu trả hàng";
        return view('admin.refund.index')->with('viewData',$viewData);
    }
 
}
