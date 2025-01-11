<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChiTietHoaDon extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_hoa_dons'; // Đặt tên bảng

    // Các thuộc tính có thể được gán đại trà
    protected $fillable = [
        'MaHD',
        'MaSP',
        'SoLuong',
        'DonGia'
    ];

    // Mối quan hệ với bảng hóa đơn
    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD');
    }

    // Mối quan hệ với bảng sản phẩm
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP');
    }
}