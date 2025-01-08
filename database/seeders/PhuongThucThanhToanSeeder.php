<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhuongThucThanhToan;

class PhuongThucThanhToanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pttt = [
            ["TenPT"=>"Ví Momo","TrangThai"=>1,"MoTa"=>"Thanh toán nhanh với ví momo"],
            ["TenPT"=>"Thanh toán khi nhận hàng","TrangThai"=>1,"MoTa"=>"Tiện lợi với thanh toán khi nhận hàng"],
        ];
        foreach($pttt as $pt)
        {
            PhuongThucThanhToan::factory()->create($pt);
        }
    }
}
