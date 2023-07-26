<?php

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
        Schema::create('incomings', function (Blueprint $table) {
            $table->id();
            $table->string("no_bpb");
            $table->string("no_po");
            $table->string("po_date");
            $table->string("address");
            $table->string("supplier");
            $table->string("no_sj_supplier");
            $table->foreignIdFor(Supply::class);
            $table->string("qty");
            $table->string("information");
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
        Schema::dropIfExists('incomings');
    }
};
