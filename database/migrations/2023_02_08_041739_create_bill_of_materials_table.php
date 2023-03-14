<?php

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
        Schema::create('bill_of_materials', function (Blueprint $table) {
            $table->id();
            $table->string("no_bom");
            $table->string("bom_code");
            $table->string("name");
            $table->string("information");
            $table->string("supply_id");
            $table->foreignIdFor(Warehouse::class);
            $table->string("type_product");
            $table->integer("qty");
            $table->bigInteger("amount_cost");
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
        Schema::dropIfExists('bill_of_materials');
    }
};
