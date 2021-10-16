<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArivagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arivages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bon_entrees_id')->constrained('bon_entrees')->onDelete('cascade');
            $table->string('article');
            $table->bigInteger('quantite');
            $table->double('prix_unitaire' , 12,2);
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
        Schema::dropIfExists('arivages');
    }
}
