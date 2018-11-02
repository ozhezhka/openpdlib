<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
	    $table->string('name');
        });

        Schema::create('b_category_b_category', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('b_category_id');
	    $table->unsignedInteger('parent_id');
        });

        Schema::create('b_category_book', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('book_id');             
            $table->unsignedInteger('b_category_id');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b_categories');
	Schema::dropIfExists('b_category_b_category');
	Schema::dropIfExists('b_category_book');
    }
}
