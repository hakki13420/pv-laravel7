<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infractions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();;
            $table->string('libelle_fr')->nullable();;
            $table->string('libelle');

            $table->string('lois');
            $table->string('articles');

            $table->string('lois_p');
            $table->string('articles_p');
            $table->float('amande')->default(0);

            $table->string('autres_mesures')->nullable();

            // $table->unsignedBigInteger('resultat_id');
            // $table->foreign('resultat_id')->references('id')->on('resultats')->onUpdate('cascade')
            //     ->onDelete('cascade');

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
        Schema::dropIfExists('infractions');
    }
}
