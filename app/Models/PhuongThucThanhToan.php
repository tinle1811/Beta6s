<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhuongThucThanhToan extends Model
{
    use HasFactory;

    protected $table = 'phuong_thuc_thanh_toans'; // Tên bảng trong CSDL
    protected $primaryKey = 'MaPT'; // Khóa chính
    public $incrementing = true; // Khóa chính tự tăng
    protected $keyType = 'int'; // Kiểu của khóa chính

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'TenPT',
        'TrangThai',
        'MoTa',
    ];

    // Thiết lập quan hệ với bảng `hoa_dons`
    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'ThanhToan', 'MaPT');
    }
}
