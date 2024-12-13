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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->increments('MaTK');
            $table->string('TenKH', 255);
            $table->string('SDT', 20);
            $table->string('DiaChi', 255);

            // Khóa ngoại khách hàng -> tài khoản
            $table->foreign('MaTK')
                ->references('MaTK')
                ->on('tai_khoans')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
