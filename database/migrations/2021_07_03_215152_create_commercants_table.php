<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nrc')->nullable();
            $table->string('name');
            $table->string('rais_soc')->nullable();
            $table->date('date_n');

            //$table->string('lieux_n');
            $table->unsignedBigInteger('lieux_n')->nullable();
            $table->foreign('lieux_n')->references('id')->on('communes')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('adresse_d');

            $table->unsignedBigInteger('commune_id')->nullable();
            $table->foreign('commune_id')->references('id')->on('communes')->onUpdate('cascade')
            ->onDelete('cascade');


            $table->string('tel')->nullable();
            $table->string('pere');
            $table->string('mere');

            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('commercants');
    }
}
