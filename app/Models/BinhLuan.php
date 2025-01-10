<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BinhLuan extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaBL';
    protected $fillable = [
        'MaKH',
        'MaSP',
        'DanhGia',
        'NoiDung',
        'TrangThai',
    ];
}
