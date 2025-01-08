<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'hoa_dons';
    protected $primaryKey = 'MaHD';
    protected $fillable = [
        'MaKH', 
        'ThanhToan',
        'TongTien', 
        'GhiChu',
        'TrangThaiThanhToan', 
        'TrangThai'
    ];
    public function chiTietHoaDons()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'MaHD', 'MaHD');
    }
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaTK');
    }
    public function phuongThucThanhToan()
    {
        return $this->belongsTo(PhuongThucThanhToan::class, 'ThanhToan', 'MaPT');
    }
}
