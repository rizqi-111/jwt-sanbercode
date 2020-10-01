<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigInteger('users_id');
            $table->string('nama',100);
            $table->string('nim',12)->unique;
            $table->string('fakultas',100);
            $table->string('jurusan',100);
            $table->string('no_hp',15); 
            $table->string('no_wa',15); 
            $table->primary('users_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
