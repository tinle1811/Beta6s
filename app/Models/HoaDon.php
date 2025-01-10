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
    // Mảng ánh xạ trạng thái theo yêu cầu và lớp text tương ứng
    $trangThaiList = [
        0 => ['name' => 'Chờ xử lý', 'class' => 'text-warning'],
        1 => ['name' => 'Đang giao hàng', 'class' => 'text-primary'],
        2 => ['name' => 'Đã hoàn thành', 'class' => 'text-success'],
        3 => ['name' => 'Đã hủy', 'class' => 'text-danger'],
    ];
    $status = isset($trangThaiList[$this->TrangThai]) ? $trangThaiList[$this->TrangThai] : ['name' => 'Không xác định', 'class' => 'text-secondary'];

    return $status;
}


}
