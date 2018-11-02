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
            $table->timestamps();
	    $table->text('name')->nullable();
	    $table->text('name_orig')->nullable();
	    $table->text('annotation')->nullable();
	    $table->string('WD')->nullable();
	    $table->string('location')->nullable();
	    $table->string('publisher')->nullable();
	    $table->integer('volume')->nullable();
	    $table->integer('pages')->nullable();
	    $table->integer('terach')->nullable();
	    $table->char('year',4)->nullable();
	    $table->char('year_firstpub',4)->nullable();
	    $table->char('PD_from_year',4)->nullable();
	    $table->integer('p_d_template_id')->nullable();
	    $table->string('filename')->nullable();
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
