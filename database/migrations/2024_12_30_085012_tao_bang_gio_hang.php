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
        Schema::create('gio_hangs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('MaTK');
            $table->unsignedInteger('MaSP');
            $table->integer('soLuong')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('MaTK')->references('MaTK')->on('tai_khoans')->onDelete('cascade');
            $table->foreign('MaSP')->references('MaSP')->on('san_phams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
