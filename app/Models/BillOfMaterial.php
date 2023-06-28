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
    ];

    public function supply()
    {
        return $this->belongsToMany(Supply::class, 'bill_of_material_supplies', 'bill_of_material_id', 'supply_id');
    }

    public function bill_supply()
    {
        return $this->hasMany(BillOfMaterialSupply::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
