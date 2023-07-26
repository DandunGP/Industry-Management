<?php

use App\Models\BillOfMaterial;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string("no_wo")->unique();
            $table->string("qty");
            $table->string("information");
            $table->foreignIdFor(Warehouse::class);
            $table->foreignIdFor(BillOfMaterial::class);
            $table->foreignIdFor(Warehouse::class, "plan_warehouse");
            $table->string("type");
            $table->string("qty_result");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
};
