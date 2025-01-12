<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khach_hangs';
    protected $primaryKey = 'MaTK';
    public $timestamps = false;

    protected $fillable = [
        'MaTK',
        'TenKH',
        'HinhAnh',
        'NgaySinh',
        'SDT',
        'GioiTinh',
        'DiaChi',
    ];

    public function binhLuans()
    {
        return $this->hasMany(BinhLuan::class, 'MaKH', 'MaTK');
    }
    
    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'MaTK');
    }
}