<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_code',
        'name',
        'type',
        'memo',
        'category',
        'merk',
        'part_number',
        'status',
        'purchase_price',
        'selling_price',
    ];
}
