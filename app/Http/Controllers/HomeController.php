<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
  
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang chủ";
        return view('user.home.index')->with('viewData',$viewData);
    }

    public function show()
    {
        $viewData['title'] = "Trang chi tiết";
        return view('user.home.show')->with('viewData',$viewData);
    }
    public function about()
    {
        $viewData['title'] = "Trang giới thiệu";
        return view('user.home.about')->with('viewData',$viewData);
    }
    public function contact()
    {
        $viewData['title'] = "Trang liên hệ";
        return view('user.home.contact')->with('viewData',$viewData);
    }
    public function wishlist()
    {
        $viewData['title']= "Trang yêu thích";
        return view('user.home.wishlist')->with('viewData',$viewData);
    }

    public function handleContactForm(Request $request)
{
    // Thực hiện validate dữ liệu
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|max:20',
        'message' => 'required',
    ]);

    // Tạo mới đối tượng Contact và lưu dữ liệu
    \App\Models\Contact::create([
        'TenKH' => $request->input('name'),
        'Email' => $request->input('email'),
        'SDT' => $request->input('phone'),
        'NoiDung' => $request->input('message'),
        'TrangThai' => 0
    ]);

    // Chuyển hướng hoặc hiển thị thông báo sau khi lưu
    return back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
}

}
