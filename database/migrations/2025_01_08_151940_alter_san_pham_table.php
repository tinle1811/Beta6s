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
        Schema::table('san_phams', function (Blueprint $table) {
            $table->integer('SoLuotYeuThich')->default(0)->nullable();
            $table->integer('SoLuotXem')->default(0)->nullable();
            $table->float('DiemRatingTB', 3, 2)->default(5.00)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropColumn(['SoLuotYeuThich', 'SoLuotXem', 'DiemRatingTB']);
        });
    }
};