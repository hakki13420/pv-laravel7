<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfractionPvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infraction_pv', function (Blueprint $table) {
            $table->bigIncrements('id');

            //$table->string('lieux_n');
            $table->unsignedBigInteger('infraction_id');
            $table->unsignedBigInteger('pv_id');


            //$table->string('created_by');
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
        Schema::dropIfExists('infraction_pv');
    }
}
