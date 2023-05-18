<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentClients extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'sex',
        'course_year',
        'qualification',
        'school',
        'address',
        'actionprovided',
    ];
}
