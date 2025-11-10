<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Person;

class CreateVolunteersTable extends Migration
{
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons')->onDelete('restrict');
            $table->string('county', 50)->nullable();
            $table->foreignId('church_id')->nullable()->constrained('organizations')->onDelete('set null');
            $table->foreignId('sffc_chapter_id')->nullable()->constrained('organizations')->onDelete('set null');
            $table->foreignId('volunteer_status_id')->constrained('volunteer_statuses')->onDelete('set null');
            $table->string('roles_requested', 255)->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->constrained('users')->onDelete('restrict');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('volunteers');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
