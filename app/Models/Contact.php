<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'lien_hes';

    protected $fillable = [
        'Email',
        'SDT',
        'TenKH',
        'NoiDung',
        'TrangThai',
    ];
    public static function validate($request)
        {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);
        }

    public function getId()
    {
        return $this->attributes['MaLH'];
    }

    public function setId($id)
    {
        $this->attributes['MaLH'] = $id;
    }

    public function getEmail()
    {
        return $this->attributes['Email'];
    }

    public function setEmail($email)
    {
        $this->attributes['Email'] = $email;
    }

    public function getPhone()
    {
        return $this->attributes['SDT'];
    }

    public function setPhone($phone)
    {
        $this->attributes['SDT'] = $phone;
    }

    public function getCustomerName()
    {
        return $this->attributes['TenKH'];
    }

    public function setCustomerName($customerName)
    {
        $this->attributes['TenKH'] = $customerName;
    }

    public function getContent()
    {
        return $this->attributes['NoiDung'];
    }

    public function setContent($content)
    {
        $this->attributes['NoiDung'] = $content;
    }

    public function getStatus()
    {
        return $this->attributes['TrangThai'];
    }

    public function setStatus($status)
    {
        $this->attributes['TrangThai'] = $status;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}
