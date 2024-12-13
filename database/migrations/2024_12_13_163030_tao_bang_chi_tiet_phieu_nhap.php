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
        Schema::create('chi_tiet_phieu_nhaps', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('MaPN');
            $table->unsignedInteger('MaSP');
            $table->integer('SoLuong');
            $table->decimal('DonGia', 18, 2);

            // Khóa ngoại chi tiết phiếu nhập -> phiếu nhập
            $table->foreign('MaPN')
                ->references('MaPN')
                ->on('phieu_nhaps')
                ->onDelete('cascade');

            // Khóa ngoại chi tiết phiếu nhập -> sản phẩm
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
        Schema::dropIfExists('chi_tiet_phieu_nhaps');
    }
};
