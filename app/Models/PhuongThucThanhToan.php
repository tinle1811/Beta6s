<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhuongThucThanhToan extends Model
{
    use HasFactory;
    protected $table = 'phuong_thuc_thanh_toans';
    protected $primaryKey = 'MaPT';
    public $timestamps = false;

    protected $fillable = [
        'TenPT',
        'TrangThai',
        'MoTa',
    ];
    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'ThanhToan', 'MaPT');
    }
}
