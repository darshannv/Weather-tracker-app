<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('coordinates');
            $table->string('condition');
            $table->float('temperature');
            $table->float('feels_like');
            $table->float('humidity');
            $table->float('wind_speed');
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
        Schema::dropIfExists('weather');
    }
}
