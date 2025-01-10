<?php

namespace Database\Seeders;

use App\Models\ChiTietHoaDon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChiTietHoaDonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chiTietHoaDon = [
            ["MaHD" => 1, "MaSP" => 1, "SoLuong" => 1, "DonGia" => 131990000.00],
            ["MaHD" => 2, "MaSP" => 2, "SoLuong" => 2, "DonGia" => 49790000.00],
            ["MaHD" => 2, "MaSP" => 3, "SoLuong" => 1, "DonGia" => 4890000.00],
            ["MaHD" => 3, "MaSP" => 4, "SoLuong" => 2, "DonGia" => 5190000.00],
            ["MaHD" => 4, "MaSP" => 5, "SoLuong" => 1, "DonGia" => 8390000.00],
            ["MaHD" => 5, "MaSP" => 6, "SoLuong" => 3, "DonGia" => 12590000.00],
            ["MaHD" => 6, "MaSP" => 7, "SoLuong" => 1, "DonGia" => 42390000.00],
            ["MaHD" => 7, "MaSP" => 8, "SoLuong" => 2, "DonGia" => 48690000.00],
            ["MaHD" => 8, "MaSP" => 9, "SoLuong" => 1, "DonGia" => 34790000.00],
            ["MaHD" => 8, "MaSP" => 10, "SoLuong" => 2, "DonGia" => 4790000.00],
        ];
        foreach ($chiTietHoaDon as $cthdData) {
            ChiTietHoaDon::create($cthdData);
        }
    }
}
