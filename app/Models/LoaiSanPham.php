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
    public function getCategoryId()
    {
        return $this->attributes['MaLSP'];
    }

    public function setCategoryId($id)
    {
        $this->attributes['MaLSP'] = $id;
    }

    public function getCategoryName()
    {
        return $this->attributes['TenLSP'];
    }

    public function setCategoryName($name)
    {
        $this->attributes['TenLSP'] = $name;
    }

    public function getCategoryStatus()
    {
        return $this->attributes['TrangThai'];
    }

    public function setCategoryStatus($status)
    {
        $this->attributes['TrangThai'] = $status;
    }
}
