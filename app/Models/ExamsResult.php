<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamsResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_exam',
        'second_exam',
        'third_exam',
    ];
}
