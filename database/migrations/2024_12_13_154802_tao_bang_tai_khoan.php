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
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table->increments('MaTK');
            $table->string('TenDN', 255);
            $table->string('Email', 255);
            $table->string('Password', 255);
            $table->unsignedInteger('LoaiTK');
            $table->integer('TrangThai');

            // Khóa ngoại tài khoản -> loại tài khoản
            $table->foreign('LoaiTK')
                ->references('MaLTK')
                ->on('Loai_tai_khoans')
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
        Schema::dropIfExists('tai_khoans');
    }
};
