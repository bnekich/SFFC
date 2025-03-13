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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Foreign key to users table
            $table->string('action', 255); // VARCHAR(255) for action description
            $table->string('model_type', 255)->nullable(); // Polymorphic type (e.g., 'Case', 'Patient')
            $table->unsignedBigInteger('model_id')->nullable(); // ID of the related model
            $table->text('details')->nullable(); // TEXT for additional context (JSON-encoded)
            $table->timestamp('created_at')->useCurrent(); // TIMESTAMP with current timestamp default

            // Indexes for performance
            $table->index('user_id', 'idx_user_id');
            $table->index('action', 'idx_action');
            $table->index(['model_type', 'model_id'], 'idx_model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
