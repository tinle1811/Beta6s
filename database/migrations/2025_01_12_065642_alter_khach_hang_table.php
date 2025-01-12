<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('khach_hangs', function (Blueprint $table) {
            $table->string('HinhAnh', 255)->nullable();
            $table->date('NgaySinh')->nullable();
            $table->string('GioiTinh', 10);
            $table->string('SDT', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('khach_hangs', function (Blueprint $table) {
            // Xóa các cột mới được thêm
            $table->dropColumn(['HinhAnh', 'NgaySinh', 'GioiTinh']);

            // Khôi phục cột SDT không cho phép NULL
            $table->string('SDT', 20)->nullable(false)->change();
        });
    }
};