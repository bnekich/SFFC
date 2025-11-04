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
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('ethnicity', 2);
            $table->char('gender', 1);
            $table->string('primary_language_spoken', 255);
            $table->date('date_of_birth');
            $table->boolean('is_homeless')->default(false);
            $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade');
            $table->string('email', 255);
            $table->string('mobile_phone', 20)->nullable();
            $table->string('other_phone', 255)->nullable();
            $table->foreignId('organization_id')->constrained('organizations')->onDelete('cascade'); //SFFC chapter
            $table->foreignId('organization_type_id')->constrained('organization_types')->onDelete('cascade'); //how did you hear about us?
            $table->string('referral_organization', 255)->nullable();
            $table->string('referral_contact', 255)->nullable();
            $table->string('referral_organization_phone', 255)->nullable();
            $table->string('referral_organization_email', 255)->nullable();
            $table->boolean('parent_declines_sffc_support')->nullable();
            $table->boolean('parent_agrees_to_sffc_support')->nullable();
            $table->boolean('parent_wants_more_info')->nullable();
            $table->string('urgency', '25');
            $table->boolean('requesting_host_family')->nullable();
            $table->boolean('requesting_family_friend')->nullable();
            $table->text('reason_for_assistance');
            $table->integer('number_of_children');
            $table->boolean('can_text_reminder')->default(true);
            $table->boolean('can_email_reminder')->default(true);
            $table->boolean('hasSFFCHistory')->nullable();
            $table->text('do_not_share_list')->nullable();
            $table->boolean('requesting_resource_friend')->nullable();
            $table->string('expected_support_duration', 10)->nullable();
            $table->string('family_preference', 255)->nullable();
            $table->text('known_risks')->nullable();
            $table->text('child_protective_services_experience')->nullable();
            $table->text('emotional_behavioral_medical_concerns')->nullable();
            $table->boolean('is_a_sffc_fit')->nullable();
            $table->text('resources_provided')->nullable();
            $table->foreignId('intake_status_id')->constrained('intake_statuses')->onDelete('cascade');
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
