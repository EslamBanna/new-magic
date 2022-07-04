<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'organizer_id'];

    public function getImagePathAttribute($value)
    {
        return asset('images/sliders/' . $value);
    }
}
