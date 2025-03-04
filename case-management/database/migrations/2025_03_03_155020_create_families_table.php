<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('family_name', 255)->comment('e.g. Smith Family');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
            $table->string('created_by', 255);
            $table->string('updated_by', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('families');
    }
}