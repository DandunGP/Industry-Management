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
        'supply_id',
        'supplier',
        'address',
        'no_sj_supplier',
        'qty',
        'information',
    ];

    public function supply () {
        return $this->belongsTo(Supply::class,'supply_id','id');
    }
}
