<?php

use App\Models\BillOfMaterial;
use App\Models\Supply;
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
        Schema::create('bill_of_material_supplies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BillOfMaterial::class);
            $table->foreignIdFor(Supply::class);
            $table->string('qty');
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
        Schema::dropIfExists('bill_of_material_supplies');
    }
};
