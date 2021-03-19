<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSortieDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sortie_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bon_sorties_id')->constrained('bon_sorties')->onDelete('cascade');
            $table->string('article');
            $table->string('description');
            $table->bigInteger('quantite');
            $table->bigInteger('total_quantite');
            $table->double('prix_unitaire' , 12,2);
            $table->double('prix_total' , 12,2);
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
        Schema::dropIfExists('sortie_details');
    }
}
