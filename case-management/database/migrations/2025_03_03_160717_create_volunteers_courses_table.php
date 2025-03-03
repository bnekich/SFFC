<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteersCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('volunteers_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('volunteer_id')->nullable();
            $table->boolean('completed')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('volunteers_courses');
    }
}