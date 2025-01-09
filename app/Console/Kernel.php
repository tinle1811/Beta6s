<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Định nghĩa các lệnh sẽ chạy theo lịch trình.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Định nghĩa các lệnh sẽ chạy theo lịch trình
        $schedule->command('app:update-thong-ke')->daily(); // Chạy lệnh app:update-thong-ke mỗi ngày
    }

    /**
     * Đăng ký các lệnh Artisan.
     *
     * @return void
     */
    protected function commands()
    {
        // Tải các lệnh từ thư mục app/Console/Commands
        $this->load(__DIR__ . '/Commands');

        // Đăng ký các lệnh Artisan mặc định
        require base_path('routes/console.php');
    }
}