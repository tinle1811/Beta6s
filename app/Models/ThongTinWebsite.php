<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThongTinWebsite extends Model
{
    use HasFactory;

    protected $table = 'thong_tin_website'; // Tên bảng
    protected $fillable = [
        'logo',
        'address',
        'hotline',
        'email',
        'facebook',
        'instagram',
        'twitter',
    ];

    // Getter và Setter cho logo
    public function getLogoAttribute()
    {
        return $this->attributes['logo'];
    }

    public function setLogoAttribute($value)
    {
        // Nếu có file được upload, lưu trữ và gán tên file cho logo
        if (is_file($value)) {
            $this->attributes['logo'] = $value->store('logos', 'public');
        } else {
            $this->attributes['logo'] = $value; // Đảm bảo giá trị logo là tên file hoặc null
        }
    }

    // Getter và Setter cho địa chỉ
    public function getAddressAttribute($value)
    {
        return ucfirst($value); // Trả về địa chỉ với chữ cái đầu tiên viết hoa
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = strtolower($value); // Chuyển địa chỉ về chữ thường
    }

    // Getter và Setter cho hotline
    public function getHotlineAttribute($value)
    {
        return "+84 " . $value; // Trả về hotline với mã vùng Việt Nam
    }

    public function setHotlineAttribute($value)
    {
        // Xóa tất cả ký tự không phải là số từ hotline
        $this->attributes['hotline'] = preg_replace('/\D/', '', $value);
    }

    // Getter và Setter cho email
    public function getEmailAttribute($value)
    {
        return strtolower($value); // Trả về email chữ thường
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value); // Chuyển email về chữ thường
    }

    // Getter và Setter cho facebook
    public function getFacebookAttribute($value)
    {
        return $value; // Trả về link đầy đủ của Facebook
    }

    public function setFacebookAttribute($value)
    {
        $this->attributes['facebook'] = $value; // Đảm bảo giá trị là tên người dùng Facebook
    }

    // Getter và Setter cho instagram
    public function getInstagramAttribute($value)
    {
        return $value; // Trả về link đầy đủ của Instagram
    }

    public function setInstagramAttribute($value)
    {
        $this->attributes['instagram'] = $value; // Đảm bảo giá trị là tên người dùng Instagram
    }

    // Getter và Setter cho twitter
    public function getTwitterAttribute($value)
    {
        return $value; // Trả về link đầy đủ của Twitter
    }

    public function setTwitterAttribute($value)
    {
        $this->attributes['twitter'] = $value; // Đảm bảo giá trị là tên người dùng Twitter
    }

    // Getter và Setter cho created_at
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s'); // Định dạng ngày giờ
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = \Carbon\Carbon::parse($value); // Chuyển thành đối tượng Carbon
    }

    // Getter và Setter cho updated_at
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s'); // Định dạng ngày giờ
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = \Carbon\Carbon::parse($value); // Chuyển thành đối tượng Carbon
    }
}
