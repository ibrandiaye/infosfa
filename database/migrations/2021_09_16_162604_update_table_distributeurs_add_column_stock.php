<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableDistributeursAddColumnStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributeurs', function (Blueprint $table) {
            $table->integer('stock');
            $table->integer('commande');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributeurs', function (Blueprint $table) {
            $table->removeColumn('stock');
            $table->removeColumn('commande');
        });
    }
}
