<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entree_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bon_entrees_id')->references('id')->on('bon_entrees')->onDelete('cascade');
            $table->string('article');
            $table->decimal('quantite');
            $table->decimal('prix_unitaire' , 8,2);
            $table->decimal('prix_total' , 8,2);
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
        Schema::dropIfExists('entree_details');
    }
}
