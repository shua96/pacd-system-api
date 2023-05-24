<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'sex',
        'address',
        'contact',
        'email',
        'feedbacks',
        'reason',
        'actionprovided',
    ];


    protected $casts = [
        'feedbacks' => 'array',
    ];
}
