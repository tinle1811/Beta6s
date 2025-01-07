<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class YeuThich extends Model
{
    use HasFactory, Notifiable;
 
    protected $table = 'yeu_thichs';
    protected $fillable = [
        'MaTK',
        'MaSP',
    ];
    public function product()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }
    public function user()
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTK','MaTK');
    }
}
