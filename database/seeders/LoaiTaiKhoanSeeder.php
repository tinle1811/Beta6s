<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoaiTaiKhoan;

class LoaiTaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ltk = [
            ["MaLTK"=>null,"TenLTK"=>"user","TrangThai"=>1,"created_at"=>"2025-01-01 00:00:00","updated_at"=>"2025-01-01 00:00:00"],
            ["MaLTK"=>null,"TenLTK"=>"admin","TrangThai"=>1,"created_at"=>"2025-01-01 00:00:00","updated_at"=>"2025-01-01 00:00:00"],
        ];
        foreach($ltk as $lsp)
        {
            LoaiTaiKhoan::factory()->create($lsp);
        }
    }
}
