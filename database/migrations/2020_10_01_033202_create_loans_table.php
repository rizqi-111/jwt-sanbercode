<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('tanggal_pinjam');
            $table->datetime('tanggal_pinjam_akhir');
            $table->datetime('tanggal_kembali');
            $table->boolean('ontime');
            $table->bigInteger('student_id');
            $table->unsignedBigInteger('book_id');

            $table->foreign('student_id')->references('users_id')->on('students');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
