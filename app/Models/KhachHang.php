<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khach_hangs';
    protected $primaryKey = 'MaTK';
    public $timestamps = false;

    public function binhLuans()
    {
        return $this->hasMany(BinhLuan::class, 'MaKH', 'MaTK');
    }
}