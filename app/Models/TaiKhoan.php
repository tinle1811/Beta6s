<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tai_khoans';  // Đảm bảo tên bảng đúng
    protected $primaryKey = 'MaTK'; // Khóa chính
    protected $fillable = [
        'TenDN',
        'Email',
        'Password',
        'LoaiTK',
        'TrangThai',
        'remember_token',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];
    public function getAuthPassword()
    {
        return $this->Password; // Tên trường mật khẩu trong bảng của bạn
    }   
    public function khachHang()
    {
        return $this->hasOne(KhachHang::class, 'MaTK', 'MaTK');  // MaTK là khóa ngoại trong bảng KhachHang
    }
    public function hoaDon()
    {
        return $this->hasMany(HoaDon::class, 'MaKH', 'MaTK');
    }

}