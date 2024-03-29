<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rate',
        'title',
        'comment',
    ];

    protected $hidden = ['updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTitleAttribute($value)
    {
        return $value ?? "";
    }

    public function getCommentAttribute($value)
    {
        return $value ?? "";
    }
}
