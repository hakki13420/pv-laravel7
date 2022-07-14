<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTsaisieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tsaisie', function (Blueprint $table) {
            $table->bigIncrements('id');

            //$table->string('lieux_n');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('tsaisie_id');

            $table->string('qte');
            $table->string('unite');
            $table->string('pu');
            $table->string('somme');


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
        Schema::dropIfExists('product_tsaisie');
    }
}
