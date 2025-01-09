<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThongTinWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('thong_tin_website')->insert([
            'logo' => 'logo.jpg', // Đường dẫn logo
            'address' => '65 Huỳnh Thúc Kháng, Phường Bến Nghé, Quận 1, TP.HCM', // Địa chỉ website
            'hotline' => '(+1) 234-567-890', // Hotline
            'email' => 'support@example.com', // Email hỗ trợ
            'facebook' => 'https://facebook.com/yourpage', // Link Facebook
            'instagram' => 'https://instagram.com/yourpage', // Link Instagram
            'twitter' => 'https://twitter.com/yourpage', // Link Twitter
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}