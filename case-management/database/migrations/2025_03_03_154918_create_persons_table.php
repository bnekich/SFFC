<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->date('date_of_birth');
            $table->char('gender', 1);
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->boolean('can_text_reminder')->default(true);
            $table->boolean('can_email_reminder')->default(true);
            $table->unsignedBigInteger('person_type')->nullable();
            $table->timestamps();
            $table->string('created_by', 255);
            $table->string('updated_by', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons');
    }
}