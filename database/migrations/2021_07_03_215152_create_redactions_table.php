<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redactions', function (Blueprint $table) {
            $table->id();

            $table->text('redaction');

            //$table->string('lieux_n');
            $table->unsignedBigInteger('pv_id')->nullable();
            $table->foreign('pv_id')->references('id')->on('pvs')->onUpdate('cascade')
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
        Schema::dropIfExists('redactions');
    }
}
