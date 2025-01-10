<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $viewData['errors'] = "";
        $viewData['taikhoan'] = TaiKhoan::find(auth()->id());
        return view('user.home.contact')->with('viewData', $viewData);
    }
    public function wishlist()
    {
        $viewData['title']= "Trang yêu thích";
        return view('user.home.wishlist')->with('viewData',$viewData);
    }

    public function handleContactForm(Request $request)
{
    Contact::validate($request);
    // Tạo mới đối tượng Contact
    $newContact = new \App\Models\Contact();
    $newContact->setCustomerName($request->input('name')); 
    $newContact->setEmail($request->input('email'));       
    $newContact->setPhone($request->input('phone'));       
    $newContact->setContent($request->input('message'));   
    $newContact->setStatus(0);                             

    // Lưu vào cơ sở dữ liệu
    $newContact->save();

    return response()->json(['success' => true, 'message' => 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.']);
}

}
