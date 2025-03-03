<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_identifier', 255)->unique()->default('NA');
            $table->text('case_description')->nullable();
            $table->unsignedBigInteger('client_family_id')->nullable();
            $table->unsignedBigInteger('host_family_id')->nullable();
            $table->unsignedBigInteger('assigned_staff_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
            $table->string('created_by', 255);
            $table->string('updated_by', 255);
            $table->comment('Tracks individual cases of support');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cases');
    }
}