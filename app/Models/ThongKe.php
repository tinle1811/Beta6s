<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongKe extends Model
{
    use HasFactory;
    // Định nghĩa tên bảng
    protected $table = 'thong_kes';

    // Định nghĩa khóa chính (nếu không phải là 'id')
    protected $primaryKey = 'id';

    // Các thuộc tính có thể được gán giá trị thông qua mass assignment
    protected $fillable = [
        'order_date',
        'sales',
        'profit',
        'quantity',
        'total_order',
    ];

    // Định nghĩa kiểu dữ liệu cho các thuộc tính
    protected $casts = [
        'order_date' => 'date',  // Chuyển đổi order_date thành kiểu date
        'sales' => 'decimal:2',  // Chuyển đổi sales thành kiểu decimal với 2 chữ số thập phân
        'profit' => 'decimal:2', // Chuyển đổi profit thành kiểu decimal với 2 chữ số thập phân
        'quantity' => 'integer', // Chuyển đổi quantity thành kiểu integer
        'total_order' => 'integer', // Chuyển đổi total_order thành kiểu integer
    ];

    // Hàm GET cho thuộc tính sales
    public function getSalesAttribute($value)
    {
        return $value;
        //return number_format($value, 2); // Định dạng số tiền sales với 2 chữ số thập phân
    }

    // Hàm SET cho thuộc tính sales
    public function setSalesAttribute($value)
    {
        $this->attributes['sales'] = (float) str_replace(',', '', $value); // Xóa dấu phẩy và chuyển thành float
    }

    // Hàm GET cho thuộc tính profit
    public function getProfitAttribute($value)
    {
        return $value;
        //return number_format($value, 2); // Định dạng số tiền profit với 2 chữ số thập phân
    }

    // Hàm SET cho thuộc tính profit
    public function setProfitAttribute($value)
    {
        $this->attributes['profit'] = (float) str_replace(',', '', $value); // Xóa dấu phẩy và chuyển thành float
    }

    // Hàm GET cho thuộc tính quantity
    public function getQuantityAttribute($value)
    {
        return (int) $value; // Chuyển quantity thành kiểu integer
    }

    // Hàm SET cho thuộc tính quantity
    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = (int) $value; // Chuyển giá trị quantity thành kiểu integer
    }

    // Hàm GET cho thuộc tính total_order
    public function getTotalOrderAttribute($value)
    {
        return (int) $value; // Chuyển total_order thành kiểu integer
    }

    // Hàm SET cho thuộc tính total_order
    public function setTotalOrderAttribute($value)
    {
        $this->attributes['total_order'] = (int) $value; // Chuyển giá trị total_order thành kiểu integer
    }

    // Hàm GET cho thuộc tính order_date
    public function getOrderDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y'); // Định dạng ngày tháng theo kiểu d-m-Y
    }

    // Hàm SET cho thuộc tính order_date
    public function setOrderDateAttribute($value)
    {
        $this->attributes['order_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d'); // Chuyển đổi ngày tháng từ d-m-Y thành Y-m-d
    }
}