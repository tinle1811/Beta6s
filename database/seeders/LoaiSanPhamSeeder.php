<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoaiSanPham;

class LoaiSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loaiSP = [
            ["MaLSP"=>NULL,"TenLSP"=>"Thường","TrangThai"=>1,"created_at"=>"2024-12-18 00:00:00","updated_at"=>"2024-12-18 00:00:00"],
            ["MaLSP" => NULL, "TenLSP" => "Đặc biệt", "TrangThai" => 1, "created_at" => "2024-12-18 00:00:00", "updated_at" => "2024-12-18 00:00:00"],
        ];
        foreach($loaiSP as $lsp)
        {
            LoaiSanPham::factory()->create($lsp);
        }
    }
}
