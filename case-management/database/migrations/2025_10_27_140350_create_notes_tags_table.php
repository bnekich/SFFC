<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //force
        Schema::create('notes_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')->constrained('notes')->onDelete('restrict');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes_tags');
    }
};
