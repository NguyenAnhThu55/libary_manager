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
        Schema::create('tbl_borrow_books', function (Blueprint $table) {
            $table->increments('borrow_books_id');
            $table->string('user_phone');
            $table->dateTime('return_date');
            $table->integer('borrow_books_status');
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
        Schema::dropIfExists('tbl_borrow_books');
    }
};
