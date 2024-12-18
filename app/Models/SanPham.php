<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SanPham extends Model
{
    use HasFactory;
    protected $fillable = [
        'TenSP',
        'Gia',
        'SoLuong',
        'Mota',
        'Slug',
        'HinhAnh',
        'LoaiSP',
        'TrangThai',
    ];
    
}
