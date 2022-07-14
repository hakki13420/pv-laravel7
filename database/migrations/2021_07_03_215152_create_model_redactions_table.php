<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelRedactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_redactions', function (Blueprint $table) {
            $table->id();

            $table->text('model');

            //$table->string('lieux_n');
            $table->unsignedBigInteger('infraction_id')->nullable();
            $table->string('title');
            $table->foreign('infraction_id')->references('id')->on('infractions')->onUpdate('cascade')
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
        Schema::dropIfExists('model_redactions');
    }
}
