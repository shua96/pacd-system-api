<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertififactionFaqs extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'answer',
    ];
}
