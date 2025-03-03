<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->comment('Stores types of role a person is assigned (i.e., Staff, Volunteer, Client)');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}