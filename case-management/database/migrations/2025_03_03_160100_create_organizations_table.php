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
            $table->bigInteger('organization_type_id')->nullable();
            $table->bigInteger('address_id')->nullable();
            $table->string('contact_person_name', 255)->nullable();
            $table->string('contact_person_title', 255)->nullable();
            $table->string('contact_person_email', 255)->nullable();
            $table->string('contact_person_phone', 255)->nullable();
            $table->string('contact_person_mobile', 255)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
