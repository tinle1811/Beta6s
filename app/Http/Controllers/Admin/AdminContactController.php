<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang quản lý liên hệ";
        $viewData['contacts'] = Contact::all();
        return view('admin.contact.index')->with('viewData', $viewData);
    }

    public function updateContact(Request $request)
    {
        // Tìm liên hệ theo id
        $contact = Contact::find($request->id);

        if ($contact) {
            // Thay đổi trạng thái hoặc thông tin khác theo yêu cầu
            $contact->status = $request->status;
            $contact->save();  // Lưu thay đổi

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
    public function delete(Request $request)
    {
        $contact = Contact::find($request->id);

        if ($contact) {
            // Cập nhật trạng thái thành 2
            $contact->status = 2;
            $contact->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
