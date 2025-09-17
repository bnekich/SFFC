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
            $table->bigInteger('appointment_id')->nullable();
            $table->bigInteger('person_id')->nullable();
            $table->timestamps();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments_persons');
    }
}
