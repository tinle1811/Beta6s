<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'hoa_dons';
    protected $primaryKey = 'MaHD';
    protected $fillable = [
        'MaKH', 
        'ThanhToan',
        'TongTien', 
        'GhiChu',
        'TrangThaiThanhToan', 
        'TrangThai'
    ];
    public function chiTietHoaDons()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'MaHD', 'MaHD');
    }
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaTK');
    }
    public function phuongThucThanhToan()
    {
        return $this->belongsTo(PhuongThucThanhToan::class, 'ThanhToan', 'MaPT');
    }
    public function getTrangThaiName()
    {
        // Mảng ánh xạ trạng thái
        $trangThaiList = [
            0 => 'Tất cả',
            1 => 'Chờ lấy hàng',
            2 => 'Chờ giao hàng',
            3 => 'Hoàn thành',
            4 => 'Đã huỷ',
        ];

        return $trangThaiList[$this->TrangThai] ;
    }

    // Code của Khoa
    public function getOrderId()
    {
        return $this->attributes['MaHD'];
    }

    public function setOrderId($orderId)
    {
        $this->attributes['MaHD'] = $orderId;
    }

    public function getCustomerId()
    {
        return $this->attributes['MaKH'];
    }

    public function setCustomerId($customerId)
    {
        $this->attributes['MaKH'] = $customerId;
    }

    public function getPayId()
    {
        return $this->attributes['ThanhToan'];
    }

    public function setPayId($payId)
    {
        $this->attributes['ThanhToan'] = $payId;
    }

    public function getTotalamount()
    {
        return $this->attributes['TongTien'];
    }

    public function setTotalamount($totalAmount)
    {
        $this->attributes['TongTien'] = $totalAmount;
    }

    public function getNote()
    {
        return $this->attributes['GhiChu'];
    }

    public function setNote($note)
    {
        $this->attributes['GhiChu'] = $note;
    }

    public function getStatusPay()
    {
        return $this->attributes['TrangThaiThanhToan'];
    }

    public function setStatusPay($statusPay)
    {
        $this->attributes['TrangThaiThanhToan'] = $statusPay;
    }

    public function getStatus()
    {
        return $this->attributes['TrangThai'];
    }

    public function setStatus($status)
    {
        $this->attributes['TrangThai'] = $status;
    }
}
