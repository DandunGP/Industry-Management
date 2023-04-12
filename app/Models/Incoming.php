<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_bpb',
        'no_po',
        'po_date',
        'date_of_receipt',
        'supplier',
        'address',
        'no_sj_supplier',
        'qty',
        'information',
    ];
}
