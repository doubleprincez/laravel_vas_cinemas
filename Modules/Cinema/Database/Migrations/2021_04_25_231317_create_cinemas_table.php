<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCinemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('town_id');
            $table->string('name');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('seat_capacity')->nullable()->default(0);
            $table->longText('other_details')->nullable();
            $table->boolean('in_use')->nullable()->default(false);
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
        Schema::dropIfExists('cinemas');
    }
}
