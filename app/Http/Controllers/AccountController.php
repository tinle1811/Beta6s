<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public $viewData= [];
    public function index(){
        $viewData['title']= "Trang tài khoản";

        return view('user.account.index')->with('viewData',$viewData);
    }
}
