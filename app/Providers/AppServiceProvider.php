<?php

namespace App\Providers;

use App\Models\GioHang;
use App\Models\LoaiSanPham;
use App\Models\YeuThich;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ThongTinWebsite;
use App\Models\ThongKe;
use Illuminate\Support\Facades\Auth;


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

        // Chia sẻ dữ liệu logo tới tất cả view
        View::composer('*', function ($view) {
            $websiteInfo = ThongTinWebsite::first();
            $view->with('websiteInfo', $websiteInfo);
        });
        View::composer('admin.analysis.index', function ($view) {
            $thongKes = ThongKe::orderBy('order_date', 'asc')->get();

            $viewData['thongKes'] = $thongKes;

            foreach ($thongKes as $key => $val) {

                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity,
                );
            }
            $view->with('data', json_encode($chart_data));

            //$viewData['data'] = json_encode($chart_data);
            //$view->with('data', $viewData['data']);
        });

        // Sử dụng View Composer để truyền dữ liệu vào tất cả các view
        View::composer('user.layouts.header', function ($view) {
            $viewData = [];
            $viewData['cartCount'] = 0; // Giá trị mặc định
            $viewData['wishlistCount'] = 0;
            $loaiSanPhams = LoaiSanPham::all(); //Dùng cho chức năng search
            $viewData['DS-DanhMuc'] = LoaiSanPham::where('TrangThai', 1)->limit(5)->get(); //Dùng cho chức năng hiển thị một số danh mục
            $view->with('loaiSanPhams', $loaiSanPhams); //Dùng cho chức năng search

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
                $yeuThich = YeuThich::where('MaTK', $maTk)->with('product')->get();
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
