<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonEntreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_entrees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bon_number', 50);
            $table->date('bon_date')->nullable();
            $table->string('article', 50);
            $table->bigInteger( 'categorie_id' )->unsigned();
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->decimal('prix_unitaire',8,2);
            $table->decimal('prix_total',8,2);
            $table->integer('quantite');
            $table->string('received_by');
            $table->string('created_by', 999);
            $table->softDeletes();
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
        Schema::dropIfExists('bon_entrees');
    }
}
