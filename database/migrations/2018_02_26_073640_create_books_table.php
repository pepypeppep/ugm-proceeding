<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->string('description', 1000)->nullable();
            $table->string('category', 20)->nullable();
            $table->integer('edition')->nullable();
            $table->integer('pages')->nullable();
            $table->year('publication_year');
            $table->string('publisher', 200);
            $table->string('file', 300)->nullable();
            $table->string('cover', 300)->nullable();
            $table->integer('isbn')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('books');
    }
}
