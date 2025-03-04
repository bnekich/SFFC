<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsFamiliesTable extends Migration
{
    public function up()
    {
        Schema::create('persons_families', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->unsignedBigInteger('family_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons_families');
    }
}