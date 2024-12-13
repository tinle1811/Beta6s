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
        Schema::create('phuong_thuc_thanh_toans', function (Blueprint $table) {
            $table->increments('MaPT');
            $table->string('TenPT', 255);
            $table->integer('TrangThai');
            $table->string('MoTa', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phuong_thuc_thanh_toans');
    }
};
