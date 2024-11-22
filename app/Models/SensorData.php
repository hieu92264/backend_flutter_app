<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    // Để phép gán dữ liệu vào các cột cụ thể
    protected $fillable = [
        'rain',           // Trạng thái mưa
        'light',          // Trạng thái ánh sáng
        'temperature',    // Nhiệt độ
        'humidity',       // Độ ẩm
    ];
}
