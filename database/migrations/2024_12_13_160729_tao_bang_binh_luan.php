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
        Schema::create('binh_luans', function (Blueprint $table) {
            $table->increments('MaBL');
            $table->unsignedInteger('MaKH');
            $table->unsignedInteger('MaSP');
            $table->integer('DanhGia');
            $table->text('NoiDung');
            $table->integer('TrangThai');

            // Khóa ngoại bình luận -> khách hàng
            $table->foreign('MaKH')
                ->references('MaTK')
                ->on('khach_hangs')
                ->onDelete('cascade');

            // khóa ngoại bình luận -> sản phẩm
            $table->foreign('MaSP')
                ->references('MaSP')
                ->on('san_phams')
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
        Schema::dropIfExists('binh_luans');
    }
};
