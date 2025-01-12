<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $viewData['title'] = "Trang đăng ký";
        return view('user.auth.register')->with('viewData', $viewData);
    }
    // Phương thức đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'TenDN' => 'required|unique:tai_khoans',
            'Email' => 'required|email|unique:tai_khoans',
            'Password' => 'required|min:6',
        ]);


        // Kiểm tra xem email đã tồn tại hay chưa
        if (TaiKhoan::where('Email', $request->Email)->exists()) {
            // Sử dụng viewData để truyền thông báo lỗi
            $viewData = [
                'error' => 'Email này đã được sử dụng.',
                'oldData' => $request->all(),
            ];
            return view('user.auth.register')->with('viewData', $viewData);
        }


        $user = TaiKhoan::create([
            'TenDN' => $request->TenDN,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'LoaiTK' => 1,
            'TrangThai' => 1,
            'remember_token' => \Str::random(60), // Thêm remember_token
        ]);


        Auth::login($user);
        // Chuyển hướng về trang chủ với thông báo chào mừng
        return redirect()->route('user.home.index')->with('success', 'Xin chào ' . $user->TenDN . '!');
    }
    public function login(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required|min:6',
        ]);
        $taiKhoan = TaiKhoan::where('Email',$request->Email)->first();
        if($taiKhoan && Hash::check($request->Password, $taiKhoan->Password)){
            // đăng nhập thành công
            Auth::login($taiKhoan);
            
            // Lưu thông tin vào session nếu chọn "Nhớ mật khẩu"
            
            //kiểm tra phân quyền và điều hướng
            if($taiKhoan->LoaiTK == 1){
                return redirect()->route('user.home.index')->with('success','Chào mừng người dùng!');
            }else{
                return redirect()->route('admin.analysis')->with('success','Chào mừng admin!');
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Email hoặc mật khẩu không khớp']);
        }
    }
    public function logout(Request $request)
    {
        // Thực hiện đăng xuất
        Auth::logout();


        // Hủy bỏ session hiện tại
        $request->session()->invalidate();


        // Tạo một session mới để tránh các cuộc tấn công Session Fixation
        $request->session()->regenerateToken();


        // Chuyển hướng về trang đăng nhập hoặc trang chủ
        return redirect()->route('user.home.index')->with('success', 'Bạn đã đăng xuất!');
    }
}
