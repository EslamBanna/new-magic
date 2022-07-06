<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CunsultantTests extends Model
{
    use HasFactory;
    protected $table = 'cunsultant_tests';

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'consult_id',
        'age',
        'phone',
        'job',
        'social_status',
        'apperance',
        'feel',
        'interest',
        'budget',
        'amount',
        'brand',
        'formats',
        'want'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
