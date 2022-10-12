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
        Schema::create('vendor_password_reset', function (Blueprint $table) {
             $table->id();
             $table->string('email')->nullable();
             $table->string('country_code')->nullable();
             $table->string('phone_no')->nullable();
             $table->string('token')->nullable();
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
        Schema::dropIfExists('vendor_password_reset');
    }
};
