<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiviteComsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activite_coms', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->unsignedBigInteger('activite_id')->nullable();
            $table->foreign('activite_id')->references('id')
                ->on('activites')->onUpdate('cascade');

            $table->unsignedBigInteger('commercant_id')->nullable();
            $table->foreign('commercant_id')->references('id')
                    ->on('commercants')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('activite_coms');
    }
}
