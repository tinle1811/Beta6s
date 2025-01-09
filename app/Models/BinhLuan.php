<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    protected $table = 'binh_luans';
    protected $primaryKey = 'MaBL';
    public $timestamps = false;

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaTK');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }
}
