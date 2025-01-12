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
        Schema::table('binh_luans', function (Blueprint $table) {
            // Thêm cột MaHD
            $table->unsignedInteger('MaHD')->nullable();

            // Khóa ngoại bình luận -> hóa đơn
            $table->foreign('MaHD')
                ->references('MaHD')
                ->on('hoa_dons')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('binh_luans', function (Blueprint $table) {
            // Xóa cột MaHD và khóa ngoại
            $table->dropForeign(['MaHD']);
            $table->dropColumn('MaHD');
        });
    }
};