<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsPersonsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments_persons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->timestamps();
            $table->string('created_by', 255);
            $table->string('updated_by', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments_persons');
    }
}