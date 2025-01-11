<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Auth;


class HomeController extends Controller
{

    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang chủ";
        return view('user.home.index')->with('viewData', $viewData);
    }

    public function show()
    {
        $viewData['title'] = "Trang chi tiết";
        return view('user.home.show')->with('viewData', $viewData);
    }
    public function about()
    {
        $viewData['title'] = "Trang giới thiệu";
        return view('user.home.about')->with('viewData', $viewData);
    }
    public function contact()
    {
        $viewData['title'] = "Trang liên hệ";
        $viewData['errors'] = "";
        $viewData['taikhoan'] = TaiKhoan::find(auth()->id());
        return view('user.home.contact')->with('viewData', $viewData);
    }
    public function wishlist()
    {
        $viewData['title'] = "Trang yêu thích";
        return view('user.home.wishlist')->with('viewData', $viewData);
    }

    public function handleContactForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|digits_between:10,15',
            'message' => 'required|string',
        ]);

        Contact::create([
            'TenKH' => $validated['name'],
            'Email' => $validated['email'],
            'SDT' => $validated['phone']?? null,
            'NoiDung' => $validated['message'],
            'TrangThai' => 0, // Mặc định là chưa xử lý
        ]);

        return response()->json(['success' => true, 'message' => 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.']);
    }
}