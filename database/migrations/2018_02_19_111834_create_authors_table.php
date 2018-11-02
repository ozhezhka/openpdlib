<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('patronimic')->nullable();
            $table->string('surname')->nullable();
            $table->char('birth_year',4)->nullable();
            $table->char('death_year',4)->nullable();
	    $table->boolean('repressed')->nullable();
	    $table->char('rehabilitated_year',4)->nullable();
	    $table->string('WD')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
