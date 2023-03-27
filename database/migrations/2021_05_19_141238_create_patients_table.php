<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('fatherName');
            $table->string('motherName');
            $table->string('password');
            $table->string('email');
            $table->string('userName');
            $table->string('gender');
            $table->integer('nationalityID');
            $table->date('birthday')->default(Carbon::createFromDate(0000-00-00));
            $table->string('bloodSymbol');
            $table->integer('phoneNumber')->nullable();
            $table->string('work')->nullable();
            $table->integer('avatarID')->nullable();
            $table->string('addressDetails')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
