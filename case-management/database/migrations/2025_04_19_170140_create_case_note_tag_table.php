<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseNoteTagTable extends Migration
{
    public function up()
    {
        Schema::create('case_note_tag', function (Blueprint $table) {
            $table->bigInteger('case_note_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->timestamps();
            $table->primary(['case_note_id', 'tag_id']);
            $table->foreign('case_note_id')->references('id')->on('case_notes')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('case_note_tag');
    }
}
