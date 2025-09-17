<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intakes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('completed_by_id')->nullable();
            $table->string('parent_name', 50)->nullable();
            $table->string('parent_phone', 20)->nullable();
            $table->date('referral_date')->nullable();
            $table->text('referral_contact')->nullable();
            $table->text('case_summary')->nullable();
            $table->boolean('hasSFFCHistory')->nullable();
            $table->text('do_not_share_list')->nullable();
            $table->boolean('requesting_host_family')->nullable();
            $table->boolean('requesting_family_friend')->nullable();
            $table->boolean('requesting_resource_friend')->nullable();
            $table->string('urgency', 10)->nullable();
            $table->string('expected_support_duration', 10)->nullable();
            $table->string('family_preference', 255)->nullable();
            $table->text('known_risks')->nullable();
            $table->text('child_protective_services_experience')->nullable();
            $table->text('emotional_behavioral_medical_concerns')->nullable();
            $table->boolean('is_a_sffc_fit')->nullable();
            $table->text('resources_provided')->nullable();
            $table->string('intake_status', 2)->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intakes');
    }
};
