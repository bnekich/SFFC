<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesVolunteersTable extends Migration
{
    public function up()
    {
        Schema::create('cases_volunteers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('case_id')->nullable();
            $table->bigInteger('volunteer_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cases_volunteers');
    }
}
