<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SanPham;

class CartController extends Controller
{
    public $viewData=[];
    public function index(){

        $viewData['title'] ="Trang giỏ hàng";

        //$viewData['cartItems'] = GioHang::with('product')->where('MaTK', Auth::id())->get();
        $viewData['cartItems'] = GioHang::with('product')->where('MaTK',1)->get();
        return View('user.cart.index')->with('viewData',$viewData);
    }
    public function checkout(){
        $viewData['title'] = "Trang thanh toán";

        return View('user.cart.checkout')->with('viewData',$viewData);
    }
    public function addToCart(Request $request)
    {
        $request->validate([
            'MaSP' => 'required|exists:san_phams,MaSp',
            'soLuong' => 'required|integer|min:1'
        ]);

        $userId = 1;
        $productId = $request->input('MaSP');

        //kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        $cartItems = GioHang::where('MaTK', $userId)->where('MaSP', $productId)->first();
        if($cartItems)
        {
            $cartItems->soLuong += 1;
            $cartItems->save();
        }else
        {
            GioHang::create([
                'MaTK'=>$userId,
                'MaSP'=>$productId,
                'soLuong'=>1
            ]);
        }
        return redirect()->route('user.cart.index');
    }
}
