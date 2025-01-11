<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'blogs';

    // Các trường có thể gán giá trị
    protected $fillable = [
        'TacGia',
        'TieuDe',
        'Slug',
        'NoiDung',
        'HinhAnh',
        'TrangThai',
    ];

    // Lấy tiêu đề với chữ cái đầu tiên viết hoa
    public function getTieuDeAttribute($value)
    {
        return ucfirst($value);
    }

    // Lấy tên tác giả với chữ cái đầu viết hoa
    public function getTacGiaAttribute($value)
    {
        return ucwords($value);
    }

    // Lấy slug dạng đầy đủ (nếu cần thêm tiền tố)
    public function getSlugAttribute($value)
    {
        return "/blogs/{$value}";
    }

    // Lấy nội dung định dạng HTML (nếu cần)
    public function getNoiDungAttribute($value)
    {
        //return nl2br($value); // Chuyển đổi xuống dòng thành thẻ `<br>`
        return $value;
    }

    // Lấy đường dẫn đầy đủ cho hình ảnh
    public function getHinhAnhAttribute($value)
    {
        //return asset("storage/images/{$value}");
        return $value;
    }

    // Chuyển trạng thái sang dạng chữ
    public function getTrangThaiAttribute($value)
    {
        return $value === 1 ? 'Hoạt động' : 'Không hoạt động';
    }

    // Lấy ngày tạo dạng dd-mm-yyyy
    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    // Lấy ngày cập nhật dạng dd-mm-yyyy
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    /**
     * Mutator - Định nghĩa các phương thức set
     */

    // Lưu tiêu đề sau khi loại bỏ khoảng trắng
    public function setTieuDeAttribute($value)
    {
        $this->attributes['TieuDe'] = trim($value);
    }

    // Lưu tên tác giả với chữ cái đầu viết hoa
    public function setTacGiaAttribute($value)
    {
        $this->attributes['TacGia'] = ucwords(trim($value));
    }

    // Tự động chuyển slug thành chữ thường
    public function setSlugAttribute($value)
    {
        $this->attributes['Slug'] = strtolower(trim($value));
    }

    // Lưu nội dung sau khi xóa khoảng trắng đầu/cuối
    public function setNoiDungAttribute($value)
    {
        $this->attributes['NoiDung'] = trim($value);
    }

    // Chỉ cho phép lưu các định dạng ảnh hợp lệ
    public function setHinhAnhAttribute($value)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $extension = pathinfo($value, PATHINFO_EXTENSION);
        if (!in_array($extension, $allowedExtensions)) {
            throw new \Exception("Định dạng ảnh không hợp lệ");
        }
        $this->attributes['HinhAnh'] = $value;
    }

    // Lưu trạng thái thành 0 hoặc 1
    public function setTrangThaiAttribute($value)
    {
        $this->attributes['TrangThai'] = $value ? 1 : 0;
    }
}