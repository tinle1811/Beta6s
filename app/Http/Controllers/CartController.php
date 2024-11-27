<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public $viewData=[];
    public function index(){

        $viewData['title'] ="Trang giỏ hàng";

        return View('user.cart.index')->with('viewData',$viewData);
    }
    public function checkout(){
        $viewData['title'] = "Trang thanh toán";

        return View('user.cart.checkout')->with('viewData',$viewData);
    }
}
