<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsRolesTable extends Migration
{
    public function up()
    {
        Schema::create('persons_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons_roles');
    }
}