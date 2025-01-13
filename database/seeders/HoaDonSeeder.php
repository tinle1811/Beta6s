<?php

namespace Database\Seeders;

use App\Models\HoaDon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoaDonSeeder extends Seeder
{

    public function run(): void
    {
        $hoaDon = [
            ["MaHD" => null, "MaKH" => 1, "ThanhToan" => 1, "TongTien" => 131990000, "GhiChu" => "Đơn hàng đầu tiên", "TrangThaiThanhToan" => 0, "TrangThai" => 1, "created_at" => now(), "updated_at" => now()],
            ["MaHD" => null, "MaKH" => 1, "ThanhToan" => 1, "TongTien" => 104790000, "GhiChu" => "Đơn hàng thứ hai", "TrangThaiThanhToan" => 0, "TrangThai" => 0, "created_at" => now(), "updated_at" => now()],
            ["MaHD" => null, "MaKH" => 1, "ThanhToan" => 1, "TongTien" => 10380000, "GhiChu" => "Đơn hàng thứ ba", "TrangThaiThanhToan" => 1, "TrangThai" => 3, "created_at" => now(), "updated_at" => now()],
            ["MaHD" => null, "MaKH" => 1, "ThanhToan" => 1, "TongTien" => 8390000, "GhiChu" => "Đơn hàng thứ tư", "TrangThaiThanhToan" => 1, "TrangThai" => 3, "created_at" => now(), "updated_at" => now()],
            ["MaHD" => null, "MaKH" => 2, "ThanhToan" => 1, "TongTien" => 37770000, "GhiChu" => "Đơn hàng thứ nhất", "TrangThaiThanhToan" => 0, "TrangThai" => 1, "created_at" => now(), "updated_at" => now()],
            ["MaHD" => null, "MaKH" => 2, "ThanhToan" => 1, "TongTien" => 42390000, "GhiChu" => "Đơn hàng thứ hai", "TrangThaiThanhToan" => 0, "TrangThai" => 2, "created_at" => now(), "updated_at" => now()],
            ["MaHD" => null, "MaKH" => 2, "ThanhToan" => 1, "TongTien" => 97380000, "GhiChu" => "Đơn hàng thứ ba", "TrangThaiThanhToan" => 1, "TrangThai" => 3, "created_at" => now(), "updated_at" => now()],
            ["MaHD" => null, "MaKH" => 2, "ThanhToan" => 1, "TongTien" => 44370000, "GhiChu" => "Đơn hàng thứ tu", "TrangThaiThanhToan" => 0, "TrangThai" => 0, "created_at" => now(), "updated_at" => now()],
        ];
        
        foreach ($hoaDon as $hdData) {
            HoaDon::create($hdData);
        }
    }
}
