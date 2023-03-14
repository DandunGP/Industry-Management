<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_wo',
        'wo_date',
        'qty',
        'information',
        'warehouse_id',
        'plan_warehouse',
        'type',
        'qty_result',
        'amount_cost',
    ];
}
