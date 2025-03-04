<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReminderTypesTable extends Migration
{
    public function up()
    {
        Schema::create('reminder_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reminder_types');
    }
}