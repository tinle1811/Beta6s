<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\KhachHang;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\PhuongThucThanhToan;
use App\Events\SanPhamUpdated;

class CheckoutController extends Controller
{
    public function checkout() {
        $viewData['title'] = "Trang thanh toán";
        $maTk = Auth::user()->MaTK;
        
        // Lấy thông tin giỏ hàng của người dùng
        $cartItems = GioHang::where('MaTK', Auth::id())->get();
        $gioHang = GioHang::where('MaTK', $maTk)->with('product')->get();
        
        $paymentMethods = PhuongThucThanhToan::where('TrangThai', 1)->get();
        //lấy thông tin người dùng hiện tại
        $user = Auth::user();
        $khachHang = KhachHang::where('MaTK', $user->MaTK)->first();
        // Kiểm tra nếu giỏ hàng trống
        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }
        $subtotal = $gioHang->sum(function ($item) {
            return $item->soLuong * $item->product->Gia;
        });
    
        // Hiển thị trang thanh toán với thông tin giỏ hàng
        return view('user.cart.checkout', compact('cartItems','subtotal','viewData','user','paymentMethods','khachHang'));
    }
    
    public function payment(Request $request) {
        $validateForm = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address_street' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            'email' => 'required|email|max:255',
            'address_checkbox' => 'nullable',
            'first_name_other' => 'required_if:address_checkbox,1|string|max:255',
            'last_name_other' => 'required_if:address_checkbox,1|string|max:255',
            'address_street_other' => 'required_if:address_checkbox,1|string|max:255',
            'district_other' => 'required_if:address_checkbox,1|string|max:255',
            'city_other' => 'required_if:address_checkbox,1|string|max:255',
            'phone_other' => 'required_if:address_checkbox,1|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            'email_other' => 'required_if:address_checkbox,1|email|max:255',
            'order_note' => 'nullable|string|max:500',
        ]);

       
        if ($request->input('address_checkbox') == 1) {
            // Nếu người dùng muốn nhập địa chỉ của người khác
            $firstName = $request->input('first_name_other');
            $lastName = $request->input('last_name_other');
            $addressStreet = $request->input('address_street_other');
            $district = $request->input('district_other');
            $city = $request->input('city_other');
            $phone = $request->input('phone_other');
            $email = $request->input('email_other');
        }
        else{
            $firstName = $request->input('first_name');
            $lastName = $request->input('last_name');
            $addressStreet = $request->input('address_street');
            $district = $request->input('district');
            $city = $request->input('city');
            $phone = $request->input('phone');
            $email = $request->input('email');
        }
        $note = $request->get('order_note');
        $paymentMethods = $request->input('check_method');

        // Kiểm tra và cập nhật thông tin khách hàng
        $user = Auth::user();
        $khachHang = KhachHang::where('MaTK', $user->MaTK)->first();

        if ($khachHang) {
            // Cập nhật thông tin khách hàng nếu đã có
            $khachHang->TenKH = $firstName . ' ' . $lastName;
            $khachHang->SDT = $phone;
            $khachHang->DiaChi = $addressStreet . ', ' . $district . ', ' . $city;
            $khachHang->save();
        } else {
            // Thêm mới khách hàng nếu chưa có
            KhachHang::create([
                'MaTK' => $user->MaTK,
                'TenKH' => $firstName . ' ' . $lastName,
                'SDT' => $phone,
                'DiaChi' => $addressStreet . ', ' . $district . ', ' . $city,
            ]);
        }
        // Kiểm tra giỏ hàng của người dùng
        $cartItems = GioHang::where('MaTK', Auth::id())->get();

        // Tính tổng tiền giỏ hàng
        $totalAmount = $cartItems->sum(function($item) {
            return $item->soLuong * $item->product->Gia;
        });

        // Tạo hóa đơn trong bảng hoa_dons
        $order = HoaDon::create([
            'MaKH' => Auth::id(),  
            'ThanhToan' => $paymentMethods, 
            'TongTien' => $totalAmount,
            'GhiChu' => $note,  // Ghi chú từ form
            'TrangThaiThanhToan' => 0, 
            'TrangThai' => 0, // Trạng thái đơn hàng
        ]);

        // Lưu các sản phẩm trong đơn hàng vào bảng order_details
        foreach ($cartItems as $item) {
            // Giảm số lượng sản phẩm trong kho
            $product = SanPham::find($item->MaSP);
            $product->SoLuong -= $item->soLuong;
            $product->save();

            // Thêm chi tiết đơn hàng vào bảng order_details
            ChiTietHoaDon::create([
                'MaHD' => $order->MaHD,
                'MaSP' => $item->MaSP,
                'SoLuong' => $item->soLuong,
                'DonGia' => $product->Gia,
            ]);

            event(new SanPhamUpdated([
                'MaSP' => $product->MaSP,
                'SoLuotYeuThich' => $product->SoLuotYeuThich,
                'SoLuotXem' => $product->SoLuotXem,
                'DiemRatingTB' => $product->DiemRatingTB,
                'SoLuongTon' => $product->SoLuong,
            ]));
        }
    
        // Xóa giỏ hàng sau khi thanh toán thành công
        GioHang::where('MaTK', Auth::id())->delete();
    
        return redirect()->route('user.home.index')->with('success', 'Thanh toán thành công!');
    }
}