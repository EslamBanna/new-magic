<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'organizer_id'];

    protected $hidden = ['created_at', 'updated_at'];
    
    public function getImagePathAttribute($value)
    {
        return asset('images/sliders/' . $value);
    }
}
