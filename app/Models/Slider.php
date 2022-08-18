<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'organizer_id',
        'title_en',
        'description_en',
        'title_ar',
        'description_ar',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function getImagePathAttribute($value)
    {
        return asset('images/sliders/' . $value);
    }

    public function getTitleEnAttribute($value)
    {
        return $value ?? "";
    }
    public function getDescriptionEnAttribute($value)
    {
        return $value ?? "";
    }
    public function getTitleArAttribute($value)
    {
        return $value ?? "";
    }
    public function getDescriptionArAttribute($value)
    {
        return $value ?? "";
    }
}
