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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->increments('MaSP');
            $table->string('TenSP');
            $table->decimal('Gia', 18, 2);
            $table->integer('SoLuong');
            $table->text('MoTa');
            $table->string('Slug', 255);
            $table->string('HinhAnh', 255);
            $table->unsignedInteger('LoaiSP');
            $table->integer('TrangThai');

            // Khóa ngoại sản phẩm -> loại sản phẩm
            $table->foreign('LoaiSP')
                ->references('MaLSP')
                ->on('loai_san_phams')
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
        Schema::dropIfExists('san_phams');
    }
};
