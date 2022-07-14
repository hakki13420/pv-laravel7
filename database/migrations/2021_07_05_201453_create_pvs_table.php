<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pvs', function (Blueprint $table) {
            $table->id();

            $table->string('num_pv');

            $table->unsignedBigInteger('commercant_id')->nullable();
            $table->foreign('commercant_id')->references('id')
                ->on('commercants')->onUpdate('cascade');

            $table->unsignedBigInteger('activite_com_id')->nullable();
            $table->foreign('activite_com_id')->references('id')
                    ->on('activite_coms')->onUpdate('cascade');

            $table->unsignedBigInteger('adresse_com_id')->nullable();
            $table->foreign('adresse_com_id')->references('id')
                    ->on('adresse_coms')->onUpdate('cascade');

            $table->date('date_pv');
            $table->string('hour_pv');
            $table->string('min_pv');
            $table->date('date_constat');

            $table->unsignedBigInteger('user1')->nullable();
            $table->foreign('user1')->references('id')
                    ->on('users')->onUpdate('cascade');

            $table->unsignedBigInteger('user2')->nullable();
            $table->foreign('user2')->references('id')
                    ->on('users')->onUpdate('cascade');

            $table->unsignedBigInteger('user3')->nullable();
            $table->foreign('user3')->references('id')
                  ->on('users')->onUpdate('cascade');

            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')
                  ->on('services')->onUpdate('cascade');

            $table->string('num_conv');
            $table->date('date_conv');

            $table->text('redaction');

            $table->string('amande')->nullable();
            $table->text('commentaires')->nullable();
            $table->boolean('signature');
            $table->boolean('hasSaisie')->default(false);

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
        Schema::dropIfExists('pvs');
    }
}
