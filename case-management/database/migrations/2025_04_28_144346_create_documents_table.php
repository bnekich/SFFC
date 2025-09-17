<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable(); // Uploader
            $table->string('name'); // Original file name
            $table->string('path'); // Storage path
            $table->string('mime_type'); // e.g., application/pdf
            $table->bigInteger('size'); // File size in bytes
            $table->text('content')->nullable(); // Extracted text for full-text search
            $table->string('type'); // e.g., pdf, docx, image
            $table->timestamps();
            $table->softDeletes(); // Soft delete for documents
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
