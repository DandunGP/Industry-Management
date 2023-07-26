<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_wo',
        'qty',
        'information',
        'warehouse_id',
        'bill_of_material_id',
        'plan_warehouse',
        'type',
        'qty_result',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function billOfMaterial()
    {
        return $this->belongsTo(BillOfMaterial::class);
    }

    public function planWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'plan_warehouse');
    }
}
