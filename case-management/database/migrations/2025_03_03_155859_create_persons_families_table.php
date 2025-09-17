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
            $table->bigInteger('person_id')->nullable();
            $table->bigInteger('family_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons_families');
    }
}
