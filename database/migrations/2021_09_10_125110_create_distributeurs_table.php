<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributeurs', function (Blueprint $table) {
            $table->id();
            // '','','','',''
            $table->string('nomcomplet');
           // $table->integer('stock');
            $table->string('contact');
            // $table->longText('observation');
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')
            ->references('id')
            ->on('departements');
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
        Schema::dropIfExists('distributeurs');
    }
}
