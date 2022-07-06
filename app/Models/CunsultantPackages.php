<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CunsultantPackages extends Model
{
    use HasFactory;

    protected $fillable = [
        'description_en',
        'description_ar',
        'price',
        'consultation_type_en',
        'consultation_type_ar',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
