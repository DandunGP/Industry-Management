<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillOfMaterialSupply extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function supply()
    {
        return $this->belongsTo(Supply::class, 'supply_id', 'id');
    }
}
