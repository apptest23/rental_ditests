<?php

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
        Schema::create('tranding_product', function (Blueprint $table) {
            $table->id();
            $table->Integer('product_id')->nullable();
            $table->Integer('vendor_id')->nullable();
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
        Schema::dropIfExists('tranding_product');
    }
};
