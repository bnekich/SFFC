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
            $table->foreignId('client_family_id')->nullable()->constrained('families')->onDelete('set null');
            $table->foreignId('host_family_id')->nullable()->constrained('families')->onDelete('set null');
            $table->foreignId('assigned_staff_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('case_status_id')->nullable()->constrained('case_statuses')->onDelete('set null');
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->constrained('users')->onDelete('restrict');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
