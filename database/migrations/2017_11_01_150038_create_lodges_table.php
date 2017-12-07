<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLodgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lodges', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('lodge_name')->nullable();
            $table->string('lodge_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lodges');
    }
}
