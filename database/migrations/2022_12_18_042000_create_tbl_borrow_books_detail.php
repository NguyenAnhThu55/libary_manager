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
        Schema::create('tbl_borrow_books_detail', function (Blueprint $table) {
            $table->increments('borrow_detail_id');
            $table->integer('borrow_book_id');
            $table->integer('book_id');
            $table->string('book_name');
            $table->string('book_price');
            $table->string('book_image');
            $table->integer('user_id');
            $table->integer('user_name');
            $table->integer('user_phone');
            $table->integer('borrow_detail_status');
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
        Schema::dropIfExists('tbl_borrow_books_detail');
    }
};
