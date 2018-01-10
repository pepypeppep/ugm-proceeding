<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proceeding_id')->unsigned();
            $table->string('title', 300);
            $table->string('abstract', 500)->nullable();
            $table->string('keywords', 100)->nullable();
            $table->integer('start_page', 3)->nullable();
            $table->integer('end_page', 3)->nullable();
            $table->double('views')->default(0);
            $table->double('downloads')->default(0);
            $table->double('cites')->default(0);
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
        Schema::dropIfExists('articles');
    }
}
