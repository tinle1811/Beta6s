<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
    protected $table = 'tai_khoans';
    protected $primaryKey = 'MaTK';

    protected $fillable = ['TenDN', 'Email', 'Password', 'LoaiTK', 'TrangThai'];
    protected $hidden = ['Password','remember_token'];
}
