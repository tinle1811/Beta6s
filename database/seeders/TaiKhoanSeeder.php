<?php

namespace Database\Seeders;

use App\Models\TaiKhoan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tk = [
            ["MaTK"=>null, "TenDN"=>"user111", "Email"=>"user111@gmail.com", "Password"=>bcrypt('User123'), "LoaiTK"=>1, "TrangThai"=>1, "created_at"=>now(), "updated_at"=>now()],
            ["MaTK"=>null, "TenDN"=>"user222", "Email"=>"user222@gmail.com", "Password"=>bcrypt('User123'), "LoaiTK"=>1, "TrangThai"=>1, "created_at"=>now(), "updated_at"=>now()],
            ["MaTK"=>null, "TenDN"=>"admin111", "Email"=>"admin111@gmail.com", "Password"=>bcrypt('Admin123'), "LoaiTK"=>2, "TrangThai"=>1, "created_at"=>now(), "updated_at"=>now()],
        ];
        foreach ($tk as $tkData) {
            TaiKhoan::create($tkData);
        }
    }
}
