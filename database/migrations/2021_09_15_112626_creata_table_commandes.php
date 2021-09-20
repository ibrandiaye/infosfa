<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreataTableCommandes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('nbfacom');
            $table->string('adresse');
            $table->unsignedBigInteger('distributeur_id');
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')
            ->references('id')
            ->on('departements');
            $table->foreign('distributeur_id')
            ->references('id')
            ->on('distributeurs');
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
        Schema::dropIfExists('commandes');
    }
}
