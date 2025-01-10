<?php

namespace Database\Seeders;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\PhuongThucThanhToan;
use App\Models\TaiKhoan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();    
        $this->call(LoaiSanPhamSeeder::class);
        $this->call(SanPhamSeeder::class);
        $this->call(LoaiTaiKhoanSeeder::class);
        $this->call(TaiKhoanSeeder::class);
        $this->call(PhuongThucThanhToanSeeder::class);
        $this->call(KhachHangSeeder::class);
        $this->call(HoaDonSeeder::class);
        $this->call(ChiTietHoaDonSeeder::class);

    }
}
