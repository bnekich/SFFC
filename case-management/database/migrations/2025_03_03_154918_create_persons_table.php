<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->date('date_of_birth');
            $table->char('gender', 1);
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->boolean('can_text_reminder')->default(true);
            $table->boolean('can_email_reminder')->default(true);
            $table->string('ethnicity', 2)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
