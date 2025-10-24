<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('note_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('note_statuses');
    }
}
