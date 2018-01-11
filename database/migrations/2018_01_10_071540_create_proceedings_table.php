<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceedings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('alias', 100)->nullable();
            $table->string('front_cover', 250)->nullable();
            $table->string('back_cover', 250)->nullable();
            $table->string('isbn', 13)->nullable();
            $table->string('issn', 8)->nullable();
            $table->string('organizer', 100)->nullable();
            $table->text('introduction')->nullable();
            $table->string('location')->nullable();
            $table->date('conference_start')->nullable();
            $table->date('conference_end')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('proceedings');
    }
}
