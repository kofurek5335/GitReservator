<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Reservator\Reservation;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Reservation::TABLE_NAME, function (Blueprint $table) {
            $table->increments(Reservation::COLUMN_ID);
            $table->integer(Reservation::COLUMN_NUMBER_OF_PEOPLE);
            $table->timestamp(Reservation::COLUMN_START_AT)->nullable();
            $table->timestamp(Reservation::COLUMN_END_AT)->nullable();
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
        Schema::dropIfExists(Reservation::TABLE_NAME);
    }
}
