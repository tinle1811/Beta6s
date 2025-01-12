<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    protected $table = 'binh_luans';
    protected $primaryKey = 'MaBL';
    protected $casts = [
        'created_at' => 'datetime',
    ];
    public $timestamps = false;
    protected $fillable = [
        'MaHD',    // Thêm vào đây
        'MaKH',
        'MaSP',
        'DanhGia',
        'NoiDung',
        'TrangThai',
        'created_at',
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaTK');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }
    // Quan hệ với HoaDon (Một bình luận thuộc về một hóa đơn)
    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD', 'MaHD');
    }

    // Quan hệ với ChiTietHoaDon (Một bình luận thuộc về một chi tiết hóa đơn)
    public function chiTietHoaDon()
    {
        return $this->belongsTo(ChiTietHoaDon::class, 'MaSP', 'MaSP');
    }
}
