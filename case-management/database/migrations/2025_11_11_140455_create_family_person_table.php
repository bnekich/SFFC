<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_person', function (Blueprint $table) {
            $table->foreignId('family_id')->constrained('families')->onDelete('restrict');
            $table->foreignId('person_id')->constrained('persons')->onDelete('restrict');
            $table->foreignId('relationship_type_id')->constrained('relationship_types')->onDelete('restrict');
            $table->boolean('is_primary_contact')->default(false);
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamp('left_at')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->constrained('users')->onDelete('restrict');
            $table->primary(['family_id', 'person_id', 'relationship_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_person');
    }
};
