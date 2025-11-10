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
            $table->foreignId('case_id')->constrained('cases')->onDelete('set null');
            $table->foreignId('service_id')->constrained('services')->onDelete('set null');
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->constrained('users')->onDelete('set null');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cases_services');
    }
}
