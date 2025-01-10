<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public $viewData=[];
    public function index(){

        // kiểm tra người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('user.home.index')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
        }

        // lấy id tài khoản người dùng
        $maTk = Auth::user()->MaTK;

        //lấy dữ liệu từ giỏ hàng
        $gioHang = GioHang::where('MaTK', $maTk)->with('product')->get();

        $subtotal = $gioHang->sum(function ($item) {
            return $item->soLuong * $item->product->Gia;
        });
        $shipping = 0;
        $total = $subtotal + $shipping;
        $totalQuantity = GioHang::sum('soLuong');
        $viewData = [
            'title' =>"Giỏ hàng của bạn",
            'cartItems' => $gioHang,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'totalQuantity' => $totalQuantity
        ];
        return View('user.cart.index')->with('viewData',$viewData);
    }
    public function addToCart(Request $request, $id)
    {
        // kiểm tra người dùng đã đăng nhập chưa
        if(!Auth::check()){
            return redirect()->route('user.home.index')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
        }

        $userId = Auth::id();
        $productId = $id;

        //kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        $cartItems = GioHang::where('MaTK', $userId)->where('MaSP', $productId)->first();
        if($cartItems)
        {
            $cartItems->soLuong += 1;
            $cartItems->save();
        }else{
            GioHang::create([
                'MaTK'=>$userId,
                'MaSP'=>$productId,
                'soLuong'=>1,
            ]);
        }
        return redirect()->route('user.cart.index');
    }
    public function remove($id)
    {
        // Lấy thông tin sản phẩm trong giỏ hàng dựa trên ID
        $cartItem = GioHang::find($id);

        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$cartItem) {
            return redirect()->route('user.cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        // Xóa sản phẩm khỏi giỏ hàng
        $cartItem->delete();

        // Chuyển hướng về trang giỏ hàng với thông báo
        return redirect()->route('user.cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
    public function update(Request $request ,$id)
    {
        $cartItems = GioHang::find($id);

        if(!$cartItems){
            return redirect()->route('user.cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        $cartItems->soLuong = $request->input('soLuong');
        $cartItems->save();

        return redirect()->route('user.cart.index')->with('success', 'Giỏ hàng đã được cập nhật.');

    }
    
   
    
}
