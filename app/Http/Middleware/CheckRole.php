<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Kiểm tra nếu người dùng đã đăng nhập và có quyền tương ứng
        if(Auth::check()){
            $taikhoan = Auth::user(); // Auth::user() trả về đối tượng của tài khoản người dùng
            if($role == "admin" && $taikhoan->LoaiTK == 1){
                return $next($request); // Người dùng là admin, tiếp tục xử lý
            }elseif($role =="user" && $taikhoan->LoaiTK == 2){
                return $next($request); // Người dùng là admin, tiếp tục xử lý
            }
        }
        // Nếu không có quyền, chuyển hướng về trang đăng nhập
        return redirect('/login')->with('error', 'Bạn không có quyền truy cập.');
    }
}
