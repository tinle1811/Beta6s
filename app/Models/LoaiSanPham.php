<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoaiSanPham extends Model
{
    use HasFactory;
    protected $fillable = [
        "TenLSP",
        "TrangThai",
    ];

}
