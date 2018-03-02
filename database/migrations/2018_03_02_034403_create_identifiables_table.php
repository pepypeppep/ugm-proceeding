<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentifiablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identifiables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identifier_id')->unsigned();
            $table->integer('identifiable_id')->unsigned();
            $table->integer('identifiable_type')->unsigned();
            $table->string('code', 50)->nullable();
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
        Schema::dropIfExists('identifiables');
    }
}
