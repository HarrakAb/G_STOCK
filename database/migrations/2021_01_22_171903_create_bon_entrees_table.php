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
            $table->id('id');
            $table->string('bon_number', 50)->nullable();
            $table->date('bon_date')->nullable();
            $table->string('client_name' , 50);
            $table->double('total',12,2)->default(0.00);
            $table->string('created_by');
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
