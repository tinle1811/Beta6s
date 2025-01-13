<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhuongThucThanhToanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phuong_thuc_thanh_toans')->insert([
            [
                'TenPT' => 'Momo',
                'TrangThai' => 1,
                'MoTa' => 'Thanh toán thông qua các ví điện tử như MoMo',
            ],
            [
                'TenPT' => 'Tiền mặt',
                'TrangThai' => 1,
                'MoTa' => 'Thanh toán trực tiếp khi nhận hàng',
            ],
            
           
        ]);
        
    }
}