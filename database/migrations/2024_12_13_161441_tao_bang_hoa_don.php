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
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->increments('MaHD');
            $table->unsignedInteger('MaKH');
            $table->unsignedInteger('ThanhToan');
            $table->decimal('TongTien', 18, 2);
            $table->string('GhiChu', 255);
            $table->integer('TrangThaiThanhToan');
            $table->integer('TrangThai');

            // Khóa ngoại hóa đơn -> khách hàng
            $table->foreign('MaKH')
                ->references('MaTK')
                ->on('khach_hangs')
                ->onDelete('cascade');

            // Khóa ngoại hóa đơn -> phương thức thanh toán
            $table->foreign('ThanhToan')
                ->references('MaPT')
                ->on('phuong_thuc_thanh_toans')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_dons');
    }
};
