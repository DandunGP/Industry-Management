<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'date_of_birth',
        'gender',
        'address',
        'phone',
        'position',
        'user_id',
    ];
}
