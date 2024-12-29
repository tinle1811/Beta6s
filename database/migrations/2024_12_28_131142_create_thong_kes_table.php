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
        Schema::create('thong_kes', function (Blueprint $table) {
            $table->increments('id'); // Khóa chính
            $table->date('order_date'); // Ngày thống kê
            $table->decimal('sales', 18, 2); // Tổng doanh thu
            $table->decimal('profit', 18, 2); // Lợi nhuận
            $table->integer('quantity'); // Tổng số lượng sản phẩm bán
            $table->integer('total_order'); // Tổng số đơn hàng
            $table->timestamps(); // Thời gian tạo, cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thong_kes');
    }
};