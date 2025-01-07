<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;

class SearchController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['products'] = SanPham::paginate(9);
        $viewData['title'] = "Trang tìm kiếm";

        return view('user.search.index')->with('viewData',$viewData);
    }
}
