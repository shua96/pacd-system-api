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
        'region',
        'province',
        'city',
        'barangay',
        'contact',
        'email',
        'feedbacks',
        'reason',
        'actionprovided',
        'reco',
    ];


    protected $casts = [
        'feedbacks' => 'array',
    ];
}
