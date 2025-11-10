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
            $table->foreignId('case_id')->constrained('cases')->onDelete('restrict');
            $table->foreignId('volunteer_id')->constrained('volunteers')->onDelete('restrict');
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->constrained('users')->onDelete('set null');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cases_volunteers');
    }
}
