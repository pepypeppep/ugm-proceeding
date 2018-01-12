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
            $table->text('abstract')->nullable();
            $table->string('keywords', 100)->nullable();
            $table->integer('start_page')->nullable();
            $table->integer('end_page')->nullable();
            $table->integer('views')->default(0)->nullable();
            $table->integer('downloads')->default(0)->nullable();
            $table->integer('cites')->default(0)->nullable();
            $table->string('file', 250)->nullable();
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
