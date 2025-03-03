<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTables extends Migration
{
    public function up()
    {
        // Cases
        Schema::table('cases', function (Blueprint $table) {
            $table->foreign('client_family_id')->references('id')->on('families')->onDelete('set null');
            $table->foreign('host_family_id')->references('id')->on('families')->onDelete('set null');
            $table->foreign('assigned_staff_id')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
        });

        // Persons
        Schema::table('persons', function (Blueprint $table) {
            $table->foreign('person_type')->references('id')->on('persons_types')->onDelete('set null');
        });

        // Families
        Schema::table('families', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
        });

        // Persons_Roles
        Schema::table('persons_roles', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        // Relationships
        Schema::table('relationships', function (Blueprint $table) {
            $table->foreign('person_id_1')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('person_id_2')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('relationship_type_id')->references('id')->on('relationship_types')->onDelete('set null');
        });

        // Cases_Services
        Schema::table('cases_services', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });

        // Volunteers
        Schema::dropIfExists('volunteers');
        Schema::create('volunteers', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');
            $table->primary('person_id');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->timestamps();
            $table->string('created_by', 255);
            $table->string('updated_by', 255);
        });

        // Persons_Families
        Schema::table('persons_families', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
        });

        // Cases_Volunteers
        Schema::table('cases_volunteers', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('volunteer_id')->references('person_id')->on('volunteers')->onDelete('cascade');
        });

        // Organizations
        Schema::table('organizations', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
            $table->foreign('contact_person_id')->references('id')->on('persons')->onDelete('set null');
        });

        // Appointments
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
        });

        // Reminders
        Schema::table('reminders', function (Blueprint $table) {
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('set null');
            $table->foreign('for_person_id')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('reminder_type')->references('id')->on('reminder_types')->onDelete('set null');
        });

        // Appointments_Persons
        Schema::table('appointments_persons', function (Blueprint $table) {
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
        });

        // Courses
        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('instructor_id')->references('id')->on('persons')->onDelete('set null');
        });

        // Volunteers_Courses
        Schema::table('volunteers_courses', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('volunteer_id')->references('person_id')->on('volunteers')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Drop foreign keys in reverse order
        Schema::table('volunteers_courses', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['volunteer_id']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['instructor_id']);
        });

        Schema::table('appointments_persons', function (Blueprint $table) {
            $table->dropForeign(['appointment_id']);
            $table->dropForeign(['person_id']);
        });

        Schema::table('reminders', function (Blueprint $table) {
            $table->dropForeign(['appointment_id']);
            $table->dropForeign(['for_person_id']);
            $table->dropForeign(['reminder_type']);
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
            $table->dropForeign(['status_id']);
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropForeign(['contact_person_id']);
        });

        Schema::table('cases_volunteers', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
            $table->dropForeign(['volunteer_id']);
        });

        Schema::table('persons_families', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropForeign(['family_id']);
        });

        Schema::dropIfExists('volunteers'); //Drop the volunteers table.
        Schema::table('cases', function (Blueprint $table) {
            $table->dropForeign(['client_family_id']);
            $table->dropForeign(['host_family_id']);
            $table->dropForeign(['assigned_staff_id']);
            $table->dropForeign(['status_id']);
        });

        Schema::table('cases_volunteers', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
            $table->dropForeign(['volunteer_id']);
        });

        Schema::table('cases_services', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
            $table->dropForeign(['service_id']);
        });

        Schema::table('relationships', function (Blueprint $table) {
            $table->dropForeign(['person_id_1']);
            $table->dropForeign(['person_id_2']);
            $table->dropForeign(['relationship_type_id']);
        });

        Schema::table('persons_roles', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropForeign(['role_id']);
        });

        Schema::table('families', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropForeign(['status_id']);
        });

        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign(['person_type']);
        });
        Schema::table('volunteers', function(Blueprint $table){
            $table->dropForeign(['person_id']);
        });
    }
}
