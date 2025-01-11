<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoaDon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hoa_dons'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'MaHD'; // Khóa chính
    public $incrementing = true; // Mã tự tăng
    protected $keyType = 'int'; // Kiểu của khóa chính

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'MaKH',
        'ThanhToan',
        'TongTien',
        'GhiChu',
        'TrangThaiThanhToan',
        'TrangThai',
    ];

    // Quan hệ với bảng `khach_hangs`
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaTK');
    }

    // Quan hệ với bảng `phuong_thuc_thanh_toans`
    public function phuongThucThanhToan()
    {
        return $this->belongsTo(PhuongThucThanhToan::class, 'ThanhToan', 'MaPT');
    }

    // Mối quan hệ với chi tiết hóa đơn
    public function chiTietHoaDons()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'MaHD');
    }
}
