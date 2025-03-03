<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 255);
            $table->string('provider', 255)->comment('internal or external');
            $table->timestamps();
            $table->string('created_by', 255);
            $table->string('updated_by', 255);
            $table->comment('Services offered or facilitated by SFFC');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}