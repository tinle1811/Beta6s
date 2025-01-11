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
        Schema::create('thong_tin_website', function (Blueprint $table) {
            $table->id(); // Thêm trường ID tự động tăng
            $table->string('logo'); // Trường lưu đường dẫn ảnh logo
            $table->string('address'); // Trường lưu địa chỉ
            $table->string('hotline'); // Trường lưu hotline
            $table->string('email'); // Trường lưu email
            $table->string('facebook'); // Trường lưu link Facebook
            $table->string('instagram'); // Trường lưu link Instagram
            $table->string('twitter'); // Trường lưu link Twitter
            $table->timestamps(); // Các trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thong_tin_website');
    }
};