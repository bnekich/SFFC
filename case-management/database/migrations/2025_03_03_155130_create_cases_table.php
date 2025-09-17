<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_identifier', 255)->unique()->default('NA');
            $table->text('case_description');
            $table->bigInteger('client_family_id')->nullable();
            $table->bigInteger('host_family_id')->nullable();
            $table->bigInteger('assigned_staff_id')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status', 2)->default('O');
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
