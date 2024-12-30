<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GioHang extends Model
{
    use HasFactory;
    protected $fillable = [
        "MaTK",
        "MaSP",
        "soLuong",
    ];
    public function product()
    {
        return $this->belongsTo(SanPham::class);
    }
    public function getSoLuong()
    {
        return $this->attributes['soLuong'];
    }
    public function setSoluong($sl)
    {
        return $this->attributes['soLuong'] = $sl;
    }
    public function getMaTK()
    {
        return $this->attributes['MaTK'];
    }
    public function getMaSP()
    {
        return $this->attributes['MaSP'];
    }
}
