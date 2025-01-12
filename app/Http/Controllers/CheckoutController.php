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
            'order_note' => 'nullable|string|max:500',
        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $addressStreet = $request->input('address_street');
        $district = $request->input('district');
        $city = $request->input('city');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $note = $request->get('order_note');
        $paymentMethods = $request->input('check_method');
        // Kiểm tra và cập nhật thông tin khách hàng
        $user = Auth::user();
        $khachHang = KhachHang::where('MaTK', $user->MaTK)->first();

        if ($khachHang) {
            // Cập nhật thông tin khách hàng nếu đã có
            $khachHang->TenKH = $firstName . ' ' .  $lastName;
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
            'GhiChu' => $note,  
            'TrangThaiThanhToan' => 0, 
            'TrangThai' => 0, // Trạng thái đơn hàng
        ]);

        // Lưu các sản phẩm trong đơn hàng vào bảng chi tiết hóa đơn
        foreach ($cartItems as $item) {
            // Giảm số lượng sản phẩm trong kho
            $product = SanPham::find($item->MaSP);
            $product->SoLuong -= $item->soLuong;
            $product->save();

            // Thêm chi tiết đơn hàng vào bảng chi tiết hóa đơn
            ChiTietHoaDon::create([
                'MaHD' => $order->MaHD,
                'MaSP' => $item->MaSP,
                'SoLuong' => $item->soLuong,
                'DonGia' => $product->Gia,
            ]);
        }
    
        // Xóa giỏ hàng sau khi thanh toán thành công
        GioHang::where('MaTK', Auth::id())->delete();
        if($paymentMethods == 2){
            return redirect()->route('user.home.index')->with('success', 'Thanh toán thành công!');
        }
        if($paymentMethods == 1){
            return $this->momo_payment($order, $totalAmount);
        }
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo_payment($order, $totalAmount)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo cho đơn hàng ". $order->MaHD;
        $amount = $totalAmount;
        $orderId = $order->MaHD . '-' . time();
        $redirectUrl = route('user.cart.momo');
        $ipnUrl = "http://127.0.0.1:8000/";
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  
        return redirect()->to($jsonResult['payUrl']);
    }
    public function momo(Request $request)
    {
        $orderId = $request->input('orderId');
        $resultCode = $request->input('resultCode');
        $orderMaHD = explode('-', $orderId)[0];
        $order = HoaDon::find($orderId);

        if ($resultCode == 0) { // Thanh toán thành công
            $order->TrangThaiThanhToan = 1;
            $order->save();
            return redirect()->route('user.home.index')->with('success', 'Thanh toán thành công!');
        } else { // Thanh toán thất bại
            return redirect()->route('user.home.index')->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
        }
    }
}
