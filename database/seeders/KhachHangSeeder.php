<?php

namespace Database\Seeders;

use App\Models\KhachHang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kh = [
            ["MaTK"=>1, "TenKH"=>"Nguyễn Văn A", "SDT"=>"0912345678", "DiaChi"=>"13 đường 27, gò vấp, Hà Nội"],
            ["MaTK"=>2, "TenKH"=>"Lê Thị B", "SDT"=>"0987654321", "DiaChi"=>"TP. Hồ Chí Minh"],
        ];
        foreach ($kh as $khData) {
            KhachHang::create($khData);
        }
    }
}
