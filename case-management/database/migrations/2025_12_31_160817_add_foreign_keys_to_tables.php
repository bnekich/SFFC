<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTables extends Migration
{
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('note_status_id')->references('id')->on('note_statuses')->onDelete('set null');
            $table->foreign('note_privacy_id')->references('id')->on('note_privacies')->onDelete('set null');
        });

        Schema::table('notes_tags', function (Blueprint $table) {
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('set null');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('set null');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('volunteers', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('volunteer_status_id')->references('id')->on('volunteer_statuses')->onDelete('set null');
            $table->foreign('church_id')->references('id')->on('organizations')->onDelete('set null');
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->foreign('client_family_id')->references('id')->on('families')->onDelete('set null');
            $table->foreign('host_family_id')->references('id')->on('families')->onDelete('set null');
            $table->foreign('assigned_staff_id')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('case_status_id')->references('id')->on('case_statuses')->onDelete('set null');
        });

        // Intake
        Schema::table('intakes', function (Blueprint $table) {
            $table->foreign('completed_by_id')->references('id')->on('persons')->onDelete('cascade');
        });

        // Persons
        Schema::table('persons', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Families
        Schema::table('families', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
            //$table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Relationships
        Schema::table('relationships', function (Blueprint $table) {
            $table->foreign('person_id_1')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('person_id_2')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('relationship_type_id')->references('id')->on('relationship_types')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Cases_Services
        Schema::table('cases_services', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });


        // Persons_Families
        Schema::table('persons_families', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
        });

        // Cases_Volunteers
        Schema::table('cases_volunteers', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('volunteer_id')->references('id')->on('volunteers')->onDelete('cascade');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('set null');
            //$table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Reminders
        Schema::table('reminders', function (Blueprint $table) {
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('set null');
            $table->foreign('for_person_id')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('reminder_type')->references('id')->on('reminder_types')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Appointments_Persons
        Schema::table('appointments_persons', function (Blueprint $table) {
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Courses
        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('instructor_id')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Volunteers_Courses
        Schema::table('volunteers_courses', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('volunteer_id')->references('id')->on('volunteers')->onDelete('cascade');
        });

        // Persons_Organizations
        Schema::table('persons_organizations', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('persons_organizations', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropForeign(['organization_id']);
        });


        // Drop foreign keys in reverse order
        Schema::table('volunteers_courses', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['volunteer_id']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['instructor_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::table('appointments_persons', function (Blueprint $table) {
            $table->dropForeign(['appointment_id']);
            $table->dropForeign(['person_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::table('reminders', function (Blueprint $table) {
            $table->dropForeign(['appointment_id']);
            $table->dropForeign(['for_person_id']);
            $table->dropForeign(['reminder_type']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
            //$table->dropForeign(['status_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::table('persons_families', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropForeign(['family_id']);
        });

        Schema::table('cases_volunteers', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
            $table->dropForeign(['volunteer_id']);
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->dropForeign(['client_family_id']);
            $table->dropForeign(['host_family_id']);
            $table->dropForeign(['assigned_staff_id']);
            $table->dropForeign(['status_id']);
        });

        Schema::table('cases_services', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
            $table->dropForeign(['service_id']);
        });


        Schema::table('relationships', function (Blueprint $table) {
            $table->dropForeign(['person_id_1']);
            $table->dropForeign(['person_id_2']);
            $table->dropForeign(['relationship_type_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::table('families', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            //$table->dropForeign(['status_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign(['person_type']);
        });

        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropForeign(['volunteer_status_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });


        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
    }
}
