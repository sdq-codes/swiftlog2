<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikeRidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bike_riders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('rider_name');
            $table->string('duration');
            $table->string('duration');
            $table->uuid('bike_id');
            $table->foreign('bike_id')
                ->references('id')
                ->on('bikes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('bike_riders');
    }
}
