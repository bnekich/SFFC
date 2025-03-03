<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTypesTable extends Migration
{
    public function up()
    {
        Schema::create('persons_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('person_types');
    }
}