<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesServicesTable extends Migration
{
    public function up()
    {
        Schema::create('cases_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cases_services');
    }
}