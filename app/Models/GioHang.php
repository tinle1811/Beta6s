<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GioHang extends Model
{
    use HasFactory;
    protected $fillable = [
        "MaTK",
        "MaSP",
        "soLuong",
    ];
    public function product()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }
    public function user()
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTK','MaTK');
    }
}
