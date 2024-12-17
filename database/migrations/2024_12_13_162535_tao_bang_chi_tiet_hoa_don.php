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
        Schema::create('chi_tiet_hoa_dons', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('MaHD');
            $table->unsignedInteger('MaSP');
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);

            // Khóa ngoại chi tiết hóa đơn -> hóa đơn
            $table->foreign('MaHD')
                ->references('MaHD')
                ->on('hoa_dons')
                ->onDelete('cascade');

            // Khóa ngoại chi tiết hóa đơn -> sản phẩm
            $table->foreign('MaSP')
                ->references('MaSP')
                ->on('san_phams')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_hoa_dons');
    }
};
