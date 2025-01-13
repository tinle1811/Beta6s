<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use App\Models\PhuongThucThanhToan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SanPham;

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

        $paymentMethods = PhuongThucThanhToan::where('TrangThai', 1)->get();
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
        return View('user.cart.index',compact('viewData','paymentMethods'));
    }
    public function addToCart(Request $request, $id)
    {
        // kiểm tra người dùng đã đăng nhập chưa
        if(!Auth::check()){
            return redirect()->route('user.home.index')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
        }

        $userId = Auth::id();
        $productId = $id;
        $quantity = $request->input('soLuong',1);

        $getQuantity = SanPham::where('MaSP', $productId)->value('SoLuong');

        if($quantity > $getQuantity){
            return redirect()->back()->with('error', 'Số lượng tồn kho không đủ! Số lượng tồn kho hiện tại '.$getQuantity);
        }
        //kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        $cartItems = GioHang::where('MaTK', $userId)->where('MaSP', $productId)->first();
        if ($cartItems) {
            if(($cartItems->soLuong + $quantity) <= $getQuantity)
            {
                $cartItems->soLuong += $quantity;
                $cartItems->save();
            } else {
                return redirect()->back()->with('error', 'Số lượng tồn kho không đủ! Số lượng tồn kho hiện tại ' . $getQuantity);
            }
        } else {
            GioHang::create([
                'MaTK' => $userId,
                'MaSP' => $productId,
                'soLuong' => $quantity,
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
        $getQuantity = SanPham::where('MaSP', $id)->value('SoLuong');

        if(!$cartItems){
            return redirect()->route('user.cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        $quantity = $request->input('soLuong');

        if($quantity <= $getQuantity)
        {
            $cartItems->soLuong = $quantity;
            $cartItems->save();
        } else {
            return redirect()->back()->with('error', 'Số lượng tồn kho không đủ! Số lượng tồn kho hiện tại:'. $getQuantity);
        }

        return redirect()->route('user.cart.index')->with('success', 'Giỏ hàng đã được cập nhật.');

    }
    public function paymentMethod(Request $request)
    {
        if ($request->has('paymentMethod')) {
            // Lưu phương thức thanh toán vào session
            session(['paymentMethod' => $request->paymentMethod]);
        }
        return redirect()->route('user.cart.index');
    }
    public function clearCart()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('user.home.index')->with('error', 'Vui lòng đăng nhập để xóa giỏ hàng');
        }

        // Lấy id tài khoản người dùng
        $maTk = Auth::user()->MaTK;

        // Xóa tất cả sản phẩm trong giỏ hàng của người dùng
        GioHang::where('MaTK', $maTk)->delete();

        // Chuyển hướng về trang giỏ hàng với thông báo thành công
        return redirect()->route('user.cart.index')->with('success', 'Giỏ hàng đã được xóa.');
    }
}