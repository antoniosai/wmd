<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InfoRestaurant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_restaurant_pusat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->text('tentang')->nullable();
            // $table->
            // $table->
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_restaurant_pusat');
    }
}
