<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsaisiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsaisies', function (Blueprint $table) {
            $table->id();
            $table->string('num_saisie')->nullable();;
            $table->unsignedBigInteger('typesaisie_id')->nullable();
            $table->foreign('typesaisie_id')->references('id')
            ->on('typesaisies')->onUpdate('cascade');

            $table->unsignedBigInteger('pv_id')->nullable();
            $table->foreign('pv_id')->references('id')
            ->on('pvs')->onUpdate('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')
                    ->on('categories')->onUpdate('cascade');

            $table->date('date_saisie')->nullable();;
            $table->string('lieux_saisie')->nullable();;
            $table->string('depot_saisie')->nullable();;

            $table->string('quantite');
            $table->string('sommeDa');

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
        Schema::dropIfExists('tsaisies');
    }
}
