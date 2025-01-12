<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KhachHang extends Model
{
    use HasFactory;
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

    public function hoaDon()
    {
        return $this->hasMany(HoaDon::class, 'MaKH', 'MaTK');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'MaTK', 'MaTK');  
    }
}