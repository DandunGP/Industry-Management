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
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string("supply_code")->unique();
            $table->string("name");
            $table->string("type");
            $table->string("category");
            $table->string("merk");
            $table->string("memo");
            $table->string("part_number");
            $table->string("status");
            $table->integer("qty");
            $table->bigInteger("purchase_price");
            $table->bigInteger("selling_price");
            $table->foreignIdFor(Warehouse::class);
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
        Schema::dropIfExists('supplies');
    }
};
