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
                $taikhoan = Auth::user();
                if($role == "admin" && $taikhoan->LoaiTK == 2){
                    return $next($request);
                }elseif($role == "shared" && in_array($taikhoan->LoaiTK,[1,2])){
                    return $next($request); 
                }
            }
            // Nếu không có quyền, chuyển hướng về trang đăng nhập
            return redirect('/')->with('error', 'Bạn không có quyền truy cập.');
    }
}
