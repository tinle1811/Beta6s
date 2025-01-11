<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThongTinWebsite; // Đảm bảo đã import model


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminInfoWebController extends Controller
{
    public $viewData = [];
    public function index()
    {
        // Lấy dữ liệu thông tin website từ bảng
        $websiteInfo = ThongTinWebsite::first(); // Lấy 1 bản ghi đầu tiên

        // Truyền dữ liệu vào view
        $viewData['title'] = "Trang thông tin website";
        $viewData['websiteInfo'] = $websiteInfo; // Gửi thông tin website vào view

        return view('admin.infoweb.index')->with('viewData', $viewData);
    }
    public function create()
    {
        $viewData['title'] = "Trang thêm thông tin website";
        return view("admin.infoweb.create")->with("viewData", $viewData);
    }

    public function edit()
    {
        // Lấy dữ liệu thông tin website từ bảng
        $websiteInfo = ThongTinWebsite::first(); // Lấy 1 bản ghi đầu tiên

        // Truyền dữ liệu vào view
        $viewData['title'] = "Chỉnh sửa thông tin website";
        $viewData['websiteInfo'] = $websiteInfo; // Gửi thông tin website vào view

        return view('admin.infoweb.edit')->with('viewData', $viewData);
    }
    public function update(Request $request)
    {
        // Validate input
        $request->validate([
            'logo' => 'image|mimes:jpg,jpeg,png|max:2048',
            'address' => 'required|string|max:255',
            'hotline' => 'required|string|max:20',
            'email_support' => 'required|email|max:255',
            'facebook' => 'url|max:255',
            'instagram' => 'url|max:255',
            'twitter' => 'url|max:255',
        ]);

        // Lấy thông tin website đầu tiên (nếu chỉ có 1 bản ghi)
        $websiteInfo = ThongTinWebsite::first();

        // Cập nhật logo nếu có file mới
        if ($request->hasFile('logo')) {
            // Xóa logo cũ nếu có
            if ($websiteInfo && $websiteInfo->logo && Storage::exists('public/logos/' . $websiteInfo->logo)) {
                Storage::delete('public/logos/' . $websiteInfo->logo);
            }

            // Lưu logo mới với slug
            // $logoPath = $request->file('logo')->storeAs('logos', Str::slug($request->address) . '.' . $request->file('logo')->extension(), 'public');
            // $websiteInfo->logo = basename($logoPath);

            // Lưu logo mới với tên cố định 'logo-web'
            $logoPath = $request->file('logo')->storeAs('logos', 'logo-web.' . $request->file('logo')->extension(), 'public');

            // Cập nhật tên file logo trong cơ sở dữ liệu
            $websiteInfo->logo = 'logo-web.' . $request->file('logo')->extension();
        } else {
            // Nếu không có file mới được chọn, giữ lại logo cũ trong DB
            if ($websiteInfo && $websiteInfo->logo) {
                // Không thay đổi logo nếu không có file mới
                $websiteInfo->logo = $websiteInfo->logo;
            }
        }

        // Cập nhật các thông tin khác
        $websiteInfo->address = $request->address;
        $websiteInfo->hotline = $request->hotline;
        $websiteInfo->email = $request->email_support;
        $websiteInfo->facebook = $request->facebook;
        $websiteInfo->instagram = $request->instagram;
        $websiteInfo->twitter = $request->twitter;

        // Lưu thông tin
        $websiteInfo->save();

        // Trả về thông báo thành công và chuyển hướng
        return redirect()->route('admin.infoweb')->with('success', 'Thông tin website đã được cập nhật thành công.');
    }
}