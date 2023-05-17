<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOfMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_bom',
        'bom_code',
        'name',
        'information',
        'supply_id',
        'warehouse_id',
        'type_product',
        'qty',
        'amount_cost',
    ];

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
