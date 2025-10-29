<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->foreignId('organization_type_id')->constrained('organization_types')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('cascade');
            $table->bigInteger('organization_status_id')->nullable();
            $table->string('contact_person_name', 255)->nullable();
            $table->string('contact_person_title', 255)->nullable();
            $table->string('contact_person_email', 100)->nullable();
            $table->string('contact_person_phone', 50)->nullable();
            $table->string('contact_person_mobile', 50)->nullable();
            $table->string('organization_phone', 50)->nullable();
            $table->boolean('is_referring_agency')->default(false);
            $table->boolean('is_community_partner')->default(false);
            $table->string('county', 50)->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
