<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateThongKe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-thong-ke';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật dữ liệu thống kê hằng ngày.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('thong_kes')->insert([
            'order_date' => Carbon::yesterday()->toDateString(),
            'sales' => DB::table('hoa_dons')
                ->whereDate('created_at', Carbon::yesterday())
                ->where('TrangThai', 1) // Lọc theo TrangThai = 1 // hóa đơn đã hoàn tất
                ->sum('TongTien'),
            'profit' => DB::table('hoa_dons')
                ->whereDate('created_at', Carbon::yesterday())
                ->where('TrangThai', 1) // Lọc theo TrangThai = 1
                ->sum('TongTien')
                - DB::table('phieu_nhaps')
                ->whereDate('created_at', Carbon::yesterday())
                ->sum('TongTien'),
            'quantity' => DB::table('chi_tiet_hoa_dons')
                ->join('hoa_dons', 'chi_tiet_hoa_dons.MaHD', '=', 'hoa_dons.MaHD')
                ->whereDate('hoa_dons.created_at', Carbon::yesterday())
                ->where('hoa_dons.TrangThai', 1) // Lọc theo TrangThai = 1
                ->sum('SoLuong'),
            'total_order' => DB::table('hoa_dons')
                ->whereDate('created_at', Carbon::yesterday())
                ->where('TrangThai', 1) // Lọc theo TrangThai = 1
                ->count(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $this->info('Dữ liệu thống kê đã được cập nhật thành công!');
    }
}