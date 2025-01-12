<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChiTietHoaDon extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_hoa_dons';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'MaHD', 
        'MaSP', 
        'SoLuong', 
        'DonGia'
    ];
    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD', 'MaHD');
    }
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }
    public function binhLuans()
    {
        return $this->hasOne(BinhLuan::class, 'MaSP', 'MaSP');
    }

    // Code của Khoa
    public function getOrderDetailId()
    {
        return $this->attributes['ID'];
    }

    public function setOrderDetailId($id)
    {
        $this->attributes['ID'] = $id;
    }

    public function getOrderId()
    {
        return $this->attributes['MaHD'];
    }

    public function setOrderId($orderId)
    {
        $this->attributes['MaHD'] = $orderId;
    }

    public function getProductId()
    {
        return $this->attributes['MaSP'];
    }

    public function setProductId($productId)
    {
        $this->attributes['MaSP'] = $productId;
    }

    public function getQuantity()
    {
        return $this->attributes['SoLuong'];
    }

    public function setQuantity($quantity)
    {
        $this->attributes['SoLuong'] = $quantity;
    }

    public function getPrice()
    {
        return $this->attributes['DonGia'];
    }

    public function setPrice($price)
    {
        $this->attributes['DonGia'] = $price;
    }

}
