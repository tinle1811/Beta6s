<?php

namespace App\Providers;

use App\Models\GioHang;
use App\Models\LoaiSanPham;
use App\Models\YeuThich;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sử dụng View Composer để truyền dữ liệu vào tất cả các view
        View::composer('user.layouts.header', function ($view) {
            $viewData = [];
            $viewData['cartCount'] = 0; // Giá trị mặc định
            $viewData['wishlistCount'] = 0;

            // Kiểm tra người dùng đã đăng nhập hay chưa
            if (Auth::check()) {
                // Lấy id tài khoản người dùng
                $maTk = Auth::user()->MaTK;

                // Lấy dữ liệu từ giỏ hàng
                $gioHang = GioHang::where('MaTK', $maTk)->with('product')->get();
                $viewData['cartItems'] = $gioHang;

                // Đếm số lượng sản phẩm trong giỏ hàng
                $viewData['cartCount'] = $gioHang->count();

                // Tính tổng giá trị giỏ hàng (subtotal)
                $viewData['subtotal'] = $gioHang->sum(function ($item) {
                    return $item->product ? $item->soLuong * $item->product->Gia : 0;
                });

                //lấy dữ liệu từ yêu thích
                $yeuThich = YeuThich::where('MaTK',$maTk)->with('product')->get();
                $viewData['wishlistCount'] = $yeuThich->count();

            } else {
                // Người dùng chưa đăng nhập
                $viewData['cartItems'] = collect(); // Mảng rỗng
                $viewData['subtotal'] = 0; // Giá trị mặc định
            }

            // Lấy danh sách danh mục
            $viewData['DS-DanhMuc'] = LoaiSanPham::Where('TrangThai', 1)->limit(5)->get();

            // Truyền dữ liệu vào view
            $view->with('viewData', $viewData);
        });
    }
}