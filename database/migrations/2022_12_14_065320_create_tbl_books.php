<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_books', function (Blueprint $table) {
            $table->increments('books_id');
            $table->string('books_name');
            $table->integer('authors_id');
            $table->integer('books_quantity');
            $table->integer('books_category_id');
            $table->string('books_slug')->unique();
            $table->integer('books_price');
            $table->string('books_image');
            $table->integer('books_status');
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
        Schema::dropIfExists('tbl_books');
    }
};
