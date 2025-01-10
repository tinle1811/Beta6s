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

    protected $fillable = [
        'TenSP',
        'Gia',
        'SoLuong',
        'Mota',
        'Slug',
        'HinhAnh',
        'LoaiSP',
        'TrangThai',
        'SoLuotYeuThich',
        'SoLuotXem',
        'DiemRatingTB',
    ];
    
    public function binhLuans()
    {
        return $this->hasMany(BinhLuan::class, 'MaSP', 'MaSP');
    }
    public function carts()
    {
        return $this->hasMany(GioHang::class, 'MaSP', 'MaSP');
    }
    public function chiTietHoaDons()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'MaSP', 'MaSP');
    }

    public function getProductId()
    {
        return $this->attributes['MaSP'];
    }

    public function setProductId($id)
    {
        $this->attributes['MaSP'] = $id;
    }

    public function getProductName()
    {
        return $this->attributes['TenSP'];
    }

    public function setProductName($name)
    {
        $this->attributes['TenSP'] = $name;
    }

    public function getProductPrice()
    {
        return $this->attributes['Gia'];
    }

    public function setProductPrice($price)
    {
        $this->attributes['Gia'] = $price;
    }

    public function getProductQuantity()
    {
        return $this->attributes['SoLuong'];
    }

    public function setProductQuantity($quantity)
    {
        $this->attributes['SoLuong'] = $quantity;
    }

    public function getProductDescription()
    {
        return $this->attributes['MoTa'];
    }

    public function setProductDescription($description)
    {
        $this->attributes['MoTa'] = $description;
    }

    public function getProductSlug()
    {
        return $this->attributes['Slug'];
    }

    public function setProductSlug($slug)
    {
        $this->attributes['Slug'] = $slug;
    }

    public function getProductImage()
    {
        return $this->attributes['HinhAnh'];
    }

    public function setProductImage($image)
    {
        $this->attributes['HinhAnh'] = $image;
    }

    public function getProductType()
    {
        return $this->attributes['LoaiSP'];
    }

    public function setProductType($producttype)
    {
        $this->attributes['LoaiSP'] = $producttype;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    public function getDeletedAt()
    {
        return $this->attributes['deleted_at'];
    }

    public function setDeletedAt($deletedAt)
    {
        $this->attributes['deleted_at'] = $deletedAt;
    }
}