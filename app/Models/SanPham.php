<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'san_phams';
    protected $primaryKey = 'MaSP';
    public $timestamps = false;

    public function binhLuans()
    {
        return $this->hasMany(BinhLuan::class, 'MaSP', 'MaSP');
    }
}