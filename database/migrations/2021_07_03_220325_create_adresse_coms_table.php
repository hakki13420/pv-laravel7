<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdresseComsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresse_coms', function (Blueprint $table) {
            $table->id();
            $table->string('num')->nullable();
            $table->string('adresse_com');

            $table->unsignedBigInteger('commercant_id')->nullable();
            $table->foreign('commercant_id')->references('id')->on('commercants')->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('adresse_coms');
    }
}
